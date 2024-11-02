@extends('layouts.app')
@section('title', __('lang.daily_sale_report'))
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
                            @lang('lang.daily_sale_report')
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
                                        <div class="col-md-3 px-5">
                                            <div class="form-group">
                                                {!! Form::label('method', __('lang.payment_type'), [
                                                    'class' => 'form-label d-block mb-1 app()->isLocale("ar") ? text-end : text-start',
                                                ]) !!}
                                                {!! Form::select('method', $payment_types, request()->method, [
                                                    'class' => 'form-control',
                                                    'placeholder' => __('lang.all'),
                                                    'data-live-search' => 'true',
                                                ]) !!}
                                            </div>
                                        </div>
                                        <div class="col-md-3 px-5">
                                            <div class="form-group">
                                                {!! Form::label('created_by', __('lang.cashier'), [
                                                    'class' => 'form-label d-block mb-1 app()->isLocale("ar") ? text-end : text-start',
                                                ]) !!}
                                                {!! Form::select('created_by', $cashiers, false, [
                                                    'class' => 'form-control selectpicker',
                                                    'id' => 'created_by',
                                                    'data-live-search' => 'true',
                                                    'placeholder' => __('lang.all'),
                                                ]) !!}
                                            </div>
                                        </div>

                                        <div class="col-md-3 px-5 d-flex justify-content-center align-items-center">
                                            <button type="submit" class="btn btn-main col-md-12">@lang('lang.filter')</button>
                                        </div>
                                        <div class="col-md-3 px-5 d-flex justify-content-center align-items-center">
                                            <a href="{{ action('ReportController@getDailySaleReport') }}"
                                                class="btn btn-danger col-md-12">@lang('lang.clear_filter')</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    @endif
                    <div class="card mb-2">
                        <div class="card-body p-2">
                            <table class="table table-bordered"
                                style="border-top: 1px solid #dee2e6; border-bottom: 1px solid #dee2e6;">
                                <thead>
                                    <tr>
                                        <th><a
                                                href="{{ url('report/get-daily-sale-report?year=' . $prev_year . '&month=' . $prev_month) }}"><i
                                                    class="fa fa-arrow-left"></i> {{ trans('lang.previous') }}</a></th>
                                        <th colspan="5" class="text-center">
                                            {{ date('F', strtotime($year . '-' . $month . '-01')) . ' ' . $year }}</th>
                                        <th><a
                                                href="{{ url('report/get-daily-sale-report?year=' . $next_year . '&month=' . $next_month) }}">{{ trans('lang.next') }}
                                                <i class="fa fa-arrow-right"></i></a></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><strong>@lang('lang.sunday')</strong></td>
                                        <td><strong>@lang('lang.monday')</strong></td>
                                        <td><strong>@lang('lang.tuesday')</strong></td>
                                        <td><strong>@lang('lang.wednesday')</strong></td>
                                        <td><strong>@lang('lang.thursday')</strong></td>
                                        <td><strong>@lang('lang.friday')</strong></td>
                                        <td><strong>@lang('lang.saturday')</strong></td>
                                    </tr>
                                    @php
                                        $i = 1;
                                        $flag = 0;
                                    @endphp
                                    @while ($i <= $number_of_day)
                                        <tr>
                                            @for ($j = 1; $j <= 7; $j++)
                                                @if ($i > $number_of_day)
                                                    @php
                                                        break;
                                                    @endphp
                                                @endif
                                                @if ($flag)
                                                    @if ($year . '-' . $month . '-' . $i == date('Y') . '-' . date('m') . '-' . (int) date('d'))
                                                        <td>
                                                            <p style="color:red"><strong>{{ $i }}</strong>
                                                            </p>
                                                        @else
                                                        <td>
                                                            <p><strong>{{ $i }}</strong></p>
                                                    @endif

                                                    @if (!empty($total_surplus[$i]))
                                                        <strong>@lang('lang.total_surplus')</strong><br><span>{{ @num_format($total_surplus[$i]) }}</span><br><br>
                                                    @endif

                                                    @if (!empty($total_discount[$i]))
                                                        <strong>@lang('lang.product_discount')</strong><br><span>{{ @num_format($total_discount[$i]) }}</span><br><br>
                                                    @endif

                                                    @if (!empty($total_tax[$i]))
                                                        <strong>@lang('lang.product_tax')</strong><br><span>{{ @num_format($total_tax[$i]) }}</span><br><br>
                                                    @endif

                                                    @if (!empty($order_tax[$i]))
                                                        <strong>@lang('lang.order_tax')</strong><br><span>{{ @num_format($order_tax[$i]) }}</span><br><br>
                                                    @endif

                                                    @if (!empty($shipping_cost[$i]))
                                                        <strong>@lang('lang.delivery_cost')</strong><br><span>{{ @num_format($shipping_cost[$i]) }}</span><br><br>
                                                    @endif

                                                    @if (!empty($grand_total[$i]))
                                                        <strong>@lang('lang.grand_total')</strong><br><span>{{ @num_format($grand_total[$i]) }}</span><br><br>
                                                    @endif

                                                    </td>
                                                    @php
                                                        $i++;
                                                    @endphp
                                                @elseif($j == $start_day)
                                                    @if ($year . '-' . $month . '-' . $i == date('Y') . '-' . date('m') . '-' . (int) date('d'))
                                                        <td>
                                                            <p style="color:red"><strong>'.$i.'</strong></p>
                                                        @else
                                                        <td>
                                                            <p><strong>{{ $i }}</strong></p>
                                                    @endif

                                                    @if (!empty($total_discount[$i]))
                                                        <strong>@lang('lang.product_discount')</strong><br><span>{{ @num_format($total_discount[$i]) }}</span><br><br>
                                                    @endif

                                                    @if (!empty($total_tax[$i]))
                                                        <strong>@lang('lang.product_tax')</strong><br><span>{{ @num_format($total_tax[$i]) }}</span><br><br>
                                                    @endif

                                                    @if (!empty($order_tax[$i]))
                                                        <strong>@lang('lang.order_tax')</strong><br><span>{{ @num_format($order_tax[$i]) }}</span><br><br>
                                                    @endif

                                                    @if (!empty($shipping_cost[$i]))
                                                        <strong>@lang('lang.delivery_cost')</strong><br><span>{{ @num_format($shipping_cost[$i]) }}</span><br><br>
                                                    @endif

                                                    @if (!empty($grand_total[$i]))
                                                        <strong>@lang('lang.grand_total')</strong><br><span>{{ @num_format($grand_total[$i]) }}</span><br><br>
                                                    @endif

                                                    </td>
                                                    @php
                                                        $flag = 1;
                                                        $i++;
                                                        continue;
                                                    @endphp
                                                @else
                                                    <td></td>
                                                @endif
                                            @endfor

                                        </tr>
                                    @endwhile

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

@endsection
