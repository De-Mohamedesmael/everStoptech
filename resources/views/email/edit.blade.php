@extends('layouts.app')
@section('title', __('lang.email'))
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
                            @lang('lang.email')
                            <span class="header-pill"></span>
                        </h5>
                    </div>
                    <div class="card mb-2">
                        <div class="card-body p-2">
                            <div class="row @if (app()->isLocale('ar')) flex-row-reverse @else flex-row @endif">

                                <div class="col-md-4 px-5">
                                    <div class="form-group">
                                        {!! Form::label('employee_id', __('lang.employee'), [
                                            'class' => 'form-label d-block mb-1 app()->isLocale("ar") ? text-end : text-start',
                                        ]) !!}
                                        {!! Form::select('employee_id[]', $employees, explode(',', $email->emails), [
                                            'class' => 'form-control
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        selectpicker',
                                            'multiple',
                                            'id' => 'employee_id',
                                            'placeholder' => __('lang.please_select'),
                                        ]) !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    {!! Form::open([
                        'url' => action('EmailController@update', $email->id),
                        'method' => 'put',
                        'id' => 'email_form',
                        'files' => true,
                    ]) !!}
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
                                            value="@if (!empty($email->emails)) {{ $email->emails }} @endif">
                                    </div>
                                </div>

                                <div class="col-md-8 px-5">
                                    <div class="form-group">
                                        <label
                                            class="form-label d-block mb-1  @if (app()->isLocale('ar')) text-end @else text-start @endif"
                                            for="subject">{{ __('lang.subject') }}</label>
                                        <input type="text"
                                            class="form-control modal-input m-auto @if (app()->isLocale('ar')) text-end @else  text-start @endif"
                                            id="name" name="subject" required="" value="{{ $email->subject }}">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card mb-2">
                        <div class="card-body p-2">
                            <div class="row @if (app()->isLocale('ar')) flex-row-reverse @else flex-row @endif">
                                <div class="col-md-4 px-5">
                                    <div
                                        class="form-group d-flex px-0 justify-content-between @if (app()->isLocale('ar')) flex-row-reverse @else flex-row @endif">
                                        <label
                                            class="form-label d-block mb-1  @if (app()->isLocale('ar')) text-end @else text-start @endif"
                                            for="body">{{ __('lang.attachment') }}:</label> <br>
                                        <input type="file" name="attachments[]" id="attachments" class="" multiple>
                                    </div>
                                </div>
                                <div class="col-md-12 px-5">
                                    <div class="form-group">
                                        <label
                                            class="form-label d-block mb-1  @if (app()->isLocale('ar')) text-end @else text-start @endif"
                                            for="body">{{ __('lang.body') }}</label>
                                        <textarea name="body" id="body" cols="30" rows="3"
                                            class="form-control modal-input m-auto @if (app()->isLocale('ar')) text-end @else  text-start @endif">{!! $email->body !!}</textarea>
                                    </div>
                                </div>

                                <div class="col-md-12 px-5">
                                    <div class="form-group">
                                        <label
                                            class="form-label d-block mb-1  @if (app()->isLocale('ar')) text-end @else text-start @endif"
                                            for="body">{{ __('lang.notes') }}</label>
                                        <textarea name="notes" id="notes" cols="30" rows="3"
                                            class="form-control modal-input m-auto @if (app()->isLocale('ar')) text-end @else  text-start @endif">{{ $email->notes }}</textarea>
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
            $('#to').val(numbers.join());

        });
        tinymce.init({
            selector: "#body",
            height: 130,
            plugins: [
                "advlist autolink lists link charmap print preview anchor textcolor",
                "searchreplace visualblocks code fullscreen",
                "insertdatetime table contextmenu paste code wordcount",
            ],
            toolbar: "insert | undo redo |  formatselect | bold italic backcolor  | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | removeformat",
            branding: false,
        });
    </script>
@endsection
