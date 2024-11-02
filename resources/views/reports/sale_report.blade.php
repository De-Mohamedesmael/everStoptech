@extends('layouts.app')
@section('title', __('lang.sale_report'))
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
                            @lang('lang.sale_report')
                            <span class="header-pill"></span>
                        </h5>
                    </div>
                    <form action="">
                        <div class="card mb-2">
                            <div class="card-body p-2">
                                <div class="row @if (app()->isLocale('ar')) flex-row-reverse @else flex-row @endif">
                                    <div class="col-md-3 px-5">
                                        <div class="form-group">
                                            {!! Form::label('start_date', __('lang.start_date'), [
                                                'class' => 'form-label d-block mb-1 app()->isLocale("ar") ? text-end : text-start',
                                            ]) !!}
                                            {!! Form::text('start_date', request()->start_date, [
                                                'class' => 'form-control  modal-input app()->isLocale("ar") ? text-end : text-start',
                                            ]) !!}
                                        </div>
                                    </div>
                                    <div class="col-md-3 px-5">
                                        <div class="form-group">
                                            {!! Form::label('start_time', __('lang.start_time'), [
                                                'class' => 'form-label d-block mb-1 app()->isLocale("ar") ? text-end : text-start',
                                            ]) !!}
                                            {!! Form::text('start_time', request()->start_time, [
                                                'class' => 'form-control
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        time_picker sale_filter  modal-input app()->isLocale("ar") ? text-end : text-start',
                                            ]) !!}
                                        </div>
                                    </div>
                                    <div class="col-md-3 px-5">
                                        <div class="form-group">
                                            {!! Form::label('end_date', __('lang.end_date'), [
                                                'class' => 'form-label d-block mb-1 app()->isLocale("ar") ? text-end : text-start',
                                            ]) !!}
                                            {!! Form::text('end_date', request()->end_date, [
                                                'class' => 'form-control  modal-input app()->isLocale("ar") ? text-end : text-start',
                                            ]) !!}
                                        </div>
                                    </div>
                                    <div class="col-md-3 px-5">
                                        <div class="form-group">
                                            {!! Form::label('end_time', __('lang.end_time'), [
                                                'class' => 'form-label d-block mb-1 app()->isLocale("ar") ? text-end : text-start',
                                            ]) !!}
                                            {!! Form::text('end_time', request()->end_time, [
                                                'class' => 'form-control time_picker
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        sale_filter  modal-input app()->isLocale("ar") ? text-end : text-start',
                                            ]) !!}
                                        </div>
                                    </div>
                                    @if (session('user.is_superadmin'))
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
                                        <div class="col-md-3 px-5">
                                            <div class="form-group">
                                                {!! Form::label('pos_id', __('lang.pos'), [
                                                    'class' => 'form-label d-block mb-1 app()->isLocale("ar") ? text-end : text-start',
                                                ]) !!}
                                                {!! Form::select('pos_id', $store_pos, request()->pos_id, [
                                                    'class' => 'form-control',
                                                    'placeholder' => __('lang.all'),
                                                    'data-live-search' => 'true',
                                                ]) !!}
                                            </div>
                                        </div>
                                    @endif
                                    <div class="col-md-3 px-5">
                                        <div class="form-group">
                                            {!! Form::label('product_id', __('lang.product'), [
                                                'class' => 'form-label d-block mb-1 app()->isLocale("ar") ? text-end : text-start',
                                            ]) !!}
                                            {!! Form::select('product_id', $products, request()->product_id, [
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
                                        <a href="{{ action('ReportController@getSaleReport') }}"
                                            class="btn btn-danger col-md-12">@lang('lang.clear_filter')</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                    <div class="card mb-2">
                        <div class="card-body p-2">
                            <div class="table-responsive">
                                <table class="table dataTable">
                                    <thead>
                                        <tr>
                                            <th>@lang('lang.product_name')</th>
                                            <th class="sum">@lang('lang.sold_amount')</th>
                                            <th class="sum">@lang('lang.sold_qty')</th>
                                            <th class="sum">@lang('lang.in_stock')</th>
                                            <th>@lang('lang.sale_note')</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @foreach ($transactions as $transaction)
                                            <tr>
                                                <td>{{ $transaction->product_name }}</td>
                                                <td> {{ @num_format($transaction->sold_amount) }}</td>
                                                <td> {{ @num_format($transaction->sold_qty) }}</td>
                                                <td> {{ preg_match('/\.\d*[1-9]+/', (string) $transaction->in_stock) ? $transaction->in_stock : @num_format($transaction->in_stock) }}
                                                </td>
                                                <td> {{ $transaction->sale_note }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th style="text-align: right">@lang('lang.total')</th>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                        </tr>
                                    </tfoot>
                                </table>
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
