@extends('layouts.app')
@section('title', __('lang.category_report'))
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
                            @lang('lang.product_report')
                            <span class="header-pill"></span>
                        </h5>
                    </div>

                    <div class="card mb-2">
                        <div class="card-body p-2">

                            <div class="table-responsive">
                                <table class="table dataTable">
                                    <thead>
                                        <tr>
                                            <th>@lang('lang.category')</th>
                                            <th>@lang('lang.sales')</th>
                                            <th>@lang('lang.purchases')</th>
                                            <th>@lang('lang.purchased_qty')</th>
                                            <th>@lang('lang.sold_qty')</th>
                                            <th>@lang('lang.profit')</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @foreach ($transactions as $transaction)
                                            <tr>
                                                <td>{{ $transaction->product_class_name }}</td>
                                                <td>{{ number_format($transaction->sold_amount, 3) }}</td>
                                                <td>{{ number_format($transaction->purchased_amount, 3) }}</td>
                                                <td>{{ number_format($transaction->purchased_qty, 3) }}</td>
                                                <td>{{ number_format($transaction->sold_qty, 3) }}</td>
                                                <td> {{ number_format($transaction->sold_amount - $transaction->purchased_amount, 3) }}
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th></th>
                                            <th style="text-align: right">@lang('lang.total')</th>
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
