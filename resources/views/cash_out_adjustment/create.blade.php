@extends('layouts.app')
@section('title', __('lang.cash_out_adjustment'))
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
                            @lang('lang.cash_out_adjustment')
                            <span class="header-pill"></span>
                        </h5>
                    </div>
                    {!! Form::open([
                        'url' => action('CashOutAdjustmentController@store'),
                        'method' => 'post',
                        'id' => 'sms_form',
                        'files' => true,
                    ]) !!}
                    <div class="card mb-2">
                        <div class="card-body p-2">
                            <div class="row @if (app()->isLocale('ar')) flex-row-reverse @else flex-row @endif">
                                <div class="col-md-3 px-5">
                                    <div class="form-group">
                                        {!! Form::label('store_id', __('lang.store'), [
                                            'class' => 'form-label d-block mb-1 app()->isLocale("ar") ? text-end : text-start',
                                        ]) !!}
                                        {!! Form::select('store_id', $stores, false, [
                                            'class' => 'form-control
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                selectpicker',
                                            'id' => 'store_id',
                                            'placeholder' => __('lang.please_select'),
                                        ]) !!}
                                    </div>
                                </div>
                                <div class="col-md-3 px-5">
                                    <div class="form-group">
                                        {!! Form::label('admin_id', __('lang.cashier'), [
                                            'class' => 'form-label d-block mb-1 app()->isLocale("ar") ? text-end : text-start',
                                        ]) !!}
                                        {!! Form::select('admin_id', $admins, false, [
                                            'class' => 'form-control
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                selectpicker',
                                            'id' => 'admin_id',
                                            'placeholder' => __('lang.please_select'),
                                        ]) !!}
                                    </div>
                                </div>
                                <div class="col-md-3 px-5">
                                    <div class="form-group">
                                        {!! Form::label('current_cash', __('lang.current_cash'), [
                                            'class' => 'form-label d-block mb-1 app()->isLocale("ar") ? text-end : text-start',
                                        ]) !!}
                                        {!! Form::text('current_cash', null, [
                                            'class' => 'form-control modal-input app()->isLocale("ar") ? text-end : text-start',
                                            'id' => 'current_cash',
                                            'placeholder' => __('lang.current_cash'),
                                            'readonly',
                                        ]) !!}
                                    </div>
                                </div>
                                <div class="col-md-3 px-5">
                                    <div class="form-group">
                                        {!! Form::label('amount', __('lang.amount'), [
                                            'class' => 'form-label d-block mb-1 app()->isLocale("ar") ? text-end : text-start',
                                        ]) !!}
                                        {!! Form::text('amount', null, [
                                            'class' => 'form-control modal-input app()->isLocale("ar") ? text-end : text-start',
                                            'id' => 'amount',
                                            'placeholder' => __('lang.amount'),
                                        ]) !!}
                                    </div>
                                </div>
                                <div class="col-md-3 px-5">
                                    <div class="form-group">
                                        {!! Form::label('discrepancy', __('lang.discrepancy'), [
                                            'class' => 'form-label d-block mb-1 app()->isLocale("ar") ? text-end : text-start',
                                        ]) !!}
                                        {!! Form::text('discrepancy', null, [
                                            'class' => 'form-control modal-input app()->isLocale("ar") ? text-end : text-start',
                                            'id' => 'discrepancy',
                                            'placeholder' => __('lang.discrepancy'),
                                        ]) !!}
                                    </div>
                                </div>
                                <input type="hidden" name="cash_register_id" id="cash_register_id" value="">

                            </div>
                        </div>

                        <div class="row my-2 justify-content-center align-items-center">
                            <div class="col-md-2">
                                <button type="submit" name="submit" id="print" value="save"
                                    class="btn btn-primary submit-btn submit">@lang('lang.save')</button>

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
        $('.selectpicker').selectpicker()
        $(document).on('change', '#amount', function() {
            let amount = __read_number($('#amount'));
            let current_cash = __read_number($('#current_cash'));

            let discrepancy = amount - current_cash;

            __write_number($('#discrepancy'), discrepancy);

        });
        $(document).on('change', '#admin_id', function() {
            let admin_id = $(this).val();

            $.ajax({
                method: 'get',
                url: '/cash-out-adjustment/get-cash-details/1',
                data: {},
                success: function(result) {
                    if (result.store_id) {
                        $('#store_id').val(result.store_id).selectpicker('refresh');
                    }
                    if (result.current_cash) {
                        __write_number($('#current_cash'), result.current_cash);
                    }
                    if (result.cash_register_id) {
                        $('#cash_register_id').val(result.cash_register_id);
                    }
                },
            });
        })
    </script>
@endsection
