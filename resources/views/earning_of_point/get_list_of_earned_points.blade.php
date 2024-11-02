@extends('layouts.app')
@section('title', __('lang.list_of_earn_point_by_transactions'))
@section('style')
    <link rel="stylesheet" type="text/css" href="{{ url('front/css/stock.css') }}">
@endsection
@section('content')
    <section class="forms py-0">

        <div class="container-fluid no-print">
            <div class="col-md-12 px-1">

                <div
                    class="d-flex align-items-center my-2 @if (app()->isLocale('ar')) justify-content-end @else justify-content-start @endif">
                    <h5 class="mb-0 position-relative print-title" style="margin-right: 30px">
                        @lang('lang.list_of_earn_point_by_transactions')
                        <span class="header-pill"></span>
                    </h5>
                </div>
                <div class="card mb-2">
                    <div class="card-body p-2">

                        <div class="table-responsive">
                            <table id="store_table" class="table dataTable">
                                <thead>
                                    <tr>
                                        <th>@lang('lang.date_and_time')</th>
                                        <th>@lang('lang.store')</th>
                                        <th>@lang('lang.cashier')</th>
                                        <th>@lang('lang.customer')</th>
                                        <th>@lang('lang.invoice_no')</th>
                                        <th>@lang('lang.product_grant_the_points')</th>
                                        <th>@lang('lang.value')</th>
                                        <th>@lang('lang.paid_amount')</th>
                                        <th>@lang('lang.point_earned')</th>
                                        <th>@lang('lang.balance')</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($transactions as $transaction)
                                        <tr>
                                            <td>{{ @format_datetime($transaction->transaction_date) }}
                                            </td>
                                            <td>{{ $transaction->store->name ?? '' }}</td>
                                            <td>{{ ucfirst($transaction->created_by_user->name ?? '') }}</td>
                                            <td>{{ $transaction->customer->name ?? '' }}</td>
                                            <td style="color: rgb(85, 85, 231)"><a
                                                    data-href="{{ action('SellController@show', $transaction->id) }}"
                                                    data-container=".view_modal"
                                                    class="btn btn-modal">{{ $transaction->invoice_no }}</a></td>
                                            <td>
                                                @php
                                                    $sell_lines = App\Models\TransactionSellLine::where(
                                                        'transaction_id',
                                                        $transaction->id,
                                                    )
                                                        ->where('point_earned', 1)
                                                        ->get();
                                                @endphp
                                                @foreach ($sell_lines as $line)
                                                    {{ $line->product->name }},
                                                @endforeach
                                            </td>
                                            <td>{{ @num_format($transaction->final_total) }}</td>
                                            <td>{{ @num_format($transaction->transaction_payments->sum('amount')) }}
                                            </td>
                                            <td>{{ @num_format($transaction->rp_earned) }}</td>
                                            <td>{{ @num_format($transaction->customer->total_rp) }}</td>

                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>

    </section>
@endsection

@section('javascript')
    <script></script>
@endsection
