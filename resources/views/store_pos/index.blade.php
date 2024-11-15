@extends('layouts.app')
@section('title', __('lang.pos_for_the_stores'))
@section('style')
    <link rel="stylesheet" type="text/css" href="{{ url('front/css/pos-modals.css') }}">

    <link rel="stylesheet" type="text/css" href="{{ url('front/css/main.css') }}">
@endsection
@section('content')
    <section class="forms py-0">

        <div class="container-fluid">
            <div class="col-md-12 px-1  no-print">
                <div
                    class="d-flex align-items-center my-2 @if (app()->isLocale('ar')) justify-content-end @else justify-content-start @endif">
                    <h5 class="mb-0 position-relative print-title" style="margin-right: 30px">
                        @lang('lang.pos_for_the_stores')
                        <span class="header-pill"></span>
                    </h5>
                </div>
                @can('settings.store.create_and_edit')
                    <div class="card mb-2">
                        <div class="card-body d-flex justify-content-center p-2">
                            <a style="color: white" data-href="{{ action('StorePosController@create') }}"
                                data-container=".view_modal" class="btn btn-modal btn-main col-md-3"><i
                                    class="dripicons-plus"></i>
                                @lang('lang.add_pos_for_store')</a>
                        </div>
                    </div>
                @endcan
                <div class="card mb-2">
                    <div class="card-body p-2">
                        <div class="table-responsive">
                            <table id="store_table" class="table dataTable">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>@lang('lang.store')</th>
                                        <th>@lang('lang.name')</th>
                                        <th>@lang('lang.user')</th>
                                        <th>@lang('lang.email')</th>
                                        <th>@lang('lang.date_and_time')</th>
                                        <th>@lang('lang.total_sales')</th>
                                        <th>@lang('lang.cash_sales')</th>
                                        <th>@lang('lang.credit_card_sales')</th>
                                        <th>@lang('lang.delivery_sales')</th>
                                        <th>@lang('lang.pending_orders')</th>
                                        <th>@lang('lang.pay_later_sales')</th>
                                        <th>@lang('lang.return_sale_of_this_pos')</th>
                                        <th>@lang('lang.last_session_closed_at')</th>
                                        <th class="notexport">@lang('lang.action')</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($store_poses as $store_pos)
                                        <tr>
                                            <td>{{ $store_pos->id }}</td>
                                            <td>{{ $store_pos->store->name ?? '' }}</td>
                                            <td>{{ $store_pos->name }}</td>
                                            <td>{{ $store_pos->user->name }}</td>
                                            <td>{{ $store_pos->user->email }}</td>
                                            <td>{{ @format_datetime($store_pos->created_at) }}</td>
                                            <td>{{ @num_format($store_pos->total_sales) }}</td>
                                            <td>{{ @num_format($store_pos->total_cash) }}</td>
                                            <td>{{ @num_format($store_pos->total_card) }}</td>
                                            <td>{{ @num_format($store_pos->total_delivery_sales) }}</td>
                                            <td>{{ @num_format($store_pos->pending_orders) }}</td>
                                            <td>{{ @num_format($store_pos->pay_later_sales) }}</td>
                                            <td>{{ @num_format($store_pos->total_sales_return) }}</td>
                                            @php
                                                $last_session = App\Models\CashRegister::where(
                                                    'store_pos_id',
                                                    $store_pos->id,
                                                )
                                                    ->where('status', 'close')
                                                    ->orderBy('closed_at', 'desc')
                                                    ->first();
                                            @endphp
                                            <td>{{ !empty($last_session) ? @format_datetime($last_session->closed_at) : '' }}
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
                                                        @can('settings.store_pos.create_and_edit')
                                                            <li>

                                                                <a data-href="{{ action('StorePosController@edit', $store_pos->id) }}"
                                                                    data-container=".view_modal" class="btn btn-modal"><i
                                                                        class="dripicons-document-edit"></i>
                                                                    @lang('lang.edit')</a>
                                                            </li>
                                                            <li class="divider"></li>
                                                        @endcan
                                                        @can('settings.store_pos.delete')
                                                            <li>
                                                                <a data-href="{{ action('StorePosController@destroy', $store_pos->id) }}"
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
