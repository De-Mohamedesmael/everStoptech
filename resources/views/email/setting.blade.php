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
                    {!! Form::open(['url' => action('EmailController@saveSetting'), 'method' => 'post', 'id' => 'sms_form']) !!}
                    <div class="card mb-2">
                        <div class="card-body  p-2">
                            <div class="row @if (app()->isLocale('ar')) flex-row-reverse @else flex-row @endif">
                                <div class="col-md-4 px-5">
                                    <div class="form-group">
                                        <label
                                            class="form-label d-block mb-1  @if (app()->isLocale('ar')) text-end @else text-start @endif"
                                            for="sender_email">{{ __('lang.email') }}</label>
                                        <input type="text"
                                            class="form-control modal-input m-auto @if (app()->isLocale('ar')) text-end @else  text-start @endif"
                                            id="sender_email" name="sender_email" required
                                            value="@if (!empty($settings['sender_email'])) {{ $settings['sender_email'] }} @endif">
                                    </div>
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
                    {!! Form::close() !!}

                </div>
            </div>
        </div>
    </section>
@endsection

@section('javascript')
    <script type="text/javascript"></script>
@endsection
