@extends('layouts.app')
@section('title', __('lang.store_stock_chart'))
@section('style')
    <link rel="stylesheet" type="text/css" href="{{ url('front/css/main.css') }}">
@endsection
@section('content')
    <section class="forms py-0">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12 px-1 no-print">
                    <div
                        class="d-flex align-items-center my-2 @if (app()->isLocale('ar')) justify-content-end @else justify-content-start @endif">
                        <h5 class="mb-0 print-title position-relative" style="margin-right: 30px">
                            @lang('lang.store_stock_chart')
                            <span class="header-pill"></span>
                        </h5>
                    </div>
                    @if (session('user.is_superadmin'))
                        <form action="">
                            <div class="card mb-2">
                                <div class="card-body p-2">
                                    <div
                                        class="row @if (app()->isLocale('ar')) flex-row-reverse @else flex-row @endif">
                                        <div class="col-md-3 px-5">
                                            <div class="form-group">
                                                {!! Form::label('store_id', __('lang.store'), [
                                                    'class' => 'form-label d-block mb-1 app()->isLocale("ar") ? text-end : text-start',
                                                ]) !!}
                                                {!! Form::select('store_id', $stores, request()->store_id, [
                                                    'class' => 'form-control',
                                                    'placeholder' => __('lang.all'),
                                                    'data-live-search' => 'true',
                                                ]) !!}
                                            </div>
                                        </div>
                                        <div class="col-md-3 px-5 d-flex justify-content-center align-items-center">
                                            <button type="submit" class="btn btn-main col-md-12">@lang('lang.filter')</button>
                                        </div>
                                        <div class="col-md-3 px-5 d-flex justify-content-center align-items-center">
                                            <a href="{{ action('ReportController@getStoreStockChart') }}"
                                                class="btn btn-danger col-md-12 ">@lang('lang.clear_filter')</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    @endif
                    <div class="card mb-2">
                        <div class="card-body p-2">
                            <div class="row justify-content-center">
                                <div class="col-md-6 ">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <span>Total @lang('lang.items')</span>
                                            <h2><strong>{{ @num_format($total_item) }}</strong></h2>
                                        </div>
                                        <div class="col-md-6">
                                            <span>Total @lang('lang.quantity')</span>
                                            <h2><strong>{{ @num_format($total_qty) }}</strong></h2>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="col-md-12 d-flex justify-content-center">
                                    @php
                                        $color = '#733686';
                                        $color_rgba = 'rgba(115, 54, 134, 0.8)';

                                    @endphp
                                    <div class="col-md-6">
                                        <div class="pie-chart">
                                            <canvas id="pieChart" data-color="{{ $color }}"
                                                data-color_rgba="{{ $color_rgba }}" data-price={{ $total_price }}
                                                data-cost={{ $total_cost }} width="5" height="5"
                                                data-label1="@lang('lang.stock_value_by_price')" data-label2="@lang('lang.stock_value_by_cost')"
                                                data-label3="@lang('lang.estimate_profit')">
                                            </canvas>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </section>
@endsection

@section('javascript')

@endsection
