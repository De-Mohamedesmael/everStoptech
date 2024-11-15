@extends('layouts.app')
@section('title', __('lang.earning_of_point_system'))
@section('style')
    <link rel="stylesheet" type="text/css" href="{{ url('front/css/stock.css') }}">
@endsection
@section('content')
    <section class="forms py-0">

        <div class="container-fluid">
            <div
                class="d-flex align-items-center my-2 @if (app()->isLocale('ar')) justify-content-end @else justify-content-start @endif">
                <h5 class="mb-0 position-relative print-title" style="margin-right: 30px">
                    @lang('lang.earning_of_point_system')
                    <span class="header-pill"></span>
                </h5>
            </div>
            <div class="card mb-2">
                <div class="card-body d-flex justify-content-center p-2">

                    <a style="color: white" href="{{ action('EarningOfPointController@create') }}"
                        class="btn btn-main col-md-3"><i class="dripicons-plus"></i>
                        @lang('lang.earning_of_point_system')</a>

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
                                    <th>@lang('lang.name')</th>
                                    <th>@lang('lang.stores')</th>
                                    <th>@lang('lang.customer_types')</th>
                                    <th>@lang('lang.products_')</th>
                                    <th>@lang('lang.points_on_per_amount_sale')</th>
                                    <th>@lang('lang.start_date')</th>
                                    <th>@lang('lang.expiry_date')</th>
                                    <th class="notexport">@lang('lang.action')</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($earning_of_points as $earning_of_point)
                                    <tr>
                                        <td>{{ $earning_of_point->created_at }}</td>
                                        <td>{{ ucfirst($earning_of_point->created_by_user->name ?? '') }}</td>
                                        <td>{{ $earning_of_point->number }}</td>
                                        <td>{{ implode(', ', $earning_of_point->stores->pluck('name')->toArray()) }}
                                        </td>
                                        <td>{{ implode(', ', $earning_of_point->customer_types->pluck('name')->toArray()) }}
                                        </td>
                                        <td>{{ implode(', ', $earning_of_point->products->pluck('name')->toArray()) }}
                                        </td>
                                        <td>{{ @num_format($earning_of_point->points_on_per_amount) }}</td>
                                        <td>
                                            @if (!empty($earning_of_point->start_date))
                                                {{ @format_date($earning_of_point->start_date) }}
                                            @endif
                                        </td>
                                        <td>
                                            @if (!empty($earning_of_point->end_date))
                                                {{ @format_date($earning_of_point->end_date) }}
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
                                                    @can('loyalty_points.earning_of_points.delete')
                                                        <li>

                                                            <a data-href="{{ action('EarningOfPointController@show', $earning_of_point->id) }}"
                                                                data-container=".view_modal" class="btn btn-modal"><i
                                                                    class="dripicons-document"></i> @lang('lang.view')</a>
                                                        </li>
                                                        <li class="divider"></li>
                                                    @endcan
                                                    @can('loyalty_points.earning_of_points.view')
                                                        <li>
                                                            <a
                                                                href="{{ action('EarningOfPointController@edit', $earning_of_point->id) }}"><i
                                                                    class="dripicons-document-edit btn"></i>@lang('lang.edit')</a>
                                                        </li>
                                                        <li class="divider"></li>
                                                    @endcan
                                                    @can('loyalty_points.earning_of_points.delete')
                                                        <li>
                                                            <a data-href="{{ action('EarningOfPointController@destroy', $earning_of_point->id) }}"
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
    </section>
@endsection

@section('javascript')
    <script></script>
@endsection
