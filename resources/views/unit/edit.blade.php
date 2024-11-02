<div class="modal-dialog" role="document">
    <div class="modal-content">

        {!! Form::open([
            'url' => action('UnitController@update', $unit->id),
            'method' => 'put',
            'id' => 'unit_add_form',
        ]) !!}

        <div
            class="modal-header position-relative border-0 d-flex justify-content-between align-items-center @if (app()->isLocale('ar')) flex-row-reverse @else flex-row @endif">

            <h4 class="modal-title px-2 position-relative">@lang('lang.edit')
                <span class=" header-modal-pill"></span>
            </h4>
            <button type="button"
                class="close btn btn-danger d-flex justify-content-center align-items-center rounded-circle text-white"
                data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <span class="position-absolute modal-border"></span>
        </div>

        <div
            class="modal-body row @if (app()->isLocale('ar')) flex-row-reverse justify-content-end @else justify-content-start flex-row @endif align-items-center">
            <div class="col-sm-6 mb-2">
                {!! Form::label('name', __('lang.name') . '*', [
                    'class' => 'form-label d-block mb-1 app()->isLocale("ar") ? text-end : text-start',
                ]) !!}
                {!! Form::text('name', $unit->name, [
                    'class' => 'form-control modal-input app()->isLocale("ar") ? text-end : text-start',
                    'placeholder' => __('lang.name'),
                    'required',
                ]) !!}
            </div>
            {{-- @if (!empty($unit->is_raw_material_unit)) --}}
            <div class="col-sm-6 mb-2">
                {!! Form::label('info', __('lang.info'), [
                    'class' => 'form-label d-block mb-1 app()->isLocale("ar") ? text-end : text-start',
                ]) !!}
                {!! Form::textarea('description', $unit->description, [
                    'class' => 'form-control modal-input app()->isLocale("ar") ? text-end : text-start',
                    'placeholder' => __('lang.info'),
                    'rows' => 3,
                    'style' => 'height:30px',
                ]) !!}
            </div>
            <div class="col-sm-6 mb-2">
                {!! Form::label('base_unit_multiplier', __('lang.times_of'), [
                    'class' => 'form-label d-block mb-1 app()->isLocale("ar") ? text-end : text-start',
                ]) !!}
                {!! Form::text('base_unit_multiplier', @num_format($unit->base_unit_multiplier), [
                    'class' => 'form-control modal-input app()->isLocale("ar") ? text-end : text-start',
                    'placeholder' => __('lang.times_of'),
                ]) !!}
            </div>
            <div class="col-sm-6 mb-2">
                {!! Form::label('base_unit_id', __('lang.base_unit'), [
                    'class' => 'form-label d-block mb-1 app()->isLocale("ar") ? text-end : text-start',
                ]) !!}
                {!! Form::select('base_unit_id', $units, $unit->base_unit_id, [
                    'class' => 'form-control selectpicker',
                    'placeholder' => __('lang.select_base_unit'),
                    'data-live-search' => 'true',
                ]) !!}
            </div>
            {{-- @endif --}}
        </div>

        <div class="modal-footer d-flex justify-content-center align-content-center gap-3">

            <button type="submit" class="btn col-3 py-1 btn-main">@lang('lang.save')</button>
            <button type="button" class="btn col-3 py-1 btn-danger" data-dismiss="modal">@lang('lang.close')</button>
        </div>

        {!! Form::close() !!}

    </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->
<script>
    $('.selectpicker').selectpicker('render');
</script>
