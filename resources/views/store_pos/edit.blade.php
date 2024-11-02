<div class="modal-dialog" role="document">
    <div class="modal-content">

        {!! Form::open([
            'url' => action('StorePosController@update', $store_pos->id),
            'method' => 'put',
            'id' => 'store_pos_edit_form',
        ]) !!}

        <div
            class="modal-header  position-relative border-0 d-flex justify-content-between align-items-center @if (app()->isLocale('ar')) flex-row-reverse @else flex-row @endif">

            <h4 class="modal-title  px-2 position-relative">@lang('lang.edit_pos_for_store')
                <span class=" header-modal-pill"></span>

            </h4>
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
                {!! Form::select('store_id', $stores, $store_pos->store_id, [
                    'class' => 'selectpicker form-control',
                    'data-live-search' => 'true',
                    'required',
                    'style' => 'width: 80%',
                    'placeholder' => __('lang.please_select'),
                ]) !!}
            </div>
            <div class="form-group col-md-6 px-5">
                {!! Form::label('name', __('lang.name') . '*', [
                    'class' => 'form-label d-block mb-1 app()->isLocale("ar") ? text-end : text-start',
                ]) !!}
                {!! Form::text('name', $store_pos->name, [
                    'class' => 'form-control  modal-input app()->isLocale("ar") ? text-end : text-start',
                    'placeholder' => __('lang.name'),
                    'required',
                ]) !!}
            </div>
            <div class="form-group col-md-6 px-5">
                {!! Form::label('admin_id', __('lang.user') . '*', [
                    'class' => 'form-label d-block mb-1 app()->isLocale("ar") ? text-end : text-start',
                ]) !!}
                {!! Form::select('admin_id', $users, $store_pos->admin_id, [
                    'class' => 'selectpicker form-control',
                    'data-live-search' => 'true',
                    'required',
                    'style' => 'width: 80%',
                    'placeholder' => __('lang.please_select'),
                ]) !!}
            </div>

        </div>

        <div class="modal-footer d-flex justify-content-center align-content-center gap-3">
            <button type="submit" class="btn btn-main col-md-3">@lang('lang.save')</button>
            <button type="button" class="btn btn-danger col-md-3 py-1" data-dismiss="modal">@lang('lang.close')</button>
        </div>

        {!! Form::close() !!}

    </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->

<script>
    $('.selectpicker').selectpicker('render');
</script>
