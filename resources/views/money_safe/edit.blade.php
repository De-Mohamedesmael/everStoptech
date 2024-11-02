<div class="modal-dialog" role="document">
    <div class="modal-content">

        {!! Form::open([
            'url' => action('MoneySafeController@update', $money_safe->id),
            'method' => 'put',
            'id' => 'money_safe_edit_form',
        ]) !!}

        <div
            class="modal-header position-relative border-0 d-flex justify-content-between align-items-center @if (app()->isLocale('ar')) flex-row-reverse @else flex-row @endif">

            <h5 class="modal-title px-2 position-relative d-flex align-items-center" style="gap: 5px;">@lang('lang.edit')
            </h5>
            <button type="button" data-dismiss="modal" aria-label="Close"
                class="close  btn btn-danger d-flex justify-content-center align-items-center rounded-circle text-white"><span
                    aria-hidden="true"><i class="dripicons-cross"></i></span></button>
            <span class="position-absolute modal-border"></span>
        </div>

        <div class="modal-body">
            <div class="row @if (app()->isLocale('ar')) flex-row-reverse @else flex-row @endif">

                <div class="col-md-6 px-5">
                    <div class="form-group">
                        {!! Form::label('store_id', __('lang.store') . '*', [
                            'class' => 'form-label d-block mb-1 app()->isLocale("ar") ? text-end : text-start',
                        ]) !!}
                        {!! Form::select('store_id', $stores, $money_safe->store_id, [
                            'class' => 'form-control selectpicker',
                            'data-live-search' => 'true',
                            'required',
                            'placeholder' => __('lang.please_select'),
                        ]) !!}
                    </div>
                </div>
                <div class="col-md-6 px-5">
                    <div class="form-group">
                        {!! Form::label('name', __('lang.safe_name') . '*', [
                            'class' => 'form-label d-block mb-1 app()->isLocale("ar") ? text-end : text-start',
                        ]) !!}
                        {!! Form::text('name', $money_safe->name, [
                            'class' => 'form-control modal-input app()->isLocale("ar") ? text-end : text-start',
                            'placeholder' => __('lang.name'),
                            'required',
                            'readonly' => $money_safe->is_default == 1 ? true : false,
                        ]) !!}
                    </div>
                </div>
                <div class="col-md-6 px-5">
                    <div class="form-group">
                        {!! Form::label('currency_id', __('lang.currency') . '*', [
                            'class' => 'form-label d-block mb-1 app()->isLocale("ar") ? text-end : text-start',
                        ]) !!}
                        {!! Form::select('currency_id', $currencies, $money_safe->currency_id, [
                            'class' => 'form-control selectpicker',
                            'data-live-search' => 'true',
                            'required',
                        ]) !!}
                    </div>
                </div>
                <div class="col-md-6 px-5">
                    <div class="form-group">
                        {!! Form::label('type', __('lang.type_of_safe') . '*', [
                            'class' => 'form-label d-block mb-1 app()->isLocale("ar") ? text-end : text-start',
                        ]) !!}
                        {!! Form::select('type', ['cash' => __('lang.cash'), 'bank' => __('lang.bank')], $money_safe->type, [
                            'class' => 'form-control selectpicker',
                            'data-live-search' => 'true',
                            'required',
                            'placeholder' => __('lang.please_select'),
                        ]) !!}
                    </div>
                </div>
                <div class="col-md-6 px-5">
                    <div class="form-group bank_fields">
                        {!! Form::label('bank_name', __('lang.bank_name') . '*', [
                            'class' => 'form-label d-block mb-1 app()->isLocale("ar") ? text-end : text-start',
                        ]) !!}
                        {!! Form::text('bank_name', $money_safe->bank_name, [
                            'class' =>
                                'modal-input app()->isLocale("ar") ? text-end : text-start form-control ' . $money_safe->type == 'bank'
                                    ? 'bank_required'
                                    : '',
                            'placeholder' => __('lang.bank_name'),
                            $money_safe->type == 'bank' ? 'required' : '',
                        ]) !!}
                    </div>
                </div>
                <div class="col-md-6 px-5">
                    <div class="form-group bank_fields">
                        {!! Form::label('IBAN', __('lang.IBAN'), [
                            'class' => 'form-label d-block mb-1 app()->isLocale("ar") ? text-end : text-start',
                        ]) !!}
                        {!! Form::text('IBAN', $money_safe->IBAN, [
                            'class' => 'form-control modal-input app()->isLocale("ar") ? text-end : text-start',
                            'placeholder' => __('lang.IBAN'),
                        ]) !!}
                    </div>
                </div>
                <div class="col-md-6 px-5">
                    <div class="form-group bank_fields">
                        {!! Form::label('bank_address', __('lang.bank_address'), [
                            'class' => 'form-label d-block mb-1 app()->isLocale("ar") ? text-end : text-start',
                        ]) !!}
                        {!! Form::text('bank_address', $money_safe->bank_address, [
                            'class' => 'form-control modal-input app()->isLocale("ar") ? text-end : text-start',
                            'placeholder' => __('lang.bank_address'),
                        ]) !!}
                    </div>
                </div>
                {{-- <div class="col-md-6 px-5">
                 <div class="form-group bank_fields">
                {!! Form::label('credit_card_currency_id', __('lang.credit_card_default_currency') . ':*') !!}
                {!! Form::select('credit_card_currency_id', $currencies, $money_safe->credit_card_currency_id, ['class' => 'form-control selectpicker bank_required', 'data-live-search' => 'true', 'placeholder' => __('lang.please_select')]) !!}
            </div>
            </div>
           <div class="col-md-6 px-5">
            <div class="form-group bank_fields">
                {!! Form::label('bank_transfer_currency_id', __('lang.bank_transfer_default_currency') . ':*') !!}
                {!! Form::select('bank_transfer_currency_id', $currencies, $money_safe->bank_transfer_currency_id, ['class' => 'form-control selectpicker bank_required', 'data-live-search' => 'true', 'placeholder' => __('lang.please_select')]) !!}
            </div>
            </div> --}}
                <div class="col-md-6 px-5">
                    <div class="form-group cash_fields">
                        {!! Form::label('add_money_users', __('lang.add_money_users'), [
                            'class' => 'form-label d-block mb-1 app()->isLocale("ar") ? text-end : text-start',
                        ]) !!}
                        {!! Form::select('add_money_users[]', $employees, $money_safe->add_money_users, [
                            'class' => 'form-control selectpicker',
                            'data-live-search' => 'true',
                            'data-actions-box' => 'true',
                            'multiple',
                        ]) !!}
                    </div>
                </div>
                <div class="col-md-6 px-5">
                    <div class="form-group cash_fields">
                        {!! Form::label('take_money_users', __('lang.take_money_users'), [
                            'class' => 'form-label d-block mb-1 app()->isLocale("ar") ? text-end : text-start',
                        ]) !!}
                        {!! Form::select('take_money_users[]', $employees, $money_safe->take_money_users, [
                            'class' => 'form-control selectpicker',
                            'data-live-search' => 'true',
                            'data-actions-box' => 'true',
                            'multiple',
                        ]) !!}
                    </div>
                </div>
            </div>
        </div>

        <div class="modal-footer d-flex justify-content-center align-content-center gap-3">

            <button type="submit" class="col-md-3 btn btn-main">@lang('lang.save')</button>
            <button type="button" class="col-md-3 btn btn-danger" data-dismiss="modal">@lang('lang.close')</button>
        </div>

        {!! Form::close() !!}

    </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->
<script>
    $('.selectpicker').selectpicker();
    @if ($money_safe->type == 'cash')
        $('.bank_fields').hide();
    @else
        $('.cash_fields').hide();
    @endif
    $('select#type').change();
    $(document).on('change', '#type', function() {
        let type = $(this).val();
        if (type == 'cash') {
            $('.bank_fields').hide();
            $('.cash_fields').show();
            $('.bank_required').attr('required', false);
        }
        if (type == 'bank') {
            $('.bank_fields').show();
            $('.cash_fields').hide();
            $('.bank_required').attr('required', true);
        }
    })
</script>
