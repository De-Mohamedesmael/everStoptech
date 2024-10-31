@extends('layouts.app')
@section('title', __('lang.customer_type'))
@section('style')
    <link rel="stylesheet" type="text/css" href="{{ url('front/css/main.css') }}">
@endsection
@section('content')
    <section class="forms py-0">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12 px-1">
                    <div
                        class="d-flex align-items-center my-2 @if (app()->isLocale('ar')) justify-content-end @else justify-content-start @endif">
                        <h5 class="mb-0 position-relative print-title" style="margin-right: 30px">@lang('lang.edit')
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
                        'url' => action('CustomerTypeController@update', $customer_type->id),
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
                                        {!! Form::label('name', __('lang.name') . '*', [
                                            'class' => 'form-label d-block mb-1 app()->isLocale("ar") ? text-end : text-start',
                                        ]) !!}
                                        {!! Form::text('name', $customer_type->name, [
                                            'class' => 'form-control modal-input app()->isLocale("ar") ? text-end : text-start',
                                            'placeholder' => __('lang.name'),
                                            'required',
                                        ]) !!}
                                    </div>
                                </div>
                                <div class="col-md-3 px-5">
                                    <div class="form-group">
                                        {!! Form::label('store', __('lang.store') . '*', [
                                            'class' => 'form-label d-block mb-1 app()->isLocale("ar") ? text-end : text-start',
                                        ]) !!}
                                        {!! Form::select('stores[]', $stores, $customer_type->customer_type_store->pluck('store_id'), [
                                            'class' => 'selectpicker
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        form-control',
                                            'data-live-search' => 'true',
                                            'multiple',
                                            'required',
                                        ]) !!}
                                    </div>
                                </div>
                            </div>

                            <div class="row my-2 justify-content-center align-items-center">
                                <div class="col-md-3">
                                    <input type="submit" value="{{ trans('lang.submit') }}" id="submit-btn"
                                        class="btn btn-main submit-btn">
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
    <script type="text/javascript">
        $(document).on('click', '.remove_row', function() {
            $(this).closest('tr').remove();
        })

        $(document).on('click', '.add_row_point', function() {
            var row_id = parseInt($('#row_id_point').val()) + 1;
            $.ajax({
                method: 'get',
                url: '/customer-type/get-product-point-row?row_id=' + row_id,
                data: {},
                contentType: 'html',
                success: function(result) {
                    $('#product_point_table tbody').append(result);
                    $('.row_' + row_id).find('.product_id_' + row_id).selectpicker('refresh');
                    $('#row_id_point').val(row_id);
                },
            });
        })

        $('#customer-type-form').submit(function() {
            $(this).validate();
            if ($(this).valid()) {
                $(this).submit();
            }
        })
    </script>
@endsection
