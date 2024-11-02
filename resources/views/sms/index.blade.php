@extends('layouts.app')
@section('title', __('lang.sms'))
@section('style')
    <link rel="stylesheet" type="text/css" href="{{ url('front/css/stock.css') }}">
@endsection
@section('content')
    <section class="forms py-0">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12 px-1 no-print">
                    <div
                        class="d-flex align-items-center my-2 @if (app()->isLocale('ar')) justify-content-end @else justify-content-start @endif">
                        <h5 class="mb-0 print-title position-relative" style="margin-right: 30px">
                            @lang('lang.sms')
                            <span class="header-pill"></span>
                        </h5>
                    </div>
                    <div class="card mb-2">
                        <div class="card-body p-2">
                            <div class="table-responsive">
                                <table id="store_table" class="table dataTable">
                                    <thead>
                                        <tr>
                                            <th>@lang('lang.date_and_time')</th>
                                            <th>@lang('lang.created_by')</th>
                                            <th>@lang('lang.content')</th>
                                            <th>@lang('lang.receiver')</th>
                                            <th>@lang('lang.notes')</th>
                                            <th class="notexport">@lang('lang.action')</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($sms as $key)
                                            <tr>
                                                <td>{{ $key->created_at }}</td>
                                                <td>{{ $key->sent_by }}</td>
                                                <td>{!! $key->message !!}</td>
                                                <td>{{ $key->mobile_numbers }}</td>
                                                <td>{{ $key->notes }}</td>
                                                <td>
                                                    @can('sms_module.sms.create_and_edit')
                                                        <a href="{{ action('SmsController@edit', $key->id) }}"
                                                            class="btn btn-danger text-white"><i
                                                                class="fa fa-pencil-square-o"></i></a>
                                                    @endcan
                                                    @can('sms_module.sms.delete')
                                                        <a data-href="{{ action('SmsController@destroy', $key->id) }}"
                                                            data-check_password="{{ action('AdminController@checkPassword', Auth::user()->id) }}"
                                                            class="btn btn-danger text-white delete_item"><i
                                                                class="fa fa-trash"></i></a>
                                                    @endcan
                                                    @can('sms_module.resend.create_and_edit')
                                                        <a href="{{ action('SmsController@resend', $key->id) }}"
                                                            class="btn btn-danger text-white"><i
                                                                class="fa fa-paper-plane"></i></a>
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
        </div>
    </section>
@endsection

@section('javascript')

@endsection
