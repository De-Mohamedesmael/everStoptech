@extends('layouts.app')
@section('title', __('lang.consumption'))
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
                            @lang('lang.add_manual_consumption')
                            <span class="header-pill"></span>
                        </h5>
                    </div>
                    <div class="card mb-2 d-flex flex-row justify-content-center align-items-center">
                        <p class="italic mb-0 py-1">
                            <small>@lang('lang.required_fields_info')</small>
                        <div style="width: 30px;height: 30px;">
                            <img class="w-100 h-100" src="{{ asset('front/images/icons/warning.png') }}" alt="warning!">
                        </div>
                        </p>
                    </div>
                    {!! Form::open([
                        'url' => action('ConsumptionController@store'),
                        'id' => 'consumption-form',
                        'method' => 'POST',
                        'class' => '',
                        'enctype' => 'multipart/form-data',
                    ]) !!}
                    <div class="card mb-2">
                        <div class="card-body p-2">
                            <div class="row @if (app()->isLocale('ar')) flex-row-reverse @else flex-row @endif">
                                <div class="col-md-3 px-5">
                                    <div class="form-group">
                                        {!! Form::label('store_id', __('lang.store') . '*', [
                                            'class' => 'form-label d-block mb-1 app()->isLocale("ar") ? text-end : text-start',
                                        ]) !!}
                                        {!! Form::select('store_id', $stores, session('user.store_id'), [
                                            'class' => 'selectpicker form-control',
                                            'data-live-search' => 'true',
                                            'required',
                                            'style' => 'width: 80%',
                                            'placeholder' => __('lang.please_select'),
                                        ]) !!}
                                    </div>
                                </div>
                                <div class="col-md-3 px-5 @if (!auth()->user()->can('raw_material_module.add_consumption_for_others.create_and_edit')) hide @endif">
                                    <div class="form-group">
                                        {!! Form::label('created_by', __('lang.chef') . '*', [
                                            'class' => 'form-label d-block mb-1 app()->isLocale("ar") ? text-end : text-start',
                                        ]) !!}
                                        {!! Form::select('created_by', $chefs, auth()->user()->id, [
                                            'class' => 'selectpicker form-control',
                                            'data-live-search' => 'true',
                                            'required',
                                            'style' => 'width: 80%',
                                            'placeholder' => __('lang.please_select'),
                                        ]) !!}
                                    </div>
                                </div>
                                <div class="col-md-3 px-5">
                                    {!! Form::label('date_and_time', __('lang.date_and_time'), [
                                        'class' => 'form-label d-block mb-1 app()->isLocale("ar") ? text-end : text-start',
                                    ]) !!}
                                    <input type="datetime-local" id="date_and_time" name="date_and_time"
                                        value="{{ date('Y-m-d\TH:i') }}"
                                        class="form-control modal-input @if (app()->isLocale('ar')) text-end @else text-start @endif">

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card mb-2">
                        <div class="card-body p-2">
                            <table class="table table-bordered" id="consumption_table">
                                <thead>
                                    <tr>
                                        <td
                                            style="width: 20%;font-weight: 500;font-size: 0.8rem !important;text-align: center">
                                            @lang('lang.raw_material')</td>
                                        <td
                                            style="width: 20%;font-weight: 500;font-size: 0.8rem !important;text-align: center">
                                            @lang('lang.products')</td>
                                        <td
                                            style="width: 20%;font-weight: 500;font-size: 0.8rem !important;text-align: center">
                                            @lang('lang.quantity')</td>
                                        <td
                                            style="width: 20%;font-weight: 500;font-size: 0.8rem !important;text-align: center">
                                            @lang('lang.unit')</td>
                                        {{-- <td style="width: 20%;"><button type="button"
                                            class="btn btn-xs btn-success add_row"><i class="fa fa-plus"></i></button>
                                    </td> --}}
                                    </tr>
                                </thead>
                                <tbody>
                                    @include('consumption.partial.consumption_row', ['row_id' => 0])
                                </tbody>
                            </table>

                            <input type="hidden" name="active" value="1">
                            <input type="hidden" name="row_id" id="row_id" value="1">

                            <div class="row my-2 justify-content-center align-items-center">
                                <div class="col-md-4">
                                    <input type="submit" value="{{ trans('lang.submit') }}" id="submit-btn"
                                        class="btn py-1">
                                </div>
                            </div>
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>

    </section>

@endsection

@section('javascript')
    <script src="{{ asset('js/consumption.js') }}"></script>
    <script src="{{ asset('js/raw_material.js') }}"></script>
    <script type="text/javascript">
        @if (!empty(request()->raw_material_id))
            $(document).ready(function() {
                $('select.raw_material_id').change();
            });
        @endif
    </script>
@endsection
