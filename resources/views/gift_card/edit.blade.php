<div class="modal-dialog" role="document">
    <div class="modal-content">

        {!! Form::open([
            'url' => action('GiftCardController@update', $gift_card->id),
            'method' => 'put',
            'id' => 'gift_card_add_form',
        ]) !!}

        <div
            class="modal-header position-relative border-0 d-flex justify-content-between align-items-center @if (app()->isLocale('ar')) flex-row-reverse @else flex-row @endif">
            <h4 class="modal-title px-2 position-relative d-flex align-items-center" style="gap: 5px;">@lang('lang.generate_gift_card')
            </h4>
            <button type="button" data-dismiss="modal" aria-label="Close"
                class="close  btn btn-danger d-flex justify-content-center align-items-center rounded-circle text-white"><span
                    aria-hidden="true"><i class="dripicons-cross"></i></span></button>
            <span class="position-absolute modal-border"></span>
        </div>

        <div class="modal-body">
            <div class="row @if (app()->isLocale('ar')) flex-row-reverse @else flex-row @endif">

                <div class="col-md-6 px-5">
                    <div class="form-group">
                        {!! Form::label('card_number', __('lang.card_number') . '*', [
                            'class' => 'form-label d-block mb-1 app()->isLocale("ar") ? text-end : text-start',
                        ]) !!}
                        <div class="input-group select-button-group">
                            {!! Form::text('card_number', $gift_card->card_number, [
                                'class' => 'form-control  modal-input app()->isLocale("ar") ? text-end : text-start',
                                'placeholder' => __('lang.card_number'),
                                'required',
                            ]) !!}
                            <div class="input-group-append">
                                <button type="button" class="select-button refresh_code"><i
                                        class="fa fa-refresh"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 px-5">
                    <div class="form-group">
                        {!! Form::label('amount', __('lang.amount') . '*', [
                            'class' => 'form-label d-block mb-1 app()->isLocale("ar") ? text-end : text-start',
                        ]) !!}
                        {!! Form::text('amount', @num_format($gift_card->amount), [
                            'class' => 'form-control  modal-input app()->isLocale("ar") ? text-end : text-start',
                            'placeholder' => __('lang.amount'),
                            'required',
                        ]) !!}
                    </div>
                </div>
                <div class="col-md-6 px-5">
                    <div class="form-group">
                        {!! Form::label('balance', __('lang.balance') . '*', [
                            'class' => 'form-label d-block mb-1 app()->isLocale("ar") ? text-end : text-start',
                        ]) !!}
                        {!! Form::text('balance', @num_format($gift_card->balance), [
                            'class' => 'form-control  modal-input app()->isLocale("ar") ? text-end : text-start',
                            'placeholder' => __('lang.balance'),
                            'required',
                        ]) !!}
                    </div>
                </div>
                <div class="col-md-6 px-5">
                    <div class="form-group">
                        {!! Form::label('expiry_date', __('lang.expiry_date') . '*', [
                            'class' => 'form-label d-block mb-1 app()->isLocale("ar") ? text-end : text-start',
                        ]) !!}
                        {!! Form::text('expiry_date', !empty($gift_card->expiry_date) ? @format_date($gift_card->expiry_date) : null, [
                            'class' => 'form-control datepicker  modal-input app()->isLocale("ar") ? text-end : text-start',
                            'placeholder' => __('lang.expiry_date'),
                        ]) !!}
                    </div>
                </div>
            </div>
        </div>

        <div class="modal-footer d-flex justify-content-center align-content-center gap-3">

            <button type="submit" class="btn col-md-2 btn-main">@lang('lang.save')</button>
            <button type="button" class="btn col-md-2 btn-danger" data-dismiss="modal">@lang('lang.close')</button>
        </div>

        {!! Form::close() !!}

    </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->
<script>
    $('.datepicker').datepicker({
        language: '{{ session('language') }}',
        todayHighlight: true,
    });
    $('.selectpicker').selectpicker('render');
    $('.selectpicker').selectpicker('selectAll');

    $('.all_products').change(function() {
        if (!$(this).prop('checked')) {
            $('.selectpicker').selectpicker('deselectAll');
        } else {
            $('.selectpicker').selectpicker('selectAll');
        }
    })
    $('.amount_to_be_purchase_checkbox').change(function() {
        if ($(this).prop('checked')) {
            $('.amount_to_be_purchase').attr('required', true);
        } else {
            $('.amount_to_be_purchase').attr('required', false);
        }
    })

    $('.refresh_code').click()
    $(document).on('click', '.refresh_code', function() {
        $.ajax({
            method: 'get',
            url: '/coupon/generate-code',
            data: {},
            success: function(result) {
                $('#card_number').val(result);
            },
        });
    })
</script>
