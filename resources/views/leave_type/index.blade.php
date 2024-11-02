@extends('layouts.app')
@section('title', __('lang.leave_type'))
@section('style')
    <link rel="stylesheet" type="text/css" href="{{ url('front/css/pos-modals.css') }}">

    <link rel="stylesheet" type="text/css" href="{{ url('front/css/main.css') }}">
@endsection
@section('content')
    <section class="forms py-0">

        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12 px-1">
                    <div
                        class="d-flex align-items-center my-2 @if (app()->isLocale('ar')) justify-content-end @else justify-content-start @endif">
                        <h5 class="mb-0 position-relative print-title" style="margin-right: 30px">
                            @lang('lang.leave_type')
                            <span class="header-pill"></span>
                        </h5>
                    </div>

                    <div class="card mb-2">
                        <div class="card-body d-flex justify-content-center p-2">
                            <button type="button" class="btn btn-main col-md-3 btn-modal"
                                data-href="{{ action('LeaveTypeController@create') }}" data-container=".view_modal">
                                <i class="fa fa-plus"></i> @lang('lang.add_leave_type')</button>
                        </div>
                    </div>
                    <div class="card mb-2">
                        <div class="card-body p-2">
                            <table class="table dataTable">
                                <thead>
                                    <tr>
                                        <th>@lang('lang.type_name')</th>
                                        <th>@lang('lang.number_of_days_per_year')</th>
                                        <th>@lang('lang.action')</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($leave_types as $leave_type)
                                        <tr>
                                            <td>
                                                {{ $leave_type->name }}
                                            </td>
                                            <td>
                                                {{ $leave_type->number_of_days_per_year }}
                                            </td>

                                            <td>
                                                @can('hr_management.leave_types.create_and_edit')
                                                    <a data-href="{{ action('LeaveTypeController@edit', $leave_type->id) }}"
                                                        data-container=".view_modal"
                                                        class="btn btn-primary btn-modal text-white edit_leave_type"><i
                                                            class="fa fa-pencil-square-o"></i></a>
                                                @endcan
                                                @can('hr_management.leave_types.delete')
                                                    <a data-href="{{ action('LeaveTypeController@destroy', $leave_type->id) }}"
                                                        data-check_password="{{ action('AdminController@checkPassword', Auth::user()->id) }}"
                                                        class="btn btn-danger text-white delete_item"><i
                                                            class="fa fa-trash"></i></a>
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
