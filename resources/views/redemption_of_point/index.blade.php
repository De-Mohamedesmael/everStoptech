@extends('layouts.app')
@section('title', __('lang.redemption_of_point_system'))
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
                        <h5 class="mb-0 position-relative print-title" style="margin-right: 30px">
                            @lang('lang.redemption_of_point_system')
                            <span class="header-pill"></span>
                        </h5>
                    </div>
                    <div class="card mb-2">
                        <div class="card-body d-flex justify-content-center p-2">
                            <a style="color: white" href="{{ action('RedemptionOfPointController@create') }}"
                                class="btn btn-main col-md-3"><i class="dripicons-plus"></i>
                                @lang('lang.redemption_of_point_system')</a>

                        </div>
                    </div>

                    <div class="card mb-2">
                        <div class="card-body p-2">
                            <div class="table-responsive">
                                <table id="store_table" class="table dataTable">
                                    <thead>
                                        <tr>
                                            <th>@lang('lang.date_and_time')</th>
                                            <th>@lang('lang.created_by')</th>
                                            <th>@lang('lang.number')</th>
                                            <th>@lang('lang.stores')</th>
                                            <th>@lang('lang.earning_of_points')</th>
                                            <th>@lang('lang.products_')</th>
                                            <th>@lang('lang.value_of_1000_points')</th>
                                            <th>@lang('lang.start_date')</th>
                                            <th>@lang('lang.expiry_date')</th>
                                            <th class="notexport">@lang('lang.action')</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($redemption_of_points as $redemption_of_point)
                                            <tr>
                                                <td>{{ $redemption_of_point->created_at }}</td>
                                                <td>{{ ucfirst($redemption_of_point->created_by_user->name ?? '') }}
                                                </td>
                                                <td>{{ $redemption_of_point->number }}</td>
                                                <td>{{ implode(', ', $redemption_of_point->stores->pluck('name')->toArray()) }}
                                                </td>
                                                <td>{{ implode(', ', $redemption_of_point->earning_of_points->pluck('number')->toArray()) }}
                                                </td>
                                                <td>{{ implode(', ', $redemption_of_point->products->pluck('name')->toArray()) }}
                                                </td>
                                                <td>{{ @num_format($redemption_of_point->value_of_1000_points) }}
                                                </td>
                                                <td>
                                                    @if (!empty($redemption_of_point->start_date))
                                                        {{ @format_date($redemption_of_point->start_date) }}
                                                    @endif
                                                </td>
                                                <td>
                                                    @if (!empty($redemption_of_point->end_date))
                                                        {{ @format_date($redemption_of_point->end_date) }}
                                                    @endif
                                                </td>
                                                <td>
                                                    <div class="btn-group">
                                                        <button type="button"
                                                            class="btn btn-default btn-sm dropdown-toggle"
                                                            data-toggle="dropdown" aria-haspopup="true"
                                                            aria-expanded="false">@lang('lang.action')
                                                            <span class="caret"></span>
                                                            <span class="sr-only">Toggle Dropdown</span>
                                                        </button>
                                                        <ul class="dropdown-menu edit-options dropdown-menu-right dropdown-default"
                                                            user="menu">
                                                            @can('loyalty_points.redemption_of_points.delete')
                                                                <li>

                                                                    <a data-href="{{ action('RedemptionOfPointController@show', $redemption_of_point->id) }}"
                                                                        data-container=".view_modal" class="btn btn-modal"><i
                                                                            class="dripicons-document"></i>
                                                                        @lang('lang.view')</a>
                                                                </li>
                                                                <li class="divider"></li>
                                                            @endcan
                                                            @can('loyalty_points.redemption_of_points.view')
                                                                <li>
                                                                    <a
                                                                        href="{{ action('RedemptionOfPointController@edit', $redemption_of_point->id) }}"><i
                                                                            class="dripicons-document-edit btn"></i>@lang('lang.edit')</a>
                                                                </li>
                                                                <li class="divider"></li>
                                                            @endcan
                                                            @can('loyalty_points.redemption_of_points.delete')
                                                                <li>
                                                                    <a data-href="{{ action('RedemptionOfPointController@destroy', $redemption_of_point->id) }}"
                                                                        data-check_password="{{ action('AdminController@checkPassword', Auth::user()->id) }}"
                                                                        class="btn text-red delete_item"><i
                                                                            class="fa fa-trash"></i>
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
        </div>
    </section>
@endsection

@section('javascript')
    <script></script>
@endsection
