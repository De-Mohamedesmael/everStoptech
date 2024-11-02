<div class="modal-dialog" role="document">
    <div class="modal-content">
        {!! Form::open([
            'url' => action('ManufacturerController@update', $manufacturer->id),
            'method' => 'put',
            'id' => 'manufacturer_add_form',
            'files' => true,
        ]) !!}
        <div
            class="modal-header position-relative border-0 d-flex justify-content-between align-items-center @if (app()->isLocale('ar')) flex-row-reverse @else flex-row @endif">
            <h5 class="modal-title  px-2 position-relative d-flex align-items-center" style="gap: 5px;">@lang('lang.edit_manufacturer')
            </h5>
            <button type="button" data-dismiss="modal" aria-label="Close"
                class="close  btn btn-danger d-flex justify-content-center align-items-center rounded-circle text-white"><span
                    aria-hidden="true"><i class="dripicons-cross"></i></span></button>
            <span class="position-absolute modal-border"></span>
        </div>
        <div class="modal-body">
            <div class="d-flex justify-content-between align-items-end  flex-column">
                {!! Form::label('name', __('lang.name') . '*', [
                    'class' => 'form-label d-block mb-1 app()->isLocale("ar") ? text-end : text-start',
                ]) !!}
                <div class="input-group my-group">
                    {!! Form::text('name', $manufacturer->name, [
                        'class' => 'form-control modal-input  app()->isLocale("ar") ? text-end : text-start',
                        'style' => 'width:80% !important',
                        'placeholder' => __('lang.name'),
                        'required',
                    ]) !!}
                    <span class="input-group-btn">
                        <button class="btn btn-default bg-white btn-flat btn-sm translation_btn" type="button"
                            data-type="manufacturer"><i class="dripicons-web text-primary"></i></button>
                    </span>
                </div>
            </div>
            @include('layouts.partials.translation_inputs', [
                'attribute' => 'name',
                'translations' => $manufacturer->translations,
                'type' => 'manufacturer',
            ])
        </div>

        <div class="modal-footer d-flex justify-content-center align-content-center gap-3">
            <button type="submit" class="btn btn-main">@lang('lang.update')</button>
            <button type="button" class="btn btn-default" data-dismiss="modal">@lang('lang.close')</button>
        </div>

        {!! Form::close() !!}

    </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->
