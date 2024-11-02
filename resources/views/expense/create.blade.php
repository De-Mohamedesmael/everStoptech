@extends('layouts.app')
@section('title', __('lang.expense'))
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
                            @lang('lang.add_new_expense')
                            <span class="header-pill"></span>
                        </h5>
                    </div>

                    {!! Form::open([
                        'url' => action('ExpenseController@store'),
                        'method' => 'post',
                        'enctype' => 'multipart/form-data',
                    ]) !!}
                    <div class="card mb-2">
                        <div class="card-body p-2">
                            <div class="row @if (app()->isLocale('ar')) flex-row-reverse @else flex-row @endif">

                                <div class="col-md-3 px-5">
                                    <div class="form-group">
                                        <label
                                            class="form-label d-block mb-1  @if (app()->isLocale('ar')) text-end @else text-start @endif"
                                            for="expense_category_id">@lang('lang.expense_category')</label>
                                        {!! Form::select('expense_category_id', $expense_categories, null, [
                                            'class' => 'form-control selectpicker',
                                            'required',
                                            'id' => 'expense_category_id',
                                            'placeholder' => __('lang.please_select'),
                                            'data-live-search' => 'true',
                                        ]) !!}
                                    </div>
                                </div>
                                <div class="col-md-3 px-5">
                                    <div class="form-group">
                                        <label
                                            class="form-label d-block mb-1  @if (app()->isLocale('ar')) text-end @else text-start @endif"
                                            for="expense_beneficiary_id">@lang('lang.beneficiary')</label>
                                        {!! Form::select('expense_beneficiary_id', [], null, [
                                            'class' => 'form-control selectpicker',
                                            'data-live-search' => 'true',
                                            'id' => 'expense_beneficiary_id',
                                            'placeholder' => __('lang.please_select'),
                                        ]) !!}
                                    </div>
                                </div>
                                <div class="col-md-3 px-5">
                                    <div class="form-group">
                                        <label
                                            class="form-label d-block mb-1  @if (app()->isLocale('ar')) text-end @else text-start @endif"
                                            for="store_id">@lang('lang.store')</label>
                                        {!! Form::select('store_id', $stores, array_key_first($stores), [
                                            'class' => 'form-control selectpicker',
                                            'data-live-search' => 'true',
                                            'required',
                                            'id' => 'store_id',
                                            'placeholder' => __('lang.please_select'),
                                        ]) !!}
                                    </div>
                                </div>
                                <div class="col-md-3 px-5">
                                    <div class="form-group">
                                        {!! Form::label('source_type', __('lang.source_type'), [
                                            'class' => 'form-label d-block mb-1 app()->isLocale("ar") ? text-end : text-start',
                                        ]) !!}
                                        {!! Form::select(
                                            'source_type',
                                            ['user' => __('lang.user'), 'pos' => __('lang.pos'), 'store' => __('lang.store'), 'safe' => __('lang.safe')],
                                            'user',
                                            [
                                                'class' => 'selectpicker form-control',
                                                'data-live-search' => 'true',
                                                'style' => 'width: 80%',
                                                'placeholder' => __('lang.please_select'),
                                            ],
                                        ) !!}
                                    </div>
                                </div>
                                <div class="col-md-3 px-5">
                                    <div class="form-group">
                                        {!! Form::label('source_of_payment', __('lang.source_of_payment'), [
                                            'class' => 'form-label d-block mb-1 app()->isLocale("ar") ? text-end : text-start',
                                        ]) !!}
                                        {!! Form::select('source_id', $users, null, [
                                            'class' => 'selectpicker form-control',
                                            'data-live-search' => 'true',
                                            'style' => 'width: 80%',
                                            'placeholder' => __('lang.please_select'),
                                            'id' => 'source_id',
                                            'required',
                                        ]) !!}
                                    </div>
                                </div>

                                @include('expense.partial.payment_form')


                                <div class="col-md-3 px-5">
                                    <div class="form-group">
                                        <label
                                            class="form-label d-block mb-1  @if (app()->isLocale('ar')) text-end @else text-start @endif"
                                            for="next_payment_date">@lang('lang.next_payment_date')</label>
                                        <input type="date"
                                            class="form-control modal-input @if (app()->isLocale('ar')) text-end @else  text-start @endif"
                                            name="next_payment_date" id="next_payment_date">
                                    </div>
                                </div>
                                <div class="col-md-3 px-5  notify_field hide">
                                    <div class="i-checks h-100 d-flex justify-content-center align-items-center">
                                        <input id="notify_me" name="notify_me" type="checkbox" value="1"
                                            class="form-control-custom">
                                        <label for="notify_me"><strong>@lang('lang.notify_me')</strong></label>
                                    </div>
                                </div>
                                <div class="col-md-3 px-5 notify_field hide
                            ">
                                    <div class="form-group">
                                        <label
                                            class="form-label d-block mb-1  @if (app()->isLocale('ar')) text-end @else text-start @endif"
                                            for="notify_before_days">@lang('lang.notify_before_days')</label>
                                        <input type="text"
                                            class="form-control modal-input @if (app()->isLocale('ar')) text-end @else  text-start @endif"
                                            name="notify_before_days" id="notify_before_days">
                                    </div>
                                </div>
                                <div class="col-md-12 px-5">
                                    <div class="form-group">
                                        <label
                                            class="form-label d-block mb-1  @if (app()->isLocale('ar')) text-end @else text-start @endif"
                                            for="details">@lang('lang.details')</label>
                                        <textarea class="form-control modal-input @if (app()->isLocale('ar')) text-end @else  text-start @endif"
                                            name="details" id="details" rows="3"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row my-2 justify-content-center align-items-center">
                                <div class="col-md-2">
                                    <input type="submit" class="btn btn-main submit-btn" value="@lang('lang.save')"
                                        name="submit">
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
    <script>
        $('#method').change(function() {
            var method = $(this).val();

            if (method === 'card') {
                $('.card_field').removeClass('hide');
                $('.not_cash_fields').addClass('hide');
                $('.not_cash').attr('required', false);
            } else if (method === 'cash') {
                $('.not_cash_fields').addClass('hide');
                $('.card_field').addClass('hide');
                $('.not_cash').attr('required', false);
            } else {
                $('.not_cash_fields').removeClass('hide');
                $('.card_field').addClass('hide');
                $('.not_cash').attr('required', true);
            }
        })

        $(document).on('change', '#next_payment_date', function() {
            if ($(this).val()) {
                $('.notify_field').removeClass('hide');
            } else {
                $('.notify_field').addClass('hide');
            }
        });
        $(document).on('change', '#expense_category_id', function() {
            expense_category_id = parseInt($(this).val());

            if (!isNaN(expense_category_id)) {
                $.ajax({
                    method: 'get',
                    url: '/expense-categories/get-beneficiary-dropdown/' + expense_category_id,
                    data: {},
                    contentType: 'html',
                    success: function(result) {
                        $('#expense_beneficiary_id').empty().append(result);
                        $('#expense_beneficiary_id').selectpicker('refresh')
                    },
                });
            }
        });

        $(document).ready(function() {
            $('#payment_status').change();
            $('#source_type').change();
        })
        $('#source_type').change(function() {
            if ($(this).val() !== '') {
                $.ajax({
                    method: 'get',
                    url: '/add-stock/get-source-by-type-dropdown/' + $(this).val(),
                    data: {},
                    success: function(result) {
                        $("#source_id").empty().append(result);
                        $("#source_id").selectpicker("refresh");
                    },
                });
            }
        });
    </script>
@endsection
