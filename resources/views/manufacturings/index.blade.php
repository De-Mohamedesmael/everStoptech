@extends('layouts.app')
@section('title', __('lang.productions'))
@section('style')
    <link rel="stylesheet" type="text/css" href="{{ url('front/css/main.css') }}">
@endsection
@section('content')
    <section class="forms py-0">
        <div class="container-fluid">
            @if ($_SERVER['QUERY_STRING'] == 'manufacture')
                <div
                    class="print-title d-flex align-items-center my-2 @if (app()->isLocale('ar')) justify-content-end @else justify-content-start @endif">
                    <h5 class="mb-0 position-relative" style="margin-right: 30px">@lang('lang.products_under_manufacturing')
                        <span class="header-pill"></span>
                    </h5>
                </div>
            @else
                <div
                    class="print-title d-flex align-items-center my-2 @if (app()->isLocale('ar')) justify-content-end @else justify-content-start @endif">
                    <h5 class="mb-0 position-relative" style="margin-right: 30px">@lang('lang.products_manufactured')
                        <span class="header-pill"></span>
                    </h5>
                </div>
            @endif
            @can('raw_material_module.production.create_and_edit')
                <div class="card my-3">
                    <div class="card-body p-2">
                        <div class=" no-print">
                            <div class="row justify-content-center">
                                <div class="col-md-3">

                                    <a style="color: white" href="{{ action('ManufacturingController@create') }}"
                                        class="btn btn-primary w-100 py-1"><i class="dripicons-plus"></i>
                                        @lang('lang.add_new_production')</a>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            @endcan




            <div class="card my-3">
                <div class="card-body p-2">

                    <div class="table-responsive">
                        <table id="store_table" class="table dataTable">
                            <thead>
                                <tr>
                                    <th>@lang('lang.raw_material')</th>
                                    <th>@lang('lang.quantity')</th>
                                    <th>@lang('lang.manufacturing_date')</th>
                                    <th>@lang('lang.status')</th>
                                    <th>@lang('lang.store')</th>
                                    <th>@lang('lang.manufacturer')</th>
                                    <th>@lang('lang.manufactured_unit_cost_purchase')</th>
                                    <th>@lang('lang.manufactured_unit_cost_sell')</th>
                                    <th>@lang('lang.manufactured_cost')</th>
                                    @if ($type == 'process')
                                        <th>@lang('lang.product_received')</th>
                                        <th>@lang('lang.product_received_quantity')</th>
                                        <th>@lang('lang.product_received_date')</th>
                                    @endif
                                    <th>@lang('lang.created_by')</th>
                                    <th>@lang('lang.edited_by')</th>
                                    @if (auth()->user()->can('superadmin') || auth()->user()->is_admin == 1)
                                        <th class="notexport">@lang('lang.action')</th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($manufacturings as $manufacturing)
                                    <tr>
                                        <td>
                                            @foreach ($manufacturing->materials as $material)
                                                @if ($material->status == '0')
                                                    {{ $material->product->name ?? '' }} <br>
                                                @endif
                                            @endforeach
                                        </td>
                                        <td>
                                            @foreach ($manufacturing->materials as $material)
                                                {{ $material->quantity ?? '' }} <br>
                                            @endforeach
                                        </td>
                                        <td>{{ date('Y/m/d H:i', strtotime($manufacturing->created_at)) }}
                                        </td>
                                        <td>{{ $type }}</td>
                                        <td>{{ $manufacturing->store->name ?? '' }}</td>
                                        <td>{{ $manufacturing->manufacturer->name ?? '' }}</td>
                                        <td>{{ number_format($manufacturing->manufacture_cost_unit_purchase, 2, '.', ',') }}
                                        </td>
                                        <td>{{ number_format($manufacturing->manufacture_cost_unit_sell, 2, '.', ',') }}
                                        </td>
                                        <td>
                                            @foreach ($manufacturing->transactions as $transaction)
                                                @foreach ($transaction->transaction_payments as $payment)
                                                    {{ number_format($payment->amount, 2, '.', ',') }}
                                                @endforeach
                                                <br>
                                            @endforeach
                                        </td>
                                        @if ($type == 'process')
                                            <td>
                                                @foreach ($manufacturing->material_recived as $material)
                                                    @if ($material->status == '1')
                                                        {{ $material->product->name ?? '' }} <br>
                                                    @endif
                                                @endforeach
                                            </td>
                                            <td>
                                                @foreach ($manufacturing->material_recived as $material)
                                                    {{ $material->quantity ?? '' }} <br>
                                                @endforeach

                                            </td>
                                            <td>
                                                @foreach ($manufacturing->material_recived as $material)
                                                    @if ($material->status == '1')
                                                        {{ date('Y/m/d H:i', strtotime($material->created_at)) ?? '' }}
                                                        <br>
                                                    @endif
                                                @endforeach
                                            </td>
                                        @endif
                                        <td>{{ $manufacturing->createdAdmin->name ?? '' }}</td>
                                        <td>{{ $manufacturing->editedAdmin->name ?? '' }}</td>
                                        @if (auth()->user()->can('superadmin') || auth()->user()->is_admin == 1)
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
                                                        @isset($manufacturing->material_recived)
                                                            @if (count($manufacturing->material_recived) < 1)
                                                                <li>
                                                                    <a href="{{ route('manufacturing.getReceivedProductsPage', $manufacturing->id) }}"
                                                                        class="btn "><i class="dripicons-retweet"></i>
                                                                        @lang('lang.status')</a>
                                                                </li>
                                                            @endif
                                                        @endisset
                                                        <li>
                                                            <a href="{{ action('ManufacturingController@edit', $manufacturing->id) }}"
                                                                class="btn "><i class="dripicons-document-edit"></i>
                                                                @lang('lang.edit')</a>
                                                        </li>
                                                        <li class="divider"></li>
                                                        <li>
                                                            <a data-href="{{ action('ManufacturingController@destroy', $manufacturing->id) }}"
                                                                data-check_password="{{ action('AdminController@checkPassword', Auth::user()->id) }}"
                                                                class="btn text-red delete_item"><i class="fa fa-trash"></i>
                                                                @lang('lang.delete')</a>
                                                        </li>

                                                    </ul>
                                                </div>
                                            </td>
                                        @endif
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('javascript')

@endsection
