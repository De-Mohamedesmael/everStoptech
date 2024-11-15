<!-- shipping_cost modal -->
<div id="delivery-cost-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true"
    class="modal fade text-left">
    <div role="document" class="modal-dialog">
        <div class="modal-content">
            <div
                class="modal-header position-relative border-0 d-flex justify-content-between align-items-center @if (app()->isLocale('ar')) flex-row-reverse @else flex-row @endif">
                <h5 class="modal-title position-relative d-flex align-items-center" style="gap: 5px;">
                    {{ __('lang.delivery') }}
                    <span class=" header-pill"></span>
                </h5>
                <button type="button" data-dismiss="modal" aria-label="Close"
                    class="close btn btn-danger d-flex justify-content-center align-items-center rounded-circle text-white"><span
                        aria-hidden="true"><i class="dripicons-cross"></i></span></button>
                <span class="position-absolute modal-border"></span>
            </div>
            <div
                class="modal-body row @if (app()->isLocale('ar')) flex-row-reverse justify-content-end @else justify-content-start flex-row @endif align-items-center">

                <div class="col-md-12">
                    <div class="form-group">
                        <label for="customer_name">@lang('lang.customer_name'): <span class="customer_name"></span></label>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="address">@lang('lang.address'): <span class="customer_address"></span></label>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="due" style="color: red;">@lang('lang.due'): <span
                                class="customer_due"></span></label>
                    </div>
                </div>

                <div class="col-sm-6 mb-2">
                    <label
                        class="form-label d-block mb-1  @if (app()->isLocale('ar')) text-end @else text-start @endif"
                        for="delivery_zone_id">@lang('lang.delivery_zone')</label>
                    <select class="form-control selectpicker" name="delivery_zone_id" id="delivery_zone_id"
                        data-live-search="true">
                        <option value="" selected>@lang('lang.select_the_zone')</option>
                        @foreach ($delivery_zones as $key => $name)
                            <option @if (!empty($transaction) && $transaction->delivery_zone_id == $key) selected @endif value="{{ $key }}">
                                {{ $name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-sm-6 mb-2">
                    <label
                        class="form-label d-block mb-1  @if (app()->isLocale('ar')) text-end @else text-start @endif"
                        for="delivery_zone_id">@lang('lang.or_enter_manually')</label>
                    <input type="text"
                        class="form-control modal-input  @if (app()->isLocale('ar')) text-end @else  text-start @endif"
                        name="manual_delivery_zone" id="manual_delivery_zone" placeholder="@lang('lang.or_enter_manually')"
                        value="@if (!empty($transaction->manual_delivery_zone)) {{ $transaction->manual_delivery_zone }} @endif">
                </div>

                <div class="col-sm-6 mb-2">
                    <label for="deliveryman_id"
                        class="form-label d-block mb-1  @if (app()->isLocale('ar')) text-end @else text-start @endif">@lang('lang.deliveryman')</label>
                    <div class="form-group mb-0">
                        <select class="form-control selectpicker" name="deliveryman_id" id="deliveryman_id"
                            data-live-search="true">
                            @foreach ($deliverymen as $key => $name)
                                <option @if (!empty($transaction) && $transaction->deliveryman_id == $key) selected @endif value="{{ $key }}">
                                    {{ $name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <input type="hidden" name="deliveryman_id_hidden" id="deliveryman_id_hidden"
                        value="@if (!empty($transaction)) {{ $transaction->deliveryman_id }} @endif">
                </div>
                <div class="col-sm-6 mb-2">
                    <label
                        class="form-label d-block mb-1  @if (app()->isLocale('ar')) text-end @else text-start @endif"
                        for="delivery_cost">@lang('lang.delivery_cost')</label>
                    @if (auth()->user()->can('settings.delivery_zone_cost.create_and_edit'))
                        {!! Form::text('delivery_cost', !empty($transaction) ? $transaction->delivery_cost : null, [
                            'class' => 'form-control modal-input app()->isLocale("ar") ? text-end : text-start',

                            'id' => 'delivery_cost',
                        ]) !!}
                    @else
                        {!! Form::text('delivery_cost', !empty($transaction) ? $transaction->delivery_cost : null, [
                            'class' => 'form-control modal-input app()->isLocale("ar") ? text-end : text-start',

                            'id' => 'delivery_cost',
                            'readonly' => true,
                        ]) !!}
                    @endif
                </div>
                <div class="col-sm-6 mb-2">
                    <label class="checkbox-inline form-label d-flex justify-content-end align-items-center"
                        style="gap: 5px">
                        <input type="checkbox" class="delivery_cost_paid_by_customer"
                            name="delivery_cost_paid_by_customer"
                            @if (!empty($transaction) && $transaction->delivery_cost_paid_by_customer == 0) @else checked @endif value="1"
                            id="delivery_cost_paid_by_customer">
                        @lang('lang.delivery_cost_paid_by_customer')
                    </label>
                </div>
                <div class="col-sm-6 mb-2">
                    <label class="checkbox-inline form-label  d-flex justify-content-end align-items-center"
                        style="gap: 5px">
                        <input type="checkbox" class="delivery_cost_given_to_deliveryman"
                            name="delivery_cost_given_to_deliveryman" @if (!empty($transaction) && $transaction->delivery_cost_given_to_deliveryman == 1) checked @endif
                            value="1" id="delivery_cost_given_to_deliveryman">
                        @lang('lang.delivery_cost_given_to_deliveryman')
                    </label>
                </div>
                <div class="col-md-12 mb-2">
                    <label
                        class="form-label d-block mb-1  @if (app()->isLocale('ar')) text-end @else text-start @endif"
                        for="delivery_address">@lang('lang.delivery_address'):</label>
                    {!! Form::textarea(
                        'delivery_address',
                        !empty($transaction->delivery_address) ? $transaction->delivery_address : null,
                        ['class' => 'form-control modal-input app()->isLocale("ar") ? text-end : text-start delivery_address', 'rows' => 2],
                    ) !!}
                </div>
            </div>
            <div class="modal-footer mb-3 d-flex justify-content-center align-content-center gap-3">
                <button type="button" id= "delivery_cost_btn" name="delivery_cost_btn" class="col-3 py-1 btn btn-main"
                    data-dismiss="modal">{{ __('lang.submit') }}</button>
                <button type="button" class="col-3 py-1 btn btn-danger"
                    data-dismiss="modal">@lang('lang.close')</button>
            </div>
        </div>
    </div>
</div>
