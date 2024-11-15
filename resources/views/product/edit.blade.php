@extends('layouts.app')
@section('title', __('lang.products'))
@section('styles')
    <style>
        .preview-edit-product-container {
            /* display: flex;
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        flex-wrap: wrap;
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        gap: 10px;
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        margin-top: 20px; */
            display: grid;
            grid-template-columns: repeat(auto-fill, 170px);
        }

        .preview {
            position: relative;
            width: 150px;
            height: 150px;
            padding: 4px;
            box-shadow: 1px 1px 2px rgba(0, 0, 0, 0.2);
            margin: 30px 0px;
            border: 1px solid #ddd;
        }

        .preview img {
            width: 100%;
            height: 100%;
            box-shadow: 1px 1px 2px rgba(0, 0, 0, 0.2);
            border: 1px solid #ddd;
            object-fit: cover;

        }

        .delete-btn {
            position: absolute;
            top: 156px;
            right: 0px;
            /*border: 2px solid #ddd;*/
            border: none;
            cursor: pointer;
        }

        .delete-btn {
            background: transparent;
            color: rgba(235, 32, 38, 0.97);
        }

        .crop-btn {
            position: absolute;
            top: 156px;
            left: 0px;
            /*border: 2px solid #ddd;*/
            border: none;
            cursor: pointer;
            background: transparent;
            color: #007bff;
        }
    </style>
    <style>
        .variants {
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .variants>div {
            margin-right: 5px;
        }

        .variants>div:last-of-type {
            margin-right: 0;
        }

        .file {
            position: relative;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .file>input[type='file'] {
            display: none
        }

        .file>label {
            font-size: 1rem;
            font-weight: 300;
            cursor: pointer;
            outline: 0;
            user-select: none;
            border-color: rgb(216, 216, 216) rgb(209, 209, 209) rgb(186, 186, 186);
            border-style: solid;
            border-radius: 4px;
            border-width: 1px;
            background-color: hsl(0, 0%, 100%);
            color: hsl(0, 0%, 29%);
            padding-left: 16px;
            padding-right: 16px;
            padding-top: 16px;
            padding-bottom: 16px;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .file>label:hover {
            border-color: hsl(0, 0%, 21%);
        }

        .file>label:active {
            background-color: hsl(0, 0%, 96%);
        }

        .file>label>i {
            padding-right: 5px;
        }

        .file--upload>label {
            color: hsl(204, 86%, 53%);
            border-color: hsl(204, 86%, 53%);
        }

        .file--upload>label:hover {
            border-color: hsl(204, 86%, 53%);
            background-color: hsl(204, 86%, 96%);
        }

        .file--upload>label:active {
            background-color: hsl(204, 86%, 91%);
        }

        .file--uploading>label {
            color: hsl(48, 100%, 67%);
            border-color: hsl(48, 100%, 67%);
        }

        .file--uploading>label>i {
            animation: pulse 5s infinite;
        }

        .file--uploading>label:hover {
            border-color: hsl(48, 100%, 67%);
            background-color: hsl(48, 100%, 96%);
        }

        .file--uploading>label:active {
            background-color: hsl(48, 100%, 91%);
        }

        .file--success>label {
            color: hsl(141, 71%, 48%);
            border-color: hsl(141, 71%, 48%);
        }

        .file--success>label:hover {
            border-color: hsl(141, 71%, 48%);
            background-color: hsl(141, 71%, 96%);
        }

        .file--success>label:active {
            background-color: hsl(141, 71%, 91%);
        }

        .file--danger>label {
            color: hsl(348, 100%, 61%);
            border-color: hsl(348, 100%, 61%);
        }

        .file--danger>label:hover {
            border-color: hsl(348, 100%, 61%);
            background-color: hsl(348, 100%, 96%);
        }

        .file--danger>label:active {
            background-color: hsl(348, 100%, 91%);
        }

        .file--disabled {
            cursor: not-allowed;
        }

        .file--disabled>label {
            border-color: #e6e7ef;
            color: #e6e7ef;
            pointer-events: none;
        }

        @keyframes pulse {
            0% {
                color: hsl(48, 100%, 67%);
            }

            50% {
                color: hsl(48, 100%, 38%);
            }

            100% {
                color: hsl(48, 100%, 67%);
            }
        }
    </style>
@section('style')
    <link rel="stylesheet" type="text/css" href="{{ url('front/css/supplier.css') }}">
@endsection
@endsection
@section('content')
<section class="forms py-0">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 px-1">
                <div
                    class="d-flex align-items-center my-2 @if (app()->isLocale('ar')) justify-content-end @else justify-content-start @endif">

                    <h4 class="mb-0">@lang('lang.edit_product')
                        <span class="header-pill"></span>
                    </h4>
                </div>

                {!! Form::open([
                    'url' => action('ProductController@update', $product->id),
                    'id' => 'products-edit-form',
                    'method' => 'PUT',
                    'class' => '',
                    'enctype' => 'multipart/form-data',
                ]) !!}
                <div class="card mb-2 d-flex flex-column justify-content-center align-items-center">

                    <div class="col-12  d-flex flex-row justify-content-center align-items-center">
                        <p class="italic mb-0 py-1"><small>@lang('lang.required_fields_info')</small>
                        <div style="width: 30px;height: 30px;">
                            <img class="w-100 h-100" src="{{ asset('front/images/icons/warning.png') }}" alt="warning!">
                        </div>
                        </p>
                    </div>

                    <div class="col-12 d-flex  flex-row justify-content-between align-items-center">
                        <div class="col-md-3 px-0 d-flex justify-content-center">
                            <div class="i-checks">
                                <input id="is_service" name="is_service" type="checkbox"
                                    @if (!empty($product->is_service)) checked @endif value="1"
                                    class="form-control-custom">
                                <label for="is_service"><strong>
                                        @if (session('system_mode') == 'restaurant')
                                            @lang('lang.or_add_new_product')
                                        @else
                                            @lang('lang.add_new_service')
                                        @endif
                                    </strong></label>
                            </div>
                        </div>
                        <div class="col-md-1 px-0 d-flex justify-content-center">
                            <div class="i-checks">
                                <input id="active" name="active" type="checkbox"
                                    @if (!empty($product->active)) checked @endif value="1"
                                    class="form-control-custom">
                                <label for="active"><strong>
                                        @lang('lang.active')
                                    </strong></label>
                            </div>
                        </div>
                        <div class="col-md-2 px-0 d-flex justify-content-center">
                            <div class="i-checks">
                                <input id="have_weight" name="have_weight" type="checkbox"
                                    @if (!empty($product->have_weight)) checked @endif value="1"
                                    class="form-control-custom">
                                <label for="have_weight"><strong>
                                        @lang('lang.have_weight')
                                    </strong></label>
                            </div>
                        </div>
                        <div class="col-md-1 px-0 d-flex justify-content-center">
                            <div class="i-checks">
                                <input id="weighing_scale_barcode" name="weighing_scale_barcode" type="checkbox"
                                    @if (!empty($product->weighing_scale_barcode)) checked @endif value="1"
                                    class="form-control-custom">
                                <label for="weighing_scale_barcode"><strong>
                                        @lang('lang.weighing_scale_barcode')
                                    </strong></label>
                            </div>
                        </div>
                        @php
                            $products_count = App\Models\Product::where('show_at_the_main_pos_page', 'yes')->count();
                        @endphp
                        <div class="col-md-3 px-0 d-flex justify-content-center">
                            <div class="i-checks">
                                <input id="show_at_the_main_pos_page" name="show_at_the_main_pos_page" type="checkbox"
                                    @if (isset($products_count) && $products_count < 40) @if (!empty($product->show_at_the_main_pos_page) && $product->show_at_the_main_pos_page == 'yes') checked @endif
                                @elseif(isset($products_count) && $products_count == 40) disabled @endif
                                value="1" class="form-control-custom">
                                <label for="show_at_the_main_pos_page"><strong>@lang('lang.show_at_the_main_pos_page')</strong></label>
                            </div>
                        </div>
                    </div>
                </div>
                <div
                    class="d-flex align-items-center my-2 @if (app()->isLocale('ar')) justify-content-end @else justify-content-start @endif">
                    <h6 class="mb-0">
                        @lang('lang.product_information')
                        <span class=" section-header-pill"></span>
                    </h6>
                </div>
                <div class="card mb-3">
                    <div class="card-body p-2">
                        <div class="row @if (app()->isLocale('ar')) flex-row-reverse @else flex-row @endif">
                            <div class="col-md-4 supplier_div @if (empty($product->is_service)) hide @endif px-5">
                                <div class="form-group ">
                                    {!! Form::label('supplier_id', __('lang.supplier'), [
                                        'class' => 'form-label d-block mb-1 app()->isLocale("ar") ? text-end : text-start',
                                    ]) !!}
                                    <div class="input-group my-group select-button-group">
                                        {!! Form::select('supplier_id', $suppliers, !empty($product->supplier) ? $product->supplier->id : false, [
                                            'class' => 'selectpicker form-control',
                                            'data-live-search' => 'true',
                                            'style' => 'width: 80%',
                                            'placeholder' => __('lang.please_select'),
                                        ]) !!}
                                        <span class="input-group-btn">
                                            @can('supplier_module.supplier.create_and_edit')
                                                <button type="button" class="btn-modal btn-flat select-button"
                                                    data-href="{{ action('SupplierController@create') }}?quick_add=1"
                                                    data-container=".view_modal"><i class="fa fa-plus"></i></button>
                                            @endcan
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4 px-5">
                                @if (session('system_mode') == 'restaurant')
                                    {!! Form::label('product_class_id', __('lang.category') . ' *', [
                                        'class' => 'form-label d-block mb-1 app()->isLocale("ar") ? text-end : text-start',
                                    ]) !!}
                                @else
                                    {!! Form::label('product_class_id', __('lang.class') . ' *', [
                                        'class' => 'form-label d-block mb-1 app()->isLocale("ar") ? text-end : text-start',
                                    ]) !!}
                                @endif
                                <div class="input-group my-group  select-button-group">
                                    {!! Form::select('product_class_id', $product_classes, $product->product_class_id, [
                                        'class' => 'selectpicker form-control',
                                        'data-live-search' => 'true',
                                        'style' => 'width: 80%',
                                        'placeholder' => __('lang.please_select'),
                                        'required',
                                    ]) !!}
                                    <span class="input-group-btn">
                                        @can('product_module.product_class.create_and_edit')
                                            <button type="button" class="btn-modal btn-flat select-button"
                                                data-href="{{ action('ProductClassController@create') }}?quick_add=1"
                                                data-container=".view_modal"><i class="fa fa-plus"></i></button>
                                        @endcan
                                    </span>
                                </div>
                                <div class="error-msg text-red"></div>
                            </div>

                            @if (session('system_mode') == 'pos' || session('system_mode') == 'garments' || session('system_mode') == 'supermarket')
                                <div class="col-md-4  px-5">
                                    {!! Form::label('category_id', __('lang.category') . ' *', [
                                        'class' => 'form-label d-block mb-1 app()->isLocale("ar") ? text-end : text-start',
                                    ]) !!}
                                    <div class="input-group my-group  select-button-group">
                                        <input type="hidden" data-category_id="{{ $product->category_id }}"
                                            id="category_value_id" />
                                        {!! Form::select('category_id', $categories, $product->category_id, [
                                            'class' => 'selectpicker form-control',
                                            'data-live-search' => 'true',
                                            'style' => 'width: 80%',
                                            'placeholder' => __('lang.please_select'),
                                        ]) !!}
                                        <span class="input-group-btn">
                                            @can('product_module.category.create_and_edit')
                                                <button type="button" class="btn-modal btn-flat select-button "
                                                    data-href="{{ action('CategoryController@create') }}?quick_add=1&type=category"
                                                    data-container=".view_modal"><i class="fa fa-plus"></i></button>
                                            @endcan
                                        </span>
                                    </div>
                                    <div class="error-msg text-red"></div>
                                </div>

                                <div class="col-md-4 px-5">
                                    {!! Form::label('sub_category_id', __('lang.sub_category') . ' *', [
                                        'class' => 'form-label d-block mb-1 app()->isLocale("ar") ? text-end : text-start',
                                    ]) !!}
                                    <div class="input-group my-group select-button-group">
                                        <input type="hidden" data-sub_category_id="{{ $product->sub_category_id }}"
                                            id="sub_category_id_data" />
                                        {!! Form::select('sub_category_id', $sub_categories, $product->sub_category_id, [
                                            'class' => 'selectpicker form-control',
                                            'data-live-search' => 'true',
                                            'style' => 'width: 80%',
                                            'placeholder' => __('lang.please_select'),
                                        ]) !!}
                                        <span class="input-group-btn">
                                            @can('product_module.sub_category.create_and_edit')
                                                <button type="button" class="btn-modal btn-flat select-button"
                                                    data-href="{{ action('CategoryController@create') }}?quick_add=1"
                                                    data-container=".view_modal"><i class="fa fa-plus"></i></button>
                                            @endcan
                                        </span>
                                    </div>
                                    <div class="error-msg text-red"></div>
                                </div>
                                <div class="col-md-4  px-5">
                                    {!! Form::label('brand_id', __('lang.brand') . ' *', [
                                        'class' => 'form-label d-block mb-1 app()->isLocale("ar") ? text-end : text-start',
                                    ]) !!}
                                    <div class="input-group my-group  select-button-group">
                                        {!! Form::select('brand_id', $brands, $product->brand_id, [
                                            'class' => 'selectpicker form-control',
                                            'data-live-search' => 'true',
                                            'style' => 'width: 80%',
                                            'placeholder' => __('lang.please_select'),
                                            'required',
                                        ]) !!}
                                        <span class="input-group-btn">
                                            @can('product_module.brand.create_and_edit')
                                                <button type="button" class="btn-modal select-button btn-flat"
                                                    data-href="{{ action('BrandController@create') }}?quick_add=1"
                                                    data-container=".view_modal"><i class="fa fa-plus"></i></button>
                                            @endcan
                                        </span>
                                    </div>
                                    <div class="error-msg text-red"></div>
                                </div>
                            @endif
                            <div class="col-md-4  px-5">
                                <div class="form-group">
                                    {!! Form::label('name', __('lang.name') . ' *', [
                                        'class' => 'form-label d-block mb-1 app()->isLocale("ar") ? text-end : text-start',
                                    ]) !!}
                                    <div class="input-group my-group select-button-group">
                                        {!! Form::text('name', $product->name, [
                                            'class' => 'form-control modal-input app()->isLocale("ar") ? text-end : text-start',
                                            'required',
                                            'placeholder' => 'mada',
                                        ]) !!}
                                        <span class="input-group-btn">
                                            <button type="button" class="select-button btn-flat translation_btn"
                                                type="button" data-type="product"><i
                                                    class="dripicons-web"></i></button>
                                        </span>
                                    </div>
                                </div>
                                @include('layouts.partials.translation_inputs', [
                                    'attribute' => 'name',
                                    'translations' => $product->translations,
                                    'type' => 'products',
                                ])
                            </div>
                            <div class="col-md-4 px-5">
                                <div class="form-group">
                                    {!! Form::label('sku', __('lang.sku') . ' *', [
                                        'class' => 'form-label d-block mb-1 app()->isLocale("ar") ? text-end : text-start',
                                    ]) !!}
                                    {!! Form::text('sku', $product->sku, [
                                        'class' => 'form-control modal-input app()->isLocale("ar") ? text-end : text-start',
                                        'required',
                                        'placeholder' => __('lang.sku'),
                                    ]) !!}
                                </div>
                            </div>
                            @if (session('system_mode') == 'pos' || session('system_mode') == 'garments' || session('system_mode') == 'supermarket')
                                <div class="col-md-4 px-5">
                                    <div class="form-group">
                                        {!! Form::label('alert_quantity', __('lang.alert_quantity') . ' *', [
                                            'class' => 'form-label d-block mb-1 app()->isLocale("ar") ? text-end : text-start',
                                        ]) !!}
                                        {!! Form::text('alert_quantity', $product->alert_quantity, [
                                            'class' => 'form-control modal-input app()->isLocale("ar") ? text-end : text-start',
                                            'placeholder' => __('lang.alert_quantity'),
                                        ]) !!}
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>


                <div
                    class="d-flex align-items-center my-2 @if (app()->isLocale('ar')) justify-content-end @else justify-content-start @endif">
                    <h6 class="mb-0">
                        @lang('lang.product_image')
                        <span class=" section-header-pill"></span>
                    </h6>
                </div>

                <div class="card mb-3">
                    <div
                        class="card-body p-2 d-flex justify-content-between align-items-center @if (app()->isLocale('ar')) flex-row-reverse @else flex-row @endif">
                        <div class="variants col-md-6">
                            <div class='file file-upload w-100'>
                                <label for='file-product-edit-product' class="w-100  modal-input m-0">
                                    <i class="fas fa-cloud-upload-alt"></i>
                                </label>
                                <!-- <input  id="file-input" multiple type='file' /> -->
                                <input type="file" id="file-product-edit-product">
                            </div>
                        </div>

                        <div class="col-md-6 d-flex justify-content-center">
                            <div class="preview-edit-product-container">
                                @if (!empty($product->getFirstMediaUrl('products')))
                                    <div id="preview{{ $product->id }}" class="preview">
                                        <img src="{{ $product->getFirstMediaUrl('products') }}"
                                            id="img{{ $product->id }}" alt="">
                                        <div class="action_div"></div>
                                        <button type="button" class="delete-btn"><i style="font-size: 16px;"
                                                data-href="{{ action('ProductController@deleteProductImage', $product->id) }}"
                                                id="deleteBtn{{ $product->id }}" class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <div
                    class="d-flex my-2  @if (app()->isLocale('ar')) justify-content-end @else justify-content-start @endif">
                    <button class="text-decoration-none toggle-button mb-0" type="button" data-bs-toggle="collapse"
                        data-bs-target="#productOtherDetailsCollapse" aria-expanded="false"
                        aria-controls="productOtherDetailsCollapse">
                        <i class="fas fa-arrow-down"></i>
                        @lang('lang.other_details')
                        <span class="section-header-pill"></span>
                    </button>
                </div>
                <div class="collapse" id="productOtherDetailsCollapse">
                    <div class="card mb-3">
                        <div class="card-body p-2">
                            <div
                                class="row  @if (app()->isLocale('ar')) flex-row-reverse @else flex-row @endif">

                                @if (session('system_mode') == 'pos' || session('system_mode') == 'garments' || session('system_mode') == 'supermarket')
                                    <div class="col-md-4 px-5">
                                        {!! Form::label('multiple_units', __('lang.unit'), [
                                            'class' => 'form-label d-block mb-1 app()->isLocale("ar") ? text-end : text-start',
                                        ]) !!}
                                        <div class="input-group my-group select-button-group">
                                            {!! Form::select('multiple_units[]', $units, $product->multiple_units, [
                                                'class' => 'selectpicker form-control',
                                                'data-live-search' => 'true',
                                                'disabled' => $product->type == 'variable' ? true : false,
                                                'style' => 'width: 80%',
                                                'multiple',
                                                'id' => 'multiple_units',
                                            ]) !!}
                                            <span class="input-group-btn">
                                                @can('product_module.unit.create_and_edit')
                                                    <button type="button" class="btn-modal select-button btn-flat"
                                                        data-href="{{ action('UnitController@create') }}?quick_add=1"
                                                        data-container=".view_modal"><i class="fa fa-plus"></i></button>
                                                @endcan
                                            </span>
                                        </div>
                                    </div>

                                    <div class="col-md-4 px-5">
                                        {!! Form::label('color_id', __('lang.color'), [
                                            'class' => 'form-label d-block mb-1 app()->isLocale("ar") ? text-end : text-start',
                                        ]) !!}
                                        <div class="input-group my-group select-button-group">
                                            {!! Form::select('color_id[]', $colors, $product->color_id, [
                                                'class' => 'selectpicker form-control',
                                                'data-live-search' => 'true',
                                                'disabled' => false,
                                                'style' => 'width: 80%',
                                                'multiple',
                                                'id' => 'color_id',
                                            ]) !!}
                                            <span class="input-group-btn">
                                                @can('product_module.color.create_and_edit')
                                                    <button type="button" class="btn-modal select-button btn-flat"
                                                        data-href="{{ action('ColorController@create') }}?quick_add=1"
                                                        data-container=".view_modal"><i class="fa fa-plus"></i></button>
                                                @endcan
                                            </span>
                                        </div>
                                    </div>
                                @endif
                                <div class="col-md-4 px-5">
                                    {!! Form::label('size_id', __('lang.size'), [
                                        'class' => 'form-label d-block mb-1 app()->isLocale("ar") ? text-end : text-start',
                                    ]) !!}
                                    <div class="input-group my-group select-button-group">
                                        {!! Form::select('size_id[]', $sizes, $product->size_id, [
                                            'class' => 'selectpicker form-control',
                                            'data-live-search' => 'true',
                                            'disabled' => $product->type == 'variable' ? true : false,
                                            'style' => 'width: 80%',
                                            'multiple',
                                            'id' => 'size_id',
                                        ]) !!}
                                        <span class="input-group-btn">
                                            @can('product_module.size.create_and_edit')
                                                <button type="button" class="btn-modal select-button btn-flat"
                                                    data-href="{{ action('SizeController@create') }}?quick_add=1"
                                                    data-container=".view_modal"><i class="fa fa-plus"></i></button>
                                            @endcan
                                        </span>
                                    </div>
                                </div>
                                @if (session('system_mode') == 'pos' || session('system_mode') == 'garments' || session('system_mode') == 'supermarket')
                                    <div class="col-md-4 px-5">
                                        {!! Form::label('multiple_grades', __('lang.grade'), [
                                            'class' => 'form-label d-block mb-1 app()->isLocale("ar") ? text-end : text-start',
                                        ]) !!}
                                        <div class="input-group my-group select-button-group">
                                            {!! Form::select('multiple_grades[]', $grades, $product->multiple_grades, [
                                                'class' => 'selectpicker form-control',
                                                'data-live-search' => 'true',
                                                'disabled' => $product->type == 'variable' ? true : false,
                                                'style' => 'width: 80%',
                                                'multiple',
                                                'id' => 'multiple_grades',
                                            ]) !!}
                                            <span class="input-group-btn">
                                                @can('product_module.grade.create_and_edit')
                                                    <button type="button" class="btn-modal select-button btn-flat"
                                                        data-href="{{ action('GradeController@create') }}?quick_add=1"
                                                        data-container=".view_modal"><i class="fa fa-plus"></i></button>
                                                @endcan
                                            </span>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <div
                    class="d-flex my-2  @if (app()->isLocale('ar')) justify-content-end @else justify-content-start @endif">
                    <button class="text-decoration-none toggle-button mb-0" type="button" data-bs-toggle="collapse"
                        data-bs-target="#productDetailsCollapse" aria-expanded="false"
                        aria-controls="productDetailsCollapse">
                        <i class="fas fa-arrow-down"></i>
                        @if (session('system_mode') == 'restaurant')
                            {{ __('lang.recipe') }}
                        @else
                            @lang('lang.product_details')
                        @endif
                        <span class="section-header-pill"></span>
                    </button>
                </div>


                <div class="collapse" id="productDetailsCollapse">
                    <div class="card mb-3">
                        <div class="card-body p-2">
                            <button type="button" class="translation_textarea_btn btn btn-sm"><i
                                    class="dripicons-web"></i></button>
                            <textarea name="product_details" id="product_details" class="form-control" rows="3">{{ $product->product_details }}</textarea>
                        </div>
                        <div class="col-md-4">
                            @include('layouts.partials.translation_textarea', [
                                'attribute' => 'product_details',
                                'translations' => $product->translations,
                            ])
                        </div>
                    </div>
                </div>


                @if (session('system_mode') == 'restaurant' || session('system_mode') == 'garments' || session('system_mode') == 'pos')

                    <div
                        class="d-flex my-2  @if (app()->isLocale('ar')) justify-content-end @else justify-content-start @endif">
                        <button class="text-decoration-none toggle-button mb-0" type="button"
                            data-bs-toggle="collapse" data-bs-target="#addPrimaryMaterialCollapse"
                            aria-expanded="false" aria-controls="addPrimaryMaterialCollapse">
                            <i class="fas fa-arrow-down"></i>
                            @lang('lang.add_primary_materials')
                            <span class="section-header-pill"></span>
                        </button>
                    </div>


                    <div class="collapse" id="addPrimaryMaterialCollapse">
                        <div class="card mb-3">
                            <div class="card-body p-2">
                                <div class="col-12 d-flex flex-row justify-content-between">

                                    <div class="col-md-4">
                                        <div class="i-checks">
                                            <input id="automatic_consumption" name="automatic_consumption"
                                                type="checkbox" @if (!empty($product) && $product->automatic_consumption == 1) checked @endif
                                                value="1" class="form-control-custom">
                                            <label
                                                for="automatic_consumption"><strong>@lang('lang.automatic_consumption')</strong></label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="i-checks">
                                            <input id="price_based_on_raw_material" name="price_based_on_raw_material"
                                                type="checkbox" @if ($product->price_based_on_raw_material == 1) checked @endif
                                                value="1" class="form-control-custom">
                                            <label
                                                for="price_based_on_raw_material"><strong>@lang('lang.price_based_on_raw_material')</strong></label>
                                        </div>
                                    </div>
                                </div>
                                {{--    <div class="col-md-4">
                                        <div class="i-checks">
                                            <input id="buy_from_supplier" name="buy_from_supplier" type="checkbox"
                                                @if ($products->buy_from_supplier == 1) checked @endif value="1"
                                                class="form-control-custom">
                                            <label for="buy_from_supplier"><strong>@lang('lang.buy_from_supplier')</strong></label>
                                        </div>
                                    </div> --}}
                                <div class="col-md-12">
                                    <table class="table  mb-1" id="consumption_table">
                                        <thead>
                                            <tr>
                                                <th class="py-2 text-center" style="width: 30%;">@lang('lang.raw_materials')
                                                </th>
                                                <th class="py-2 text-center" style="width: 30%;">@lang('lang.used_amount')
                                                </th>
                                                <th class="py-2 text-center" style="width: 30%;">@lang('lang.unit')
                                                </th>
                                                <th class="py-2 text-center" style="width: 30%;">@lang('lang.cost')
                                                </th>
                                                <th class="py-2 text-center" style="width: 10%;"></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                                $first_variation = $product->variations->first();
                                                $consumption_products = App\Models\ConsumptionProduct::where(
                                                    'variation_id',
                                                    $first_variation->id,
                                                )->get();
                                            @endphp
                                            @foreach ($consumption_products as $consumption_product)
                                                @include('product.partial.raw_material_row', [
                                                    'row_id' => $loop->index,
                                                    'consumption_product' => $consumption_product,
                                                ])
                                            @endforeach
                                        </tbody>
                                    </table>
                                    <div class="d-flex justify-content-center">
                                        <button class="btn btn-main px-5 py-1 add_raw_material_row"
                                            type="button">@lang('lang.add_new')</button>
                                    </div>
                                    <input type="hidden" name="raw_material_row_index" id="raw_material_row_index"
                                        value="@if (!empty($consumption_products) && $consumption_products->count() > 0) {{ $consumption_products->count() }}@else{{ 0 }} @endif">
                                </div>
                            </div>
                        </div>
                    </div>
                @endif




                <div
                    class="d-flex my-2  @if (app()->isLocale('ar')) justify-content-end @else justify-content-start @endif">
                    <button class="text-decoration-none toggle-button mb-0" type="button" data-bs-toggle="collapse"
                        data-bs-target="#discountInfoCollapse" aria-expanded="false"
                        aria-controls="discountInfoCollapse">
                        <i class="fas fa-arrow-down"></i>
                        @lang('lang.discount_information')
                        <span class="section-header-pill"></span>
                    </button>
                </div>

                <div class="collapse" id="discountInfoCollapse">
                    <div class="card mb-3">
                        <div class="card-body p-2">
                            <div class="col-md-12">
                                <table class="table table-bordered" id="consumption_table_discount">
                                    <thead>
                                        <tr>
                                            <th class="py-2 text-center" style="width: 15%;">@lang('lang.discount_type')</th>
                                            <th class="py-2 text-center" style="width: 15%;">@lang('lang.discount')</th>
                                            <th class="py-2 text-center" style="width: 25%;">@lang('lang.discount_category')</th>
                                            <th class="py-2 text-center" style="width: 5%;"></th>
                                            <th class="py-2 text-center" style="width: 15%;">@lang('lang.discount_start_date')</th>
                                            <th class="py-2 text-center" style="width: 15%;">@lang('lang.discount_end_date')</th>
                                            <th class="py-2 text-center" style="width: 20%;">@lang('lang.customer_type') <i
                                                    class="dripicons-question" data-toggle="tooltip"
                                                    title="@lang('lang.discount_customer_info')"></i></th>
                                            <th class="py-2 text-center" style="width: 5%;"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $discounts = \App\Models\ProductDiscount::where(
                                                'product_id',
                                                $product->id,
                                            )->get();
                                            $index_old = 0;
                                        @endphp

                                        {{-- @if ($products->discount)
                                            @php
                                            $index_old=1;
                                            @endphp
                                            @include('products.partial.raw_discount', [
                                                'row_id' => 0,
                                                'discount_product'=>$products,
                                            ])
                                        @endif --}}
                                        @foreach ($discounts as $discount)
                                            @include('product.partial.raw_discount', [
                                                'row_id' => $loop->index + $index_old,
                                                'discount' => $discount,
                                            ])
                                        @endforeach
                                    </tbody>
                                </table>
                                <div class="d-flex justify-content-center">
                                    <button class="btn btn-main px-5 py-1 add_discount_row"
                                        type="button">@lang('lang.add_new')</button>
                                </div>
                                <input type="hidden" name="raw_discount_index" id="raw_discount_index"
                                    value="{{ count($discounts) }}">
                            </div>
                        </div>
                    </div>
                </div>


                <div
                    class="d-flex my-2  @if (app()->isLocale('ar')) justify-content-end @else justify-content-start @endif">
                    <button class="text-decoration-none toggle-button mb-0" type="button" data-bs-toggle="collapse"
                        data-bs-target="#moreInfoCollapse" aria-expanded="false" aria-controls="moreInfoCollapse">
                        <i class="fas fa-arrow-down"></i>
                        @lang('lang.more_info')
                        <span class="section-header-pill"></span>
                    </button>
                </div>
                <div class="collapse" id="moreInfoCollapse">
                    <div class="card mb-3">
                        <div class="card-body p-2">
                            <div
                                class="row @if (app()->isLocale('ar')) flex-row-reverse @else flex-row @endif">
                                @if (session('system_mode') == 'pos' || session('system_mode') == 'garments' || session('system_mode') == 'supermarket')
                                    <div class="col-md-3 px-5">
                                        <div class="form-group">
                                            {!! Form::label('barcode_type', __('lang.barcode_type') . ' *', [
                                                'class' => 'form-label d-block mb-1 app()->isLocale("ar") ? text-end : text-start',
                                            ]) !!}
                                            {!! Form::select(
                                                'barcode_type',
                                                [
                                                    'C128' => 'Code 128',
                                                    'C39' => 'Code 39',
                                                    'UPCA' => 'UPC-A',
                                                    'UPCE' => 'UPC-E',
                                                    'EAN8' => 'EAN-8',
                                                    'EAN13' => 'EAN-13',
                                                ],
                                                $product->barcode_type,
                                                ['class' => 'form-control', 'required'],
                                            ) !!}
                                        </div>
                                    </div>
                                @endif
                                <div class="col-md- 3 px-5">
                                    <div class="form-group">
                                        {!! Form::label('other_cost', __('lang.other_cost'), [
                                            'class' => 'form-label d-block mb-1 app()->isLocale("ar") ? text-end : text-start',
                                        ]) !!}
                                        {!! Form::text('other_cost', @num_format($product->other_cost), [
                                            'class' => 'form-control modal-input app()->isLocale("ar") ? text-end : text-start',
                                            'placeholder' => __('lang.other_cost'),
                                        ]) !!}
                                    </div>
                                </div>
                                @can('product_module.purchase_price.create_and_edit')
                                    <div
                                        class="col-md-3 px-5 supplier_div @if (empty($product->is_service)) hide @endif">
                                        <div class="form-group">
                                            {!! Form::label(
                                                'purchase_price',
                                                session('system_mode') == 'pos' || session('system_mode') == 'garments' || session('system_mode') == 'supermarket'
                                                    ? __('lang.purchase_price')
                                                    : __('lang.cost') . ' *',
                                                [
                                                    'class' => 'form-label d-block mb-1 app()->isLocale("ar") ? text-end : text-start',
                                                ],
                                            ) !!}
                                            {!! Form::text('purchase_price', @num_format($product->purchase_price), [
                                                'class' => 'form-control modal-input app()->isLocale("ar") ? text-end : text-start',
                                                'placeholder' =>
                                                    session('system_mode') == 'pos' ||
                                                    session('system_mode') == 'garments' ||
                                                    session('system_mode') == 'supermarket'
                                                        ? __('lang.purchase_price')
                                                        : __('lang.cost'),
                                                'required',
                                            ]) !!}
                                        </div>
                                    </div>
                                @endcan
                                <div
                                    class="col-md-3 px-5 supplier_div @if (empty($product->is_service)) hide @endif">
                                    <div class="form-group">
                                        {!! Form::label('sell_price', __('lang.sell_price') . ' *', [
                                            'class' => 'form-label d-block mb-1 app()->isLocale("ar") ? text-end : text-start',
                                        ]) !!}
                                        {!! Form::text('sell_price', @num_format($product->sell_price), [
                                            'class' => 'form-control modal-input app()->isLocale("ar") ? text-end : text-start',
                                            'placeholder' => __('lang.sell_price'),
                                            'required',
                                        ]) !!}
                                    </div>
                                </div>
                                <div class="col-md-3 px-5">
                                    {!! Form::label('tax_id', __('lang.tax'), []) !!}
                                    <div class="input-group my-group select-button-group">
                                        {!! Form::select('tax_id', $taxes, $product->tax_id, [
                                            'class' => 'selectpicker form-control',
                                            'data-live-search' => 'true',
                                            'style' => 'width: 80%',
                                            'placeholder' => __('lang.please_select'),
                                        ]) !!}
                                        <span class="input-group-btn">
                                            @can('product_module.tax.create')
                                                <button type="button" class="btn-modal select-button btn-flat"
                                                    data-href="{{ action('TaxController@create') }}?quick_add=1"
                                                    data-container=".view_modal"><i class="fa fa-plus"></i></button>
                                            @endcan
                                        </span>
                                    </div>
                                    <div class="error-msg text-red"></div>
                                </div>
                                <div class="col-md-3 px-5">
                                    <div class="form-group">
                                        {!! Form::label('tax_method', __('lang.tax_method'), [
                                            'class' => 'form-label d-block mb-1 app()->isLocale("ar") ? text-end : text-start',
                                        ]) !!}
                                        {!! Form::select(
                                            'tax_method',
                                            ['inclusive' => __('lang.inclusive'), 'exclusive' => __('lang.exclusive')],
                                            $product->tax_method,
                                            [
                                                'class' => 'selectpicker form-control',
                                                'data-live-search' => 'true',
                                                'style' => 'width: 80%',
                                                'placeholder' => __('lang.please_select'),
                                            ],
                                        ) !!}
                                    </div>
                                </div>

                                <div
                                    class="col-md-4 d-flex @if (app()->isLocale('ar')) justify-content-end @else  justify-content-start @endif">
                                    <div class="i-checks">
                                        <input id="show_to_customer" name="show_to_customer" type="checkbox"
                                            @if ($product->show_to_customer) checked @endif value="1"
                                            class="form-control-custom">
                                        <label for="show_to_customer"><strong>@lang('lang.show_to_customer')</strong></label>
                                    </div>
                                </div>

                                <div class="col-md-3 show_to_customer_type_div">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            {!! Form::label('show_to_customer_types', __('lang.show_to_customer_types'), [
                                                'class' => 'form-label d-block mb-1 app()->isLocale("ar") ? text-end : text-start',
                                            ]) !!}
                                            <i class="dripicons-question" data-toggle="tooltip"
                                                title="@lang('lang.show_to_customer_types_info')"></i>
                                            {!! Form::select('show_to_customer_types[]', $customer_types, $product->show_to_customer_types, [
                                                'class' => 'selectpicker form-control',
                                                'data-live-search' => 'true',
                                                'style' => 'width: 80%',
                                                'multiple',
                                            ]) !!}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="clearfix"></div>

                <div
                    class="d-flex my-2  @if (app()->isLocale('ar')) justify-content-end @else justify-content-start @endif">
                    <button class="text-decoration-none toggle-button mb-0" type="button" data-bs-toggle="collapse"
                        data-bs-target="#pricesFromDifferentStoresCollapse" aria-expanded="false"
                        aria-controls="pricesFromDifferentStoresCollapse">
                        <i class="fas fa-arrow-down"></i>
                        @lang('lang.prices_from_different_stores')
                        <span class="section-header-pill"></span>
                    </button>
                </div>


                <div class="collapse" id="pricesFromDifferentStoresCollapse">
                    <div class="card mb-3">
                        <div class="card-body p-2">
                            <div class="col-md-12">
                                <div class="i-checks">
                                    <input id="different_prices_for_stores" name="different_prices_for_stores"
                                        @if ($product->different_prices_for_stores) checked @endif type="checkbox"
                                        value="1" class="form-control-custom">
                                    <label
                                        for="different_prices_for_stores"><strong>@lang('lang.different_prices_for_stores')</strong></label>
                                </div>
                            </div>

                            <div class="col-md-12 different_prices_for_stores_div">
                                <table class="table mb-1">
                                    <thead>
                                        <tr>
                                            <th class="py-2 text-center px-1">
                                                @lang('lang.store')
                                            </th>
                                            <th class="py-2 text-center px-1">
                                                @lang('lang.price')
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($product->product_stores as $product_store)
                                            @if (!empty($product_store->store))
                                                <tr>
                                                    <td
                                                        class="py-2 px-1 d-flex justify-content-center align-items-center">
                                                        {{ $product_store->store->name }}</td>
                                                    <td class="py-2 px-1 text-center"><input type="text"
                                                            class="form-control modal-input m-auto @if (app()->isLocale('ar')) text-end @else  text-start @endif store_prices"
                                                            style="width: 25% !important"
                                                            name="product_stores[{{ $product_store->store_id }}][price]"
                                                            value="{{ $product_store->price }}"></td>
                                                </tr>
                                            @endif
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>


                <div
                    class="d-flex my-2  @if (app()->isLocale('ar')) justify-content-end @else justify-content-start @endif">
                    <button class="text-decoration-none toggle-button mb-0" type="button" data-bs-toggle="collapse"
                        data-bs-target="#varientCollapse" aria-expanded="false" aria-controls="varientCollapse">
                        <i class="fas fa-arrow-down"></i>
                        @lang('lang.has_varient')
                        <span class="section-header-pill"></span>
                    </button>
                </div>


                <div class="collapse" id="varientCollapse">
                    <div class="card mb-3">
                        <div class="card-body p-2">
                            <div class="col-md-12">
                                <div class="i-checks">
                                    <input id="this_product_have_variant" name="this_product_have_variant"
                                        type="checkbox" @if ($product->type == 'variable') checked @endif
                                        value="1" class="form-control-custom">
                                    <label for="this_product_have_variant"><strong>@lang('lang.this_product_have_variant')</strong></label>
                                </div>
                            </div>

                            <div class="col-md-12 this_product_have_variant_div" style="overflow: auto">
                                <table class="table mb-1" id="variation_table">
                                    <thead>
                                        <tr>
                                            <th class="py-2 text-center px-1">@lang('lang.name')</th>
                                            <th class="py-2 text-center px-1">@lang('lang.sku')</th>
                                            <th class="py-2 text-center px-1">@lang('lang.color')</th>
                                            <th class="py-2 text-center px-1">@lang('lang.size')</th>
                                            <th class="py-2 text-center px-1">@lang('lang.grade')</th>
                                            <th class="py-2 text-center px-1">@lang('lang.unit')</th>
                                            <th class="py-2 text-center px-1">@lang('lang.number_vs_base_unit')</th>
                                            {{-- @if (empty($products->is_service)) hide @endif --}}
                                            <th class="supplier_div @if (empty($is_service)) hide @endif">
                                                @lang('lang.purchase_price')</th>
                                            <th class="supplier_div @if (empty($is_service)) hide @endif">
                                                @lang('lang.sell_price')</th>
                                            <th class="py-2 text-center px-1"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($product->variations as $item)
                                            @include('product.partial.edit_variation_row', [
                                                'row_id' => $loop->index,
                                                'item' => $item,
                                                'is_service' => $product->is_service,
                                            ])
                                        @endforeach
                                    </tbody>
                                </table>
                                <div class="d-flex justify-content-center">
                                    <button type="button"
                                        class="btn btn-main px-5 py-1  add_row ">@lang('lang.add_new')</button>
                                </div>
                            </div>
                            <input type="hidden" name="row_id" id="row_id"
                                value="{{ $product->variations->count() }}">
                        </div>
                    </div>
                </div>
                <div id="cropped_edit_product_images"></div>
                <div class="row my-2 justify-content-center align-items-center">
                    <div class="col-md-4">
                        <div class="form-group">
                            <input type="button" id="submit-btn" value="{{ trans('lang.save') }}"
                                class="btn btn-primary py-1">
                        </div>
                    </div>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>

</section>

<div class="modal fade" id="editProductModal" tabindex="-1" role="dialog" aria-labelledby="editProductModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editProductModalLabel">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="croppie-edit-product-modal" style="display:none">
                    <div id="croppie-edit-product-container"></div>
                    <button data-dismiss="modal" id="croppie-edit-product-cancel-btn" type="button"
                        class="btn btn-secondary"><i class="fas fa-times"></i></button>
                    <button id="croppie-edit-product-submit-btn" type="button" class="btn btn-primary"><i
                            class="fas fa-crop"></i></button>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection

@section('javascript')
<script src="{{ asset('js/product_edit.js') }}"></script>
<script src="{{ asset('front/js/bootstrap.min.js') }}"></script>

<script>
    // Add an event listener for the 'show.bs.collapse' and 'hide.bs.collapse' events
    $('#productDetailsCollapse').on('show.bs.collapse', function() {
        // Change the arrow icon to 'chevron-up' when the content is expanded
        $('button[data-bs-target="#productDetailsCollapse"] i').removeClass('fa-arrow-down').addClass(
            'fa-arrow-up');
    });

    $('#productDetailsCollapse').on('hide.bs.collapse', function() {
        // Change the arrow icon to 'chevron-down' when the content is collapsed
        $('button[data-bs-target="#productDetailsCollapse"] i').removeClass('fa-arrow-up').addClass(
            'fa-arrow-down');
    });

    // Add an event listener for the 'show.bs.collapse' and 'hide.bs.collapse' events
    $('#productOtherDetailsCollapse').on('show.bs.collapse', function() {
        // Change the arrow icon to 'chevron-up' when the content is expanded
        $('button[data-bs-target="#productOtherDetailsCollapse"] i').removeClass('fa-arrow-down').addClass(
            'fa-arrow-up');
    });

    $('#productOtherDetailsCollapse').on('hide.bs.collapse', function() {
        // Change the arrow icon to 'chevron-down' when the content is collapsed
        $('button[data-bs-target="#productOtherDetailsCollapse"] i').removeClass('fa-arrow-up').addClass(
            'fa-arrow-down');
    });

    // Add an event listener for the 'show.bs.collapse' and 'hide.bs.collapse' events
    $('#addPrimaryMaterialCollapse').on('show.bs.collapse', function() {
        // Change the arrow icon to 'chevron-up' when the content is expanded
        $('button[data-bs-target="#addPrimaryMaterialCollapse"] i').removeClass('fa-arrow-down').addClass(
            'fa-arrow-up');
    });

    $('#addPrimaryMaterialCollapse').on('hide.bs.collapse', function() {
        // Change the arrow icon to 'chevron-down' when the content is collapsed
        $('button[data-bs-target="#addPrimaryMaterialCollapse"] i').removeClass('fa-arrow-up').addClass(
            'fa-arrow-down');
    });

    // Add an event listener for the 'show.bs.collapse' and 'hide.bs.collapse' events
    $('#discountInfoCollapse').on('show.bs.collapse', function() {
        // Change the arrow icon to 'chevron-up' when the content is expanded
        $('button[data-bs-target="#discountInfoCollapse"] i').removeClass('fa-arrow-down').addClass(
            'fa-arrow-up');
    });

    $('#discountInfoCollapse').on('hide.bs.collapse', function() {
        // Change the arrow icon to 'chevron-down' when the content is collapsed
        $('button[data-bs-target="#discountInfoCollapse"] i').removeClass('fa-arrow-up').addClass(
            'fa-arrow-down');
    });

    // Add an event listener for the 'show.bs.collapse' and 'hide.bs.collapse' events
    $('#moreInfoCollapse').on('show.bs.collapse', function() {
        // Change the arrow icon to 'chevron-up' when the content is expanded
        $('button[data-bs-target="#moreInfoCollapse"] i').removeClass('fa-arrow-down').addClass(
            'fa-arrow-up');
    });

    $('#moreInfoCollapse').on('hide.bs.collapse', function() {
        // Change the arrow icon to 'chevron-down' when the content is collapsed
        $('button[data-bs-target="#moreInfoCollapse"] i').removeClass('fa-arrow-up').addClass(
            'fa-arrow-down');
    });

    // Add an event listener for the 'show.bs.collapse' and 'hide.bs.collapse' events
    $('#pricesFromDifferentStoresCollapse').on('show.bs.collapse', function() {
        // Change the arrow icon to 'chevron-up' when the content is expanded
        $('button[data-bs-target="#pricesFromDifferentStoresCollapse"] i').removeClass('fa-arrow-down')
            .addClass(
                'fa-arrow-up');
    });

    $('#pricesFromDifferentStoresCollapse').on('hide.bs.collapse', function() {
        // Change the arrow icon to 'chevron-down' when the content is collapsed
        $('button[data-bs-target="#pricesFromDifferentStoresCollapse"] i').removeClass('fa-arrow-up').addClass(
            'fa-arrow-down');
    });

    // Add an event listener for the 'show.bs.collapse' and 'hide.bs.collapse' events
    $('#varientCollapse').on('show.bs.collapse', function() {
        // Change the arrow icon to 'chevron-up' when the content is expanded
        $('button[data-bs-target="#varientCollapse"] i').removeClass('fa-arrow-down')
            .addClass(
                'fa-arrow-up');
    });

    $('#varientCollapse').on('hide.bs.collapse', function() {
        // Change the arrow icon to 'chevron-down' when the content is collapsed
        $('button[data-bs-target="#varientCollapse"] i').removeClass('fa-arrow-up').addClass(
            'fa-arrow-down');
    });
</script>
<script type="text/javascript">
    $(document).ready(function() {
        $('#store_ids').selectpicker('selectAll');

        $('#different_prices_for_stores').change();
        $('#this_product_have_variant').change();
    })
</script>
<script>
    $("#submit-btn").on("click", function(e) {
        getEditProductImages()
        e.preventDefault();
        setTimeout(() => {
            if ($("#products-edit-form").valid()) {
                tinyMCE.triggerSave();
                $.ajax({
                    type: "POST",
                    url: $("#products-edit-form").attr("action"),
                    data: $("#products-edit-form").serialize(),
                    success: function(response) {
                        if (response.success) {
                            swal("Success", response.msg, "success");
                            setTimeout(() => {
                                window.close()
                            }, 1000);
                        }
                    },
                    error: function(response) {
                        if (!response.success) {
                            swal("Error", response.msg, "error");
                        }
                    },
                });
            }
        });
    });
    @if ($product)
        {{-- document.getElementById("cropBtn{{ $products->id }}").addEventListener('click', () => { --}}
        {{--    setTimeout(() => { --}}
        {{--        launchEditProductCropTool(document.getElementById("img{{ $products->id }}")); --}}
        {{--    }, 500); --}}
        {{-- }); --}}
        document.getElementById("deleteBtn{{ $product->id }}").addEventListener('click', () => {
            Swal.fire({
                title: '{{ __('site.Are you sure?') }}',
                text: "{{ __("site.You won't be able to delete!") }}",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire(
                        'Deleted!',
                        '{{ __('site.Your Image has been deleted.') }}',
                        'success'
                    )
                    $("#preview{{ $product->id }}").remove();
                }
            });
        });
    @endif
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.5/croppie.min.js"></script>
<script>
    var fileEditProductInput = document.querySelector('#file-products-edit-products');
    var previewEditProductContainer = document.querySelector('.preview-edit-products-container');
    var croppieEditProductModal = document.querySelector('#croppie-edit-products-modal');
    var croppieEditProductContainer = document.querySelector('#croppie-edit-products-container');
    var croppieEditProductCancelBtn = document.querySelector('#croppie-edit-products-cancel-btn');
    var croppieEditProductSubmitBtn = document.querySelector('#croppie-edit-products-submit-btn');

    // let currentFiles = [];
    fileEditProductInput.addEventListener('change', () => {
        // let files = fileEditProductInput.files;
        previewEditProductContainer.innerHTML = '';
        let files = Array.from(fileEditProductInput.files)
        // files.concat(currentFiles)
        // currentFiles.push(...files)
        // currentFiles && (files = currentFiles)
        for (let i = 0; i < files.length; i++) {
            const file = files[i];
            if (file.type.match('image.*')) {
                const reader = new FileReader();
                reader.addEventListener('load', () => {
                    const preview = document.createElement('div');
                    preview.classList.add('preview');
                    const img = document.createElement('img');
                    img.src = reader.result;
                    preview.appendChild(img);
                    const container = document.createElement('div');
                    const deleteBtn = document.createElement('span');
                    deleteBtn.classList.add('delete-btn');
                    deleteBtn.innerHTML = '<i style="font-size: 20px;" class="fas fa-trash"></i>';
                    deleteBtn.addEventListener('click', () => {
                        swal({
                            title: "Delete",
                            text: "Are you sure you want to delete this image ?",
                            icon: "warning",
                            buttons: true,
                            dangerMode: true,
                            buttons: ["Cancel", "Delete"],
                        }).then((addPO) => {
                            if (addPO) {
                                files.splice(file, 1)
                                preview.remove();
                                getEditProductImages()
                            }
                        });
                    });

                    preview.appendChild(deleteBtn);
                    const cropBtn = document.createElement('span');
                    cropBtn.setAttribute("data-toggle", "modal")
                    cropBtn.setAttribute("data-target", "#editProductModal")
                    cropBtn.classList.add('crop-btn');
                    cropBtn.innerHTML = '<i style="font-size: 20px;" class="fas fa-crop"></i>';
                    cropBtn.addEventListener('click', () => {
                        setTimeout(() => {
                            launchEditProductCropTool(img);
                        }, 500);
                    });
                    preview.appendChild(cropBtn);
                    previewEditProductContainer.appendChild(preview);
                });
                reader.readAsDataURL(file);
            } else {
                Swal.fire({
                    icon: 'error',
                    title: '{{ __('site.Oops...') }}',
                    text: '{{ __('site.Sorry , You Should Upload Valid Image') }}',
                })
            }
        }

        getEditProductImages()
    });

    function launchEditProductCropTool(img) {
        getEditProductImages();
        // Set up Croppie options
        const croppieOptions = {
            viewport: {
                width: 200,
                height: 200,
                type: 'square' // or 'square'
            },
            boundary: {
                width: 300,
                height: 300,
            },
            enableOrientation: true
        };

        // Create a new Croppie instance with the selected image and options
        const croppie = new Croppie(croppieEditProductContainer, croppieOptions);
        croppie.bind({
            url: img.src,
            orientation: 1,
        });

        // Show the Croppie modal
        croppieEditProductModal.style.display = 'block';

        // When the user clicks the "Cancel" button, hide the modal
        croppieEditProductCancelBtn.addEventListener('click', () => {
            croppieEditProductModal.style.display = 'none';
            $('#editProductModal').modal('hide');
            croppie.destroy();
        });

        // When the user clicks the "Crop" button, get the cropped image and replace the original image in the preview
        croppieEditProductSubmitBtn.addEventListener('click', () => {
            croppie.result({
                type: 'canvas',
                size: {
                    width: 800,
                    height: 600
                },
                quality: 1 // Set quality to 1 for maximum quality
            }).then((croppedImg) => {
                img.src = croppedImg;
                croppieEditProductModal.style.display = 'none';
                $('#editProductModal').modal('hide');
                croppie.destroy();
                getEditProductImages()
            });
        });
    }

    function getEditProductImages() {
        setTimeout(() => {
            const container = document.querySelectorAll('.preview-edit-products-container');
            let images = [];
            $("#cropped_edit_product_images").empty();
            for (let i = 0; i < container[0].children.length; i++) {
                var newInput = $("<input>").attr("type", "hidden").attr("name", "cropImages[]").val(container[0]
                    .children[i].children[0].src);
                $("#cropped_edit_product_images").append(newInput);
                images.push(container[0].children[i].children[0].src)
            }
            console.log(images)
            return images
        }, 300);
    }
</script>


@endsection
