@extends('layouts.app')
@section('title', __('lang.purchase_return'))
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
                            @lang('lang.purchase_return')
                            <span class="header-pill"></span>
                        </h5>
                    </div>

                    {!! Form::open([
                        'url' => action('PurchaseReturnController@store'),
                        'method' => 'post',
                        'files' => true,
                        'class' => 'pos-form',
                        'id' => 'purchase_return_form',
                    ]) !!}
                    <div class="card mb-2">
                        <div class="card-body p-2">
                            <div class="row @if (app()->isLocale('ar')) flex-row-reverse @else flex-row @endif">
                                <div class="col-md-3 px-5">
                                    <div class="form-group">
                                        <label
                                            class="form-label d-block mb-1  @if (app()->isLocale('ar')) text-end @else text-start @endif"
                                            for="supplier_id">@lang('lang.supplier')</label>
                                        {!! Form::select('supplier_id', $suppliers, false, [
                                            'class' => 'form-control',
                                            'data-live-search' => 'true',
                                            'placeholder' => __('lang.please_select'),
                                            'required',
                                        ]) !!}
                                    </div>
                                </div>
                                <div class="col-md-3 px-5">
                                    <div class="form-group">
                                        <label
                                            class="form-label d-block mb-1  @if (app()->isLocale('ar')) text-end @else text-start @endif"
                                            for="store_id">@lang('lang.store')</label>
                                        {!! Form::select('store_id', $stores, false, [
                                            'class' => 'form-control',
                                            'data-live-search' => 'true',
                                            'placeholder' => __('lang.please_select'),
                                            'required',
                                            'id' => 'store_id',
                                        ]) !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card mb-2">
                        <div class="card-body p-2">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="search-box input-group"
                                        style="background-color: #e6e6e6;border-radius: 6px!important">
                                        <button type="button" class="select-button " style="height: auto !important"
                                            id="search_button"><i class="fa fa-search"></i></button>
                                        <input type="text" name="search_product" id="search_product"
                                            placeholder="@lang('lang.enter_product_name_to_print_labels')"
                                            class="form-control ui-autocomplete-input modal-input @if (app()->isLocale('ar')) text-end @else  text-start @endif "
                                            autocomplete="off" style="width: 80% !important">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card mb-2">
                        <div class="card-body p-2">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="table-responsive">
                                        <table id="product_table" style="width: 100% " class="table table-striped">
                                            <thead>
                                                <tr>
                                                    <th style="width: 30%">{{ __('lang.product') }}</th>
                                                    <th style="width: 20%">{{ __('lang.returned_quantity') }}</th>
                                                    <th style="width: 20%">{{ __('lang.price') }}</th>
                                                    <th style="width: 20%">{{ __('lang.current_stock') }}</th>
                                                    <th class="sum" style="width: 10%">{{ __('lang.sub_total') }}
                                                    </th>
                                                    <th style="width: 20%"></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @include('purchase_return.partials.product_row', [
                                                    'products' => [],
                                                ])
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <td></td>
                                                    <td></td>
                                                    <th style="text-align: right">@lang('lang.total')</th>
                                                    <th></th>
                                                    <th><span class="grand_total_span">{{ @num_format(0) }}</span></th>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="row" style="display: none;">
                                        <div class="col-md-2">
                                            <div class="form-group">

                                                <input type="hidden" id="final_total" name="final_total"
                                                    value="{{ 0 }}" />
                                                <input type="hidden" id="grand_total" name="grand_total"
                                                    value="{{ 0 }}" />

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card mb-2">
                        <div class="card-body p-2">
                            <div class="row @if (app()->isLocale('ar')) flex-row-reverse @else flex-row @endif">
                                <div class="col-md-3 px-5">
                                    <div class="form-group">
                                        {!! Form::label('payment_status', __('lang.payment_status'), [
                                            'class' => 'form-label d-block mb-1 app()->isLocale("ar") ? text-end : text-start',
                                        ]) !!}
                                        {!! Form::select('payment_status', $payment_status_array, false, [
                                            'class' => 'form-control',
                                            'placeholder' => __('lang.please_select'),
                                            'required',
                                        ]) !!}
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    @if (!empty($purchase_return))
                                        @if ($purchase_return->transaction_payments->count() > 0)
                                            @include('add_stock.partials.payment_form', [
                                                'payment' => $purchase_return->transaction_payments->first(),
                                            ])
                                        @endif
                                    @else
                                        @include('add_stock.partials.payment_form')
                                    @endif
                                </div>
                            </div>

                            <div class="row @if (app()->isLocale('ar')) flex-row-reverse @else flex-row @endif">
                                <div class="col-md-3 due_fields hide">
                                    <div class="form-group">
                                        {!! Form::label('due_date', __('lang.due_date'), [
                                            'class' => 'form-label d-block mb-1 app()->isLocale("ar") ? text-end : text-start',
                                        ]) !!}
                                        {!! Form::text('due_date', !empty($payment) ? $payment->due_date : null, [
                                            'class' => 'form-control   modal-input app()->isLocale("ar") ? text-end : text-start datepicker',
                                            'readonly',
                                            'placeholder' => __('lang.due_date'),
                                        ]) !!}
                                    </div>
                                </div>

                                <div class="col-md-3 due_fields hide">
                                    <div class="form-group">
                                        {!! Form::label('notify_before_days', __('lang.notify_before_days'), [
                                            'class' => 'form-label d-block mb-1 app()->isLocale("ar") ? text-end : text-start',
                                        ]) !!}
                                        {!! Form::text('notify_before_days', !empty($payment) ? $payment->notify_before_days : null, [
                                            'class' => 'form-control  modal-input app()->isLocale("ar") ? text-end : text-start',
                                            'placeholder' => __('lang.notify_before_days'),
                                        ]) !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div
                        class="d-flex my-2  @if (app()->isLocale('ar')) justify-content-end @else justify-content-start @endif">
                        <button class="text-decoration-none toggle-button mb-0" type="button" data-bs-toggle="collapse"
                            data-bs-target="#detailsCollapse" aria-expanded="false" aria-controls="detailsCollapse">
                            <i class="fas fa-arrow-down"></i>
                            @lang('lang.product_details')
                            <span class="toggle-pill"></span>
                        </button>
                    </div>

                    <div class="collapse" id="detailsCollapse">
                        <div class="card mb-2">
                            <div class="card-body p-2">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            {!! Form::label('notes', __('lang.notes'), [
                                                'class' => 'form-label d-block mb-1 app()->isLocale("ar") ? text-end : text-start',
                                            ]) !!}
                                            {!! Form::textarea('notes', null, [
                                                'class' => 'form-control modal-input app()->isLocale("ar") ? text-end : text-start',
                                                'rows' => 3,
                                            ]) !!}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row my-2 justify-content-center align-items-center">
                        <div class="col-md-2">
                            <button type="sbumit" class="btn py-1 submit-btn save-btn">@lang('lang.save')</button>
                        </div>
                    </div>

                    {!! Form::close() !!}
                </div>
            </div>
        </div>


    </section>
    <!-- This will be printed -->
    <section class="invoice print_section print-only" id="receipt_section"> </section>
@endsection

@section('javascript')
    <script src="{{ asset('js/purchase_return.js') }}"></script>

    <script src="{{ asset('front/js/bootstrap.min.js') }}"></script>
    <script>
        // Add an event listener for the 'show.bs.collapse' and 'hide.bs.collapse' events
        $('#detailsCollapse').on('show.bs.collapse', function() {
            // Change the arrow icon to 'chevron-up' when the content is expanded
            $('button[data-bs-target="#detailsCollapse"] i').removeClass('fa-arrow-down').addClass(
                'fa-arrow-up');
        });

        $('#detailsCollapse').on('hide.bs.collapse', function() {
            // Change the arrow icon to 'chevron-down' when the content is collapsed
            $('button[data-bs-target="#detailsCollapse"] i').removeClass('fa-arrow-up').addClass(
                'fa-arrow-down');
        });
    </script>
    <script>
        $(document).ready(function() {
            calculate_sub_totals()
        })
    </script>
@endsection
