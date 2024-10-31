<div class="modal-dialog" role="document">
    <div class="modal-content">

        {!! Form::open([
            'url' => action('GiftCardController@store'),
            'method' => 'post',
            'id' => $quick_add ? 'quick_add_gift_card_form' : 'gift_card_add_form',
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

                <div class="col-md-4">
                    <div class="form-group">
                        {!! Form::label('card_number', __('lang.card_number') . '*', [
                            'class' => 'form-label d-block mb-1 app()->isLocale("ar") ? text-end : text-start',
                        ]) !!}
                        <div class="input-group select-button-group">
                            {!! Form::text('card_number', $code, [
                                'class' => 'form-control  modal-input app()->isLocale("ar") ? text-end : text-start',
                                'placeholder' => __('lang.card_number'),
                                'required',
                            ]) !!}
                            {{-- <div class="input-group-append">
                        <button type="button"
                            class="btn btn-default btn-sm refresh_code"><i class="fa fa-refresh"></i></button>
                    </div> --}}
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        {!! Form::label('amount', __('lang.amount') . '*', [
                            'class' => 'form-label d-block mb-1 app()->isLocale("ar") ? text-end : text-start',
                        ]) !!}
                        {!! Form::text('amount', null, [
                            'class' => 'form-control  modal-input app()->isLocale("ar") ? text-end : text-start',
                            'placeholder' => __('lang.amount'),
                            'required',
                        ]) !!}
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        {!! Form::label('expiry_date', __('lang.expiry_date') . '*', [
                            'class' => 'form-label d-block mb-1 app()->isLocale("ar") ? text-end : text-start',
                        ]) !!}
                        {!! Form::text('expiry_date', null, [
                            'class' => 'form-control datepicker  modal-input app()->isLocale("ar") ? text-end : text-start',
                            'placeholder' => __('lang.expiry_date'),
                        ]) !!}
                    </div>
                </div>
                <input type="hidden" name="quick_add" value="{{ $quick_add }}">
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
    $('.refresh_code').click()
    $(document).on('click', '.refresh_code', function() {
        $.ajax({
            method: 'get',
            url: '/gift_card-code',
            data: {},
            success: function(result) {
                $('#card_number').val(result);
            },
        });
    })
</script>
