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
                            <div class="row @if (app()->isLocale('ar')) flex-row-reverse @else flex-row @endif">

                                <div class="col-md-6 px-5">

                                    <div class="form-group">
                                        {!! Form::label('employee_id', __('lang.employee'), [
                                            'class' => 'form-label d-block mb-1 app()->isLocale("ar") ? text-end : text-start',
                                        ]) !!}
                                        {!! Form::select('employee_id[]', $employees, explode(',', $sms->mobile_numbers), [
                                            'class' => 'form-control selectpicker',
                                            'multiple',
                                            'id' => 'employee_id',
                                            'placeholder' => __('lang.please_select'),
                                        ]) !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    {!! Form::open(['url' => action('SmsController@update', $sms->id), 'method' => 'put', 'id' => 'sms_form']) !!}
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
                                            value="@if (!empty($sms->mobile_numbers)) {{ $sms->mobile_numbers }} @endif">
                                    </div>
                                </div>

                                <div class="col-md-12 px-5">
                                    <div class="form-group">
                                        <label
                                            class="form-label d-block mb-1  @if (app()->isLocale('ar')) text-end @else text-start @endif"
                                            for="message">{{ __('lang.message') }}:</label>
                                        <textarea name="message" id="message" cols="30" rows="3" required
                                            class="form-control  modal-input m-auto @if (app()->isLocale('ar')) text-end @else  text-start @endif">{{ $sms->message }}</textarea>
                                    </div>
                                </div>

                                <div class="col-md-12 px-5">
                                    <div class="form-group">
                                        <label
                                            class="form-label d-block mb-1  @if (app()->isLocale('ar')) text-end @else text-start @endif"
                                            for="body">{{ __('lang.notes') }}:</label>
                                        <textarea name="notes" id="notes" cols="30" rows="3"
                                            class="form-control  modal-input m-auto @if (app()->isLocale('ar')) text-end @else  text-start @endif">{{ $sms->notes }}</textarea>
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
        $('#employee_id').change(function() {
            let numbers = $(this).val();
            numbers = numbers.filter(e => e);
            $('#to').val(numbers.join())

        })
    </script>
@endsection
