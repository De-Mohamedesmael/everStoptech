@extends('layouts.app')
@section('title', __('lang.employee'))
@section('style')
    <link rel="stylesheet" type="text/css" href="{{ url('front/css/stock.css') }}">
@endsection
@section('content')
    <section class="forms py-0">

        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12 px-1 no-print">
                    <div
                        class="d-flex align-items-center my-2 @if (app()->isLocale('ar')) justify-content-end @else justify-content-start @endif">
                        <h5 class="mb-0 position-relative print-title" style="margin-right: 30px">
                            @lang('lang.employees')
                            <span class="header-pill"></span>
                        </h5>
                    </div>
                    @can('hr_management.employee.create_and_edit')
                        <div class="card mb-2">
                            <div class="card-body d-flex justify-content-center p-2">
                                <a style="color: white" href="{{ action('EmployeeController@create') }}"
                                    class="btn btn-main col-md-3"><i class="dripicons-plus"></i>
                                    @lang('lang.add_new_employee')</a>
                            </div>
                        </div>
                    @endcan
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
                                                'class' => 'form-control  filter modal-input app()->isLocale("ar") ? text-end : text-start',
                                            ]) !!}
                                        </div>
                                    </div>
                                    <div class="col-md-3 px-5">
                                        <div class="form-group">
                                            {!! Form::label('start_time', __('lang.start_time'), [
                                                'class' => 'form-label d-block mb-1 app()->isLocale("ar") ? text-end : text-start',
                                            ]) !!}
                                            {!! Form::text('start_time', request()->start_time, [
                                                'class' => 'form-control time_picker filter modal-input app()->isLocale("ar") ? text-end : text-start',
                                            ]) !!}
                                        </div>
                                    </div>
                                    <div class="col-md-3 px-5">
                                        <div class="form-group">
                                            {!! Form::label('end_date', __('lang.end_date'), [
                                                'class' => 'form-label d-block mb-1 app()->isLocale("ar") ? text-end : text-start',
                                            ]) !!}
                                            {!! Form::text('end_date', request()->end_date, [
                                                'class' => 'form-control filter modal-input app()->isLocale("ar") ? text-end : text-start',
                                            ]) !!}
                                        </div>
                                    </div>
                                    <div class="col-md-3 px-5">
                                        <div class="form-group">
                                            {!! Form::label('end_time', __('lang.end_time'), [
                                                'class' => 'form-label d-block mb-1 app()->isLocale("ar") ? text-end : text-start',
                                            ]) !!}
                                            {!! Form::text('end_time', request()->end_time, [
                                                'class' => 'form-control time_picker filter modal-input app()->isLocale("ar") ? text-end : text-start',
                                            ]) !!}
                                        </div>
                                    </div>
                                    <div class="col-md-3 px-5">
                                        <div class="form-group">
                                            {!! Form::label('payment_status', __('lang.payment_status'), [
                                                'class' => 'form-label d-block mb-1 app()->isLocale("ar") ? text-end : text-start',
                                            ]) !!}
                                            {!! Form::select(
                                                'payment_status',
                                                ['pending' => __('lang.pending'), 'paid' => __('lang.paid')],
                                                request()->payment_status,
                                                ['class' => 'form-control filter', 'placeholder' => __('lang.all'), 'data-live-search' => 'true'],
                                            ) !!}
                                        </div>
                                    </div>
                                    <div class="col-md-3 px-5 d-flex justify-content-center align-items-center">
                                        <button class="btn btn-main col-md-12" type="submit">@lang('lang.filter')</button>
                                    </div>
                                    <div class="col-md-3 px-5 d-flex justify-content-center align-items-center">
                                        <a href="{{ action('EmployeeController@index') }}"
                                            class="btn btn-danger col-md-12">@lang('lang.clear_filter')</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="card my-3">
                        <div class="card-body p-2">
                            <div class="table-responsive">
                                <table class="table" id="employee_table">
                                    <thead>
                                        <tr>
                                            <th>@lang('lang.profile_photo')</th>
                                            <th>@lang('lang.employee_name')</th>
                                            <th>@lang('lang.email')</th>
                                            <th>@lang('lang.mobile')</th>
                                            <th>@lang('lang.job_title')</th>
                                            <th class="sum">@lang('lang.wage')</th>
                                            <th>@lang('lang.annual_leave_balance')</th>
                                            <th>@lang('lang.age')</th>
                                            <th>@lang('lang.start_working_date')</th>
                                            <th>@lang('lang.current_status')</th>
                                            <th>@lang('lang.store')</th>
                                            <th>@lang('lang.pos')</th>
                                            <th>@lang('lang.commission')</th>
                                            <th>@lang('lang.total_paid')</th>
                                            <th>@lang('lang.pending')</th>
                                            <th class="notexport">@lang('lang.action')</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        {{-- @foreach ($employees as $employee)
                                                <tr>
                                                    <td><img src="@if (!empty($employee->getFirstMediaUrl('employee_photo'))) {{ $employee->getFirstMediaUrl('employee_photo') }}@else{{ asset('/uploads/' . session('logo')) }} @endif"
                                                            alt="photo" width="50" height="50">
                                                    </td>
                                                    <td>
                                                        {{ $employee->name }}
                                                    </td>
                                                    <td>
                                                        {{ $employee->email }}
                                                    </td>
                                                    <td>
                                                        {{ $employee->mobile }}
                                                    </td>
                                                    <td>
                                                        {{ $employee->job_title }}
                                                    </td>
                                                    <td>
                                                        {{ $employee->fixed_wage_value }}
                                                    </td>
                                                    <td>
                                                        {{ App\Models\Employee::getBalanceLeave($employee->id) }}
                                                    </td>
                                                    <td>
                                                        @if (!empty($employee->date_of_birth))
                                                            {{ \Carbon\Carbon::parse($employee->date_of_birth)->diff(\Carbon\Carbon::now())->format('%y') }}
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if (!empty($employee->date_of_start_working))
                                                            {{ @format_date($employee->date_of_start_working) }}
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @php
                                                            $today_on_leave = App\Models\Leave::where('employee_id', $employee->id)
                                                                ->whereDate('end_date', '>=', date('Y-m-d'))
                                                                ->whereDate('start_date', '<=', date('Y-m-d'))
                                                                ->where('status', 'approved')
                                                                ->first();
                                                        @endphp
                                                        @if (!empty($today_on_leave))
                                                            <label for=""
                                                                style="font-weight: bold; color: red">@lang('lang.on_leave')</label>
                                                        @else
                                                            @php
                                                                $status_today = App\Models\Attendance::where('employee_id', $employee->id)
                                                                    ->whereDate('date', date('Y-m-d'))
                                                                    ->first();
                                                            @endphp
                                                            @if (!empty($status_today))
                                                                @if ($status_today->status == 'late' || $status_today->status == 'present')
                                                                    <label for=""
                                                                        style="font-weight: bold; color: green">@lang('lang.on_duty')</label>
                                                                @endif
                                                                @if ($status_today->status == 'on_leave')
                                                                    <label for=""
                                                                        style="font-weight: bold; color: red">@lang('lang.on_leave')</label>
                                                                @endif
                                                            @endif
                                                        @endif
                                                    </td>
                                                    <td>{{ implode(', ', $employee->store->pluck('name')->toArray()) }}
                                                    </td>
                                                    <td>{{ $employee->store_pos }}</td>
                                                    @php
                                                        $logged_employee = App\Models\Employee::where('admin_id', Auth::id())->first();
                                                    @endphp
                                                    @if (auth()->user()->can('hr_management.employee_commission.view'))
                                                        <td>{{ @num_format($employee->total_commission) }}</td>
                                                        <td>{{ @num_format($employee->total_commission_paid) }}</td>
                                                        <td>{{ @num_format($employee->total_commission - $employee->total_commission_paid) }}
                                                        </td>
                                                    @elseif($employee->id == $logged_employee->id)
                                                        <td>{{ @num_format($employee->total_commission) }}</td>
                                                        <td>{{ @num_format($employee->total_commission_paid) }}</td>
                                                        <td>{{ @num_format($employee->total_commission - $employee->total_commission_paid) }}
                                                        </td>
                                                    @else
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                    @endif

                                                    <td>
                                                        <div class="btn-group">
                                                            <button type="button"
                                                                class="btn btn-default btn-sm dropdown-toggle"
                                                                data-toggle="dropdown" aria-haspopup="true"
                                                                aria-expanded="false">@lang('lang.action')
                                                                <span class="caret"></span>
                                                                <span class="sr-only">Toggle Dropdown</span>
                                                            </button>
                                                            <ul class="dropdown-menu edit-options dropdown-menu-right dropdown-default"
                                                                user="menu">
                                                                @can('hr_management.employee.view')
                                                                    <li>
                                                                        <a href="{{ action('EmployeeController@show', $employee->id) }}"
                                                                            class="btn"><i
                                                                                class="fa fa-eye"></i>
                                                                            @lang('lang.view')</a>
                                                                    </li>
                                                                    <li class="divider"></li>
                                                                @endcan
                                                                @can('hr_management.employee.create_and_edit')
                                                                    <li>
                                                                        <a href="{{ action('EmployeeController@edit', $employee->id) }}"
                                                                            class="btn edit_employee"><i
                                                                                class="fa fa-pencil-square-o"></i>
                                                                            @lang('lang.edit')</a>
                                                                    </li>
                                                                    <li class="divider"></li>
                                                                @endcan
                                                                @can('hr_management.employee.delete')
                                                                    <li>
                                                                        <a data-href="{{ action('EmployeeController@destroy', $employee->id) }}"
                                                                            data-check_password="{{ action('AdminController@checkPassword', Auth::user()->id) }}"
                                                                            class="btn delete_item text-red"><i
                                                                                class="fa fa-trash"></i>
                                                                            @lang('lang.delete')</a>
                                                                    </li>
                                                                @endcan
                                                                @can('hr_management.suspend.create_and_edit')
                                                                    <li>
                                                                        <a data-href="{{ action('EmployeeController@toggleActive', $employee->id) }}"
                                                                            class="btn toggle-active"><i
                                                                                class="fa fa-ban"></i>
                                                                            @if ($employee->is_active)
                                                                                @lang('lang.suspend')
                                                                            @else
                                                                                @lang('lang.reactivate')
                                                                            @endif
                                                                        </a>
                                                                    </li>
                                                                @endcan
                                                                @can('hr_management.send_credentials.create_and_edit')
                                                                    <li>
                                                                        <a href="{{ action('EmployeeController@sendLoginDetails', $employee->id) }}"
                                                                            class="btn"><i
                                                                                class="fa fa-paper-plane"></i>
                                                                            @lang('lang.send_credentials')</a>
                                                                    </li>
                                                                @endcan
                                                                @can('sms_module.sms.create_and_edit')
                                                                    <li>
                                                                        <a href="{{ action('SmsController@create', ['employee_id' => $employee->id]) }}"
                                                                            class="btn"><i
                                                                                class="fa fa-comments-o"></i>
                                                                            @lang('lang.send_sms')</a>
                                                                    </li>
                                                                @endcan
                                                                @can('email_module.email.create_and_edit')
                                                                    <li>
                                                                        <a href="{{ action('EmailController@create', ['employee_id' => $employee->id]) }}"
                                                                            class="btn"><i
                                                                                class="fa fa-envelope "></i>
                                                                            @lang('lang.send_email')</a>
                                                                    </li>
                                                                @endcan
                                                                @can('hr_management.leaves.create_and_edit')
                                                                    <li>
                                                                        <a class="btn btn-modal"
                                                                            data-href="{{ action('LeaveController@create', ['employee_id' => $employee->id]) }}"
                                                                            data-container=".view_modal">
                                                                            <i class="fa fa-sign-out"></i> @lang( 'lang.leave')
                                                                        </a>
                                                                    </li>
                                                                @endcan
                                                                @can('hr_management.forfeit_leaves.create_and_edit')
                                                                    <li>
                                                                        <a class="btn btn-modal"
                                                                            data-href="{{ action('ForfeitLeaveController@create', ['employee_id' => $employee->id]) }}"
                                                                            data-container=".view_modal">
                                                                            <i class="fa fa-ban"></i> @lang(
                                                                            'lang.forfeit_leave')
                                                                        </a>
                                                                    </li>
                                                                @endcan
                                                            </ul>
                                                        </div>
                                                    </td>
                                                </tr>

                                            @endforeach --}}


                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td>{{ $currency_symbol }}</td>
                                            <td></td>
                                            <th style="text-align: right">@lang('lang.total')</th>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>
@endsection

@section('javascript')
    <script>
        $(document).on('click', 'a.toggle-active', function(e) {
            e.preventDefault();

            $.ajax({
                method: 'get',
                url: $(this).data('href'),
                data: {},
                success: function(result) {
                    if (result.success == true) {
                        swal(
                            'Success',
                            result.msg,
                            'success'
                        );
                        setTimeout(() => {
                            location.reload();
                        }, 500);
                    } else {
                        swal(
                            'Error',
                            result.msg,
                            'error'
                        );
                    }
                },
            });
        });

        $(document).ready(function() {
            employee_table = $("#employee_table").DataTable({
                lengthChange: true,
                paging: true,
                info: false,
                bAutoWidth: false,
                // order: [],
                language: {
                    url: dt_lang_url,
                },
                lengthMenu: [
                    [10, 25, 50, 75, 100, 200, 500, -1],
                    [10, 25, 50, 75, 100, 200, 500, "All"],
                ],
                dom: "lBfrtip",
                stateSave: true,
                buttons: buttons,
                processing: true,
                serverSide: true,
                aaSorting: [
                    [0, "desc"]
                ],
                initComplete: function() {
                    $(this.api().table().container()).find('input').parent().wrap('<form>').parent()
                        .attr('autocomplete', 'off');
                },
                ajax: {
                    url: "/hrm/employee",
                    data: function(d) {
                        d.employee_id = $("#employee_id").val();
                        d.method = $("#method").val();
                        d.start_date = $("#start_date").val();
                        d.start_time = $("#start_time").val();
                        d.end_date = $("#end_date").val();
                        d.end_time = $("#end_time").val();
                        d.created_by = $("#created_by").val();
                        d.payment_status = $("#payment_status").val();
                    },
                },
                columnDefs: [{
                        targets: "date",
                        type: "date-eu",
                    },
                    {
                        targets: [7],
                        orderable: false,
                        searchable: false,
                    },
                ],
                columns: [{
                        data: "profile_photo",
                        name: "profile_photo"
                    },
                    {
                        data: "employee_name",
                        name: "employee_name"
                    },
                    {
                        data: "email",
                        name: "email"
                    },
                    {
                        data: "mobile",
                        name: "mobile"
                    },
                    {
                        data: "job_title",
                        name: "job_types.job_title"
                    },
                    {
                        data: "fixed_wage_value",
                        name: "employees.fixed_wage_value"
                    },
                    {
                        data: "annual_leave_balance",
                        name: "annual_leave_balance",
                        searchable: false
                    },
                    {
                        data: "age",
                        name: "age",

                    },
                    {
                        data: "date_of_start_working",
                        name: "date_of_start_working"
                    },
                    {
                        data: "current_status",
                        name: "current_status"
                    },
                    {
                        data: "store",
                        name: "store",
                    },
                    {
                        data: "store_pos",
                        name: "store_pos",
                    },
                    {
                        data: "commission",
                        name: "commission",
                    },
                    {
                        data: "total_paid",
                        name: "total_paid",
                    },
                    {
                        data: "due",
                        name: "due",
                    },
                    {
                        data: "action",
                        name: "action"
                    },
                ],
                createdRow: function(row, data, dataIndex) {},
                "footerCallback": function(row, data, start, end, display) {
                    var api = this.api(),
                        intVal = function(i) {
                            return typeof i === 'string' ?
                                i.replace(/[, Rs]|(\.\d{2})/g, "") * 1 :
                                typeof i === 'number' ?
                                i : 0;
                        },
                        total2 = api
                        .column(5)
                        .data()
                        .reduce(function(a, b) {
                            return intVal(a) + intVal(b);
                        }, 0);
                    totalRows = api.page.info().recordsDisplay;

                    $(api.column(5).footer()).html(
                        total2
                    );
                    $(api.column(0).footer()).html(
                        "{{ __('lang.total_rows') }}: " + totalRows
                    );
                },
            });
            $(document).on('change', '.filter', function() {
                employee_table.ajax.reload();
            });
        })
    </script>
@endsection
