@if (auth()->user()->can('superadmin') || auth()->user()->is_admin)

    <div class="row">
        <div class="col-md-12 mt-4">

            <div class="card mt-3 mb-2 line-chart-example">
                <div class="card-body p-2">
                    <div
                        class="  d-flex align-items-center my-2 @if (app()->isLocale('ar')) justify-content-end @else justify-content-start @endif">
                        <h5 class="print-title mb-0 position-relative print-title" style="margin-right: 30px">
                            @lang('lang.cash_flow')
                            <span class="header-pill"></span>
                        </h5>
                    </div>

                    @php
                        $color = '#733686';
                        $color_rgba = 'rgba(115, 54, 134, 0.8)';
                    @endphp
                    <div class="row align-items-center">

                        <div class="col-md-7">
                            <canvas id="cashFlow" data-color="{{ $color }}"
                                data-color_rgba="{{ $color_rgba }}"
                                data-recieved="{{ json_encode($payment_received) }}"
                                data-sent="{{ json_encode($payment_sent) }}" data-month="{{ json_encode($month) }}"
                                data-label1="@lang('lang.payment_received')" data-label2="@lang('lang.payment_sent')"></canvas>
                        </div>
                        <div class="col-md-5">
                            <div class="card mb-2">
                                <div class="card-body p-2">
                                    <div
                                        class="  d-flex align-items-center my-2 @if (app()->isLocale('ar')) justify-content-end @else justify-content-start @endif">
                                        <h5 class="print-title mb-0 position-relative print-title"
                                            style="margin-right: 30px">{{ @format_date($start_date) }} -
                                            {{ @format_date($end_date) }}
                                            <span class="header-pill"></span>
                                        </h5>
                                    </div>

                                    <div class="pie-chart mb-2">
                                        <canvas id="transactionChart" data-color="{{ $color }}"
                                            data-color_rgba="{{ $color_rgba }}"
                                            data-revenue={{ $dashboard_data['revenue'] }}
                                            data-purchase={{ $dashboard_data['purchase'] }}
                                            data-expense={{ $dashboard_data['expense'] }}
                                            data-label1="@lang('lang.purchase')" data-label2="@lang('lang.revenue')"
                                            data-label3="@lang('lang.expense')">
                                        </canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12 mt-4">
            <div class="card mb-2">
                <div class="card-body p-2">
                    <div
                        class="  d-flex align-items-center my-2 @if (app()->isLocale('ar')) justify-content-end @else justify-content-start @endif">
                        <h5 class="print-title mb-0 position-relative print-title" style="margin-right: 30px">
                            @lang('lang.yearly_report')
                            <span class="header-pill"></span>
                        </h5>
                    </div>
                    <canvas id="saleChart" data-sale_chart_value="{{ json_encode($yearly_sale_amount) }}"
                        data-purchase_chart_value="{{ json_encode($yearly_purchase_amount) }}"
                        data-label1="@lang('lang.purchased_amount')" data-label2="@lang('lang.sold_amount')"></canvas>
                </div>
            </div>
        </div>
    </div>

    <div class="row @if (app()->isLocale('ar')) flex-row-reverse @else flex-row @endif">

        <div class="col-md-6">
            <div class="card mb-2">
                <div class="card-body p-2">
                    <div
                        class="px-3  d-flex align-items-center justify-content-between my-2 @if (app()->isLocale('ar')) flex-row-reverse @else flex-row @endif">
                        <h5 class=" mb-0 position-relative">
                            @lang('lang.recent_transactions')
                            <span class="header-pill"></span>

                        </h5>
                        <div class="badge badge-primary">@lang('lang.latest') 5</div>
                    </div>

                    <div class="p-2" style="background-color: var(--secondary-color);border-radius: 8px">
                        <ul class="nav nav-tabs mb-2 border-0 justify-content-around" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" href="#sale-latest" role="tab"
                                    data-toggle="tab">@lang('lang.sale')</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#purchase-latest" role="tab"
                                    data-toggle="tab">@lang('lang.purchase')</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#quotation-latest" role="tab"
                                    data-toggle="tab">@lang('lang.quotation')</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#payment-latest" role="tab"
                                    data-toggle="tab">@lang('lang.payments')</a>
                            </li>
                        </ul>

                        <div class="tab-content">
                            <div role="tabpanel" class="tab-pane fade show active" id="sale-latest">
                                <div class="table-responsive" style="background-color: white">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>@lang('lang.date')</th>
                                                <th>@lang('lang.reference_no')</th>
                                                <th>@lang('lang.customer')</th>
                                                <th>@lang('lang.grand_total')</th>
                                                <th>@lang('lang.status')</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($sales as $sale)
                                                <tr>
                                                    <td>{{ @format_date($sale->transaction_date) }}</td>
                                                    <td>{{ $sale->invoice_no }}</td>
                                                    <td>
                                                        @if (!empty($sale->customer))
                                                            {{ $sale->customer->name }}
                                                        @endif
                                                    </td>
                                                    <td>{{ @num_format($sale->final_total) }}</td>
                                                    <td>
                                                        @if ($sale->status == 'final')
                                                            <span class="badge badge-success">@lang('lang.completed')</span>
                                                        @else
                                                            {{ ucfirst($sale->status) }}
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div role="tabpanel" class="tab-pane fade" id="purchase-latest">
                                <div class="table-responsive" style="background-color: white">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>@lang('lang.date')</th>
                                                <th>@lang('lang.reference_no')</th>
                                                <th>@lang('lang.supplier')</th>
                                                <th>@lang('lang.grand_total')</th>
                                                <th>@lang('lang.status')</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($add_stocks as $add_stock)
                                                <tr>
                                                    <td>{{ @format_date($add_stock->transaction_date) }}</td>
                                                    <td>{{ $add_stock->invoice_no }}</td>
                                                    <td>
                                                        @if (!empty($add_stock->supplier))
                                                            {{ $add_stock->supplier->name }}
                                                        @endif
                                                    </td>
                                                    <td>{{ @num_format($add_stock->final_total) }}</td>
                                                    <td>
                                                        @if ($add_stock->status == 'received')
                                                            <span class="badge badge-success">@lang('lang.completed')</span>
                                                        @else
                                                            {{ ucfirst($add_stock->status) }}
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div role="tabpanel" class="tab-pane fade" id="quotation-latest">
                                <div class="table-responsive" style="background-color: white">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>@lang('lang.date')</th>
                                                <th>@lang('lang.reference_no')</th>
                                                <th>@lang('lang.customer')</th>
                                                <th>@lang('lang.grand_total')</th>
                                                <th>@lang('lang.status')</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($quotations as $quotation)
                                                <tr>
                                                    <td>{{ @format_date($quotation->transaction_date) }}</td>
                                                    <td>{{ $quotation->invoice_no }}</td>
                                                    <td>
                                                        @if (!empty($quotation->customer))
                                                            {{ $quotation->customer->name }}
                                                        @endif
                                                    </td>
                                                    <td>{{ @num_format($quotation->final_total) }}</td>
                                                    <td>
                                                        @if ($quotation->status == 'final')
                                                            <span class="badge badge-success">@lang('lang.completed')</span>
                                                        @else
                                                            {{ ucfirst($quotation->status) }}
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div role="tabpanel" class="tab-pane fade" id="payment-latest">
                                <div class="table-responsive" style="background-color: white">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>@lang('lang.date')</th>
                                                <th>@lang('lang.payment_ref')</th>
                                                <th>@lang('lang.paid_by')</th>
                                                <th>@lang('lang.amount')</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($payments as $payment)
                                                <tr>
                                                    <td>{{ @format_date($payment->paid_on) }}</td>
                                                    <td>{{ $payment->invoice_no }}</td>
                                                    <td>
                                                        @if (!empty($payment_types[$payment->method]))
                                                            {{ $payment_types[$payment->method] }}
                                                        @endif
                                                    </td>
                                                    <td>{{ @num_format($payment->amount) }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>



        <div class="col-md-6">
            <div class="card mb-2">
                <div class="card-body p-2">
                    <div
                        class="px-3  d-flex align-items-center justify-content-between my-2 @if (app()->isLocale('ar')) flex-row-reverse @else flex-row @endif">
                        <h5 class=" mb-0 position-relative">
                            @lang('lang.best_seller')
                            <span class="header-pill"></span>
                        </h5>
                        <div class="badge badge-primary">@lang('lang.top') 5</div>
                    </div>
                    <div class="p-2" style="background-color: var(--secondary-color);border-radius: 8px">

                        <div class="table-responsive" style="background-color: white">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>SL No</th>
                                        <th>@lang('lang.product_details')</th>
                                        <th>@lang('lang.qty')</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($best_sellings as $best_selling)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $best_selling->product->name }} [{{ $best_selling->product->sku }}]
                                            </td>
                                            <td>{{ @num_format($best_selling->qty) }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card mb-2">
                <div class="card-body p-2">
                    <div
                        class="px-3  d-flex align-items-center justify-content-between my-2 @if (app()->isLocale('ar')) flex-row-reverse @else flex-row @endif">
                        <h5 class=" mb-0 position-relative">
                            @lang('lang.best_seller') (@lang('lang.qty'))
                            <span class="header-pill"></span>
                        </h5>
                        <div class="badge badge-primary">@lang('lang.top') 5</div>

                    </div>


                    <div class="p-2" style="background-color: var(--secondary-color);border-radius: 8px">

                        <div class="table-responsive" style="background-color: white">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>SL No</th>
                                        <th>@lang('lang.product_details')</th>
                                        <th>@lang('lang.qty')</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($yearly_best_sellings_qty as $best_sellings_qty)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $best_sellings_qty->product->name }}
                                                [{{ $best_sellings_qty->product->sku }}]</td>
                                            <td>{{ @num_format($best_sellings_qty->qty) }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card mb-2">
                <div class="card-body p-2">


                    <div
                        class="px-3  d-flex align-items-center justify-content-between my-2 @if (app()->isLocale('ar')) flex-row-reverse @else flex-row @endif">
                        <h5 class=" mb-0 position-relative">
                            @lang('lang.best_seller') (@lang('lang.price'))
                            <span class="header-pill"></span>
                        </h5>
                        <div class="badge badge-primary">@lang('lang.top') 5</div>
                    </div>
                    <div class="p-2" style="background-color: var(--secondary-color);border-radius: 8px">

                        <div class="table-responsive" style="background-color: white">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>SL No</th>
                                        <th>@lang('lang.product_details')</th>
                                        <th>@lang('lang.qty')</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($yearly_best_sellings_price as $best_sellings_price)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $best_sellings_price->product->name }}
                                                [{{ $best_sellings_price->product->sku }}]
                                            </td>
                                            <td>{{ @num_format($best_sellings_price->total_price) }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif
