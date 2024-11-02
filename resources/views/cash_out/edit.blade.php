<div class="modal-dialog" role="document">
    <div class="modal-content">

        {!! Form::open([
            'url' => action('CashOutController@update', $cash_out->id),
            'method' => 'put',
            'id' => 'add_cash_out_form',
            'files' => true,
        ]) !!}

        <div
            class="modal-header position-relative border-0 d-flex justify-content-between align-items-center @if (app()->isLocale('ar')) flex-row-reverse @else flex-row @endif">

            <h4 class="modal-title px-2 position-relative d-flex align-items-center" style="gap: 5px;">@lang('lang.add_cash_out')
            </h4>
            <button type="button" data-dismiss="modal" aria-label="Close"
                class="close  btn btn-danger d-flex justify-content-center align-items-center rounded-circle text-white"><span
                    aria-hidden="true"><i class="dripicons-cross"></i></span></button>
            <span class="position-absolute modal-border"></span>
        </div>

        <div class="modal-body">
            <div class="col-md-12">
                <div class="row @if (app()->isLocale('ar')) flex-row-reverse @else flex-row @endif">
                    <input type="hidden" name="cash_register_id" value="{{ $cash_out->cash_register_id }}">
                    <div class="col-md-6 px-5">
                        <div class="form-group">
                            {!! Form::label('amount', __('lang.amount') . '*', [
                                'class' => 'form-label d-block mb-1 app()->isLocale("ar") ? text-end : text-start',
                            ]) !!}
                            {!! Form::text('amount', @num_format($cash_out->amount), [
                                'class' => 'form-control modal-input app()->isLocale("ar") ? text-end : text-start',
                                'placeholder' => __('lang.amount'),
                                'required',
                            ]) !!}
                        </div>
                    </div>
                    <div class="col-md-6 px-5">
                        <div class="form-group">
                            {!! Form::label('source_id', __('lang.receiver'), [
                                'class' => 'form-label d-block mb-1 app()->isLocale("ar") ? text-end : text-start',
                            ]) !!}
                            {!! Form::select('source_id', $users, $cash_out->source_id, [
                                'class' => 'selectpicker form-control',
                                'data-live-search' => 'true',
                                'placeholder' => __('lang.please_select'),
                            ]) !!}
                        </div>
                    </div>
                    <div class="col-md-12 px-5">
                        <div class="form-group">
                            {!! Form::label('notes', __('lang.notes'), [
                                'class' => 'form-label d-block mb-1 app()->isLocale("ar") ? text-end : text-start',
                            ]) !!}
                            {!! Form::textarea('notes', $cash_out->notes, [
                                'class' => 'form-control modal-input app()->isLocale("ar") ? text-end : text-start',
                                'placeholder' => __('lang.notes'),
                                'rows' => 3,
                            ]) !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer d-flex justify-content-center align-content-center gap-3">
            <button type="submit" class="btn btn-primary">@lang('lang.save')</button>
            <button type="button" class="btn btn-danger" data-dismiss="modal">@lang('lang.close')</button>
        </div>

        {!! Form::close() !!}

    </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->
<script>
    $('.selectpicker').selectpicker('render')
</script>
