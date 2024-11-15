@extends('layouts.app')
@section('title', __('lang.sales_promotion_formal_discount'))
@section('style')
    <link rel="stylesheet" type="text/css" href="{{ url('front/css/pos-modals.css') }}">

    <link rel="stylesheet" type="text/css" href="{{ url('front/css/main.css') }}">
@endsection
@section('content')
    <section class="forms py-0">

        <div class="container-fluid">
            <div
                class="  d-flex align-items-center my-2 @if (app()->isLocale('ar')) justify-content-end @else justify-content-start @endif">
                <h5 class="mb-0 position-relative print-title" style="margin-right: 30px">@lang('lang.sales_promotion_formal_discount')
                    <span class="header-pill"></span>
                </h5>
            </div>
            <div class="card my-3">
                <div class="card-body p-2 d-flex justify-content-center align-items-center">
                    <a style="color: white" href="{{ action('SalesPromotionController@create') }}"
                        class="btn btn-main col-md-3"><i class="dripicons-plus"></i>
                        @lang('lang.sales_promotion_formal_discount')</a>
                </div>
            </div>
            <div class="card my-3">
                <div class="card-body p-2">
                    <div class="table-responsive">
                        <table id="store_table" class="table dataTable">
                            <thead>
                                <tr>
                                    <th>@lang('lang.name')</th>
                                    <th>@lang('lang.type')</th>
                                    <th>@lang('lang.stores')</th>
                                    <th>@lang('lang.discount_type')</th>
                                    <th class="sum">@lang('lang.discount_value')</th>
                                    <th>@lang('lang.start_date')</th>
                                    <th>@lang('lang.expiry_date')</th>
                                    <th>@lang('lang.purchase_condition')</th>
                                    <th>@lang('lang.products_')</th>
                                    <th>@lang('lang.product_condition')</th>
                                    <th>@lang('lang.created_by')</th>
                                    <th>@lang('lang.date_and_time')</th>
                                    <th>@lang('lang.barcode')</th>
                                    <th class="notexport">@lang('lang.action')</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($sales_promotions as $sales_promotion)
                                    <tr>
                                        <td>{{ $sales_promotion->name }}</td>
                                        <td>
                                            @if ($sales_promotion->type == 'item_discount')
                                                @lang('lang.item_discount')
                                            @elseif($sales_promotion->type == 'package_promotion')
                                                @lang('lang.package_promotion')
                                            @endif
                                        </td>
                                        <td>{{ implode(', ', $sales_promotion->stores->pluck('name')->toArray()) }}</td>
                                        <td>{{ ucfirst($sales_promotion->discount_type) }}</td>
                                        <td>{{ @num_format($sales_promotion->discount_value) }}</td>
                                        <td>
                                            @if (!empty($sales_promotion->start_date))
                                                {{ @format_date($sales_promotion->start_date) }}
                                            @endif
                                        </td>
                                        <td>
                                            @if (!empty($sales_promotion->end_date))
                                                {{ @format_date($sales_promotion->end_date) }}
                                            @endif
                                        </td>
                                        <td>
                                            @if ($sales_promotion->purchase_condition)
                                                {{ @num_format($sales_promotion->purchase_condition_amount) }}
                                            @endif
                                        </td>
                                        <td>
                                            @foreach ($sales_promotion->variations as $k => $variation)
                                                @if ($k != 0)
                                                    ,
                                                @endif
                                                @if ($variation->name != 'Default')
                                                    {{ $variation->name }}
                                                @else
                                                    {{ $variation->product->name }}
                                                @endif
                                            @endforeach
                                        </td>
                                        <td>
                                            @foreach ($sales_promotion->condition_variations as $condition_k => $condition_variation)
                                                @if ($condition_k != 0)
                                                    ,
                                                @endif
                                                @if ($condition_variation->name != 'Default')
                                                    {{ $condition_variation->name }}
                                                @else
                                                    {{ $condition_variation->product->name }}
                                                @endif
                                            @endforeach
                                        </td>
                                        <td>{{ ucfirst($sales_promotion->created_by_user->name ?? '') }}</td>
                                        <td>{{ $sales_promotion->created_at }}</td>
                                        <td>
                                            @if (!empty($sales_promotion->generate_barcode))
                                                <img style="margin-top:10px;"
                                                    src="data:image/png;base64,{{ DNS1D::getBarcodePNG($sales_promotion->code, 'C128') }}"
                                                    width="180" alt="barcode" />
                                                <p style="text-align: center">{{ $sales_promotion->code }}</p>
                                            @endif
                                        </td>
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
                                                    @can('sp_module.sales_promotion.delete')
                                                        <li>

                                                            <a data-href="{{ action('SalesPromotionController@show', $sales_promotion->id) }}"
                                                                data-container=".view_modal" class="btn btn-modal"><i
                                                                    class="dripicons-document"></i> @lang('lang.view')</a>
                                                        </li>
                                                        <li class="divider"></li>
                                                    @endcan
                                                    @can('sp_module.sales_promotion.view')
                                                        <li>
                                                            <a
                                                                href="{{ action('SalesPromotionController@edit', $sales_promotion->id) }}"><i
                                                                    class="dripicons-document-edit btn"></i>@lang('lang.edit')</a>
                                                        </li>
                                                        <li class="divider"></li>
                                                    @endcan
                                                    @can('sp_module.sales_promotion.delete')
                                                        <li>
                                                            <a data-href="{{ action('SalesPromotionController@destroy', $sales_promotion->id) }}"
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
                            <tfoot>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <th style="text-align: right">@lang('lang.total')</th>
                                    <td></td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('javascript')
    <script></script>
@endsection
