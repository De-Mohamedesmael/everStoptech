@extends('layouts.app')
@section('title', __('lang.product_in_adjustment'))
@section('style')
    <link rel="stylesheet" type="text/css" href="{{ url('front/css/stock.css') }}">
@endsection
@section('content')
    <section class="forms py-0">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12 px-1">
                    <div
                        class="d-flex align-items-center my-2 @if (app()->isLocale('ar')) justify-content-end @else justify-content-start @endif">
                        <h5 class="mb-0 position-relative" style="margin-right: 30px">
                            @lang('lang.product_in_adjustment')
                            <span class="header-pill"></span>
                        </h5>
                    </div>
                    <div class="card mb-2">
                        <div class="card-body p-2">
                            <table class="table dataTable">
                                <thead>
                                    <tr>
                                        <th>@lang('lang.date_and_time')</th>
                                        <th>@lang('lang.store')</th>
                                        <th class="sum">@lang('lang.total_shortage_value')</th>
                                        <th>@lang('lang.created_by')</th>
                                        <th>@lang('lang.action')</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($product_adjustment as $adjustment)
                                        <tr>
                                            <td>{{ @format_datetime($adjustment->created_at) }}</td>
                                            <td>{{ $adjustment->store->name ?? '' }}</td>
                                            <td>{{ @num_format($adjustment->total_shortage_value) }}</td>
                                            <td>{{ $adjustment->created_by_user->name ?? '' }}</td>
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
                                                        @can('adjustment.cash_in_adjustment.create_and_edit')
                                                            <li>

                                                                <a href="{{ action('ProductInAdjustmentsController@getDetails', $adjustment->id) }}"
                                                                    class="btn"><i class="dripicons-document-edit"></i>
                                                                    @lang('lang.view')</a>
                                                            </li>
                                                            <li class="divider"></li>
                                                        @endcan
                                                        @can('adjustment.cash_in_adjustment.delete')
                                                            <li>
                                                                <a data-href="{{ action('ProductInAdjustmentsController@delete', $adjustment->id) }}"
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
                                        <th style="text-align: right">@lang('lang.total_shortage_value')</th>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                </tfoot>
                            </table>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('javascript')
    <script type="text/javascript"></script>
@endsection
