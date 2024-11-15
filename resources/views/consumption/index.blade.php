@extends('layouts.app')
@section('title', __('lang.list_view_the_consumption_of_raw_material'))
@section('style')
    <link rel="stylesheet" type="text/css" href="{{ url('front/css/main.css') }}">
@endsection
@section('content')
    <section class="forms py-0">
        <div class="container-fluid">

            @can('product_module.consumption.create_and_edit')
                <div class="card my-3">
                    <div class="card-body d-flex justify-content-center p-2">
                        <a style="color: white" href="{{ action('ConsumptionController@create') }}"
                            class="btn col-md-4 btn-main"><i class="dripicons-plus"></i>
                            @lang('lang.add_manual_consumption')</a>
                    </div>
                </div>
            @endcan

            <div
                class="print-title   d-flex align-items-center my-2 @if (app()->isLocale('ar')) justify-content-end @else justify-content-start @endif">
                <h5 class="mb-0 position-relative print-title" style="margin-right: 30px">@lang('lang.list_view_the_consumption_of_raw_material')
                    <span class="header-pill"></span>
                </h5>
            </div>

            <div class="card my-3">
                <div class="card-body p-2">

                    <div class="row @if (app()->isLocale('ar')) flex-row-reverse @else flex-row @endif">
                        <div class="col-md-3 px-5">
                            <div class="form-group">
                                {!! Form::label('start_date', __('lang.start_date'), [
                                    'class' => 'form-label d-block mb-1 app()->isLocale("ar") ? text-end : text-start',
                                ]) !!}
                                {!! Form::text('start_date', request()->start_date, [
                                    'class' => 'form-control  modal-input app()->isLocale("ar") ? text-end : text-start filter',
                                ]) !!}
                            </div>
                        </div>
                        <div class="col-md-3 px-5">
                            <div class="form-group">
                                {!! Form::label('start_time', __('lang.start_time'), [
                                    'class' => 'form-label d-block mb-1 app()->isLocale("ar") ? text-end : text-start',
                                ]) !!}
                                {!! Form::text('start_time', null, [
                                    'class' => 'form-control  modal-input app()->isLocale("ar") ? text-end : text-start time_picker filter',
                                ]) !!}
                            </div>
                        </div>
                        <div class="col-md-3 px-5">
                            <div class="form-group">
                                {!! Form::label('end_date', __('lang.end_date'), [
                                    'class' => 'form-label d-block mb-1 app()->isLocale("ar") ? text-end : text-start',
                                ]) !!}
                                {!! Form::text('end_date', request()->end_date, [
                                    'class' => 'form-control  modal-input app()->isLocale("ar") ? text-end : text-start filter',
                                ]) !!}
                            </div>
                        </div>
                        <div class="col-md-3 px-5">
                            <div class="form-group">
                                {!! Form::label('end_time', __('lang.end_time'), [
                                    'class' => 'form-label d-block mb-1 app()->isLocale("ar") ? text-end : text-start',
                                ]) !!}
                                {!! Form::text('end_time', null, [
                                    'class' => 'form-control  modal-input app()->isLocale("ar") ? text-end : text-start time_picker filter',
                                ]) !!}
                            </div>
                        </div>
                        <div class="col-md-3 px-5">
                            <div class="form-group">
                                {!! Form::label(
                                    'raw_material_id',
                                    __('lang.raw_material') .
                                        ':
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            (' .
                                        __('lang.that_raw_materials_are_used_for') .
                                        ')',
                                    [
                                        'class' => 'form-label d-block mb-1 app()->isLocale("ar") ? text-end : text-start',
                                    ],
                                ) !!}
                                {!! Form::select('raw_material_id', $raw_materials, request()->raw_material_id, [
                                    'class' => 'form-control filter
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            selectpicker',
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
                                    'class' => 'form-control
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            filter
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            selectpicker',
                                    'data-live-search' => 'true',
                                    'placeholder' => __('lang.all'),
                                ]) !!}
                            </div>
                        </div>
                        <div class="col-md-3 px-5">
                            <div class="form-group">
                                {!! Form::label('variation_id', __('lang.products'), [
                                    'class' => 'form-label d-block mb-1 app()->isLocale("ar") ? text-end : text-start',
                                ]) !!}
                                {!! Form::select('variation_id', $products, request()->variation_id, [
                                    'class' => 'form-control filter
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            selectpicker',
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
                            <div class="form-group">
                                {!! Form::label('created_by', __('lang.chef'), [
                                    'class' => 'form-label d-block mb-1 app()->isLocale("ar") ? text-end : text-start',
                                ]) !!}
                                {!! Form::select('created_by', $users, request()->created_by, [
                                    'class' => 'form-control filter
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            selectpicker',
                                    'data-live-search' => 'true',
                                    'placeholder' => __('lang.all'),
                                ]) !!}
                            </div>
                        </div>
                        <div class="col-md-3 px-5">
                            <button class="btn btn-danger mt-4 clear_filters">@lang('lang.clear_filters')</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card my-3">
                <div class="card-body p-2">
                    <div class="table-responsive">
                        <table id="raw_material_table" class="table" style="width: 100%">
                            <thead>
                                <tr>
                                    <th>@lang('lang.raw_material')</th>
                                    <th>@lang('lang.current_stock')</th>
                                    <th>@lang('lang.value_of_current_stock')</th>
                                    <th>@lang('lang.products_')</th>
                                    <th>@lang('lang.chef')</th>
                                    <th>@lang('lang.remaining_qty_sufficient_for')</th>

                                    <th class="notexport">@lang('lang.action')</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                            <tfoot>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>


    </section>
@endsection

@section('javascript')
    <script>
        $(document).ready(function() {
            raw_material_table = $('#raw_material_table').DataTable({
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
                    "url": "/consumption",
                    "data": function(d) {
                        d.raw_material_id = $('#raw_material_id').val();
                        d.variation_id = $('#variation_id').val();
                        d.brand_id = $('#brand_id').val();
                        d.store_id = $('#store_id').val();
                        d.created_by = $('#created_by').val();
                        d.start_date = $("#start_date").val();
                        d.start_time = $("#start_time").val();
                        d.end_date = $("#end_date").val();
                        d.end_time = $("#end_time").val();
                    }
                },
                columnDefs: [{
                    "targets": [5],
                    "orderable": false,
                    "searchable": false
                }],
                columns: [{
                        data: 'raw_material_name',
                        name: 'raw_material.name'
                    },
                    {
                        data: 'product_current_stock',
                        name: 'product_current_stock',
                        searchable: false
                    },
                    {
                        data: 'value_of_current_stock',
                        name: 'value_of_current_stock',
                        searchable: false
                    },
                    {
                        data: 'products_',
                        name: 'products.name'
                    },
                    {
                        data: 'chef',
                        name: 'users.name'
                    },
                    {
                        data: 'remaining_qty_sufficient_for',
                        name: 'remaining_qty_sufficient_for'
                    },
                    {
                        data: 'action',
                        name: 'action'
                    },

                ],
                createdRow: function(row, data, dataIndex) {

                },
                fnDrawCallback: function(oSettings) {
                    __currency_convert_recursively($('#raw_material_table'));
                },
            });

            $(document).on('change', '.filter', function() {
                raw_material_table.ajax.reload();
            })
            $(document).on('click', '.clear_filters', function() {
                $('.filter').val('');
                $('.filter').selectpicker('refresh')
                raw_material_table.ajax.reload();
            })
            $('.time_picker').focusout(function(event) {
                raw_material_table.ajax.reload();
            });
        });
    </script>
@endsection
