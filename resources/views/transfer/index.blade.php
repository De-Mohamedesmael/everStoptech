@extends('layouts.app')
@section('title', __('lang.all_transfers'))
@section('style')
    <link rel="stylesheet" type="text/css" href="{{ url('front/css/main.css') }}">
@endsection
@section('content')
    <section class="forms py-0">
        <div class="container-fluid">
            <div class=" no-print">
                <div
                    class=" print-title d-flex align-items-center my-2 @if (app()->isLocale('ar')) justify-content-end @else justify-content-start @endif">
                    <h5 class="mb-0 position-relative" style="margin-right: 30px">
                        @lang('lang.all_transfers')
                        <span class="header-pill"></span>
                    </h5>
                </div>
                <div class="card my-3">
                    <div class="card-body p-2">
                        <form action="">
                            <div class="row @if (app()->isLocale('ar')) flex-row-reverse @else flex-row @endif">
                                <div class="col-md-3 px-5">
                                    <div class="form-group">
                                        {!! Form::label('sender_store_id', __('lang.sender_store'), [
                                            'class' => 'form-label d-block mb-1 app()->isLocale("ar") ? text-end : text-start',
                                        ]) !!}
                                        {!! Form::select('sender_store_id', $stores, null, [
                                            'class' => 'selectpicker form-control',
                                            'data-live-search' => 'true',
                                            'style' => 'width: 80%',
                                            'placeholder' => __('lang.please_select'),
                                        ]) !!}
                                    </div>
                                </div>
                                <div class="col-md-3 px-5">
                                    <div class="form-group">
                                        {!! Form::label('receiver_store_id', __('lang.receiver_store'), [
                                            'class' => 'form-label d-block mb-1 app()->isLocale("ar") ? text-end : text-start',
                                        ]) !!}
                                        {!! Form::select('receiver_store_id', $stores, null, [
                                            'class' => 'selectpicker form-control',
                                            'data-live-search' => 'true',
                                            'style' => 'width: 80%',
                                            'placeholder' => __('lang.please_select'),
                                        ]) !!}
                                    </div>
                                </div>

                                <div class="col-md-3 px-5">
                                    <div class="form-group">
                                        {!! Form::label('start_date', __('lang.start_date'), [
                                            'class' => 'form-label d-block mb-1 app()->isLocale("ar") ? text-end : text-start',
                                        ]) !!}
                                        {!! Form::text('start_date', request()->start_date, [
                                            'class' => 'form-control  modal-input app()->isLocale("ar") ? text-end : text-start',
                                        ]) !!}
                                    </div>
                                </div>
                                <div class="col-md-3 px-5">
                                    <div class="form-group">
                                        {!! Form::label('start_time', __('lang.start_time'), [
                                            'class' => 'form-label d-block mb-1 app()->isLocale("ar") ? text-end : text-start',
                                        ]) !!}
                                        {!! Form::text('start_time', request()->start_time, [
                                            'class' => 'form-control  modal-input app()->isLocale("ar") ? text-end : text-start time_picker sale_filter',
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
                                            'class' => 'form-control  modal-input app()->isLocale("ar") ? text-end : text-start time_picker sale_filter',
                                        ]) !!}
                                    </div>
                                </div>
                                <div class="col-md-3 px-5 d-flex justify-content-center align-items-center">
                                    <button type="submit" class="btn w-100 py-1 btn-success">@lang('lang.filter')</button>
                                </div>
                                <div class="col-md-3 px-5 d-flex justify-content-center align-items-center">
                                    <a href="{{ action('TransferController@index') }}"
                                        class="btn w-100 py-1 btn-danger">@lang('lang.clear_filter')</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="card my-3">
                <div class="card-body p-2">
                    <div class="table-responsive no-print">
                        <table id="sales_table" class="table dataTable">
                            <thead>
                                <tr>
                                    <th>@lang('lang.date')</th>
                                    <th>@lang('lang.reference')</th>
                                    <th>@lang('lang.created_by')</th>
                                    <th>@lang('lang.approved_at')</th>
                                    <th>@lang('lang.received_at')</th>
                                    <th>@lang('lang.sender_store')</th>
                                    <th>@lang('lang.receiver_store')</th>
                                    <th class="sum">@lang('lang.value_of_transaction')</th>
                                    <th>@lang('lang.status')</th>
                                    <th>@lang('lang.notes')</th>
                                    <th class="notexport">@lang('lang.action')</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($transfers as $transfer)
                                    <tr>
                                        <td>{{ @format_date($transfer->transaction_date) }}</td>
                                        <td>{{ $transfer->invoice_no }}</td>
                                        <td>{{ ucfirst($transfer->created_by_user->name ?? '') }}</td>
                                        <td>
                                            @if (!empty($transfer->approved_at))
                                                {{ @format_date($transfer->approved_at) }}
                                            @endif
                                        </td>
                                        <td>
                                            @if (!empty($transfer->received_at))
                                                {{ @format_date($transfer->received_at) }}
                                            @endif
                                        </td>
                                        <td>{{ ucfirst($transfer->sender_store->name ?? '') }}</td>
                                        <td>{{ ucfirst($transfer->receiver_store->name ?? '') }}</td>
                                        <td>{{ @num_format($transfer->final_total) }}</td>
                                        <td>
                                            @if ($transfer->status == 'received')
                                                {{ __('lang.received') }}@else{{ ucfirst($transfer->status) }}
                                            @endif
                                        </td>
                                        <td>{{ $transfer->notes }}</td>
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
                                                    @if ($transfer->is_raw_material == 1)
                                                        @if ($transfer->is_internal_stock_transfer == 1 && $transfer->status != 'final')
                                                            <li>
                                                                <a data-href="{{ action('InternalStockRequestController@getUpdateStatus', $transfer->id) }}"
                                                                    data-container=".view_modal" class="btn btn-modal"><i
                                                                        class="fa fa-arrow-up"></i>
                                                                    @lang('lang.update_status')</a>
                                                            </li>
                                                            <li class="divider"></li>
                                                        @endif
                                                        @can('raw_material_module.transfer.view')
                                                            <li>

                                                                <a data-href="{{ action('TransferController@show', $transfer->id) }}"
                                                                    data-container=".view_modal" class="btn btn-modal"><i
                                                                        class="fa fa-eye"></i>
                                                                    @lang('lang.view')</a>
                                                            </li>
                                                            <li class="divider"></li>
                                                        @endcan
                                                        @can('raw_material_module.transfer.view')
                                                            <li>

                                                                <a href="{{ action('TransferController@print', $transfer->id) }}?print=true"
                                                                    class="btn"><i class="dripicons-print"></i>
                                                                    @lang('lang.print')</a>
                                                            </li>
                                                            <li class="divider"></li>
                                                        @endcan
                                                        @can('raw_material_module.transfer.create_and_edit')
                                                            <li>

                                                                <a href="/raw-materials/transfer/{{ $transfer->id }}/edit"
                                                                    class="btn"><i class="dripicons-document-edit"></i>
                                                                    @lang('lang.edit')</a>
                                                            </li>
                                                            <li class="divider"></li>
                                                        @endcan

                                                        @can('raw_material_module.transfer.delete')
                                                            <li>
                                                                <a data-href="{{ action('TransferController@destroy', $transfer->id) }}"
                                                                    data-check_password="{{ action('AdminController@checkPassword', Auth::guard('admin')->user()->id) }}"
                                                                    class="btn text-red delete_item"><i class="fa fa-trash"></i>
                                                                    @lang('lang.delete')</a>
                                                            </li>
                                                        @endcan
                                                    @else
                                                        @if ($transfer->is_internal_stock_transfer == 1 && $transfer->status != 'final')
                                                            <li>
                                                                <a data-href="{{ action('InternalStockRequestController@getUpdateStatus', $transfer->id) }}"
                                                                    data-container=".view_modal" class="btn btn-modal"><i
                                                                        class="fa fa-arrow-up"></i>
                                                                    @lang('lang.update_status')</a>
                                                            </li>
                                                            <li class="divider"></li>
                                                        @endif
                                                        @can('stock.transfer.view')
                                                            <li>

                                                                <a data-href="{{ action('TransferController@show', $transfer->id) }}"
                                                                    data-container=".view_modal" class="btn btn-modal"><i
                                                                        class="fa fa-eye"></i>
                                                                    @lang('lang.view')</a>
                                                            </li>
                                                            <li class="divider"></li>
                                                        @endcan
                                                        @can('stock.transfer.view')
                                                            <li>

                                                                <a href="{{ action('TransferController@print', $transfer->id) }}?print=true"
                                                                    class="btn"><i class="dripicons-print"></i>
                                                                    @lang('lang.print')</a>
                                                            </li>
                                                            <li class="divider"></li>
                                                        @endcan
                                                        @can('stock.transfer.create_and_edit')
                                                            <li>

                                                                <a href="{{ action('TransferController@edit', $transfer->id) }}"
                                                                    class="btn"><i class="dripicons-document-edit"></i>
                                                                    @lang('lang.edit')</a>
                                                            </li>
                                                            <li class="divider"></li>
                                                        @endcan

                                                        @can('stock.transfer.delete')
                                                            <li>
                                                                <a data-href="{{ action('TransferController@destroy', $transfer->id) }}"
                                                                    data-check_password="{{ action('AdminController@checkPassword', Auth::guard('admin')->user()->id) }}"
                                                                    class="btn text-red delete_item"><i class="fa fa-trash"></i>
                                                                    @lang('lang.delete')</a>
                                                            </li>
                                                        @endcan
                                                    @endif
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
    </section>

    <!-- This will be printed -->
    <section class="invoice print_section print-only" id="receipt_section"> </section>
@endsection

@section('javascript')
    <script src="{{ asset('js/transfer.js') }}"></script>
    <script>
        table
            .column('0:visible')
            .order('desc')
            .draw();

        $(document).on('click', '#update-status', function(e) {
            e.preventDefault();
            if ($('#update_status_form').valid()) {
                $('#update_status_form').submit();
            }
        })
    </script>
@endsection
