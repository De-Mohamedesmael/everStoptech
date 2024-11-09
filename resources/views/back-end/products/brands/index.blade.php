@extends('back-end.layouts.app')
@section('title', __('lang.brands'))

@section('breadcrumbs')
    @parent
    <li class="breadcrumb-item @if (app()->isLocale('ar')) mr-2 @else ml-2 @endif active"><a
            style="text-decoration: none;color: #1565c0" href="{{ action('ProductController@index') }}">/
            @lang('lang.products')</a>
    </li>
    <li class="breadcrumb-item  @if (app()->isLocale('ar')) mr-2 @else ml-2 @endif active" aria-current="page">
        @lang('lang.brands')</li>
@endsection

@section('button')

    @can('product_module.brand.create_and_edit')
        <div class="widgetbar d-flex @if (app()->isLocale('ar')) justify-content-start @else justify-content-end @endif">
            <a style="color: white"
               data-href="{{ action('BrandController@create') }}"
               data-container=".view_modal" class="btn btn-modal btn-main"><i
                    class="dripicons-plus"></i>
                {{translate('add_brand')}}
            </a>
        </div>
    @endcan
@endsection
@section('content')
    <section class="forms py-0">

        <div class="container-fluid">

            <div class="col-md-12 px-1 no-print">
                <div class="card mb-2 mt-2">
                    <div class="card-body p-2">
                        <div class="table-responsive">
                            <table id="store_table" class="table dataTable">
                                <thead>
                                    <tr>
                                        <th>@lang('lang.image')</th>
                                        <th>@lang('lang.name')</th>
                                        <th class="notexport">@lang('lang.action')</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($brands as $brand)
                                        <tr>
                                            <td><img src="@if (!empty($brand->getFirstMediaUrl('brand'))) {{ $brand->getFirstMediaUrl('brand') }}@else{{ asset('/uploads/' . session('logo')) }} @endif"
                                                    alt="photo" width="50" height="50">
                                            </td>
                                            <td>{{ $brand->name }}</td>

                                            <td>
                                                @can('product_module.brand.create_and_edit')

                                                    <a data-href="{{ action('BrandController@edit', $brand->id) }}"
                                                       data-container=".view_modal"
                                                       class="btn btn-primary btn-modal text-white edit_job">
                                                        <i class="fa fa-pencil-square-o"></i>
                                                    </a>
                                                @endcan
                                                @can('product_module.brand.delete')
                                                    <a
                                                        data-href="{{ action('BrandController@destroy', $brand->id) }}"
                                                        class="btn btn-danger text-white delete_item">
                                                        <i class="fa fa-trash"></i>
                                                    </a>
                                                @endcan
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
    <script></script>
@endsection
