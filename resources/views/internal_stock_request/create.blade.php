@extends('layouts.app')
@section('title', __('lang.internal_stock_request'))
@section('style')
    <link rel="stylesheet" type="text/css" href="{{ url('front/css/main.css') }}">
@endsection
@section('content')
    <section class="forms py-0">
        <div class="container-fluid">
            <div
                class="  d-flex align-items-center my-2 @if (app()->isLocale('ar')) justify-content-end @else justify-content-start @endif">
                <h5 class="mb-0 print-title position-relative print-title" style="margin-right: 30px">@lang('lang.internal_stock_request')
                    <span class="header-pill"></span>
                </h5>
            </div>
            {!! Form::open([
                'url' => action('InternalStockRequestController@store'),
                'method' => 'post',
                'id' => 'internal_stock_request_form',
                'enctype' => 'multipart/form-data',
            ]) !!}
            <input type="hidden" name="is_raw_material" id="is_raw_material" value="{{ $is_raw_material }}">
            <div class="card my-3">
                <div class="card-body p-2">
                    <div class="row @if (app()->isLocale('ar')) flex-row-reverse @else flex-row @endif">
                        <div class="col-md-3 px-5">
                            <div class="form-group">
                                {!! Form::label('receiver_store_id', __('lang.receiver_store') . '*', [
                                    'class' => 'form-label d-block mb-1 app()->isLocale("ar") ? text-end : text-start',
                                ]) !!}
                                {!! Form::select('receiver_store_id', $stores, session('user.store_id'), [
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
                                {!! Form::select(
                                    'status',
                                    [
                                        'received' => __('lang.received'),
                                        'approved' => __('lang.approved'),
                                        'pending' => __('lang.pending'),
                                        'declined' => __('lang.declined'),
                                    ],
                                    'pending',
                                    [
                                        'class' => 'selectpicker form-control',
                                        'data-live-search' => 'true',
                                        'required',
                                        'style' => 'width: 80%',
                                        'placeholder' => __('lang.please_select'),
                                    ],
                                ) !!}
                            </div>
                        </div>
                        <div class="col-md-3 px-5">
                            <div class="form-group">
                                {!! Form::label('product_class_id', __('lang.product_class'), [
                                    'class' => 'form-label d-block mb-1 app()->isLocale("ar") ? text-end : text-start',
                                ]) !!}
                                {!! Form::select('product_class_id', $product_classes, request()->product_class_id, [
                                    'class' => 'form-control filter selectpicker',
                                    'data-live-search' => 'true',
                                    'placeholder' => __('lang.all'),
                                ]) !!}
                            </div>
                        </div>
                        <div class="col-md-3 px-5">
                            <div class="form-group">
                                {!! Form::label('category_id', __('lang.category'), [
                                    'class' => 'form-label d-block mb-1 app()->isLocale("ar") ? text-end : text-start',
                                ]) !!}
                                {!! Form::select('category_id', $categories, request()->category_id, [
                                    'class' => 'form-control filterselectpicker',
                                    'data-live-search' => 'true',
                                    'placeholder' => __('lang.all'),
                                ]) !!}
                            </div>
                        </div>
                        <div class="col-md-3 px-5">
                            <div class="form-group">
                                {!! Form::label('sub_category_id', __('lang.sub_category'), [
                                    'class' => 'form-label d-block mb-1 app()->isLocale("ar") ? text-end : text-start',
                                ]) !!}
                                {!! Form::select('sub_category_id', $sub_categories, request()->sub_category_id, [
                                    'class' => 'form-control filter selectpicker',
                                    'data-live-search' => 'true',
                                    'placeholder' => __('lang.all'),
                                ]) !!}
                            </div>
                        </div>
                        <div class="col-md-3 px-5">
                            <div class="form-group">
                                {!! Form::label('brand_id', __('lang.brand'), [
                                    'class' => 'form-label d-block mb-1 app()->isLocale("ar") ? text-end : text-start',
                                ]) !!}
                                {!! Form::select('brand_id', $brands, request()->brand_id, [
                                    'class' => 'form-control filter selectpicker',
                                    'data-live-search' => 'true',
                                    'placeholder' => __('lang.all'),
                                ]) !!}
                            </div>
                        </div>
                        <div class="col-md-3 px-5">
                            <div class="form-group">
                                {!! Form::label('unit_id', __('lang.unit'), [
                                    'class' => 'form-label d-block mb-1 app()->isLocale("ar") ? text-end : text-start',
                                ]) !!}
                                {!! Form::select('unit_id', $units, request()->unit_id, [
                                    'class' => 'form-control filter selectpicker',
                                    'data-live-search' => 'true',
                                    'placeholder' => __('lang.all'),
                                ]) !!}
                            </div>
                        </div>
                        <div class="col-md-3 px-5">
                            <div class="form-group">
                                {!! Form::label('color_id', __('lang.color'), [
                                    'class' => 'form-label d-block mb-1 app()->isLocale("ar") ? text-end : text-start',
                                ]) !!}
                                {!! Form::select('color_id', $colors, request()->color_id, [
                                    'class' => 'form-control filter selectpicker',
                                    'data-live-search' => 'true',
                                    'placeholder' => __('lang.all'),
                                ]) !!}
                            </div>
                        </div>
                        <div class="col-md-3 px-5">
                            <div class="form-group">
                                {!! Form::label('size_id', __('lang.size'), [
                                    'class' => 'form-label d-block mb-1 app()->isLocale("ar") ? text-end : text-start',
                                ]) !!}
                                {!! Form::select('size_id', $sizes, request()->size_id, [
                                    'class' => 'form-control filter selectpicker',
                                    'data-live-search' => 'true',
                                    'placeholder' => __('lang.all'),
                                ]) !!}
                            </div>
                        </div>
                        <div class="col-md-3 px-5">
                            <div class="form-group">
                                {!! Form::label('grade_id', __('lang.grade'), [
                                    'class' => 'form-label d-block mb-1 app()->isLocale("ar") ? text-end : text-start',
                                ]) !!}
                                {!! Form::select('grade_id', $grades, request()->grade_id, [
                                    'class' => 'form-control filter selectpicker',
                                    'data-live-search' => 'true',
                                    'placeholder' => __('lang.all'),
                                ]) !!}
                            </div>
                        </div>
                        <div class="col-md-3 px-5">
                            <div class="form-group">
                                {!! Form::label('tax_id', __('lang.tax'), [
                                    'class' => 'form-label d-block mb-1 app()->isLocale("ar") ? text-end : text-start',
                                ]) !!}
                                {!! Form::select('tax_id', $taxes, request()->tax_id, [
                                    'class' => 'form-control filter selectpicker',
                                    'data-live-search' => 'true',
                                    'placeholder' => __('lang.all'),
                                ]) !!}
                            </div>
                        </div>
                        <div class="col-md-3 px-5">
                            <div class="form-group">
                                {!! Form::label('store_id', __('lang.store'), [
                                    'class' => 'form-label d-block mb-1 app()->isLocale("ar") ? text-end : text-start',
                                ]) !!}
                                {!! Form::select('store_id', $stores, request()->store_id, [
                                    'class' => 'form-control filter',
                                    'placeholder' => __('lang.all'),
                                    'data-live-search' => 'true',
                                ]) !!}
                            </div>
                        </div>
                        <div class="col-md-3 px-5">
                            <a class="btn btn-danger"
                                href="{{ action('InternalStockRequestController@create') }}">@lang('lang.clear_filters')</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card my-3">
                <div class="card-body p-2">
                    <div class="d-flex flex-wrap mb-3 @if (app()->isLocale('ar')) flex-row-reverse @else flex-row @endif"
                        style="gap: 7px">

                        <button type="button" value="1"
                            class="select_product_button column-toggle">@lang('lang.image')</button>
                        <button type="button" value="7"
                            class="select_product_button column-toggle">@lang('lang.class')</button>
                        <button type="button" value="8"
                            class="select_product_button column-toggle">@lang('lang.category')</button>
                        <button type="button" value="9"
                            class="select_product_button column-toggle">@lang('lang.sub_category')</button>
                        <button type="button" value="10"
                            class="select_product_button column-toggle">@lang('lang.purchase_history')</button>
                        <button type="button" value="11"
                            class="select_product_button column-toggle">@lang('lang.batch_number')</button>
                        <button type="button" value="12"
                            class="select_product_button column-toggle">@lang('lang.selling_price')</button>
                        <button type="button" value="13"
                            class="select_product_button column-toggle">@lang('lang.tax')</button>
                        <button type="button" value="14"
                            class="select_product_button column-toggle">@lang('lang.brand')</button>
                        <button type="button" value="15"
                            class="select_product_button column-toggle">@lang('lang.unit')</button>
                        <button type="button" value="16"
                            class="select_product_button column-toggle">@lang('lang.color')</button>
                        <button type="button" value="17"
                            class="select_product_button column-toggle">@lang('lang.size')</button>
                        <button type="button" value="18"
                            class="select_product_button column-toggle">@lang('lang.grade')</button>
                        <button type="button" value="19"
                            class="select_product_button column-toggle">@lang('lang.expiry_date')</button>
                        <button type="button" value="20"
                            class="select_product_button column-toggle">@lang('lang.manufacturing_date')</button>
                        <button type="button" value="21"
                            class="select_product_button column-toggle">@lang('lang.discount')</button>
                        @can('product_module.purchase_price.view')
                            <button type="button" value="22"
                                class="select_product_button column-toggle">@lang('lang.purchase_price')</button>
                        @endcan

                    </div>

                    <div id="product_table_div" class="table-responsive">
                        <table id="product_table" class="table" style="width: auto">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>@lang('lang.image')</th>
                                    <th>@lang('lang.name')</th>
                                    <th>@lang('lang.product_code')</th>
                                    <th>@lang('lang.store')</th>
                                    <th class="sum">@lang('lang.current_stock')</th>
                                    <th style="width: 100px;">@lang('lang.qty')</th>
                                    <th>@lang('lang.class')</th>
                                    <th>@lang('lang.category')</th>
                                    <th>@lang('lang.sub_category')</th>
                                    <th>@lang('lang.purchase_history')</th>
                                    <th>@lang('lang.batch_number')</th>
                                    <th>@lang('lang.selling_price')</th>
                                    <th>@lang('lang.tax')</th>
                                    <th>@lang('lang.brand')</th>
                                    <th>@lang('lang.unit')</th>
                                    <th>@lang('lang.color')</th>
                                    <th>@lang('lang.size')</th>
                                    <th>@lang('lang.grade')</th>
                                    <th>@lang('lang.expiry_date')</th>
                                    <th>@lang('lang.manufacturing_date')</th>
                                    <th>@lang('lang.discount')</th>
                                    @can('product_module.purchase_price.view')
                                        <th>@lang('lang.purchase_price')</th>
                                    @endcan
                                </tr>
                            </thead>
                            <tbody>
                                {{-- @include(
                                                    'internal_stock_request.partials.product_table',
                                                    ['products' => $products]
                                                ) --}}
                            </tbody>

                        </table>
                    </div>
                </div>
            </div>


            <input type="hidden" id="product_data" name="product_data" value="[]">
            <input type="hidden" id="store_array" name="store_array" value="[]">

            <div class="row">
                <div class="col-md-12 mt-3 d-flex justify-content-center">
                    <h4
                        class="count_wrapper col-md-6 d-flex @if (app()->isLocale('ar')) flex-row-reverse @else flex-row @endif">
                        <span class="count_title col-md-6"> @lang('lang.total') </span>
                        <span class="count_value_style col-md-6 final_total_span">{{ 0 }}</span>
                    </h4>
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
                    <button type="submit" name="submit" id="save" value="save"
                        class="btn py-1 submit submit-btn">@lang('lang.send')</button>
                </div>
            </div>
            {!! Form::close() !!}
        </div>

    </section>
@endsection

@section('javascript')
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
        var hidden_column_array = $.cookie('column_visibility') ? JSON.parse($.cookie('column_visibility')) : [];

        function toggleColumnInCookie() {
            $.each(hidden_column_array, function(index, value) {
                $('.column-toggle').each(function() {
                    if ($(this).val() == value) {
                        toggleColumnVisibility(value, $(this));
                    }
                });

            });
        }
        $(document).ready(function() {
            toggleColumnInCookie()

        });
        $(document).on('click', '.column-toggle', function() {
            let column_index = parseInt($(this).val());
            toggleColumnVisibility(column_index, $(this));
            if (hidden_column_array.includes(column_index)) {
                hidden_column_array.splice(hidden_column_array.indexOf(column_index), 1);
            } else {
                hidden_column_array.push(column_index);
            }

            //unique array javascript
            hidden_column_array = $.grep(hidden_column_array, function(v, i) {
                return $.inArray(v, hidden_column_array) === i;
            });

            $.cookie('column_visibility', JSON.stringify(hidden_column_array));
        })

        function toggleColumnVisibility(column_index, this_btn) {
            column = product_table.column(column_index);
            column.visible(!column.visible());

            if (column.visible()) {
                $(this_btn).addClass('badge-primary')
                $(this_btn).removeClass('badge-warning')
            } else {
                $(this_btn).removeClass('badge-primary')
                $(this_btn).addClass('badge-warning')

            }
        }

        $(document).ready(function() {
            product_table = $('#product_table').DataTable({
                lengthChange: true,
                paging: true,
                info: false,
                bAutoWidth: false,
                order: [],
                language: {
                    url: dt_lang_url,
                },
                lengthMenu: [
                    [10, 25, 50, 75, 100, 200, 500, -1],
                    [10, 25, 50, 75, 100, 200, 500, "All"],
                ],
                dom: "lBfrtip",
                buttons: buttons,
                processing: true,
                serverSide: true,
                aaSorting: [
                    [2, 'asc']
                ],
                "ajax": {
                    "url": "/internal-stock-request/get-product-table",
                    "data": function(d) {
                        d.product_class_id = $('#product_class_id').val(),
                            d.category_id = $('#category_id').val(),
                            d.sub_category_id = $('#sub_category_id').val(),
                            d.brand_id = $('#brand_id').val(),
                            d.unit_id = $('#unit_id').val(),
                            d.color_id = $('#color_id').val(),
                            d.size_id = $('#size_id').val(),
                            d.grade_id = $('#grade_id').val(),
                            d.tax_id = $('#tax_id').val(),
                            d.store_id = $('#store_id').val(),
                            d.is_raw_material = $('#is_raw_material').val();
                    }
                },
                columnDefs: [{
                    "targets": [0, 3],
                    "orderable": false,
                    "searchable": false
                }],
                columns: [{
                        data: 'selected_product',
                        name: 'selected_product'
                    },
                    {
                        data: 'image',
                        name: 'image'
                    },
                    {
                        data: 'variation_name',
                        name: 'products.name'
                    },
                    {
                        data: 'sub_sku',
                        name: 'variations.sub_sku'
                    },
                    {
                        data: 'store_name',
                        name: 'stores.name'
                    },
                    {
                        data: 'current_stock',
                        name: 'current_stock'
                    },
                    {
                        data: 'qty',
                        name: 'qty'
                    },
                    {
                        data: 'product_class',
                        name: 'product_classes.name'
                    },
                    {
                        data: 'category',
                        name: 'categories.name'
                    },
                    {
                        data: 'sub_category',
                        name: 'sub_categories.name'
                    },
                    {
                        data: 'purchase_history',
                        name: 'purchase_history'
                    },
                    {
                        data: 'batch_number',
                        name: 'batch_number'
                    },
                    {
                        data: 'sell_price',
                        name: 'sell_price'
                    },
                    {
                        data: 'tax_name',
                        name: 'taxes.name'
                    },
                    {
                        data: 'brand_name',
                        name: 'brands.name'
                    },
                    {
                        data: 'unit',
                        name: 'units.name'
                    },

                    {
                        data: 'color',
                        name: 'colors.name'
                    },
                    {
                        data: 'size',
                        name: 'sizes.name'
                    },
                    {
                        data: 'grade',
                        name: 'grades.name'
                    },
                    {
                        data: 'expiry_date',
                        name: 'expiry_date'
                    },
                    {
                        data: 'manufacturing_date',
                        name: 'manufacturing_date'
                    },
                    {
                        data: 'discount',
                        name: 'discount'
                    },
                    {
                        data: 'purchase_price',
                        name: 'purchase_price'
                    }

                ],
                createdRow: function(row, data, dataIndex) {

                },
                fnDrawCallback: function(oSettings) {
                    var intVal = function(i) {
                        return typeof i === "string" ?
                            i.replace(/[\$,]/g, "") * 1 :
                            typeof i === "number" ?
                            i :
                            0;
                    };

                    this.api()
                        .columns(".sum", {
                            page: "current"
                        })
                        .every(function() {
                            var column = this;
                            if (column.data().count()) {
                                var sum = column.data().reduce(function(a, b) {
                                    a = intVal(a);
                                    if (isNaN(a)) {
                                        a = 0;
                                    }

                                    b = intVal(b);
                                    if (isNaN(b)) {
                                        b = 0;
                                    }

                                    return a + b;
                                });
                                $(column.footer()).html(
                                    __currency_trans_from_en(sum, false)
                                );
                            }
                        });
                },
            });

            $(document).on('change', '.filter', function() {
                product_table.ajax.reload();
            })


        });


        var data_array = [];
        var store_array = [];
        $(document).on('change', '.qty', function() {
            let tr = $(this).closest('tr');
            let row_index = parseFloat($(tr).find('.row_index').val());
            let qty = parseFloat($(tr).find('.qty').val());
            let current_stock = parseFloat($(tr).find('.current_stock').val());
            $(tr).find('.stock_error').addClass('hide');
            $(tr).find('.product_checkbox').prop('checked', false);
            if (qty < 0) {
                $(tr).find('.qty').val(0);
                return;
            }
            if (qty > current_stock) {
                $(tr).find('.stock_error').removeClass('hide');
                return;

            }
            if (qty) {
                $(tr).find('.product_checkbox').prop('checked', true);
                let product_id = $(tr).find('.product_id').val();
                let variation_id = $(tr).find('.variation_id').val();
                let store_id = $(tr).find('.store_id').val();
                let qty = $(tr).find('.qty').val();
                let purchase_price = $(tr).find('.purchase_price').val();
                store_array.push(store_id);

                store_array = $.grep(store_array, function(v, i) {
                    return $.inArray(v, store_array) === i;
                });
                $('#store_array').val(JSON.stringify(store_array));
                data_array[row_index] = {
                    'product_id': product_id,
                    'variation_id': variation_id,
                    'store_id': store_id,
                    'qty': qty,
                    'purchase_price': purchase_price,
                }
                $('#product_data').val(JSON.stringify(data_array));
            } else {
                $(tr).find('.product_checkbox').prop('checked', false);
                data_array.splice(row_index, 1);
            }
            calculateTotal()
        })

        function calculateTotal() {
            let final_total = 0;
            console.log(data_array);
            for (i = 0; i < data_array.length; ++i) {
                let item = data_array[i];
                if (item) {
                    final_total += parseFloat(item.qty) * parseFloat(item.purchase_price);
                }
            }

            $(".final_total_span").text(
                __currency_trans_from_en(final_total, false)
            );
        }
    </script>
@endsection
