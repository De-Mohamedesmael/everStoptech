@extends('layouts.app')
@section('title', __('lang.cash_out'))
@section('style')
    <link rel="stylesheet" type="text/css" href="{{ url('front/css/pos-modals.css') }}">

    <link rel="stylesheet" type="text/css" href="{{ url('front/css/main.css') }}">
@endsection
@section('content')
    <section class="forms py-0">
        <div class="container-fluid">
            <div class="col-md-12 px1
             no-print">
                <div
                    class="  d-flex align-items-center my-2 @if (app()->isLocale('ar')) justify-content-end @else justify-content-start @endif">
                    <h5 class="mb-0 position-relative print-title" style="margin-right: 30px">@lang('lang.cash_out')
                        <span class="header-pill"></span>
                    </h5>
                </div>

                <div class="card my-3">
                    <div class="card-body p-2">
                        <form action="">
                            <div class="row @if (app()->isLocale('ar')) flex-row-reverse @else flex-row @endif">

                                <div class="col-md-3 px-5">
                                    <div class="form-group">
                                        {!! Form::label('start_date', __('lang.start_date'), [
                                            'class' => 'form-label d-block mb-1 app()->isLocale("ar") ? text-end : text-start',
                                        ]) !!}
                                        {!! Form::text('start_date', request()->start_date, [
                                            'class' => 'form-control modal-input app()->isLocale("ar") ? text-end : text-start',
                                        ]) !!}
                                    </div>
                                </div>
                                <div class="col-md-3 px-5">
                                    <div class="form-group">
                                        {!! Form::label('start_time', __('lang.start_time'), [
                                            'class' => 'form-label d-block mb-1 app()->isLocale("ar") ? text-end : text-start',
                                        ]) !!}
                                        {!! Form::text('start_time', request()->start_time, [
                                            'class' => 'form-control time_picker sale_filter modal-input app()->isLocale("ar") ? text-end : text-start',
                                        ]) !!}
                                    </div>
                                </div>
                                <div class="col-md-3 px-5">
                                    <div class="form-group">
                                        {!! Form::label('end_date', __('lang.end_date'), [
                                            'class' => 'form-label d-block mb-1 app()->isLocale("ar") ? text-end : text-start',
                                        ]) !!}
                                        {!! Form::text('end_date', request()->end_date, [
                                            'class' => 'form-control modal-input app()->isLocale("ar") ? text-end : text-start',
                                        ]) !!}
                                    </div>
                                </div>
                                <div class="col-md-3 px-5">
                                    <div class="form-group">
                                        {!! Form::label('end_time', __('lang.end_time'), [
                                            'class' => 'form-label d-block mb-1 app()->isLocale("ar") ? text-end : text-start',
                                        ]) !!}
                                        {!! Form::text('end_time', request()->end_time, [
                                            'class' => 'form-control time_picker sale_filter modal-input app()->isLocale("ar") ? text-end : text-start',
                                        ]) !!}
                                    </div>
                                </div>
                                <div class="col-md-3 px-5">
                                    <div class="form-group">
                                        {!! Form::label('admin_id', __('lang.user'), [
                                            'class' => 'form-label d-block mb-1 app()->isLocale("ar") ? text-end : text-start',
                                        ]) !!}
                                        {!! Form::select('admin_id', $users, request()->admin_id, [
                                            'class' => 'form-control',
                                            'placeholder' => __('lang.all'),
                                            'data-live-search' => 'true',
                                        ]) !!}
                                    </div>
                                </div>
                                <div class="col-md-3 px-5">
                                    <div class="form-group">
                                        {!! Form::label('receiver_id', __('lang.receiver'), [
                                            'class' => 'form-label d-block mb-1 app()->isLocale("ar") ? text-end : text-start',
                                        ]) !!}
                                        {!! Form::select('receiver_id', $users, request()->receiver_id, [
                                            'class' => 'form-control',
                                            'placeholder' => __('lang.all'),
                                            'data-live-search' => 'true',
                                        ]) !!}
                                    </div>
                                </div>
                                <div class="col-md-3 px-5 d-flex justify-content-center align-items-center">

                                    <button type="submit" class="btn btn-main col-md-12">@lang('lang.filter')</button>
                                </div>
                                <div class="col-md-3 px-5 d-flex justify-content-center align-items-center">
                                    <a href="{{ action('CashOutController@index') }}"
                                        class="btn btn-danger col-md-12">@lang('lang.clear_filter')</a>
                                </div>

                            </div>
                        </form>
                    </div>
                </div>
                <div class="card my-3">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="store_table" class="table dataTable">
                                <thead>
                                    <tr>
                                        <th>@lang('lang.date_and_time')</th>
                                        <th>@lang('lang.user')</th>
                                        <th>@lang('lang.pos')</th>
                                        <th>@lang('lang.job_title')</th>
                                        <th>@lang('lang.receiver')</th>
                                        <th>@lang('lang.receiver_title')</th>
                                        <th class="sum">@lang('lang.amount')</th>
                                        <th>@lang('lang.notes')</th>

                                        <th class="notexport">@lang('lang.action')</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($cash_registers as $cash_register)
                                        <tr>
                                            <td>{{ @format_datetime($cash_register->created_at) }}</td>
                                            <td>{{ ucfirst($cash_register->cashier_name) }}</td>
                                            @php
                                                $employee = App\Models\Employee::find($cash_register->employee_id);
                                            @endphp
                                            <td>{{ ucfirst($employee->store_pos ?? '') }}</td>
                                            <td>{{ ucfirst($cash_register->job_title ?? '') }}</td>
                                            @if ($cash_register->transaction_type == 'add_stock')
                                                @php
                                                    $supplier_name = $cash_register->transaction->supplier->name ?? '';
                                                @endphp
                                                <td>{{ ucfirst($supplier_name ?? '') }}</td>
                                            @elseif ($cash_register->transaction_type == 'expense')
                                                @php
                                                    $beneficiary_name =
                                                        $cash_register->transaction->expense_beneficiary->name ?? '';
                                                @endphp
                                                <td>{{ ucfirst($beneficiary_name ?? '') }}</td>
                                            @elseif ($cash_register->transaction_type == 'wages_and_compensation')
                                                @php
                                                    $employee_name =
                                                        $cash_register->transaction->wages_and_compensation->employee
                                                            ->employee_name ?? '';
                                                @endphp
                                                <td>{{ ucfirst($employee_name ?? '') }}</td>
                                            @else
                                                <td>{{ ucfirst($cash_register->source->name ?? '') }}</td>
                                            @endif
                                            @if ($cash_register->transaction_type == 'add_stock')
                                                <td>@lang('lang.supplier')</td>
                                            @elseif ($cash_register->transaction_type == 'expense')
                                                <td>@lang('lang.beneficiary')</td>
                                            @elseif ($cash_register->transaction_type == 'expense')
                                                <td>{{ $cash_register->transaction->wages_and_compensation->employee->employee_name ?? '' }}
                                                </td>
                                            @else
                                                <td>{{ ucfirst($cash_register->source->employee->job_type->job_title ?? '') }}
                                                </td>
                                            @endif
                                            <td>{{ @num_format($cash_register->amount) }}</td>
                                            <td>{{ $cash_register->notes }}</td>

                                            <td>
                                                <div class="btn-group">
                                                    <button type="button" class="btn btn-default btn-sm dropdown-toggle"
                                                        data-toggle="dropdown" aria-haspopup="true"
                                                        aria-expanded="false">@lang('lang.action')
                                                        <span class="caret"></span>
                                                        <span class="sr-only">Toggle Dropdown</span>
                                                    </button>
                                                    <ul class="dropdown-menu edit-options dropdown-menu-right dropdown-default"
                                                        user="menu">
                                                        @can('cash.add_cash_out.create_and_edit')
                                                            <li>
                                                                <a data-href="{{ action('CashOutController@edit', $cash_register->id) }}"
                                                                    data-container=".view_modal" class="btn btn-modal"><i
                                                                        class="dripicons-document-edit"></i>
                                                                    @lang('lang.edit')</a>
                                                            </li>
                                                            <li class="divider"></li>
                                                        @endcan
                                                        @can('cash.add_cash_out.delete')
                                                            <li>
                                                                <a data-href="{{ action('CashOutController@destroy', $cash_register->id) }}"
                                                                    data-check_password="{{ action('AdminController@checkPassword', Auth::user()->id) }}"
                                                                    class="btn text-red delete_item"><i class="fa fa-trash"></i>
                                                                    @lang('lang.delete')</a>
                                                            </li>
                                                        @endcan


                                                    </ul>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <th style="text-align: right">@lang('lang.total')</th>
                                        <td></td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('javascript')

@endsection
