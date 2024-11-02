@extends('layouts.app')
@section('title', __('lang.customer_balance_adjustment'))
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
                            @lang('lang.customer_balance_adjustment')
                            <span class="header-pill"></span>
                        </h5>
                    </div>
                    {!! Form::open([
                        'url' => action('CustomerBalanceAdjustmentController@update', $customer_balance_adjustment->id),
                        'method' => 'put',
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
                                        {!! Form::select('store_id', $stores, $customer_balance_adjustment->store_id, [
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
                                        {!! Form::select('admin_id', $users, $customer_balance_adjustment->admin_id, [
                                            'class' => 'form-control
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                selectpicker',
                                            'id' => 'admin_id',
                                            'placeholder' => __('lang.please_select'),
                                        ]) !!}
                                    </div>
                                </div>
                                <div class="col-md-3 px-5">
                                    <div class="form-group">
                                        {!! Form::label('customer_id', __('lang.customer'), [
                                            'class' => 'form-label d-block mb-1 app()->isLocale("ar") ? text-end : text-start',
                                        ]) !!}
                                        {!! Form::select('customer_id', $customers, $customer_balance_adjustment->customer_id, [
                                            'class' => 'form-control
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                selectpicker',
                                            'id' => 'customer_id',
                                            'data-live-search' => 'true',
                                            'placeholder' => __('lang.please_select'),
                                            'required',
                                        ]) !!}
                                    </div>
                                </div>
                                <div class="col-md-3 px-5">
                                    <div class="form-group">
                                        {!! Form::label('current_balance', __('lang.current_balance'), [
                                            'class' => 'form-label d-block mb-1 app()->isLocale("ar") ? text-end : text-start',
                                        ]) !!}
                                        {!! Form::text('current_balance', @num_format($customer_balance_adjustment->current_balance), [
                                            'class' => 'form-control modal-input app()->isLocale("ar") ? text-end : text-start',
                                            'id' => 'current_balance',
                                            'placeholder' => __('lang.current_balance'),
                                            'readonly',
                                        ]) !!}
                                    </div>
                                </div>
                                <div class="col-md-3 px-5">
                                    <div class="form-group">
                                        {!! Form::label('add_new_balance', __('lang.add_new_balance'), [
                                            'class' => 'form-label d-block mb-1 app()->isLocale("ar") ? text-end : text-start',
                                        ]) !!}
                                        {!! Form::text('add_new_balance', @num_format($customer_balance_adjustment->add_new_balance), [
                                            'class' => 'form-control modal-input app()->isLocale("ar") ? text-end : text-start',
                                            'id' => 'add_new_balance',
                                            'placeholder' => __('lang.add_new_balance'),
                                        ]) !!}
                                    </div>
                                </div>
                                <div class="col-md-3 px-5">
                                    <div class="form-group">
                                        {!! Form::label('new_balance', __('lang.new_balance'), [
                                            'class' => 'form-label d-block mb-1 app()->isLocale("ar") ? text-end : text-start',
                                        ]) !!}
                                        {!! Form::text('new_balance', @num_format($customer_balance_adjustment->new_balance), [
                                            'class' => 'form-control modal-input app()->isLocale("ar") ? text-end : text-start',
                                            'id' => 'new_balance',
                                            'placeholder' => __('lang.new_balance'),
                                        ]) !!}
                                    </div>
                                </div>
                                <div class="col-md-12 px-5">
                                    {!! Form::label('notes', __('lang.notes'), [
                                        'class' => 'form-label d-block mb-1 app()->isLocale("ar") ? text-end : text-start',
                                    ]) !!}
                                    {!! Form::textarea('notes', $customer_balance_adjustment->notes, [
                                        'class' => 'form-control modal-input app()->isLocale("ar") ? text-end : text-start',
                                        'rows' => 3,
                                    ]) !!}
                                </div>

                            </div>
                        </div>

                        <div class="row my-2 justify-content-center align-items-center">
                            <div class="col-md-2">
                                <button type="submit" id="print"
                                    class="btn btn-primary submit-btn submit">@lang('lang.update')</button>

                            </div>
                        </div>
                    </div>
                    {!! Form::close() !!}

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
                url: '/cash-in-adjustment/get-cash-details/' + admin_id,
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
        });
        $(document).on('change', '#customer_id', function() {
            let customer_id = $(this).val();

            $.ajax({
                method: 'get',
                url: '/customer/get-customer-balance/' + customer_id,
                data: {},
                success: function(result) {
                    __write_number($('#current_balance'), result.balance);

                    $('#add_new_balance').change()
                },
            });
        })
        $(document).on('change', '#add_new_balance', function() {
            if (!$('#customer_id').val()) {
                alert('Please select customer first');
                $(this).val('');
                return false;
            }
            let add_new_balance = __read_number($('#add_new_balance'));
            let current_balance = __read_number($('#current_balance'));

            let new_balance = add_new_balance + current_balance;

            __write_number($('#new_balance'), new_balance);

        });
    </script>
@endsection
