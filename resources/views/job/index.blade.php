@extends('layouts.app')
@section('title', __('lang.jobs'))
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
                            @lang('lang.jobs')
                            <span class="header-pill"></span>
                        </h5>
                    </div>
                    <div class="card mb-2">
                        <div class="card-body d-flex justify-content-center p-2">
                            <button type="button" class="btn btn-main col-md-3 btn-modal"
                                data-href="{{ action('JobController@create') }}" data-container=".view_modal">
                                <i class="fa fa-plus"></i> @lang('lang.add_job')</button>
                        </div>
                    </div>
                    <div class="card mb-2">
                        <div class="card-body p-2">

                            <div class="table-responsive">
                                <table class="table dataTable">
                                    <thead>
                                        <tr>
                                            <th>@lang('lang.job_title')</th>
                                            <th>@lang('lang.date_of_creation')</th>
                                            <th>@lang('lang.name_of_creator')</th>
                                            <th class="notexport">@lang('lang.action')</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @foreach ($jobs as $job)
                                            <tr>
                                                <td>
                                                    {{ $job->job_title }}
                                                </td>
                                                <td>
                                                    {{ @format_date($job->date_of_creation) }}
                                                </td>
                                                <td>
                                                    {{ $job->created_by }}
                                                </td>
                                                <td>

                                                    @if (!in_array($job->job_title, ['Cashier', 'Deliveryman', 'Chef']))
                                                        @can('hr_management.jobs.create_and_edit')
                                                            <a data-href="{{ action('JobController@edit', $job->id) }}"
                                                                data-container=".view_modal"
                                                                class="btn btn-sm btn-primary btn-modal text-white edit_job"><i
                                                                    class="fa fa-pencil-square-o"></i></a>
                                                        @endcan
                                                        @can('hr_management.jobs.delete')
                                                            <a data-href="{{ action('JobController@destroy', $job->id) }}"
                                                                data-check_password="{{ action('AdminController@checkPassword', Auth::user()->id) }}"
                                                                class="btn btn-danger btn-sm text-white delete_item"><i
                                                                    class="fa fa-trash"></i></a>
                                                        @endcan
                                                    @endif
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
