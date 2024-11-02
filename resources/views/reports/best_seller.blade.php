@extends('layouts.app')
@section('title', __('lang.best_seller_report'))
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
                        <h5 class="mb-0 position-relative" style="margin-right: 30px">
                            @lang('lang.best_seller_report')
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
                                            <a href="{{ action('ReportController@getBestSellerReport') }}"
                                                class="btn btn-danger col-md-12 ">@lang('lang.clear_filter')</a>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </form>
                    @endif
                    <div class="card mb-2">
                        <div class="card-body p-2">
                            <div class="col-md-12">
                                @php
                                    $color = '#733686';
                                    $color_rgba = 'rgba(115, 54, 134, 0.8)';

                                @endphp
                                <canvas id="bestSeller" data-color="{{ $color }}"
                                    data-color_rgba="{{ $color_rgba }}" data-product = "{{ json_encode($product) }}"
                                    data-sold_qty="{{ json_encode($sold_qty) }}"></canvas>
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
