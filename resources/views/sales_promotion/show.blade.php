<div class="modal-dialog" role="document">
    <div class="modal-content">
        <div
            class="modal-header position-relative border-0 d-flex justify-content-between align-items-center @if (app()->isLocale('ar')) flex-row-reverse @else flex-row @endif">

            <h5 class="modal-title  px-2 position-relative d-flex align-items-center" style="gap: 5px;">@lang('lang.sales_promotion_formal_discount')
            </h5>
            <button type="button" data-dismiss="modal" aria-label="Close"
                class="close  btn btn-danger d-flex justify-content-center align-items-center rounded-circle text-white"><span
                    aria-hidden="true"><i class="dripicons-cross"></i></span></button>
            <span class="position-absolute modal-border"></span>
        </div>

        <div class="modal-body">
            <div class="row">
                <div class="col-md-12 d-flex justify-content-center mb-2">
                    <h4
                        class="count_wrapper col-md-8 d-flex @if (app()->isLocale('ar')) flex-row-reverse @else flex-row @endif">
                        <span class="count_title col-md-6"> {{ __('lang.name') }}</span>
                        <span class="count_value_style col-md-6 d-flex justify-content-start">
                            {{ $sales_promotion->name }}
                        </span>
                    </h4>
                </div>
                <div class="col-md-12 d-flex justify-content-center mb-2">
                    <h4
                        class="count_wrapper col-md-8 d-flex @if (app()->isLocale('ar')) flex-row-reverse @else flex-row @endif">
                        <span class="count_title col-md-6">{!! Form::label('store_ids', __('lang.store'), [
                            'class' => 'form-label d-flex justify-content-center mb-1 app()->isLocale("ar") ? text-end : text-start',
                        ]) !!}</span>
                        <span
                            class="count_value_style col-md-6 d-flex justify-content-start">{{ implode(', ', $sales_promotion->stores->pluck('name')->toArray()) }}
                        </span>
                    </h4>
                </div>
                <div class="col-md-12 d-flex justify-content-center mb-2">
                    <h4
                        class="count_wrapper col-md-8 d-flex @if (app()->isLocale('ar')) flex-row-reverse @else flex-row @endif">
                        <span class="count_title col-md-6">{!! Form::label('customer_type_ids', __('lang.customer_type'), [
                            'class' => 'form-label d-flex justify-content-center mb-1 app()->isLocale("ar") ? text-end : text-start',
                        ]) !!}</span>
                        <span class="count_value_style col-md-6 d-flex justify-content-start">
                            {{ implode(', ', $sales_promotion->customer_types->pluck('name')->toArray()) }}
                        </span>
                    </h4>
                </div>
                @if ($sales_promotion->product_condition)
                    <div class="col-md-12 d-flex justify-content-center mb-2">
                        <h4
                            class="count_wrapper col-md-8 d-flex @if (app()->isLocale('ar')) flex-row-reverse @else flex-row @endif">
                            <span class="count_title col-md-6">{!! Form::label('product_ids', __('lang.product'), [
                                'class' => 'form-label d-flex justify-content-center mb-1 app()->isLocale("ar") ? text-end : text-start',
                            ]) !!}</span>
                            <span class="count_value_style col-md-6 d-flex justify-content-start">
                                {{ implode(', ', $sales_promotion->products->pluck('name')->toArray()) }}
                            </span>
                        </h4>
                    </div>
                @endif
                @if ($sales_promotion->purchase_condition)
                    <div class="col-md-12 d-flex justify-content-center mb-2">
                        <h4
                            class="count_wrapper col-md-8 d-flex @if (app()->isLocale('ar')) flex-row-reverse @else flex-row @endif">
                            <span class="count_title col-md-6">{!! Form::label('purchase_condition_amount', __('lang.purchase_condition_amount'), [
                                'class' => 'form-label d-flex justify-content-center mb-1 app()->isLocale("ar") ? text-end : text-start',
                            ]) !!}</span>
                            <span class="count_value_style col-md-6 d-flex justify-content-start">
                                {{ @num_format($sales_promotion->purchase_condition_amount) }}
                            </span>
                        </h4>
                    </div>
                @endif
                <div class="col-md-12 d-flex justify-content-center mb-2">
                    <h4
                        class="count_wrapper col-md-8 d-flex @if (app()->isLocale('ar')) flex-row-reverse @else flex-row @endif">
                        <span class="count_title col-md-6">{!! Form::label('discount_type', __('lang.discount_type'), [
                            'class' => 'form-label d-flex justify-content-center mb-1 app()->isLocale("ar") ? text-end : text-start',
                        ]) !!}</span>
                        <span class="count_value_style col-md-6 d-flex justify-content-start">
                            {{ ucfirst($sales_promotion->discount_type) }}
                        </span>
                    </h4>
                </div>
                <div class="col-md-12 d-flex justify-content-center mb-2">
                    <h4
                        class="count_wrapper col-md-8 d-flex @if (app()->isLocale('ar')) flex-row-reverse @else flex-row @endif">
                        <span class="count_title col-md-6">{!! Form::label('discount_value', __('lang.discount'), [
                            'class' => 'form-label d-flex justify-content-center mb-1 app()->isLocale("ar") ? text-end : text-start',
                        ]) !!}</span>
                        <span class="count_value_style col-md-6 d-flex justify-content-start">
                            {{ @num_format($sales_promotion->discount_value) }}
                        </span>
                    </h4>
                </div>
                <div class="col-md-12 d-flex justify-content-center mb-2">
                    <h4
                        class="count_wrapper col-md-8 d-flex @if (app()->isLocale('ar')) flex-row-reverse @else flex-row @endif">
                        <span class="count_title col-md-6">{!! Form::label('start_date', __('lang.start_date'), [
                            'class' => 'form-label d-flex justify-content-center mb-1 app()->isLocale("ar") ? text-end : text-start',
                        ]) !!}</span>
                        <span class="count_value_style col-md-6 d-flex justify-content-start">
                            @if (!empty($sales_promotion->start_date))
                                {{ @format_date($sales_promotion->start_date) }}
                            @endif
                        </span>

                    </h4>
                </div>
                <div class="col-md-12 d-flex justify-content-center mb-2">
                    <h4
                        class="count_wrapper col-md-8 d-flex @if (app()->isLocale('ar')) flex-row-reverse @else flex-row @endif">
                        <span class="count_title col-md-6">{!! Form::label('expiry_date', __('lang.expiry_date'), [
                            'class' => 'form-label d-flex justify-content-center mb-1 app()->isLocale("ar") ? text-end : text-start',
                        ]) !!}</span>
                        <span class="count_value_style col-md-6 d-flex justify-content-start">
                            @if (!empty($sales_promotion->end_date))
                                {{ @format_date($sales_promotion->end_date) }}
                            @endif
                        </span>

                    </h4>
                </div>
            </div>
        </div>

        <div class="modal-footer d-flex justify-content-center align-content-center gap-3">
            <button type="button" class="btn btn-danger" data-dismiss="modal">@lang('lang.close')</button>
        </div>

    </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->
