@extends('layouts.app')
@section('title', __('lang.manufacturers'))
@section('style')
    <link rel="stylesheet" type="text/css" href="{{ url('front/css/main.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ url('front/css/pos-modals.css') }}">
@endsection
@section('content')
    <section class="forms py-0">

        <div class="container-fluid">

            <div class=" no-print">
                <div
                    class="print-title d-flex align-items-center my-2 @if (app()->isLocale('ar')) justify-content-end @else justify-content-start @endif">
                    <h5 class="mb-0 position-relative" style="margin-right: 30px">
                        @lang('lang.manufacturers_list')
                        <span class="header-pill"></span>
                    </h5>
                </div>


                <div class="card my-3">
                    <div class="card-body p-2">
                        <div class="row justify-content-center">
                            <div class="col-md-3">
                                {{--                    TODO add permissions --}}
                                {{--                @can('product_module.product_class.create_and_edit') --}}
                                <a style="color: white" data-href="{{ action('ManufacturerController@create') }}"
                                    data-container=".view_modal" class="btn btn-primary w-100 py-1 btn-modal"><i
                                        class="dripicons-plus"></i>
                                    @lang('lang.add_manufacturer')</a>
                                {{--                @endcan --}}
                            </div>

                        </div>
                    </div>
                </div>
                <div class="card my-3">
                    <div class="card-body p-2">
                        <div class="table-responsive">
                            <table id="category_table" class="table dataTable">
                                <thead>
                                    <tr>
                                        <th style="width: 60%">@lang('lang.name')</th>
                                        <th class="notexport">@lang('lang.action')</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($manufacturers as $manufacturer)
                                        <tr>
                                            <td class="text-center">{{ $manufacturer->name }}</td>
                                            <td>
                                                <div class="btn-group">
                                                    <button type="button" class="btn btn-default btn-sm dropdown-toggle"
                                                        data-toggle="dropdown" aria-haspopup="true"
                                                        aria-expanded="false">@lang('lang.action')
                                                        <span class="caret"></span>
                                                        <span class="sr-only">Toggle Dropdown</span>
                                                    </button>
                                                    <ul class="dropdown-menu edit-options dropdown-menu-right dropdown-default"
                                                        user="menu">
                                                        {{--                                            @can('product_module.category.create_and_edit') --}}
                                                        <li>

                                                            <a data-href="{{ action('ManufacturerController@edit', $manufacturer->id) }}"
                                                                data-container=".view_modal" class="btn btn-modal"><i
                                                                    class="dripicons-document-edit"></i>
                                                                @lang('lang.edit')</a>
                                                        </li>
                                                        <li class="divider"></li>
                                                        {{--                                            @endcan --}}
                                                        {{--                                            @can('product_module.category.delete') --}}
                                                        <li>
                                                            <a data-href="{{ action('ManufacturerController@destroy', $manufacturer->id) }}"
                                                                data-check_password="{{ action('AdminController@checkPassword', Auth::user()->id) }}"
                                                                class="btn text-red delete_item"><i class="fa fa-trash"></i>
                                                                @lang('lang.delete')</a>
                                                        </li>
                                                        {{--                                            @endcan --}}
                                                    </ul>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
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
