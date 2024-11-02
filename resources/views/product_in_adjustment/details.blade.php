@extends('layouts.app')
@section('title', __('lang.product_in_adjustment'))
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
                            @lang('lang.product_in_adjustment')
                            <span class="header-pill"></span>
                        </h5>
                    </div>
                    <div class="card mb-2">
                        <div class="card-body p-2">
                            <table class="table dataTable">
                                <thead>
                                    <tr>
                                        <th style="">@lang('lang.name')</th>
                                        <th>@lang('lang.product_code')</th>
                                        <th>@lang('lang.old_stock')</th>
                                        <th>@lang('lang.new_stock')</th>
                                        <th>@lang('lang.shortage')</th>
                                        <th>@lang('lang.value_of_shortage')</th>
                                        <th>@lang('lang.old_purchase_price')</th>
                                        <th>@lang('lang.new_purchase_price')</th>
                                        <th>@lang('lang.old_sell_price')</th>
                                        <th>@lang('lang.new_sell_price')</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($adjustment_details as $adjustment)
                                        <tr>
                                            <td>{{ $adjustment->product->name }}</td>
                                            <td>{{ $adjustment->product->sku }}</td>
                                            <td>{{ $adjustment->old_stock ?? '-' }}</td>
                                            <td>{{ $adjustment->new_stock ?? '-' }}</td>
                                            <td>{{ $adjustment->shortage ?? '-' }}</td>
                                            <td>{{ @num_format($adjustment->shortage_value) ?? '-' }}</td>
                                            <td>{{ $adjustment->old_purchase_price ?? '-' }}</td>
                                            <td>{{ $adjustment->new_purchase_price ?? '-' }}</td>
                                            <td>{{ $adjustment->old_sell_price ?? '-' }}</td>
                                            <td>{{ $adjustment->new_sell_price ?? '-' }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td></td>
                                        <th></th>
                                        <td></td>
                                        <th></th>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('javascript')
    <script type="text/javascript"></script>
@endsection
