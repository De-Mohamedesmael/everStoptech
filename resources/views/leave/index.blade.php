@extends('layouts.app')
@section('title', __('lang.leave'))
@section('style')
    <link rel="stylesheet" type="text/css" href="{{ url('front/css/pos-modals.css') }}">

    <link rel="stylesheet" type="text/css" href="{{ url('front/css/main.css') }}">
@endsection
@section('content')
    <section class="forms py-0">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12 px-1">
                    <div
                        class="d-flex align-items-center my-2 @if (app()->isLocale('ar')) justify-content-end @else justify-content-start @endif">
                        <h5 class="mb-0 position-relative print-title" style="margin-right: 30px">
                            @lang('lang.list_of_employees_in_leave')
                            <span class="header-pill"></span>
                        </h5>
                    </div>
                    <div class="card mb-2">
                        <div class="card-body d-flex justify-content-center p-2">
                            <button type="button" class="btn btn-main col-md-3 btn-modal "
                                data-href="{{ action('LeaveController@create') }}" data-container=".view_modal">
                                @lang('lang.submit_a_leave')</button>
                        </div>
                    </div>

                    <div class="card mb-2">
                        <div class="card-body p-2">
                            <form action="">
                                <div class="row @if (app()->isLocale('ar')) flex-row-reverse @else flex-row @endif">
                                    <div class="col-md-4 px-5">
                                        <div class="form-group">
                                            {!! Form::label('start_date', __('lang.start_date'), [
                                                'class' => 'form-label d-block mb-1 app()->isLocale("ar") ? text-end : text-start',
                                            ]) !!}
                                            {!! Form::text('start_date', request()->start_date, [
                                                'class' => 'form-control  modal-input app()->isLocale("ar") ? text-end : text-start',
                                            ]) !!}
                                        </div>
                                    </div>
                                    <div class="col-md-4 px-5">
                                        <div class="form-group">
                                            {!! Form::label('end_date', __('lang.end_date'), [
                                                'class' => 'form-label d-block mb-1 app()->isLocale("ar") ? text-end : text-start',
                                            ]) !!}
                                            {!! Form::text('end_date', request()->end_date, [
                                                'class' => 'form-control  modal-input app()->isLocale("ar") ? text-end : text-start',
                                            ]) !!}
                                        </div>
                                    </div>
                                    <div class="col-md-4 px-5 d-flex justify-content-center align-items-center">
                                        <button type="submit" class="btn btn-main col-md-12">@lang('lang.filter')</button>
                                    </div>

                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="card mb-2">
                        <div class="card-body p-2">

                            <table class="table dataTable">
                                <thead>
                                    <tr>
                                        <th>@lang('lang.employee_name')</th>
                                        <th>@lang('lang.profile_photo')</th>
                                        <th>@lang('lang.job_title')</th>
                                        <th>@lang('lang.leave_type')</th>
                                        <th>@lang('lang.start_date')</th>
                                        <th>@lang('lang.end_date')</th>
                                        <th>@lang('lang.rejoining_date')</th>
                                        <th>@lang('lang.leave_balance')</th>
                                        <th class="notexport">@lang('lang.action')</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($leaves as $leave)
                                        <tr>
                                            <td>
                                                {{ $leave->name }}
                                            </td>
                                            <td>
                                                @php
                                                    $employee = App\Models\Employee::find($leave->employee_id);
                                                @endphp
                                                <img src="@if (!empty($employee->getFirstMediaUrl('employee_photo'))) {{ $employee->getFirstMediaUrl('employee_photo') }}@else{{ asset('images/default.jpg') }} @endif"
                                                    style="width: 60px; border: 2px solid #fff; padding: 4px;" />
                                            </td>
                                            <td>
                                                {{ $leave->job_title }}
                                            </td>
                                            <td>
                                                {{ $leave->leave_type_name }}
                                            </td>
                                            <td>
                                                {{ @format_date($leave->start_date) }}
                                            </td>
                                            <td>
                                                {{ @format_date($leave->end_date) }}
                                            </td>
                                            <td>
                                                {{ @format_date($leave->rejoining_date) }}
                                            </td>

                                            <td>
                                                @php
                                                    $balance_leaves = App\Models\Employee::getBalanceLeave(
                                                        $leave->employee_id,
                                                    );
                                                @endphp
                                                <a style="cursor: pointer;"
                                                    data-href="/hrm/leave/get-leave-details/{{ $leave->employee_id }}?start_date={{ request()->start_date }}&end_date={{ request()->end_date }}"
                                                    data-container=".view_modal" class="btn-modal">
                                                    {{ @num_format($balance_leaves) }} </a>
                                            </td>
                                            <td>
                                                @can('hr_management.leaves.view')
                                                    <a data-href="{{ action('LeaveController@show', $leave->id) }}"
                                                        class="btn btn-danger text-white view_leave btn-modal"
                                                        data-container=".view_modal"><i class="fa fa-eye"></i></a>
                                                @endcan
                                                @can('hr_management.leaves.create_and_edit')
                                                    <a data-href="{{ action('LeaveController@edit', $leave->id) }}"
                                                        class="btn btn-danger text-white edit_leave btn-modal"
                                                        data-container=".view_modal"><i class="fa fa-pencil-square-o"></i></a>
                                                @endcan
                                                @can('hr_management.leaves.delete')
                                                    <a data-href="{{ action('LeaveController@destroy', $leave->id) }}"
                                                        data-check_password="{{ action('AdminController@checkPassword', Auth::user()->id) }}"
                                                        class="btn btn-danger text-white delete_item"><i
                                                            class="fa fa-trash"></i></a>
                                                @endcan
                                            </td>
                                        </tr>
                                    @endforeach


                                </tbody>

                            </table>

                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="modal fade second_modal" role="dialog" aria-hidden="true"></div>
    </section>
    @endsection @section('javascript')
    <script></script>
@endsection
