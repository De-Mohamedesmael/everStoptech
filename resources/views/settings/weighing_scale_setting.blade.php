@extends('layouts.app')
@section('title', __('lang.weighing_scale_setting'))
@section('style')

    <link rel="stylesheet" type="text/css" href="{{ url('front/css/main.css') }}">
@endsection
@section('content')
    <section class="forms py-0">

        <div class="container-fluid">
            <div class="col-md-12 px-1 no-print">
                <div
                    class="d-flex align-items-center my-2 @if (app()->isLocale('ar')) justify-content-end @else justify-content-start @endif">
                    <h5 class="mb-0 position-relative" style="margin-right: 30px">
                        @lang('lang.weighing_scale_setting')
                        <span class="header-pill"></span>
                    </h5>
                </div>
                {!! Form::open([
                    'url' => action('SettingController@postWeighingScaleSetting'),
                    'method' => 'post',
                    'enctype' => 'multipart/form-data',
                ]) !!}
                <div class="card mb-2">
                    <div class="card-body p-2">
                        <div class="row @if (app()->isLocale('ar')) flex-row-reverse @else flex-row @endif">

                            <div class="col-md-3 px-5">
                                <div class="form-group">
                                    {!! Form::label('label_prefix', __('lang.weighing_barcode_prefix'), [
                                        'class' => 'form-label d-block mb-1 app()->isLocale("ar") ? text-end : text-start',
                                    ]) !!}
                                    {!! Form::text(
                                        'weighing_scale_setting[label_prefix]',
                                        isset($weighing_scale_setting['label_prefix']) ? $weighing_scale_setting['label_prefix'] : null,
                                        ['class' => 'form-control  modal-input app()->isLocale("ar") ? text-end : text-start', 'id' => 'label_prefix'],
                                    ) !!}
                                </div>
                            </div>

                            <div class="col-md-3 px-5">
                                <div class="form-group">
                                    {!! Form::label('product_sku_length', __('lang.weighing_product_sku_length'), [
                                        'class' => 'form-label d-block mb-1 app()->isLocale("ar") ? text-end : text-start',
                                    ]) !!}

                                    {!! Form::select(
                                        'weighing_scale_setting[product_sku_length]',
                                        [1, 2, 3, 4, 5, 6, 7, 8, 9],
                                        isset($weighing_scale_setting['product_sku_length']) ? $weighing_scale_setting['product_sku_length'] : 4,
                                        ['class' => 'form-control select2', 'style' => 'width: 100%;', 'id' => 'product_sku_length'],
                                    ) !!}
                                </div>
                            </div>

                            <div class="col-md-3 px-5">
                                <div class="form-group">
                                    {!! Form::label('qty_length', __('lang.weighing_qty_integer_part_length'), [
                                        'class' => 'form-label d-block mb-1 app()->isLocale("ar") ? text-end : text-start',
                                    ]) !!}

                                    {!! Form::select(
                                        'weighing_scale_setting[qty_length]',
                                        [1, 2, 3, 4, 5],
                                        isset($weighing_scale_setting['qty_length']) ? $weighing_scale_setting['qty_length'] : 3,
                                        ['class' => 'form-control select2', 'style' => 'width: 100%;', 'id' => 'qty_length'],
                                    ) !!}
                                </div>
                            </div>

                            <div class="col-md-3 px-5">
                                <div class="form-group">
                                    {!! Form::label('qty_length_decimal', __('lang.weighing_qty_fractional_part_length'), [
                                        'class' => 'form-label d-block mb-1 app()->isLocale("ar") ? text-end : text-start',
                                    ]) !!}
                                    {!! Form::select(
                                        'weighing_scale_setting[qty_length_decimal]',
                                        [1, 2, 3, 4],
                                        isset($weighing_scale_setting['qty_length_decimal']) ? $weighing_scale_setting['qty_length_decimal'] : 2,
                                        ['class' => 'form-control select2', 'style' => 'width: 100%;', 'id' => 'qty_length_decimal'],
                                    ) !!}
                                </div>
                            </div>
                            <div class="col-md-3 px-5">
                                <div class="form-group">
                                    {!! Form::label('last_digits_type', __('lang.last_digits_type'), [
                                        'class' => 'form-label d-block mb-1 app()->isLocale("ar") ? text-end : text-start',
                                    ]) !!}
                                    {!! Form::select(
                                        'weighing_scale_setting[last_digits_type]',
                                        ['price' => __('lang.price'), 'quantity' => __('lang.quantity')],
                                        isset($weighing_scale_setting['last_digits_type']) ? $weighing_scale_setting['last_digits_type'] : 'quantity',
                                        ['class' => 'form-control select2', 'style' => 'width: 100%;', 'id' => 'last_digits_type', 'required'],
                                    ) !!}
                                </div>
                            </div>
                            <div class="col-md-3 px-5">
                                <div class="i-checks" style="margin-top: 30px;">
                                    <input id="enable" name="weighing_scale_setting[enable]" type="checkbox"
                                        @if (!empty($weighing_scale_setting['enable'])) checked @endif value="1"
                                        class="form-control-custom">
                                    <label for="enable"><strong>{{ __('lang.enable') }}</strong></label>
                                </div>
                            </div>
                        </div>

                        <div class="row my-2 justify-content-center align-items-center">

                            <div class="col-md-4 w-25">
                                <button type="submit"
                                    class="btn btn-main  py-1 w-100 submit-btn">@lang('lang.save')</button>
                            </div>
                        </div>
                    </div>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </section>


@endsection

@section('javascript')
    <script></script>
@endsection
