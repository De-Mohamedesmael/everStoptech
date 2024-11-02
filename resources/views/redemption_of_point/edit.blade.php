@extends('layouts.app')
@section('title', __('lang.redemption_of_point_system'))
@section('style')
    <link rel="stylesheet" type="text/css" href="{{ url('front/css/stock.css') }}">
@endsection
@section('content')
    <section class="forms py-0 ">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12 px-1">
                    <div
                        class="d-flex align-items-center my-2 @if (app()->isLocale('ar')) justify-content-end @else justify-content-start @endif">
                        <h5 class="mb-0 position-relative" style="margin-right: 30px">
                            @lang('lang.edit_redemption_of_point_system')
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
                        'url' => action('RedemptionOfPointController@update', $redemption_of_point->id),
                        'id' => 'customer-type-form',
                        'method' => 'PUT',
                        'class' => '',
                        'enctype' => 'multipart/form-data',
                    ]) !!}
                    <div class="card mb-2">
                        <div class="card-body p-2">
                            <div class="row @if (app()->isLocale('ar')) flex-row-reverse @else flex-row @endif">
                                <div class="col-md-3 px-5">
                                    <div class="form-group">
                                        {!! Form::label('store_ids', __('lang.store') . '*', [
                                            'class' => 'form-label d-block mb-1 app()->isLocale("ar") ? text-end : text-start',
                                        ]) !!}
                                        {!! Form::select('store_ids[]', $stores, $redemption_of_point->store_ids, [
                                            'class' => 'selectpicker
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            form-control',
                                            'data-live-search' => 'true',
                                            'multiple',
                                            'required',
                                            'data-actions-box' => 'true',
                                        ]) !!}
                                    </div>
                                </div>
                                <div class="col-md-3 px-5">
                                    <div class="form-group">
                                        {!! Form::label('earning_of_point_ids', __('lang.earning_of_points') . '*', [
                                            'class' => 'form-label d-block mb-1 app()->isLocale("ar") ? text-end : text-start',
                                        ]) !!}
                                        {!! Form::select('earning_of_point_ids[]', $earning_of_points, $redemption_of_point->earning_of_point_ids, [
                                            'class' => 'selectpicker
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            form-control',
                                            'data-live-search' => 'true',
                                            'multiple',
                                            'required',
                                            'data-actions-box' => 'true',
                                        ]) !!}
                                    </div>
                                </div>

                                <div class="col-md-3 px-5">
                                    <div class="form-group">
                                        {!! Form::label('value_of_1000_points', __('lang.value_of_1000_points') . '*', [
                                            'class' => 'form-label d-block mb-1 app()->isLocale("ar") ? text-end : text-start',
                                        ]) !!}
                                        {!! Form::text('value_of_1000_points', $redemption_of_point->value_of_1000_points, [
                                            'class' => 'form-control  modal-input app()->isLocale("ar") ? text-end : text-start',
                                            'required',
                                        ]) !!}
                                    </div>
                                </div>
                                <div class="col-md-3 px-5 d-flex justify-content-center align-items-center">
                                    @include('product_classification_tree.partials.product_selection_tree')
                                </div>
                                <div class="col-md-3 px-5">
                                    <div class="form-group">
                                        {!! Form::label('start_date', __('lang.start_date'), [
                                            'class' => 'form-label d-block mb-1 app()->isLocale("ar") ? text-end : text-start',
                                        ]) !!}
                                        {!! Form::text('start_date', $redemption_of_point->start_date, [
                                            'class' => 'form-control   modal-input app()->isLocale("ar") ? text-end : text-start',
                                        ]) !!}
                                    </div>
                                </div>
                                <div class="col-md-3 px-5">
                                    <div class="form-group">
                                        {!! Form::label('end_date', __('lang.end_date'), [
                                            'class' => 'form-label d-block mb-1 app()->isLocale("ar") ? text-end : text-start',
                                        ]) !!}
                                        {!! Form::text('end_date', $redemption_of_point->end_date, [
                                            'class' => 'form-control  modal-input app()->isLocale("ar") ? text-end : text-start',
                                        ]) !!}
                                    </div>
                                </div>
                            </div>

                            <div class="row my-2 justify-content-center align-items-center">
                                <div class="col-md-2">
                                    <input type="submit" value="{{ trans('lang.submit') }}" id="submit-btn"
                                        class="btn btn-main">
                                </div>
                            </div>
                        </div>
                    </div>
                    {!! Form::close() !!}
                    <input type="hidden" name="is_edit_page" id="is_edit_page" value="1">
                </div>
            </div>
        </div>

    </section>
@endsection

@section('javascript')
    <script src="{{ asset('js/product_selection_tree.js') }}"></script>
    <script type="text/javascript"></script>
@endsection
