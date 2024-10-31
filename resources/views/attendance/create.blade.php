@extends('layouts.app')
@section('title', __('lang.attendance'))
@section('style')
    <link rel="stylesheet" type="text/css" href="{{ url('front/css/main.css') }}">
@endsection
@section('content')
    <section class="forms py-0">

        <div class="container-fluid">

            <div
                class="  d-flex align-items-center my-2 @if (app()->isLocale('ar')) justify-content-end @else justify-content-start @endif">
                <h5 class="print-title mb-0 position-relative print-title" style="margin-right: 30px">@lang('lang.attendance')
                    <span class="header-pill"></span>
                </h5>
            </div>
            <div class="card my-3">
                <div class="card-body p-2">
                    <div class="row @if (app()->isLocale('ar')) flex-row-reverse @else flex-row @endif">
                        <div class="col-sm-12">
                            {!! Form::open(['url' => action('AttendanceController@store'), 'method' => 'post']) !!}
                            <input type="hidden" name="index" id="index" value="0">


                            <table class="table" id="attendance_table">
                                <thead>
                                    <tr>
                                        <th>@lang('lang.date')</th>
                                        <th>@lang('lang.employee')</th>
                                        <th>@lang('lang.checkin')</th>
                                        <th>@lang('lang.checkout')</th>
                                        <th>@lang('lang.status')</th>
                                        <th>@lang('lang.created_by')</th>
                                    </tr>
                                </thead>

                                <tbody>

                                    <tr>
                                        <td>
                                            <input type="date"
                                                class="form-control  date  modal-input m-auto @if (app()->isLocale('ar')) text-end @else  text-start @endif"
                                                name="attendances[0][date]" required>
                                        </td>
                                        <td>
                                            {!! Form::select('attendances[0][employee_id]', $employees, null, [
                                                'class' => 'form-control selectpicker',
                                                'placeholder' => __('lang.please_select'),
                                                'data-live-search' => 'true',
                                                'required',
                                            ]) !!}
                                        </td>
                                        <td>
                                            <input type="time"
                                                class="form-control time  modal-input m-auto @if (app()->isLocale('ar')) text-end @else  text-start @endif"
                                                name="attendances[0][check_in]" required>
                                        </td>
                                        <td>
                                            <input type="time"
                                                class="form-control time  modal-input m-auto @if (app()->isLocale('ar')) text-end @else  text-start @endif"
                                                name="attendances[0][check_out]" required>
                                        </td>
                                        <td>
                                            {!! Form::select(
                                                'attendances[0][status]',
                                                ['present' => 'Present', 'late' => 'Late', 'on_leave' => 'On Leave'],
                                                null,
                                                [
                                                    'class' => 'form-control
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                selectpicker',
                                                    'data-live-search' => 'true',
                                                    'placeholder' => __('lang.please_select'),
                                                    'required',
                                                ],
                                            ) !!}
                                        </td>
                                        <td>
                                            {{ ucfirst(Auth::user()->name) }}
                                        </td>
                                    </tr>

                                </tbody>
                            </table>
                            <div class="row justify-content-center align-items-center mb-3">

                                <button type="button" class="btn btn-main col-md-3 add_row" id="add_row">+
                                    @lang('lang.add_row')</button>

                            </div>
                            <div class="row justify-content-center align-items-center  mt-3 attendance-btn">

                                <input type="submit" class="btn btn-main mt-3 col-md-3" value="@lang('lang.save')"
                                    name="submit">
                            </div>
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>
@endsection

@section('javascript')
    <script>
        $('#add_row').click(function() {
            row_index = parseInt($('#index').val());
            row_index = row_index + 1;
            $('#index').val(row_index);
            $.ajax({
                method: 'get',
                url: '/hrm/attendance/get-attendance-row/' + row_index,
                data: {},
                contentType: 'html',
                success: function(result) {
                    $('#attendance_table tbody').append(result);
                },
            });
        })
    </script>
@endsection
