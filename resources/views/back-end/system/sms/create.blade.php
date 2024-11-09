@extends('layouts.app')
@section('title', __('lang.sms'))
@section('style')
    <link rel="stylesheet" type="text/css" href="{{ url('front/css/stock.css') }}">
@endsection
@section('content')
    <section class="forms py-0">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12 px-1">
                    <div
                        class="d-flex align-items-center my-2 @if (app()->isLocale('ar')) justify-content-end @else justify-content-start @endif">
                        <h5 class="mb-0 position-relative" style="margin-right: 30px">
                            @lang('lang.sms')
                            <span class="header-pill"></span>
                        </h5>
                    </div>
                    <div class="card mb-2">
                        <div class="card-body d-flex justify-content-center p-2">
                            <div class="col-md-3 px-5">
                                <input id="select_all" name="select_all" type="checkbox" value="1"
                                    class="form-control-custom">
                                <label for="select_all"><strong>@lang('lang.select_all')</strong></label>
                            </div>
                        </div>
                    </div>
                    <div class="card mb-2">
                        <div class="card-body p-2">
                            <div class="row @if (app()->isLocale('ar')) flex-row-reverse @else flex-row @endif">
                                <div class="col-md-6 px-5">
                                    <div class="form-group">
                                        {!! Form::label('employee_id', __('lang.employee'), [
                                            'class' => 'form-label d-block mb-1 app()->isLocale("ar") ? text-end : text-start',
                                        ]) !!}
                                        {!! Form::select(
                                            'employee_id[]',
                                            ['select_all' => __('lang.select_all')] + $employees,
                                            !empty($employee_mobile_number) ? [$employee_mobile_number] : false,
                                            ['class' => 'form-control selectpicker', 'multiple', 'data-live-search' => 'true', 'id' => 'employee_id'],
                                        ) !!}
                                    </div>
                                </div>
                                <div class="col-md-6 px-5">
                                    <div class="form-group">
                                        {!! Form::label('customer_id', __('lang.customer'), [
                                            'class' => 'form-label d-block mb-1 app()->isLocale("ar") ? text-end : text-start',
                                        ]) !!}
                                        {!! Form::select(
                                            'customer_id[]',
                                            ['select_all' => __('lang.select_all')] + $customers,
                                            !empty($customer_mobile_number) ? [$customer_mobile_number] : false,
                                            ['class' => 'form-control selectpicker', 'multiple', 'data-live-search' => 'true', 'id' => 'customer_id'],
                                        ) !!}
                                    </div>
                                </div>
                                <div class="col-md-6 px-5">
                                    <div class="form-group">
                                        {!! Form::label('supplier_id', __('lang.supplier'), [
                                            'class' => 'form-label d-block mb-1 app()->isLocale("ar") ? text-end : text-start',
                                        ]) !!}
                                        {!! Form::select(
                                            'supplier_id[]',
                                            ['select_all' => __('lang.select_all')] + $suppliers,
                                            !empty($supplier_mobile_number) ? [$supplier_mobile_number] : false,
                                            ['class' => 'form-control selectpicker', 'multiple', 'data-live-search' => 'true', 'id' => 'supplier_id'],
                                        ) !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    {!! Form::open(['url' => action('SmsController@store'), 'method' => 'post', 'id' => 'sms_form']) !!}
                    <div class="card mb-2">
                        <div class="card-body p-2">
                            <div class="row @if (app()->isLocale('ar')) flex-row-reverse @else flex-row @endif">
                                <div class="col-md-4 px-5">
                                    <div class="form-group">
                                        <label
                                            class="form-label d-block mb-1  @if (app()->isLocale('ar')) text-end @else text-start @endif"
                                            for="to">{{ __('lang.to') }}
                                            <small>@lang('lang.separated_by_comma')</small></label>
                                        <input type="text"
                                            class="form-control modal-input m-auto @if (app()->isLocale('ar')) text-end @else  text-start @endif"
                                            id="to" name="to" required
                                            value="@if (!empty($number_string)) {{ $number_string }} @endif">
                                    </div>
                                </div>
                            </div>
                            <div class="row @if (app()->isLocale('ar')) flex-row-reverse @else flex-row @endif">

                                <div class="col-md-12 px-5">
                                    <div class="form-group">
                                        <label
                                            class="form-label d-block mb-1  @if (app()->isLocale('ar')) text-end @else text-start @endif"
                                            for="message">{{ __('lang.message') }}</label>
                                        <textarea name="message" id="message" rows="3" required
                                            class="form-control modal-input m-auto @if (app()->isLocale('ar')) text-end @else  text-start @endif"></textarea>
                                    </div>
                                </div>
                                <div class="col-md-12 px-5">
                                    <div class="form-group">
                                        <label
                                            class="form-label d-block mb-1  @if (app()->isLocale('ar')) text-end @else text-start @endif"
                                            for="body">{{ __('lang.notes') }}</label>
                                        <textarea name="notes" id="notes" rows="3"
                                            class="form-control modal-input m-auto @if (app()->isLocale('ar')) text-end @else  text-start @endif"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row my-2 justify-content-center align-items-center">
                            <div class="col-md-2">
                                <button type="submit" name="submit" id="print" value="save"
                                    class="btn btn-main submit-btn submit">@lang('lang.send')</button>

                            </div>
                        </div>
                    </div>
                    {!! Form::close() !!}

                </div>
            </div>
        </div>
    </section>
@endsection

@section('javascript')
    <script type="text/javascript">
        $(document).ready(function() {
            $('#employee_id').change()
        })
        $('#employee_id').change(function() {
            let numbers = $(this).val()
            if (numbers.includes('select_all')) {
                $('#employee_id').selectpicker('selectAll')
            }
            get_numbers()
        })
        $('#customer_id').change(function() {
            let numbers = $(this).val()
            if (numbers.includes('select_all')) {
                $('#customer_id').selectpicker('selectAll')
            }
            get_numbers()
        })
        $('#supplier_id').change(function() {
            let numbers = $(this).val()
            if (numbers.includes('select_all')) {
                $('#supplier_id').selectpicker('selectAll')
            }
            get_numbers()
        })



        $('#select_all').change(function() {
            if ($(this).prop('checked')) {
                $('#employee_id').selectpicker('selectAll')
                $('#customer_id').selectpicker('selectAll')
                $('#supplier_id').selectpicker('selectAll')
            } else {
                $('#employee_id').selectpicker('deselectAll')
                $('#customer_id').selectpicker('deselectAll')
                $('#supplier_id').selectpicker('deselectAll')
            }
            get_numbers()
        })

        function get_numbers() {
            let employee_numbers = $('#employee_id').val();
            let customer_numbers = $('#customer_id').val();
            let supplier_numbers = $('#supplier_id').val();
            let numbers = employee_numbers.concat(customer_numbers).concat(supplier_numbers);
            var list_numbers = numbers.filter(function(e) {
                return e !== 'select_all'
            })

            list_numbers = list_numbers.filter(e => e);
            $('#to').val(list_numbers.join())
        }
    </script>
@endsection
