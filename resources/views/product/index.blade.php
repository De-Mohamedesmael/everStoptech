@extends('layouts.app')
@section('title', __('lang.products'))
@section('style')
<link rel="stylesheet" type="text/css" href="{{ url('front/css/main.css') }}">
@endsection
@section('content')
<section class="forms py-0">
    <div class="container-fluid">
        <div class="card my-3">
            <div class="card-body p-2">
                <div class="row justify-content-center">

                    @if (empty($page))
                    @can('product_module.products.create_and_edit')
                    <div class="col-md-3">
                        <a style="color: white" href="{{ action('ProductController@create') }}"
                            class="btn btn-primary w-100 py-1"><i class="dripicons-plus"></i>
                            @lang('lang.add_product')</a>
                    </div>
                    @endcan
                    <div class="col-md-3">
                        <a style="color: white" href="{{ action('ProductController@getImport') }}"
                            class="btn btn-primary w-100 py-1"><i class="fa fa-arrow-down"></i>
                            @lang('lang.import')</a>
                    </div>
                    @else
                    <div class="col-md-3">
                        <a style="color: white" href="{{ action('AddStockController@getImport') }}"
                            class="btn btn-primary w-100 py-1"><i class="fa fa-arrow-down"></i>
                            @lang('lang.import')</a>
                    </div>
                    @endif

                </div>
            </div>
        </div>
        @if (request()->segment(1) == 'products')
        <div
            class="d-flex align-items-center my-2 @if (app()->isLocale('ar')) justify-content-end @else justify-content-start @endif">
            <h5 class="mb-0 position-relative" style="margin-right: 30px">
                @lang('lang.product_lists')
                <span class="header-pill"></span>
            </h5>
        </div>
        @endif
        @if (request()->segment(1) == 'products-stocks')
        <div
            class="d-flex align-items-center my-2 @if (app()->isLocale('ar')) justify-content-end @else justify-content-start @endif">
            <h5 class="mb-0 position-relative" style="margin-right: 30px">
                @lang('lang.product_stocks')
                <span class="header-pill"></span>
            </h5>
        </div>
        @endif

        <div class="card my-3">
            <div class="card-body p-2">
                <div class="row @if (app()->isLocale('ar')) flex-row-reverse @else flex-row @endif">
                    <div class="col-md-3 px-5">
                        <div class="form-group">
                            {!! Form::label('store_id', __('lang.store'), [
                            'class' => 'form-label d-block mb-1 app()->isLocale("ar") ? text-end : text-start',
                            ]) !!}
                            {!! Form::select('store_id', $stores, request()->store_id, [
                            'class' => 'form-control filter_product',
                            'placeholder' => __('lang.all'),
                            'data-live-search' => 'true',
                            ]) !!}
                        </div>
                    </div>
                    <div class="col-md-3 px-5">
                        <div class="form-group">
                            {!! Form::label('customer_type_id', __('lang.customer_type'), [
                            'class' => 'form-label d-block mb-1 app()->isLocale("ar") ? text-end : text-start',
                            ]) !!}
                            {!! Form::select('customer_type_id', $customer_types, request()->customer_type_id, [
                            'class' => 'form-control filter_product
                            selectpicker',
                            'data-live-search' => 'true',
                            'placeholder' => __('lang.all'),
                            ]) !!}
                        </div>
                    </div>
                    <div class="col-md-3 px-5">
                        <div class="form-group">
                            {!! Form::label('created_by', __('lang.created_by'), [
                            'class' => 'form-label d-block mb-1 app()->isLocale("ar") ? text-end : text-start',
                            ]) !!}
                            {!! Form::select('created_by', $users, request()->created_by, [
                            'class' => 'form-control filter_product
                            selectpicker',
                            'data-live-search' => 'true',
                            'placeholder' => __('lang.all'),
                            ]) !!}
                        </div>
                    </div>
                    <div class="col-md-3 px-5">
                        <div class="form-group">
                            {!! Form::label('active', __('lang.active'), [
                            'class' => 'form-label d-block mb-1 app()->isLocale("ar") ? text-end : text-start',
                            ]) !!}
                            {!! Form::select('active', [0 => __('lang.no'), 1 => __('lang.yes')], request()->active, [
                            'class' => 'form-control filter_product
                            selectpicker',
                            'data-live-search' => 'true',
                            'placeholder' => __('lang.all'),
                            ]) !!}
                        </div>
                    </div>
                </div>

                <div class="row @if (app()->isLocale('ar')) flex-row-reverse @else flex-row @endif">

                    <div
                        class="d-flex my-2  col-md-3 @if (app()->isLocale('ar')) justify-content-end @else justify-content-start @endif">
                        <button class="text-decoration-none toggle-button mb-0" type="button" data-bs-toggle="collapse"
                            data-bs-target="#productsFilterCollapse" aria-expanded="false"
                            aria-controls="productsFilterCollapse">
                            <i class="fas fa-arrow-down"></i>
                            @lang('lang.products_filter')
                            <span class="section-header-pill"></span>
                        </button>
                    </div>
                    <div class="collapse col-md-9" id="productsFilterCollapse">

                        <div class="row @if (app()->isLocale('ar')) flex-row-reverse @else flex-row @endif">
                            <div class="col-md-2 px-2">
                                <div class="form-group">
                                    {!! Form::label(
                                    'product_class_id',
                                    session('system_mode') == 'restaurant' ? __('lang.category') :
                                    __('lang.product_class'),
                                    [
                                    'class' => 'form-label d-block mb-1 app()->isLocale("ar") ? text-end : text-start',
                                    ],
                                    ) !!}
                                    {!! Form::select('product_class_id', $product_classes, request()->product_class_id,
                                    [
                                    'class' => 'form-control filter_product selectpicker',
                                    'data-live-search' => 'true',
                                    'placeholder' => __('lang.all'),
                                    ]) !!}
                                </div>
                            </div>

                            @if (session('system_mode') != 'restaurant')

                            <div class="col-md-2 px-2">
                                <div class="form-group">
                                    {!! Form::label('category_id', __('lang.category'), [
                                    'class' => 'form-label d-block mb-1 app()->isLocale("ar") ? text-end : text-start',
                                    ]) !!}
                                    {!! Form::select('category_id', $categories, request()->category_id, [
                                    'class' => 'form-control filter_product
                                    selectpicker',
                                    'data-live-search' => 'true',
                                    'placeholder' => __('lang.all'),
                                    ]) !!}
                                </div>
                            </div>

                            <div class="col-md-2 px-2">
                                <div class="form-group">
                                    {!! Form::label('sub_category_id', __('lang.sub_category'), [
                                    'class' => 'form-label d-block mb-1 app()->isLocale("ar") ? text-end : text-start',
                                    ]) !!}
                                    {!! Form::select('sub_category_id', $sub_categories, request()->sub_category_id, [
                                    'class' => 'form-control filter_product
                                    selectpicker',
                                    'data-live-search' => 'true',
                                    'placeholder' => __('lang.all'),
                                    ]) !!}
                                </div>
                            </div>

                            <div class="col-md-2 px-2">
                                <div class="form-group">
                                    {!! Form::label('brand_id', __('lang.brand'), [
                                    'class' => 'form-label d-block mb-1 app()->isLocale("ar") ? text-end : text-start',
                                    ]) !!}
                                    {!! Form::select('brand_id', $brands, request()->brand_id, [
                                    'class' => 'form-control filter_product selectpicker',
                                    'data-live-search' => 'true',
                                    'placeholder' => __('lang.all'),
                                    ]) !!}
                                </div>
                            </div>
                            @endif

                            <div class="col-md-2 px-2">
                                <div class="form-group">
                                    {!! Form::label('supplier_id', __('lang.supplier'), [
                                    'class' => 'form-label d-block mb-1 app()->isLocale("ar") ? text-end : text-start',
                                    ]) !!}
                                    {!! Form::select('supplier_id', $suppliers, request()->supplier_id, [
                                    'class' => 'form-control filter_product selectpicker',
                                    'data-live-search' => 'true',
                                    'placeholder' => __('lang.all'),
                                    ]) !!}
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="row @if (app()->isLocale('ar')) flex-row-reverse @else flex-row @endif">
                    <div
                        class="d-flex my-2  col-md-3 @if (app()->isLocale('ar')) justify-content-end @else justify-content-start @endif">
                        <button class="text-decoration-none toggle-button mb-0" type="button" data-bs-toggle="collapse"
                            data-bs-target="#productsOtherFilterCollapse" aria-expanded="false"
                            aria-controls="productsOtherFilterCollapse">
                            <i class="fas fa-arrow-down"></i>
                            @lang('lang.products_other_filter')
                            <span class="section-header-pill"></span>
                        </button>
                    </div>
                    <div class="collapse col-md-9" id="productsOtherFilterCollapse">
                        <div class="row @if (app()->isLocale('ar')) flex-row-reverse @else flex-row @endif">
                            <div class="col-md-2 px-2">
                                <div class="form-group">
                                    {!! Form::label('unit_id', __('lang.unit'), [
                                    'class' => 'form-label d-block mb-1 app()->isLocale("ar") ? text-end : text-start',
                                    ]) !!}
                                    {!! Form::select('unit_id', $units, request()->unit_id, [
                                    'class' => 'form-control
                                    filter_product
                                    selectpicker',
                                    'data-live-search' => 'true',
                                    'placeholder' => __('lang.all'),
                                    ]) !!}
                                </div>
                            </div>

                            <div class="col-md-2 px-2">
                                <div class="form-group">
                                    {!! Form::label('color_id', __('lang.color'), [
                                    'class' => 'form-label d-block mb-1 app()->isLocale("ar") ? text-end : text-start',
                                    ]) !!}
                                    {!! Form::select('color_id', $colors, request()->color_id, [
                                    'class' => 'form-control
                                    filter_product
                                    selectpicker',
                                    'data-live-search' => 'true',
                                    'placeholder' => __('lang.all'),
                                    ]) !!}
                                </div>
                            </div>

                            <div class="col-md-2 px-2">
                                <div class="form-group">
                                    {!! Form::label('size_id', __('lang.size'), [
                                    'class' => 'form-label d-block mb-1 app()->isLocale("ar") ? text-end : text-start',
                                    ]) !!}
                                    {!! Form::select('size_id', $sizes, request()->size_id, [
                                    'class' => 'form-control
                                    filter_product
                                    selectpicker',
                                    'data-live-search' => 'true',
                                    'placeholder' => __('lang.all'),
                                    ]) !!}
                                </div>
                            </div>

                            <div class="col-md-2 px-2">
                                <div class="form-group">
                                    {!! Form::label('grade_id', __('lang.grade'), [
                                    'class' => 'form-label d-block mb-1 app()->isLocale("ar") ? text-end : text-start',
                                    ]) !!}
                                    {!! Form::select('grade_id', $grades, request()->grade_id, [
                                    'class' => 'form-control
                                    filter_product
                                    selectpicker',
                                    'data-live-search' => 'true',
                                    'placeholder' => __('lang.all'),
                                    ]) !!}
                                </div>
                            </div>

                            <div class="col-md-2 px-2">
                                <div class="form-group">
                                    {!! Form::label('tax_id', __('lang.tax'), [
                                    'class' => 'form-label d-block mb-1 app()->isLocale("ar") ? text-end : text-start',
                                    ]) !!}
                                    {!! Form::select('tax_id', $taxes, request()->tax_id, [
                                    'class' => 'form-control
                                    filter_product
                                    selectpicker',
                                    'data-live-search' => 'true',
                                    'placeholder' => __('lang.all'),
                                    ]) !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="row @if (app()->isLocale('ar')) flex-row-reverse @else flex-row @endif">


                    <input type="hidden" name="product_id" id="product_id" value="">
                    <div class="col-md-3 px-2 d-flex justify-content-around align-items-center">
                        <button class="btn py-1 btn-danger clear_filters">@lang('lang.clear_filters')</button>

                        <a data-href="{{ action('ProductController@multiDeleteRow') }}" id="delete_all"
                            data-check_password="{{ action('AdminController@checkPassword', Auth::user()->id) }}"
                            class="btn btn-danger text-white delete_all"><i class="fa fa-trash"></i>
                            @lang('lang.delete_all')</a>
                    </div>


                    <div class="col-md-3 px-2 d-flex justify-content-center align-items-center">
                        <div class="form-group d-flex justify-content-center align-items-center mb-0">
                            {{-- <label>
                                Don't show zero stocks
                            </label> --}}
                            {!! Form::label('show_zero_stocks', "Don't show zero stocks", [
                            'class' => 'form-label d-block mb-0 app()->isLocale("ar") ? text-end : text-start',
                            ]) !!}
                            {!! Form::checkbox(
                            'show_zero_stocks',
                            1,
                            false,
                            ['class' => ' form-control show_zero_stocks mx-2',
                            'style' => 'width:fit-content',
                            'data-live-search' => 'true'],
                            request()->show_zero_stocks ? true : false,
                            ) !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div
            class="d-flex align-items-center my-2 @if (app()->isLocale('ar')) justify-content-end @else justify-content-start @endif">
            <h5 class="mb-0 position-relative" style="margin-right: 30px">
                @lang('lang.classification')
                <span class="header-pill"></span>
            </h5>
        </div>
        <div class="card my-3">
            <div class="card-body p-2">
                {{-- <div class="row @if (app()->isLocale('ar')) flex-row-reverse @else flex-row @endif">
                    <div class="col-md-12">
                        <button type="button" value="1"
                            class="select_product_button column-toggle">@lang('lang.image')</button>
                        <button type="button" value="4" class="select_product_button column-toggle">
                            @if (session('system_mode') == 'restaurant')
                            @lang('lang.category')
                            @else
                            @lang('lang.class')
                            @endif
                        </button>
                        @if (session('system_mode') != 'restaurant')
                        <button type="button" value="6"
                            class="select_product_button column-toggle">@lang('lang.category')</button>
                        <button type="button" value="7"
                            class="select_product_button column-toggle">@lang('lang.sub_category')</button>
                        @endif
                        <button type="button" value="8"
                            class="select_product_button column-toggle">@lang('lang.purchase_history')</button>
                        <button type="button" value="9"
                            class="select_product_button column-toggle">@lang('lang.batch_number')</button>
                        <button type="button" value="10"
                            class="select_product_button column-toggle">@lang('lang.selling_price')</button>
                        <button type="button" value="11"
                            class="select_product_button column-toggle">@lang('lang.tax')</button>
                        @if (session('system_mode') != 'restaurant')
                        <button type="button" value="12"
                            class="select_product_button column-toggle">@lang('lang.brand')</button>
                        @endif
                        <button type="button" value="13"
                            class="select_product_button column-toggle">@lang('lang.unit')</button>
                        <button type="button" value="14"
                            class="select_product_button column-toggle">@lang('lang.color')</button>
                        <button type="button" value="15"
                            class="select_product_button column-toggle">@lang('lang.size')</button>
                        <button type="button" value="16"
                            class="select_product_button column-toggle">@lang('lang.grade')</button>
                        @if (empty($page))
                        <button type="button" value="17"
                            class="select_product_button column-toggle">@lang('lang.current_stock')</button>
                        @endif
                        @if (!empty($page))
                        <button type="button" value="18"
                            class="select_product_button column-toggle">@lang('lang.current_stock_value')</button>
                        @endif
                        <button type="button" value="19"
                            class="select_product_button column-toggle">@lang('lang.customer_type')</button>
                        <button type="button" value="20"
                            class="select_product_button column-toggle">@lang('lang.expiry_date')</button>
                        <button type="button" value="21"
                            class="select_product_button column-toggle">@lang('lang.manufacturing_date')</button>
                        <button type="button" value="22"
                            class="select_product_button column-toggle">@lang('lang.discount')</button>
                        @can('product_module.purchase_price.view')
                        <button type="button" value="23"
                            class="select_product_button column-toggle">@lang('lang.purchase_price')</button>
                        @endcan
                        <button type="button" value="24"
                            class="select_product_button column-toggle">@lang('lang.supplier')</button>
                        <button type="button" value="25"
                            class="select_product_button column-toggle">@lang('lang.active')</button>
                        <button type="button" value="26"
                            class="select_product_button column-toggle">@lang('lang.created_by')</button>
                        <button type="button" value="28"
                            class="select_product_button column-toggle">@lang('lang.edited_by')</button>

                    </div>
                </div> --}}
            </div>




            <div class="table-responsive" style="height: 60vh">
                <table id="product_table" class="table table-hover">
                    <div style="overflow: auto; width: 100%;height: 10px; transform:rotateX(180deg);">
                    </div>
                    <thead>
                        <tr>
                            <th>@lang('lang.show_at_the_main_pos_page')</th>
                            <th>@lang('lang.image')</th>
                            <th style="">@lang('lang.name')</th>
                            <th>@lang('lang.product_code')</th>
                            <th>
                                @if (session('system_mode') == 'restaurant')
                                @lang('lang.category')
                                @else
                                @lang('lang.class')
                                @endif
                            </th>

                            <th>@lang('lang.select_to_delete')
                                <input type="checkbox" name="product_delete_all" class="product_delete_all mx-1" />
                            </th>
                            @if (session('system_mode') != 'restaurant')
                            <th>@lang('lang.category')</th>
                            <th>@lang('lang.sub_category')</th>
                            @endif
                            <th>@lang('lang.purchase_history')</th>
                            <th>@lang('lang.batch_number')</th>
                            <th>@lang('lang.selling_price')</th>
                            <th>@lang('lang.tax')</th>
                            @if (session('system_mode') != 'restaurant')
                            <th>@lang('lang.brand')</th>
                            @endif
                            <th>@lang('lang.unit')</th>
                            <th>@lang('lang.color')</th>
                            <th>@lang('lang.size')</th>
                            <th>@lang('lang.grade')</th>
                            <th class="sum">@lang('lang.current_stock')</th>
                            <th class="sum">@lang('lang.current_stock_value')</th>
                            <th>@lang('lang.customer_type')</th>
                            <th>@lang('lang.expiry_date')</th>
                            <th>@lang('lang.manufacturing_date')</th>
                            <th>@lang('lang.discount')</th>
                            @can('product_module.purchase_price.view')
                            <th>@lang('lang.purchase_price')</th>
                            @endcan
                            <th>@lang('lang.supplier')</th>
                            <th>@lang('lang.active')</th>
                            <th>@lang('lang.created_by')</th>
                            <th>@lang('lang.date_of_creation')</th>
                            <th>@lang('lang.edited_by')</th>
                            <th>@lang('lang.edited_at')</th>
                            <th class="notexport">@lang('lang.action')</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                    <tfoot>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <th style="text-align: right">@lang('lang.total')</th>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                    </tfoot>
                </table>

            </div>
        </div>
    </div>

</section>
@endsection
@push('javascripts')
<script>
    $(document).on('click', '#delete_all', function() {
            var checkboxes = document.querySelectorAll('input[name="product_selected_delete"]');
            var selected_delete_ids = [];
            for (var i = 0; i < checkboxes.length; i++) {
                if (checkboxes[i].checked) {
                    selected_delete_ids.push(checkboxes[i].value);
                }
            }
            if (selected_delete_ids.length == 0) {
                swal({
                    title: 'Warning',
                    text: LANG.sorry_you_should_select_products_to_continue_delete,
                    icon: 'warning',
                })
            } else {
                swal({
                    title: 'Are you sure?',
                    text: LANG.all_transactions_related_to_this_products_will_be_deleted,
                    icon: 'warning',
                }).then(willDelete => {
                    if (willDelete) {
                        var check_password = $(this).data('check_password');
                        var href = $(this).data('href');
                        var data = $(this).serialize();

                        swal({
                            title: 'Please Enter Your Password',
                            content: {
                                element: "input",
                                attributes: {
                                    placeholder: "Type your password",
                                    type: "password",
                                    autocomplete: "off",
                                    autofocus: false,
                                },
                            },
                            inputAttributes: {
                                autocapitalize: 'off',
                                autoComplete: 'off',
                            },
                            focusConfirm: true
                        }).then((result) => {
                            if (result) {
                                $.ajax({
                                    url: check_password,
                                    method: 'POST',
                                    data: {
                                        value: result
                                    },
                                    dataType: 'json',
                                    success: (data) => {

                                        if (data.success == true) {
                                            swal(
                                                'Success',
                                                'Correct Password!',
                                                'success'
                                            );
                                            $.ajax({
                                                method: 'POST',
                                                url: "{{ action('ProductController@multiDeleteRow') }}",
                                                dataType: 'json',
                                                data: {
                                                    "ids": selected_delete_ids
                                                },
                                                success: function(result) {
                                                    if (result.success ==
                                                        true) {
                                                        swal(
                                                            'Success',
                                                            result.msg,
                                                            'success'
                                                        );
                                                        setTimeout(() => {
                                                            location
                                                                .reload();
                                                        }, 1500);
                                                        location.reload();
                                                    } else {
                                                        swal(
                                                            'Error',
                                                            result.msg,
                                                            'error'
                                                        );
                                                    }
                                                },
                                            });

                                        } else {
                                            swal(
                                                'Failed!',
                                                'Wrong Password!',
                                                'error'
                                            )

                                        }
                                    }
                                });
                            }
                        });
                    }
                });
            }








        });
        $(document).on('click', '.delete_product', function(e) {
            e.preventDefault();
            swal({
                title: 'Are you sure?',
                text: "@lang('lang.all_transactions_related_to_this_product_will_be_deleted')",
                icon: 'warning',
            }).then(willDelete => {
                if (willDelete) {
                    var check_password = $(this).data('check_password');
                    var href = $(this).data('href');
                    var data = $(this).serialize();

                    swal({
                        title: 'Please Enter Your Password',
                        content: {
                            element: "input",
                            attributes: {
                                placeholder: "Type your password",
                                type: "password",
                                autocomplete: "off",
                                autofocus: true,
                            },
                        },
                        inputAttributes: {
                            autocapitalize: 'off',
                            autoComplete: 'off',
                        },
                        focusConfirm: true
                    }).then((result) => {
                        if (result) {
                            $.ajax({
                                url: check_password,
                                method: 'POST',
                                data: {
                                    value: result
                                },
                                dataType: 'json',
                                success: (data) => {

                                    if (data.success == true) {
                                        swal(
                                            'Success',
                                            'Correct Password!',
                                            'success'
                                        );

                                        $.ajax({
                                            method: 'DELETE',
                                            url: href,
                                            dataType: 'json',
                                            data: data,
                                            success: function(result) {
                                                if (result.success ==
                                                    true) {
                                                    swal(
                                                        'Success',
                                                        result.msg,
                                                        'success'
                                                    );
                                                    setTimeout(() => {
                                                        location
                                                            .reload();
                                                    }, 1500);
                                                    location.reload();
                                                } else {
                                                    swal(
                                                        'Error',
                                                        result.msg,
                                                        'error'
                                                    );
                                                }
                                            },
                                        });

                                    } else {
                                        swal(
                                            'Failed!',
                                            'Wrong Password!',
                                            'error'
                                        )

                                    }
                                }
                            });
                        }
                    });
                }
            });
        });
</script>
@endpush

@section('javascript')
<script>
    $('#product_table').on('change', '.product_delete_all', function() {
            var isChecked = $(this).prop('checked');
            product_table.rows().nodes().to$().find('.product_selected_delete').prop('checked', isChecked);
        });
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
                // stateSave: true,
                buttons: buttons,
                processing: true,
                serverSide: true,
                aaSorting: [
                    [2, 'asc']
                ],
                "ajax": {
                    "url": "/product",
                    "data": function(d) {
                        d.product_id = $('#product_id').val();
                        d.product_class_id = $('#product_class_id').val();
                        d.category_id = $('#category_id').val();
                        d.sub_category_id = $('#sub_category_id').val();
                        d.brand_id = $('#brand_id').val();
                        d.supplier_id = $('#supplier_id').val();
                        d.unit_id = $('#unit_id').val();
                        d.color_id = $('#color_id').val();
                        d.size_id = $('#size_id').val();
                        d.grade_id = $('#grade_id').val();
                        d.tax_id = $('#tax_id').val();
                        d.store_id = $('#store_id').val();
                        d.customer_type_id = $('#customer_type_id').val();
                        d.active = $('#active').val();
                        d.created_by = $('#created_by').val();
                        d.created_at = $('#dat').val();
                        d.show_zero_stocks = $('#show_zero_stocks').val();

                    }
                },
                columnDefs: [{
                    "targets": [0, 3],
                    "orderable": false,
                    "searchable": true
                }],
                columns: [{
                        data: 'show_at_the_main_pos_page',
                        name: 'show_at_the_main_pos_page'
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
                        data: 'product_class',
                        name: 'product_classes.name'
                    },
                    {
                        data: "selection_checkbox_delete",
                        name: "selection_checkbox_delete",
                        searchable: false,
                        orderable: false,
                    },
                    @if (session('system_mode') != 'restaurant')
                        {
                            data: 'category',
                            name: 'categories.name'
                        }, {
                            data: 'sub_category',
                            name: 'categories.name'
                        },
                    @endif {
                        data: 'purchase_history',
                        name: 'purchase_history'
                    },
                    {
                        data: 'batch_number',
                        name: 'add_stock_lines.batch_number'
                    },
                    {
                        data: 'default_sell_price',
                        name: 'variations.default_sell_price'
                    },
                    {
                        data: 'tax',
                        name: 'taxes.name'
                    },
                    @if (session('system_mode') != 'restaurant')
                        {
                            data: 'brand',
                            name: 'brands.name'
                        },
                    @endif {
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
                        data: 'current_stock',
                        name: 'current_stock',
                        searchable: false
                    },
                    {
                        data: 'current_stock_value',
                        name: 'current_stock_value',
                        searchable: false
                        @if (empty($page))
                            , visible: false
                        @endif
                    },
                    {
                        data: 'customer_type',
                        name: 'customer_type'
                    },
                    {
                        data: 'exp_date',
                        name: 'add_stock_lines.expiry_date'
                    },
                    {
                        data: 'manufacturing_date',
                        name: 'add_stock_lines.manufacturing_date'
                    },
                    {
                        data: 'discount',
                        name: 'discount'
                    },
                    @can('product_module.purchase_price.view')
                        {
                            data: 'default_purchase_price',
                            name: 'default_purchase_price',
                            searchable: false
                        },
                    @endcan {
                        data: 'supplier_name',
                        name: 'supplier',
                        searchable: false
                    },
                    {
                        data: 'active',
                        name: 'active'
                    },
                    {
                        data: 'created_by',
                        name: 'users.name'
                    },
                    {
                        data: 'created_at',
                        name: 'created_at'
                    },
                    {
                        data: 'edited_by_name',
                        name: 'edited.name'
                    },
                    {
                        data: 'updated_at',
                        name: 'updated_at'
                    },
                    {
                        data: 'action',
                        name: 'action'
                    },

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

        });



        $(document).ready(function() {
            var hiddenColumnArray = JSON.parse('{!! addslashes(json_encode(Cache::get('key_' . auth()->id(), []))) !!}');

            $.each(hiddenColumnArray, function(index, value) {
                $('.column-toggle').each(function() {
                    if ($(this).val() == value) {
                        // alert(value)
                        toggleColumnVisibility(value, $(this));
                    }
                });
            });

            $(document).on('click', '.column-toggle', function() {
                var column_index = parseInt($(this).val());
                toggleColumnVisibility(column_index, $(this));

                if (hiddenColumnArray.includes(column_index)) {
                    hiddenColumnArray.splice(hiddenColumnArray.indexOf(column_index), 1);
                } else {
                    hiddenColumnArray.push(column_index);
                }

                hiddenColumnArray = [...new Set(hiddenColumnArray)]; // Remove duplicates

                // Update the columnVisibility cache data
                $.ajax({
                    url: '/update-column-visibility', // Replace with your route or endpoint for updating cache data
                    method: 'POST',
                    data: {
                        columnVisibility: hiddenColumnArray
                    },
                    success: function() {
                        console.log('Column visibility updated successfully.');
                    }
                });
            });

            function toggleColumnVisibility(column_index, this_btn) {
                var column = product_table.column(column_index);
                column.visible(!column.visible());

                if (column.visible()) {
                    $(this_btn).addClass('badge-primary').removeClass('badge-warning');
                } else {
                    $(this_btn).removeClass('badge-primary').addClass('badge-warning');
                }
            }
        });

        $(document).on('change', '.filter_product', function() {
            product_table.ajax.reload();
        })
        $(document).on('click', '.clear_filters', function() {
            $('.filter_product').val('');
            $('.filter_product').selectpicker('refresh');
            $('#product_id').val('');
            $('.show_zero_stocks').val(1);
            product_table.ajax.reload();
        });
        $(document).on('change', '.show_zero_stocks', function() {
            if (this.checked) {
                $('.show_zero_stocks').val(0);
            } else {
                $('.show_zero_stocks').val(1);
            }
            product_table.ajax.reload();
        });

        @if (!empty(request()->product_id))
            $(document).ready(function() {
                $('#product_id').val({{ request()->product_id }});
                product_table.ajax.reload();

                var container = '.view_modal';
                $.ajax({
                    method: 'get',
                    url: '/product/{{ request()->product_id }}',
                    dataType: 'html',
                    success: function(result) {
                        $(container).html(result).modal('show');
                    },
                });
            });
        @endif

        $(document).on('click', '.delete_product', function(e) {
            e.preventDefault();
            swal({
                title: 'Are you sure?',
                text: "@lang('lang.all_transactions_related_to_this_product_will_be_deleted')",
                icon: 'warning',
            }).then(willDelete => {
                if (willDelete) {
                    var check_password = $(this).data('check_password');
                    var href = $(this).data('href');
                    var data = $(this).serialize();

                    swal({
                        title: 'Please Enter Your Password',
                        content: {
                            element: "input",
                            attributes: {
                                placeholder: "Type your password",
                                type: "password",
                                autocomplete: "off",
                                autofocus: true,
                            },
                        },
                        inputAttributes: {
                            autocapitalize: 'off',
                            autoComplete: 'off',
                        },
                        focusConfirm: true
                    }).then((result) => {
                        if (result) {
                            $.ajax({
                                url: check_password,
                                method: 'POST',
                                data: {
                                    value: result
                                },
                                dataType: 'json',
                                success: (data) => {

                                    if (data.success == true) {
                                        swal(
                                            'Success',
                                            'Correct Password!',
                                            'success'
                                        );

                                        $.ajax({
                                            method: 'DELETE',
                                            url: href,
                                            dataType: 'json',
                                            data: data,
                                            success: function(result) {
                                                if (result.success ==
                                                    true) {
                                                    swal(
                                                        'Success',
                                                        result.msg,
                                                        'success'
                                                    );
                                                    setTimeout(() => {
                                                        location
                                                            .reload();
                                                    }, 1500);
                                                    location.reload();
                                                } else {
                                                    swal(
                                                        'Error',
                                                        result.msg,
                                                        'error'
                                                    );
                                                }
                                            },
                                        });

                                    } else {
                                        swal(
                                            'Failed!',
                                            'Wrong Password!',
                                            'error'
                                        )

                                    }
                                }
                            });
                        }
                    });
                }
            });
        });
        $(document).on('change', '.show_at_the_main_pos_page', function(e) {
            $.ajax({
                type: "GET",
                url: "/products/toggle-appearance-pos/" + $(this).data('id'),
                data: {
                    check: $(this).is(":checked") ? 'yes' : 'no'
                },
                // dataType: "dataType",
                success: function(response) {
                    if (response) {
                        $(this).removeAttr('checked');
                        $(this).attr('checked', false);
                        swal(response.success, response.msg, response.status);
                    }
                }
            });
        });
</script>

<script src="{{ asset('front/js/bootstrap.min.js') }}"></script>

<script>
    // Add an event listener for the 'show.bs.collapse' and 'hide.bs.collapse' events
    $('#productsFilterCollapse').on('show.bs.collapse', function() {
    // Change the arrow icon to 'chevron-up' when the content is expanded
    $('button[data-bs-target="#productsFilterCollapse"] i').removeClass('fa-arrow-down').addClass(
    'fa-arrow-up');
    });

    $('#productsFilterCollapse').on('hide.bs.collapse', function() {
    // Change the arrow icon to 'chevron-down' when the content is collapsed
    $('button[data-bs-target="#productsFilterCollapse"] i').removeClass('fa-arrow-up').addClass(
    'fa-arrow-down');
    });
    // Add an event listener for the 'show.bs.collapse' and 'hide.bs.collapse' events
    $('#productsOtherFilterCollapse').on('show.bs.collapse', function() {
    // Change the arrow icon to 'chevron-up' when the content is expanded
    $('button[data-bs-target="#productsOtherFilterCollapse"] i').removeClass('fa-arrow-down').addClass(
    'fa-arrow-up');
    });

    $('#productsOtherFilterCollapse').on('hide.bs.collapse', function() {
    // Change the arrow icon to 'chevron-down' when the content is collapsed
    $('button[data-bs-target="#productsOtherFilterCollapse"] i').removeClass('fa-arrow-up').addClass(
    'fa-arrow-down');
    });
</script>
@endsection
