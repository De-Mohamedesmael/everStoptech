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
                            @lang('lang.import_purchase_order')
                            <span class="header-pill"></span>
                        </h5>
                    </div>
                    {!! Form::open([
                        'url' => action('PurchaseOrderController@saveImport'),
                        'method' => 'post',
                        'id' => 'import_purchase_order_form',
                        'files' => true,
                    ]) !!}
                    <div class="card mb-2">
                        <div class="card-body p-2">
                            <div class="row @if (app()->isLocale('ar')) flex-row-reverse @else flex-row @endif">
                                <div class="col-md-3 px-5">
                                    <div class="form-group">
                                        {!! Form::label('store_id', __('lang.store') . '*', [
                                            'class' => 'form-label d-block mb-1 app()->isLocale("ar") ? text-end : text-start',
                                        ]) !!}
                                        {!! Form::select('store_id', $stores, null, [
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
                                        {!! Form::select('supplier_id', $suppliers, null, [
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
                                        {!! Form::text('po_no', null, [
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
                            <div class="col-md-12">
                                <div class="row @if (app()->isLocale('ar')) flex-row-reverse @else flex-row @endif">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            {!! Form::label('file', __('lang.file'), [
                                                'class' => 'form-label d-block mb-1 app()->isLocale("ar") ? text-end : text-start',
                                            ]) !!}
                                            {!! Form::file('file', ['class' => 'form-control modal-input app()->isLocale("ar") ? text-end : text-start']) !!}
                                        </div>
                                    </div>
                                    <div class="col-md-6 d-flex justify-content-center align-items-center">
                                        <a class="btn btn-block btn-primary py-1 mt-2"
                                            href="{{ asset('sample_files/purchase_order_import.csv') }}"><i
                                                class="fa fa-download"></i>@lang('lang.download_sample_file')</a>
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
                                            {!! Form::label('details', __('lang.details'), [
                                                'class' => 'form-label d-block mb-1 app()->isLocale("ar") ? text-end : text-start',
                                            ]) !!}
                                            {!! Form::textarea('details', null, [
                                                'class' => 'form-control  modal-input app()->isLocale("ar") ? text-end : text-start',
                                                'rows' => 3,
                                            ]) !!}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-12">
                        <button type="submit" name="submit" id="print" style="margin: 10px" value="print"
                            class="btn btn-primary pull-right btn-flat submit">@lang('lang.print')</button>
                        @can('purchase_order.send_to_supplier.create_and_edit')
                            <button type="button" id="send_to_supplier" style="margin: 10px" disabled
                                class="btn btn-warning pull-right btn-flat submit" data-toggle="modal"
                                data-target="#supplier_modal">@lang('lang.send_to_supplier')</button>
                        @endcan
                        @can('purchase_order.send_to_admin.create_and_edit')
                            <button type="submit" name="submit" id="send_to_admin" style="margin: 10px" value="sent_admin"
                                class="btn btn-primary pull-right btn-flat submit">@lang('lang.send_to_admin')</button>
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
    </script>
@endsection
