@extends('layouts.app')
@section('title', __('lang.add_transfer'))
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
                            @lang('lang.add_transfer')
                            <span class="header-pill"></span>
                        </h5>
                    </div>
                    {!! Form::open([
                        'url' => action('TransferController@store'),
                        'method' => 'post',
                        'id' => 'add_transfer_form',
                        'enctype' => 'multipart/form-data',
                    ]) !!}

                    <div class="card mb-2">
                        <div class="card-body p-2">
                            <div class="row @if (app()->isLocale('ar')) flex-row-reverse @else flex-row @endif">
                                <input type="hidden" name="is_raw_material" id="is_raw_material"
                                    value="{{ $is_raw_material }}">

                                <div class="col-md-3 px-5">
                                    <div class="form-group">
                                        {!! Form::label('sender_store_id', __('lang.sender_store') . '*', [
                                            'class' => 'form-label d-block mb-1 app()->isLocale("ar") ? text-end : text-start',
                                        ]) !!}
                                        {!! Form::select('sender_store_id', $stores, null, [
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
                                        {!! Form::label('receiver_store_id', __('lang.receiver_store') . '*', [
                                            'class' => 'form-label d-block mb-1 app()->isLocale("ar") ? text-end : text-start',
                                        ]) !!}
                                        {!! Form::select('receiver_store_id', $stores, null, [
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
                                        {!! Form::label('files', __('lang.files'), [
                                            'class' => 'form-label d-block mb-1 app()->isLocale("ar") ? text-end : text-start',
                                        ]) !!}
                                        {!! Form::file('files[]', null, [
                                            'class' => 'form-control modal-input app()->isLocale("ar") ? text-end : text-start',
                                        ]) !!}
                                    </div>
                                </div>


                            </div>
                        </div>
                    </div>

                    <div class="card mb-2">
                        <div class="card-body p-2">
                            <div class="row mb-2">
                                <div class="col-md-10">
                                    <div class="search-box input-group"
                                        style="background-color: #e6e6e6;border-radius: 6px!important">
                                        <button type="button" class="select-button " style="height: auto !important"
                                            id="search_button"><i class="fa fa-search"></i></button>
                                        <input type="text" name="search_product" id="search_product"
                                            placeholder="@lang('lang.enter_product_name_to_print_labels')"
                                            class="form-control modal-input @if (app()->isLocale('ar')) text-end @else  text-start @endif  ui-autocomplete-input"
                                            style="width: 80% !important" autocomplete="off">
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex justify-content-center align-items-center">
                                    @include('quotation.partial.product_selection')
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <table class="table table-bordered table-striped table-condensed" id="product_table">
                                        <thead>
                                            <tr>
                                                <th style="width: 25%" class="col-sm-8">@lang('lang.products')</th>
                                                <th style="width: 25%" class="col-sm-4">@lang('lang.sku')</th>
                                                <th style="width: 25%" class="col-sm-4">@lang('lang.quantity')</th>
                                                <th style="width: 12%" class="col-sm-4">@lang('lang.purchase_price')</th>
                                                <th style="width: 12%" class="col-sm-4">@lang('lang.sub_total')</th>
                                                <th style="width: 12%" class="col-sm-4">@lang('lang.action')</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12 mt-3 d-flex justify-content-center">
                        <h4
                            class="count_wrapper col-md-6 d-flex @if (app()->isLocale('ar')) flex-row-reverse @else flex-row @endif">
                            <span class="count_title col-md-6"> @lang('lang.total') </span>

                            <span class="count_value_style col-md-6 final_total_span"></span>
                        </h4>
                        <input type="hidden" name="final_total" id="final_total" value="0">
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
                                                'class' => 'form-control  modal-input app()->isLocale("ar") ? text-end : text-start',
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
                            <button type="submit" name="submit" id="print" value="save"
                                class="btn py-1 submit submit-btn">@lang('lang.save')</button>

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
    <script src="{{ asset('js/transfer.js') }}"></script>
    <script src="{{ asset('js/product_selection.js') }}"></script>
    <script type="text/javascript">
        $(document).on('click', '#add-selected-btn', function() {
            $('#select_products_modal').modal('hide');
            $.each(product_selected, function(index, value) {
                get_label_product_row(value.product_id, value.variation_id);
            });
            product_selected = [];
            product_table.ajax.reload();
        })
    </script>
@endsection
