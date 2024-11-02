@extends('layouts.app')
@section('title', __('lang.settings'))
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
                            @lang('lang.settings')
                            <span class="header-pill"></span>
                        </h5>
                    </div>
                    {!! Form::open(['url' => action('SmsController@saveSetting'), 'method' => 'post', 'id' => 'sms_form']) !!}
                    <div class="card mb-2">
                        <div class="card-body  p-2">
                            <div class="row @if (app()->isLocale('ar')) flex-row-reverse @else flex-row @endif">
                                <div class="col-md-4 px-5">
                                    <div class="form-group">
                                        <label
                                            class="form-label d-block mb-1  @if (app()->isLocale('ar')) text-end @else text-start @endif"
                                            for="sms_username">{{ __('lang.username') }}</label>
                                        <input type="text"
                                            class="form-control modal-input m-auto @if (app()->isLocale('ar')) text-end @else  text-start @endif"
                                            id="sms_username" name="sms_username" required
                                            value="@if (!empty($settings['sms_username'])) {{ $settings['sms_username'] }} @endif">
                                    </div>
                                </div>
                                <div class="col-md-4 px-5">
                                    <div class="form-group">
                                        <label
                                            class="form-label d-block mb-1  @if (app()->isLocale('ar')) text-end @else text-start @endif"
                                            for="sms_password">{{ __('lang.password') }}</label>
                                        <input type="text"
                                            class="form-control modal-input m-auto @if (app()->isLocale('ar')) text-end @else  text-start @endif"
                                            id="sms_password" name="sms_password" required
                                            value="@if (!empty($settings['sms_password'])) {{ $settings['sms_password'] }} @endif">
                                    </div>
                                </div>
                                <div class="col-md-4 px-5">
                                    <div class="form-group">
                                        <label
                                            class="form-label d-block mb-1  @if (app()->isLocale('ar')) text-end @else text-start @endif"
                                            for="sms_sender_name">{{ __('lang.sender_name') }}</label>
                                        <input type="text"
                                            class="form-control modal-input m-auto @if (app()->isLocale('ar')) text-end @else  text-start @endif"
                                            id="sms_sender_name" name="sms_sender_name" required
                                            value="@if (!empty($settings['sms_sender_name'])) {{ $settings['sms_sender_name'] }} @endif">
                                    </div>
                                </div>
                            </div>


                            <div class="row my-2 justify-content-center align-items-center">
                                <div class="col-md-2">
                                    <button type="submit" name="submit" id="print" value="save"
                                        class="btn btn-main submit-btn submit">@lang('lang.save')</button>
                                </div>

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
    <script type="text/javascript"></script>
@endsection
