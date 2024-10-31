@extends('layouts.app')
@section('title', __('lang.coupon'))
@section('style')
    <link rel="stylesheet" type="text/css" href="{{ url('front/css/main.css') }}">
@endsection
@section('content')
    <section class="forms py-0">

        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12 px-1">
                    <div
                        class="  d-flex align-items-center my-2 @if (app()->isLocale('ar')) justify-content-end @else justify-content-start @endif">
                        <h5 class="mb-0 position-relative " style="margin-right: 30px">@lang('lang.edit_coupon')
                            <span class="header-pill"></span>
                        </h5>
                    </div>

                    {!! Form::open([
                        'url' => action('CouponController@update', $coupon->id),
                        'method' => 'put',
                        'id' => 'coupon_add_form',
                    ]) !!}

                    <div class="card my-3">
                        <div class="card-body p-2">
                            <div class="row @if (app()->isLocale('ar')) flex-row-reverse @else flex-row @endif">
                                <div class="col-md-3 px-5">
                                    <div class="form-group">
                                        {!! Form::label('coupon_code', __('lang.coupon_code') . '*', [
                                            'class' => 'form-label d-block mb-1 app()->isLocale("ar") ? text-end : text-start',
                                        ]) !!}
                                        <div class="input-group select-button-group">
                                            {!! Form::text('coupon_code', $coupon->coupon_code, [
                                                'class' => 'form-control modal-input app()->isLocale("ar") ? text-end : text-start',
                                                'placeholder' => __('lang.coupon_code'),
                                                'required',
                                            ]) !!}
                                            <div class="input-group-append">
                                                <button type="button" class=" select-button refresh_code"><i
                                                        class="fa fa-refresh"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3 px-5">
                                    <div class="form-group">
                                        {!! Form::label('customer_type_ids', __('lang.customer_type') . '*', [
                                            'class' => 'form-label d-block mb-1 app()->isLocale("ar") ? text-end : text-start',
                                        ]) !!}
                                        {!! Form::select('customer_type_ids[]', $customer_types, $coupon->customer_type_ids, [
                                            'class' => 'selectpicker
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        form-control',
                                            'data-live-search' => 'true',
                                            'multiple',
                                            'required',
                                        ]) !!}
                                    </div>
                                </div>
                                <div class="col-md-3 px-5">
                                    <div class="form-group">
                                        {!! Form::label('store_ids', __('lang.store') . '*', [
                                            'class' => 'form-label d-block mb-1 app()->isLocale("ar") ? text-end : text-start',
                                        ]) !!}
                                        {!! Form::select('store_ids[]', $stores, $coupon->store_ids, [
                                            'class' => 'selectpicker
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        form-control',
                                            'data-live-search' => 'true',
                                            'multiple',
                                            'required',
                                            'id' => 'store_ids',
                                        ]) !!}
                                    </div>
                                </div>
                                <div class="col-md-3 px-5">
                                    <div class="form-group">
                                        {!! Form::label('type', __('lang.type') . '*', [
                                            'class' => 'form-label d-block mb-1 app()->isLocale("ar") ? text-end : text-start',
                                        ]) !!}
                                        {!! Form::select('type', ['fixed' => 'Fixed', 'percentage' => 'Percentage'], $coupon->type, [
                                            'class' => 'form-control',
                                            'data-live-search' => 'true',
                                        ]) !!}
                                    </div>
                                </div>
                                <div class="col-md-3 px-5">
                                    <div class="form-group">
                                        {!! Form::label('amount', __('lang.amount') . '*', [
                                            'class' => 'form-label d-block mb-1 app()->isLocale("ar") ? text-end : text-start',
                                        ]) !!}
                                        {!! Form::text('amount', @num_format($coupon->amount), [
                                            'class' => 'form-control  modal-input app()->isLocale("ar") ? text-end : text-start',
                                            'placeholder' => __('lang.amount'),
                                            'required',
                                        ]) !!}
                                    </div>
                                </div>
                                <div class="col-md-3 px-5">
                                    <div class="form-group">
                                        <label
                                            class="checkbox-inline form-label d-flex justify-content-end gap-5 mb-1  @if (app()->isLocale('ar')) text-end @else text-start @endif">
                                            <input type="checkbox" class="amount_to_be_purchase_checkbox"
                                                @if ($coupon->amount_to_be_purchase_checkbox) checked @endif
                                                name="amount_to_be_purchase_checkbox" value="1">
                                            @lang('lang.amount_to_be_purchase')
                                        </label>
                                        {!! Form::text('amount_to_be_purchase', $coupon->amount_to_be_purchase, [
                                            'class' => 'form-control  modal-input app()->isLocale("ar") ? text-end : text-start amount_to_be_purchase',
                                            'placeholder' => __('lang.amount_to_be_purchase'),
                                        ]) !!}
                                    </div>
                                </div>

                                <div class="col-md-3 px-5">
                                    <div class="form-group">
                                        {!! Form::label('expiry_date', __('lang.expiry_date') . '*', [
                                            'class' => 'form-label d-block mb-1 app()->isLocale("ar") ? text-end : text-start',
                                        ]) !!}
                                        {!! Form::text('expiry_date', !empty($coupon->expiry_date) ? @format_date($coupon->expiry_date) : null, [
                                            'class' => 'form-control
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        datepicker  modal-input app()->isLocale("ar") ? text-end : text-start',
                                            'placeholder' => __('lang.expiry_date'),
                                        ]) !!}
                                    </div>
                                </div>
                                <div class="col-md-3 px-5">
                                    @include('product_classification_tree.partials.product_selection_tree')
                                </div>
                            </div>
                            <div class="row my-2 justify-content-center align-items-center">
                                <div class="col-md-2">
                                    <input type="submit" class="btn submit-btn btn-main" value="@lang('lang.save')"
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
    <script src="{{ asset('js/product_selection_tree.js') }}"></script>
    <script>
        $('.datepicker').datepicker({
            language: '{{ session('language') }}',
            todayHighlight: true,
        });
        $('.selectpicker').selectpicker('render');
        // $('.selectpicker').selectpicker('selectAll');

        $('.amount_to_be_purchase_checkbox').change(function() {
            if ($(this).prop('checked')) {
                $('.amount_to_be_purchase').attr('required', true);
            } else {
                $('.amount_to_be_purchase').attr('required', false);
            }
        })

        $('.refresh_code').click()
        $(document).on('click', '.refresh_code', function() {
            console.log('asdf');
            $.ajax({
                method: 'get',
                url: '/coupon/generate-code',
                data: {},
                success: function(result) {
                    $('#coupon_code').val(result);
                },
            });
        })
    </script>
@endsection
