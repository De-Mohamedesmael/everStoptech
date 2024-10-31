@extends('layouts.app')
@section('title', __('lang.purchase_order'))
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
                            @lang('lang.purchase_order')
                            <span class="header-pill"></span>
                        </h5>
                    </div>
                    {!! Form::open([
                        'url' => action('PurchaseOrderController@update', $purchase_order->id),
                        'method' => 'put',
                        'id' => 'purchase_order_form',
                    ]) !!}
                    <div class="card mb-2">
                        <div class="card-body p-2">
                            <div class="row @if (app()->isLocale('ar')) flex-row-reverse @else flex-row @endif">
                                <div class="col-md-3 px-5">
                                    <div class="form-group">
                                        {!! Form::label('store_id', __('lang.store') . '*', [
                                            'class' => 'form-label d-block mb-1 app()->isLocale("ar") ? text-end : text-start',
                                        ]) !!}
                                        {!! Form::select('store_id', $stores, $purchase_order->store_id, [
                                            'class' => 'selectpicker form-control',
                                            'data-live-search' => 'true',
                                            'required',
                                            'style' => 'width: 80%',
                                            'placeholder' => __('lang.please_select'),
                                        ]) !!}
                                    </div>
                                </div>
                                <div class="col-md-3 px-5">
                                    <div class="form-group">
                                        {!! Form::label('supplier_id', __('lang.supplier') . '*', [
                                            'class' => 'form-label d-block mb-1 app()->isLocale("ar") ? text-end : text-start',
                                        ]) !!}
                                        {!! Form::select('supplier_id', $suppliers, $purchase_order->supplier_id, [
                                            'class' => 'selectpicker form-control',
                                            'data-live-search' => 'true',
                                            'required',
                                            'style' => 'width: 80%',
                                            'placeholder' => __('lang.please_select'),
                                        ]) !!}
                                    </div>
                                </div>

                                <div class="col-md-3 px-5">
                                    <div class="form-group">
                                        {!! Form::label('status', __('lang.status') . '*', [
                                            'class' => 'form-label d-block mb-1 app()->isLocale("ar") ? text-end : text-start',
                                        ]) !!}
                                        {!! Form::select('status', $status_array, $purchase_order->status, [
                                            'class' => 'selectpicker form-control',
                                            'data-live-search' => 'true',
                                            'required',
                                            'style' => 'width: 80%',
                                            'placeholder' => __('lang.please_select'),
                                        ]) !!}
                                    </div>
                                </div>
                                <div class="col-md-3 px-5">
                                    <div class="form-group">
                                        {!! Form::label('po_no', __('lang.po_no') . '*', [
                                            'class' => 'form-label d-block mb-1 app()->isLocale("ar") ? text-end : text-start',
                                        ]) !!}
                                        {!! Form::text('po_no', $purchase_order->po_no, [
                                            'class' => 'form-control modal-input app()->isLocale("ar") ? text-end : text-start',
                                            'required',
                                            'readonly',
                                            'placeholder' => __('lang.po_no'),
                                        ]) !!}
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="card mb-2">
                        <div class="card-body p-2">
                            <div class="row">
                                <div class="col-md-12 mb-3">
                                    <div class="search-box input-group"
                                        style="background-color: #e6e6e6;border-radius: 6px!important">
                                        <button type="button" class="select-button " style="height: auto !important"><i
                                                class="fa fa-search"></i></button>
                                        <input type="text" name="search_product" id="search_product"
                                            placeholder="@lang('lang.enter_product_name_to_print_labels')"
                                            class="form-control ui-autocomplete-input  modal-input @if (app()->isLocale('ar')) text-end @else  text-start @endif"
                                            style="width: 80% !important" autocomplete="off">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <table class="table table-bordered table-striped table-condensed" id="product_table">
                                        <thead>
                                            <tr>
                                                <th style="width: 25%" class="col-sm-8">@lang('lang.products')</th>
                                                @if (session('system_mode') == 'pos' || session('system_mode') == 'garments' || session('system_mode') == 'supermarket')
                                                    <th style="width: 25%" class="col-sm-4">@lang('lang.sku')</th>
                                                @endif
                                                <th style="width: 25%" class="col-sm-4">@lang('lang.quantity')</th>
                                                <th style="width: 12%" class="col-sm-4">@lang('lang.purchase_price')</th>
                                                <th style="width: 12%" class="col-sm-4">@lang('lang.sub_total')</th>
                                                <th style="width: 12%" class="col-sm-4">@lang('lang.action')</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($purchase_order->purchase_order_lines as $product)
                                                <tr>
                                                    <td>
                                                        {{ $product->product->name }}

                                                        @if ($product->variation->name != 'Default')
                                                            <b>{{ $product->variation->name }}</b>
                                                        @endif
                                                        <input type="hidden"
                                                            name="purchase_order_lines[{{ $loop->index }}][purchase_order_line_id]"
                                                            value="{{ $product->id }}">
                                                        <input type="hidden"
                                                            name="purchase_order_lines[{{ $loop->index }}][product_id]"
                                                            value="{{ $product->product_id }}">
                                                        <input type="hidden"
                                                            name="purchase_order_lines[{{ $loop->index }}][variation_id]"
                                                            value="{{ $product->variation_id }}">
                                                    </td>
                                                    @if (session('system_mode') == 'pos' || session('system_mode') == 'garments' || session('system_mode') == 'supermarket')
                                                        <td>
                                                            {{ $product->variation->sub_sku }}
                                                        </td>
                                                    @endif
                                                    <td>
                                                        <input type="text" class="form-control quantity" min=1
                                                            name="purchase_order_lines[{{ $loop->index }}][quantity]"
                                                            required
                                                            value="@if (isset($product->quantity)) {{ preg_match('/\.\d*[1-9]+/', (string) $product->quantity) ? $product->quantity : @num_format($product->quantity) }}@else{{ 1 }} @endif">
                                                    </td>
                                                    <td>
                                                        <input type="text" class="form-control purchase_price"
                                                            name="purchase_order_lines[{{ $loop->index }}][purchase_price]"
                                                            required
                                                            value="@if (isset($product->purchase_price)) {{ @num_format($product->purchase_price) }}@else{{ 0 }} @endif">
                                                    </td>
                                                    <td>
                                                        <span
                                                            class="sub_total_span">{{ preg_match('/\.\d*[1-9]+/', (string) $product->sub_total) ? $product->sub_total : @num_format($product->sub_total) }}</span>
                                                        <input type="hidden" class="form-control sub_total"
                                                            name="purchase_order_lines[{{ $loop->index }}][sub_total]"
                                                            value="{{ preg_match('/\.\d*[1-9]+/', (string) $product->sub_total) ? $product->sub_total : @num_format($product->sub_total) }}">
                                                    </td>
                                                    <td>
                                                        <button type="button" class="btn btn-danger btn-sx remove_row"><i
                                                                class="fa fa-times"></i></button>
                                                    </td>
                                                </tr>
                                            @empty
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <div class="col-md-12 mt-3 d-flex justify-content-center">
                                <h4
                                    class="count_wrapper col-md-6 d-flex @if (app()->isLocale('ar')) flex-row-reverse @else flex-row @endif">
                                    <span class="count_title col-md-6"> @lang('lang.total') </span>
                                    <span
                                        class="count_value_style col-md-6 final_total_span">{{ @num_format($purchase_order->final_total) }}</span>
                                </h4>
                                <input type="hidden" name="final_total" id="final_total"
                                    value="{{ $purchase_order->final_total }}">
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
                                            {!! Form::label('details', __('lang.details'), [
                                                'class' => 'form-label d-block mb-1 app()->isLocale("ar") ? text-end : text-start',
                                            ]) !!}
                                            {!! Form::textarea('details', $purchase_order->details, [
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

                            <button type="submit" name="submit" id="print" value="print"
                                class="btn py-1 submit">@lang('lang.print')</button>
                        </div>
                        @can('purchase_order.send_to_supplier.create_and_edit')
                            <div class="col-md-2">
                                <button type="button" id="send_to_supplier" disabled
                                    class="btn btn-warning pull-right btn-flat submit" data-toggle="modal"
                                    data-target="#supplier_modal">@lang('lang.send_to_supplier')</button>
                            </div>
                        @endcan
                        @can('purchase_order.send_to_admin.create_and_edit')
                            <div class="col-md-2">
                                <button type="submit" name="submit" id="send_to_admin" value="sent_admin"
                                    class="btn btn-primary pull-right btn-flat submit">@lang('lang.send_to_admin')</button>
                            </div>
                        @endcan
                        <div class="modal fade supplier_modal" id="supplier_modal" role="dialog" aria-hidden="true">
                        </div>


                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>


    </section>
@endsection

@section('javascript')
    <script src="{{ asset('js/purchase.js') }}"></script>

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
    <script type="text/javascript">
        $('#store_id').change(function() {
            let store_id = $(this).val();

            $.ajax({
                method: 'get',
                url: '/purchase-order/get-po-number',
                data: {
                    store_id
                },
                success: function(result) {
                    $('#po_no').val(result);
                },
            });
        })
        $(document).ready(function() {
            $('#supplier_id').change();
        })

        $('#supplier_id').change(function() {
            let supplier_id = $(this).val();

            if (supplier_id) {
                $.ajax({
                    method: 'get',
                    url: '/supplier/get-details/' + supplier_id + '?is_purchase_order=1',
                    data: {},
                    contentType: 'html',
                    success: function(result) {
                        $('.supplier_modal').empty().append(result);
                        $('#send_to_supplier').attr('disabled', false);
                    },
                });
            }
        })
    </script>
@endsection
