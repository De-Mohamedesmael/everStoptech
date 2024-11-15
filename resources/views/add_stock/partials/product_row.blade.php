@php
    $i = $index;
@endphp
@forelse ($products as $product)
    @php
        $i = $i + 1;
        $current_stock = \App\Models\ProductStore::where('product_id', $product->id)
            ->where('variation_id', $product->variation_id)
            ->first();
        $stock = \App\Models\AddStockLine::where('product_id', $product->id)
            ->where('variation_id', $product->variation_id)
            ->latest()
            ->first();
        $number_vs_base_unit = \App\Models\Variation::find($product->variation_id)->number_vs_base_unit;
        if ($stock) {
            $purchase_price = str_replace(',', '', $stock->purchase_price);
            $sell_price = str_replace(',', '', $stock->sell_price);

            // $purchase_price = number_format($stock->purchase_price,2);
            // $sell_price = number_format($stock->sell_price,2);
        }
    @endphp
    <tr class="product_row">
        <td class="row_number"></td>
        <td><img src="@if (!empty($product->getFirstMediaUrl('products'))) {{ $product->getFirstMediaUrl('products') }}@else{{ asset('/uploads/' . session('logo')) }} @endif"
                alt="photo" width="50" height="50"></td>
        <td>
            <h6 style="width: 100%;height: 100%;" class="d-flex justify-content-center align-items-center">
                @if ($product->variation_name != 'Default')
                    <b>{{ $product->variation_name }} {{ $product->sub_sku }}</b>
                @else
                    {{ $product->product_name }}
                @endif
                <input type="hidden" name="is_batch_product" class="is_batch_product"
                    value="{{ isset($is_batch) ? $is_batch : null }}">
                <input type="hidden" name="row_count" class="row_count" value="{{ $i }}">
                <input type="hidden" name="add_stock_lines[{{ $i }}][is_service]" class="is_service"
                    value="{{ $product->is_service }}">
                <input type="hidden" name="add_stock_lines[{{ $i }}][product_id]" class="product_id"
                    value="{{ $product->product_id }}">
                <input type="hidden" name="add_stock_lines[{{ $i }}][variation_id]" class="variation_id"
                    value="{{ $product->variation_id }}">
            </h6>

        </td>
        <td>
            {{-- @if ($sku_sub)
            {{$sku_sub}}
            <input type="hidden" name="add_stock_lines[{{$i}}][sku_sub]" value="{{$sku_sub}}">
        @else --}}
            <h6 style="width: 100%;height: 100%;" class="d-flex justify-content-center align-items-center">
                {{ $product->sub_sku }}
            </h6>
            {{-- @endif --}}

        </td>
        <td>
            <input type="hidden"
                value="{{ isset($number_vs_base_unit) && $number_vs_base_unit != 0 ? $number_vs_base_unit : 1 }}"
                id="number_vs_base_unit" />
            <input type="text"
                class="form-control modal-input m-auto @if (app()->isLocale('ar')) text-end @else  text-start @endif quantity quantity_{{ $i }}"
                data-val="0" name="add_stock_lines[{{ $i }}][quantity]" required
                min="{{ isset($product->units->pluck('name')[0]) && in_array(strtolower($product->units->pluck('name')[0]), ['piece', 'قطعة', 'قطعه', ''], true) ? 1 : 0.00001 }}"
                value="0" index_id="{{ $i }}">
        </td>
        <td>
            <h6 style="width: 100%;height: 100%;" class="d-flex justify-content-center align-items-center">
                {{ $product->units->pluck('name')[0] ?? '' }}
            </h6>
        </td>
        <td>
            <div style="width: 100%;height: 100%;" class="d-flex justify-content-center align-items-start">
                <span class="text-secondary font-weight-bold pr-1">*</span>
                <input type="hidden" class="purchase_price_submit" value="0" />
                <input type="text"
                    class="form-control modal-input m-auto @if (app()->isLocale('ar')) text-end @else  text-start @endif purchase_price purchase_price_{{ $i }}"
                    name="add_stock_lines[{{ $i }}][purchase_price]" required
                    value="@if (isset($purchase_price)) {{ @num_format($purchase_price) }}@else @if ($product->purchase_price_depends == null) {{ @num_format($product->default_purchase_price / $exchange_rate) }} @else {{ @num_format($product->purchase_price_depends / $exchange_rate) }} @endif @endif"
                    index_id="{{ $i }}">
                <input class="final_cost" type="hidden" name="add_stock_lines[{{ $i }}][final_cost]"
                    value="@if (isset($product->default_purchase_price)) {{ @num_format($product->default_purchase_price / $exchange_rate) }}@else{{ 0 }} @endif">
            </div>
        </td>
        <td>
            <div style="width: 100%;height: 100%;" class="d-flex justify-content-center align-items-start">
                <span class="text-secondary font-weight-bold pr-1">*</span>
                <input type="hidden" class="selling_price_submit" value="0" />
                <input type="text"
                    class="form-control modal-input m-auto @if (app()->isLocale('ar')) text-end @else  text-start @endif selling_price selling_price_{{ $i }}"
                    name="add_stock_lines[{{ $i }}][selling_price]" required index_id="{{ $i }}"
                    value="@if (isset($sell_price)) {{ @num_format($sell_price) }}@else @if ($product->selling_price_depends == null) {{ @num_format($product->sell_price) }} @else {{ @num_format($product->selling_price_depends) }} @endif @endif">
                {{--        <input class="final_cost" type="hidden" name="add_stock_lines[{{$i}}][final_cost]" value="@if (isset($products->default_purchase_price)){{@num_format($products->default_purchase_price / $exchange_rate)}}@else{{0}}@endif"> --}}
            </div>
        </td>
        <td>
            <h6 style="width: 100%;height: 100%;" class="d-flex justify-content-center align-items-center">
                <span class="sub_total_span"></span>
            </h6>
            <input type="hidden" class="form-control sub_total" name="add_stock_lines[{{ $i }}][sub_total]"
                value="">
        </td>
        <td>
            <input type="hidden" name="current_stock" class="current_stock current_stock{{ $product->id }}"
                value="@if ($product->is_service) {{ 0 }} @else @if (isset($current_stock->qty_available)){{ $current_stock->qty_available }}@else{{ 0 }} @endif @endif">
            <h6 style="width: 100%;height: 100%;" class="d-flex justify-content-center align-items-center">

                <span class="current_stock_text current_stock_text{{ $product->id }}">
                    @if ($current_stock->is_service) {{ '-' }}
                    @else
                        @if (isset($current_stock->qty_available))
                            {{ @num_format($current_stock->qty_available) }}@else{{ 0 }}@endif
                    @endif
                </span>
            </h6>
        </td>
        <td>
            <div class="i-checks"><input name="add_stock_lines[{{ $i }}][stock_pricechange]" id="active"
                    type="checkbox" class="stock_pricechange stockId{{ $i }}" checked value="1"></div>
        </td>
        <td>
            <button type="button" class="btn btn-sm p-1 mb-1 btn-danger remove_row"
                data-index="{{ $i }}"><i class="fa fa-times"></i></button>
            <div onclick="showDetails({{ $i }})" class="btn btn-sm p-1  btn-main">
                <i id="arrow{{ $i }}" class="fa fa-arrow-down"></i>
            </div>
        </td>
    </tr>



    <tr id="row_details_{{ $i }}" class="row_details_{{ $i }} row_details "
        style="display: none">
        <td colspan="2"> {!! Form::label('', __('lang.batch_number'), [
            'class' => 'form-label d-block mb-1 app()->isLocale("ar") ? text-end : text-start',
        ]) !!}
            {!! Form::text('add_stock_lines[' . $i . '][batch_number]', null, [
                'class' => ' batchNumber form-control modal-input app()->isLocale("ar") ? text-end : text-start ',
            ]) !!}
            <button type="button" class="btn btn-main mt-1 add_new_batch" id="addBatch"
                data-index="{{ $i }}" data-product="{{ $product }}"
                index_id="{{ $i }}">
                {{ __('lang.add_a_new_batch') }}
            </button>

            {{-- @include(
            'quotation.partial.new_batch_modal'
        ) --}}
        </td>
        <td colspan="2"> {!! Form::label('', __('lang.manufacturing_date'), [
            'class' => 'form-label d-block mb-1 app()->isLocale("ar") ? text-end : text-start',
        ]) !!}
            {!! Form::text('add_stock_lines[' . $i . '][manufacturing_date]', null, [
                'class' => 'form-control modal-input app()->isLocale("ar") ? text-end : text-start datepicker',
            ]) !!}
        </td>
        <td colspan="2"> {!! Form::label('', __('lang.expiry_date'), [
            'class' => 'form-label d-block mb-1 app()->isLocale("ar") ? text-end : text-start',
        ]) !!}
            {!! Form::text('add_stock_lines[' . $i . '][expiry_date]', null, [
                'class' => 'form-control modal-input app()->isLocale("ar") ? text-end : text-start datepicker expiry_date',
            ]) !!}
        </td>
        <td colspan="2"> {!! Form::label('', __('lang.days_before_the_expiry_date'), [
            'class' => 'form-label d-block mb-1 app()->isLocale("ar") ? text-end : text-start',
        ]) !!}
            {!! Form::text('add_stock_lines[' . $i . '][expiry_warning]', null, [
                'class' => 'form-control modal-input app()->isLocale("ar") ? text-end : text-start days_before_the_expiry_date',
            ]) !!}
        </td>
        <td colspan="2"> {!! Form::label('', __('lang.convert_status_expire'), [
            'class' => 'form-label d-block mb-1 app()->isLocale("ar") ? text-end : text-start',
        ]) !!}
            {!! Form::text('add_stock_lines[' . $i . '][convert_status_expire]', null, [
                'class' => 'form-control modal-input app()->isLocale("ar") ? text-end : text-start',
            ]) !!}
        </td>
        <td class="td_add_qty_bounce" colspan="2">
            <button type="button" class="btn mt-4 btn-main add_bounce_btn" index_id="{{ $i }}">
                {{ __('lang.add_a_free_amount') }}
            </button>
        </td>
    </tr>



    <tr id="bounce_details_td_{{ $i }}" class="hide bounce_details_td_{{ $i }} trdata "
        style="display: none">
        <td colspan="2">
            {!! Form::label('', __('lang.batch_number'), [
                'class' => 'form-label d-block mb-1 app()->isLocale("ar") ? text-end : text-start',
            ]) !!}
            {!! Form::text('add_stock_lines[' . $i . '][bounce_batch_number]', null, [
                'class' => 'form-control  modal-input app()->isLocale("ar") ? text-end : text-start',
            ]) !!}
        </td>
        <td colspan="2"> {!! Form::label('', __('lang.manufacturing_date'), [
            'class' => 'form-label d-block mb-1 app()->isLocale("ar") ? text-end : text-start',
        ]) !!}

            {!! Form::text('add_stock_lines[' . $i . '][bounce_manufacturing_date]', null, [
                'class' => 'form-control  modal-input app()->isLocale("ar") ? text-end : text-start datepicker',
                'readonly',
            ]) !!}
        </td>
        <td colspan="2"> {!! Form::label('', __('lang.expiry_date'), [
            'class' => 'form-label d-block mb-1 app()->isLocale("ar") ? text-end : text-start',
        ]) !!}
            {!! Form::text('add_stock_lines[' . $i . '][bounce_expiry_date]', null, [
                'class' => 'form-control  modal-input app()->isLocale("ar") ? text-end : text-start datepicker expiry_date',
                'readonly',
            ]) !!}
        </td>
        <td colspan="2"> {!! Form::label('', __('lang.days_before_the_expiry_date'), [
            'class' => 'form-label d-block mb-1 app()->isLocale("ar") ? text-end : text-start',
        ]) !!}
            {!! Form::text('add_stock_lines[' . $i . '][bounce_expiry_warning]', null, [
                'class' => 'form-control  modal-input app()->isLocale("ar") ? text-end : text-start days_before_the_expiry_date',
            ]) !!}
        </td>
        <td colspan="2"> {!! Form::label('', __('lang.convert_status_expire'), [
            'class' => 'form-label d-block mb-1 app()->isLocale("ar") ? text-end : text-start',
        ]) !!}
            {!! Form::text('add_stock_lines[' . $i . '][bounce_convert_status_expire]', null, [
                'class' => 'form-control  modal-input app()->isLocale("ar") ? text-end : text-start',
            ]) !!}


        </td>
        <td colspan="4">
            <div class="add_qty_bounce_dive_{{ $i }} hide d-flex flex-wrap flex-row">
                <div class="form-group col-md-6 mb-1 d-flex flex-column p-1">

                    <label
                        class="form-label d-block mb-0  @if (app()->isLocale('ar')) text-end @else text-start @endif">
                        {{ __('lang.free_amount') }}</label>
                    {!! Form::text('add_stock_lines[' . $i . '][bounce_qty]', null, [
                        'class' => 'form-control modal-input app()->isLocale("ar") ? text-end : text-start bounce_qty bounce_qty_' . $i,
                        'index_id' => "$i",
                    ]) !!}
                </div>
                <div class="form-group col-md-6 mb-1 d-flex flex-column p-1">

                    <label
                        class="form-label d-block mb-0  @if (app()->isLocale('ar')) text-end @else text-start @endif">
                        {{ __('lang.profit') }}</label>
                    {!! Form::text('add_stock_lines[' . $i . '][bounce_profit]', null, [
                        'class' => 'form-control modal-input app()->isLocale("ar") ? text-end : text-start bounce_profit_' . $i,
                        'readonly',
                    ]) !!}
                </div>
                <div class="form-group col-md-12 d-flex flex-column p-1">
                    <label
                        class="form-label d-block mb-0  @if (app()->isLocale('ar')) text-end @else text-start @endif">
                        {{ __('lang.new_purchase_price') }}</label>
                    {!! Form::text('add_stock_lines[' . $i . '][bounce_purchase_price]', null, [
                        'class' => 'form-control modal-input app()->isLocale("ar") ? text-end : text-start bounce_purchase_price_' . $i,
                        'readonly',
                    ]) !!}
                </div>
            </div>
        </td>
    </tr>


@empty
@endforelse

<script>
    $('.datepicker').datepicker({
        language: "{{ session('language') }}",
        todayHighlight: true,
    })
    // let quantity = parseInt($(".quantity").val()),
    //     purchase_price = parseInt($(".purchase_price").val()),
    //     sell_price = parseInt($(".selling_price").val()),
    //     bounce_profit = $(".bounce_profit").val(),
    //     bounce_purchase_price = $(".bounce_purchase_price").val();
    //
    // $(".bounce_qty").keyup(function(){
    //     let all_ty = parseInt($(".bounce_qty").val()) + quantity;
    //     let bounce_purchase_price_val = all_ty / sell_price;
    //     let bounce_profit_val = sell_price - all_ty;
    //     $(".bounce_purchase_price").val(bounce_purchase_price_val);
    //     $(".bounce_profit").val( bounce_profit_val);
    // });
</script>
