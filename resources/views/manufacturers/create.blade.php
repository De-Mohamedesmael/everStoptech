<div class="modal-dialog" role="document">
    <div class="modal-content">

        {!! Form::open([
            'url' => action('ManufacturerController@store'),
            'method' => 'post',
            'id' => $quick_add ? 'quick_add_manufacturer_form' : 'manufacturer_add_form',
            'files' => true,
        ]) !!}

        <div
            class="modal-header position-relative border-0 d-flex justify-content-between align-items-center @if (app()->isLocale('ar')) flex-row-reverse @else flex-row @endif">
            <h4 class="modal-title px-2 position-relative d-flex align-items-center" style="gap: 5px;">@lang('lang.add_manufacturer')
            </h4>
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
                    {!! Form::text('name', null, [
                        'class' => 'form-control modal-input  app()->isLocale("ar") ? text-end : text-start',
                        'style' => 'width:80% !important',
                        'placeholder' => __('lang.name'),
                        'required',
                    ]) !!}
                    <span class="input-group-btn">
                        <button class="btn btn-default btn-sm bg-white btn-flat translation_btn" type="button"
                            data-type="manufacturer"><i class="dripicons-web text-primary fa-lg"></i></button>
                    </span>
                </div>
            </div>
            @include('layouts.partials.translation_inputs', [
                'attribute' => 'name',
                'translations' => [],
                'type' => 'manufacturer',
            ])
        </div>

        <div class="modal-footer d-flex justify-content-center align-content-center gap-3">
            <button type="submit" class="btn btn-main">@lang('lang.save')</button>
            <button type="button" class="btn btn-default" data-dismiss="modal">@lang('lang.close')</button>
        </div>

        {!! Form::close() !!}

    </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->
<script>
    $('#cat_product_class_id').selectpicker('render');
    $('#parent_id').selectpicker('render');

    @if ($type == 'manufacturer')
        $('.view_modal').on('shown.bs.modal', function() {
            $("#cat_product_class_id").selectpicker("val", $('#product_class_id').val());
        })
    @endif
</script>
