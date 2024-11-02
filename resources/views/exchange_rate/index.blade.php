@extends('layouts.app')
@section('title', __('lang.exchange_rate'))
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
                        @lang('lang.exchange_rate')
                        <span class="header-pill"></span>
                    </h5>
                </div>
                @can('settings.exchange_rate.create_and_edit')
                    <div class="card mb-2">
                        <div class="card-body d-flex justify-content-center p-2">
                            <a style="color: white" data-href="{{ action('ExchangeRateController@create') }}"
                                data-container=".view_modal" class="btn btn-modal btn-main col-md-3"><i
                                    class="dripicons-plus"></i>
                                @lang('lang.add_new_rate')</a>
                        </div>
                    </div>
                @endcan
                <div class="card mb-2">
                    <div class="card-body p-2">
                        <div class="table-responsive">
                            <table id="store_table" class="table dataTable">
                                <thead>
                                    <tr>
                                        <th>@lang('lang.received_currency')</th>
                                        <th>@lang('lang.rate_ex')</th>
                                        <th>@lang('lang.default_currency')</th>
                                        <th>@lang('lang.created_by')</th>
                                        <th>@lang('lang.created_on')</th>
                                        <th>@lang('lang.expiry_in')</th>
                                        <th class="notexport">@lang('lang.action')</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($exchange_rates as $exchange_rate)
                                        <tr>
                                            <td>{{ $exchange_rate->received_currency->currency }}({{ $exchange_rate->received_currency->code }})
                                            </td>
                                            <td>{{ rtrim(number_format($exchange_rate->conversion_rate, 8, '.', ''), '0') }}
                                            </td>
                                            <td>{{ $exchange_rate->default_currency->currency }}({{ $exchange_rate->default_currency->code }})
                                            </td>
                                            <td>{{ $exchange_rate->created_by_user->name }}</td>
                                            <td>{{ @format_datetime($exchange_rate->created_at) }}</td>
                                            <td>
                                                @if (!empty($exchange_rate->expiry_date))
                                                    {{ @format_date($exchange_rate->expiry_date) }}
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
                                                        @can('settings.exchange_rate.create_and_edit')
                                                            <li>

                                                                <a data-href="{{ action('ExchangeRateController@edit', $exchange_rate->id) }}"
                                                                    data-container=".view_modal" class="btn btn-modal"><i
                                                                        class="dripicons-document-edit"></i>
                                                                    @lang('lang.edit')</a>
                                                            </li>
                                                            <li class="divider"></li>
                                                        @endcan
                                                        @can('settings.exchange_rate.delete')
                                                            <li>
                                                                <a data-href="{{ action('ExchangeRateController@destroy', $exchange_rate->id) }}"
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
