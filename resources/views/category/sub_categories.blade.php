@extends('layouts.app')
@section('title', __('lang.sub_category'))
@section('style')
    <link rel="stylesheet" type="text/css" href="{{ url('front/css/pos-modals.css') }}">

    <link rel="stylesheet" type="text/css" href="{{ url('front/css/main.css') }}">
@endsection
@section('content')
    <section class="forms py-0">
        <div class="container-fluid">

            <div class="col-md-12 px-1 no-print">
                <div
                    class="d-flex align-items-center my-2 @if (app()->isLocale('ar')) justify-content-end @else justify-content-start @endif">
                    <h5 class="mb-0 position-relative print-title" style="margin-right: 30px">
                        @lang('lang.sub_categories')
                        <span class="header-pill"></span>
                    </h5>
                </div>
                @can('product_module.product_class.create_and_edit')
                    <div class="card mb-2">
                        <div class="card-body d-flex justify-content-center p-2">
                            <a style="color: white" data-href="{{ action('CategoryController@create') }}?type=sub_category"
                                data-container=".view_modal" class="btn btn-modal btn-main col-md-3"><i
                                    class="dripicons-plus"></i>
                                @lang('lang.add_sub_category')</a>
                        </div>
                    </div>
                @endcan
                <div class="card mb-2">
                    <div class="card-body p-2">
                        <div class="table-responsive">
                            <table id="category_table" class="table dataTable">
                                <thead>
                                    <tr>
                                        <th>@lang('lang.image')</th>
                                        <th>@lang('lang.name')</th>
                                        <th>@lang('lang.path')</th>
                                        <th class="notexport">@lang('lang.action')</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($categories as $category)
                                        <tr>
                                            <td><img src="@if (!empty($category->getFirstMediaUrl('category'))) {{ $category->getFirstMediaUrl('category') }}@else{{ asset('images/default.jpg') }} @endif"
                                                    alt="photo" width="50" height="50"></td>
                                            <td>{{ $category->name }}</td>
                                            <td> <a
                                                    href='/product-class'>{{ $category->mainCategory->productClass->name ?? null }}</a>
                                                / <a href='/category'>{{ $category->mainCategory->name }} </a> /
                                                {{ $category->name }} </td>
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
                                                        @can('product_module.category.delete')
                                                            <li>

                                                                <a data-href="{{ action('CategoryController@edit', $category->id) }}?type=sub_category"
                                                                    data-container=".view_modal" class="btn btn-modal"><i
                                                                        class="dripicons-document-edit"></i>
                                                                    @lang('lang.edit')</a>
                                                            </li>
                                                            <li class="divider"></li>
                                                        @endcan
                                                        @can('product_module.category.delete')
                                                            <li>
                                                                <a data-href="{{ action('CategoryController@destroy', $category->id) }}"
                                                                    data-check_password="{{ action('AdminController@checkPassword', Auth::user()->id) }}"
                                                                    class="btn text-red delete_item"><i class="fa fa-trash"></i>
                                                                    @lang('lang.delete')</a>
                                                            </li>
                                                        @endcan
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
