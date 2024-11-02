<div class="modal-dialog" role="document">
    <div class="modal-content">

        {!! Form::open([
            'url' => action('ExchangeRateController@store'),
            'method' => 'post',
            'id' => 'exchange_rate_add_form',
        ]) !!}

        <div
            class="modal-header  position-relative border-0 d-flex justify-content-between align-items-center @if (app()->isLocale('ar')) flex-row-reverse @else flex-row @endif">

            <h4 class="modal-title px-2 position-relative">@lang('lang.add_new_rate') <span class=" header-modal-pill"></span></h4>
            <button type="button"
                class="close btn btn-danger d-flex justify-content-center align-items-center rounded-circle text-white"
                data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <span class="position-absolute modal-border"></span>
        </div>

        <div
            class="modal-body row @if (app()->isLocale('ar')) flex-row-reverse @else flex-row @endif align-items-center">
            <div class="form-group col-md-6 px-5">

                {!! Form::label('store_id', __('lang.store') . '*', [
                    'class' => 'form-label d-block mb-1 app()->isLocale("ar") ? text-end : text-start',
                ]) !!}
                {!! Form::select('store_id', $stores, !empty($default_store) ? $default_store->id : null, [
                    'class' => 'form-control selectpicker',
                    'data-live-search' => 'true',
                    'id' => 'store_id',
                    'placeholder' => __('lang.please_select'),
                    'required',
                ]) !!}
            </div>

            <div class="form-group col-md-6 px-5">

                {!! Form::label('received_currency_id', __('lang.received_currency') . '*', [
                    'class' => 'form-label d-block mb-1 app()->isLocale("ar") ? text-end : text-start',
                ]) !!}
                {!! Form::select('received_currency_id', $currencies_excl, false, [
                    'class' => 'form-control selectpicker',
                    'data-live-search' => 'true',
                    'id' => 'received_currency_id',
                    'placeholder' => __('lang.please_select'),
                    'required',
                ]) !!}
            </div>

            <div class="form-group col-md-6 px-5">

                {!! Form::label('conversion_rate', __('lang.enter_the_rate') . '*', [
                    'class' => 'form-label d-block mb-1 app()->isLocale("ar") ? text-end : text-start',
                ]) !!}
                {!! Form::text('conversion_rate', null, [
                    'class' => 'form-control modal-input app()->isLocale("ar") ? text-end : text-start',
                    'placeholder' => __('lang.enter_the_rate'),
                    'required',
                ]) !!}
            </div>

            <div class="form-group col-md-6 px-5">

                {!! Form::label('default_currency_id', __('lang.default_currency') . '*', [
                    'class' => 'form-label d-block mb-1 app()->isLocale("ar") ? text-end : text-start',
                ]) !!}
                {!! Form::select('default_currency_id', $currencies_all, $default_currency->id, [
                    'class' => 'form-control selectpicker',
                    'data-live-search' => 'true',
                    'id' => 'default_currency_id',
                    'placeholder' => __('lang.please_select'),
                    'required',
                ]) !!}

            </div>

            <div class="form-group col-md-6 px-5">

                {!! Form::label('expiry_date', __('lang.expiry_date'), [
                    'class' => 'form-label d-block mb-1 app()->isLocale("ar") ? text-end : text-start',
                ]) !!}
                {!! Form::date('expiry_date', null, [
                    'class' => 'form-control modal-input app()->isLocale("ar") ? text-end : text-start',
                    'placeholder' => __('lang.expiry_date'),
                ]) !!}

            </div>
        </div>


        <div class="modal-footer d-flex justify-content-center align-content-center gap-3">

            <button type="submit" class="btn btn-main col-md-3 py-1">@lang('lang.save')</button>
            <button type="button" class="btn btn-danger py-1 col-md-3" data-dismiss="modal">@lang('lang.close')</button>
        </div>

        {!! Form::close() !!}

    </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->
<script>
    $('.selectpicker').selectpicker('refresh');
</script>
