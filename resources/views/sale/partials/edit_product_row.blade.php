@php
$exchange_rate = !empty($sale->exchange_rate) ? $sale->exchange_rate : 1;
@endphp
@forelse ($products as $product)
@php
$Variation=\App\Models\Variation::where('id',$product->variation_id)->first();
    if($Variation){
        $stockLines=\App\Models\AddStockLine::where('sell_price','>',0)->where('variation_id',$Variation->id)
        ->latest()->first();
        $default_sell_price=$stockLines?$stockLines->sell_price : $Variation->default_sell_price;
        $default_purchase_price=$stockLines?$stockLines->purchase_price : $Variation->default_purchase_price;
        $cost_ratio_per_one = $stockLines ? $stockLines->cost_ratio_per_one : 0;

    }
@endphp
@php
 $product_all_discounts_categories = App\Models\ProductDiscount::where('product_id', $product->product_id)
                ->where(function($query){
                    $query->where('discount_start_date','<=',date('Y-m-d'));
                    $query->where('discount_end_date','>=',date('Y-m-d'));
                    $query->orWhere('is_discount_permenant',"1");
                }) ->select(
                        'id',
                        'discount_type',
                        'discount',
                        'discount_category',
                        'discount_start_date',
                        'discount_end_date',
                    )
                    ->get();

@endphp
    <tr class="product_row">
        <td style="width: 20%">


            @if ($product->variation->name != 'Default')
                <b>{{ $product->variation->name }}</b>
                <br>
                <b>{{ $product->variation->sub_sku }}</b>
            @else
                {{ $product->product->name }}
                <br>
                {{ $product->product->sku }}
            @endif
            <input type="hidden" name="transaction_sell_line[{{ $loop->index }}][transaction_sell_line_id]"
                class="transaction_sell_line_id" value="{{ $product->id }}">
            <input type="hidden" name="transaction_sell_line[{{ $loop->index }}][product_id]" class="product_id"
                value="{{ $product->product_id }}">
            <input type="hidden" name="transaction_sell_line[{{ $loop->index }}][variation_id]" class="variation_id"
                value="{{ $product->variation_id }}">
            <input type="hidden" name="transaction_sell_line[{{ $loop->index }}][purchase_price]" class="purchase_price"
                value="@if (isset($product->purchase_price)) {{ @num_format($product->purchase_price) }}@else{{ 0 }} @endif">
                <input type="hidden" name="transaction_sell_line[{{$loop->index}}][price_hidden]" class="price_hidden"
                value="@if(isset($default_sell_price)){{@num_format(($default_sell_price) / $exchange_rate)}}@else{{0}}@endif">
            <input type="hidden" name="transaction_sell_line[{{ $loop->index }}][tax_id]" class="tax_id"
                value="{{ $product->tax_id }}">
            <input type="hidden" name="transaction_sell_line[{{ $loop->index }}][tax_method]" class="tax_method"
                value="{{ $product->tax_method }}">
            <input type="hidden" name="transaction_sell_line[{{ $loop->index }}][tax_rate]" class="tax_rate"
                value="{{ @num_format($product->tax_rate) }}">
            <input type="hidden" name="transaction_sell_line[{{ $loop->index }}][item_tax]" class="item_tax"
                value="{{ @num_format($product->item_tax) }}">
            <input type="hidden" name="transaction_sell_line[{{ $loop->index }}][coupon_discount]"
                class="coupon_discount_value" value="{{ $product->coupon_discount_value }}">
            <!-- value is percentage or fixed value from coupon data -->
            <input type="hidden" name="transaction_sell_line[{{ $loop->index }}][coupon_discount_type]"
                class="coupon_discount_type" value="{{ $product->coupon_discount_type }}">
            <!-- value is percentage or fixed value from coupon data -->
            <input type="hidden" name="transaction_sell_line[{{ $loop->index }}][coupon_discount_amount]"
                class="coupon_discount_amount" value="{{ $product->coupon_discount_amount }}">
            <!-- after calculation actual discounted amount for row products row -->
        </td>
        <td style="width: 15%">
            <div class="input-group">
                <span class="input-group-btn">
                   <button type="button" class="btn btn-danger minus">
                        <span class="dripicons-minus"></span>
                    </button>
                </span>
                <input type="text" class="form-control quantity  qty numkey input-number" step="any"
                    name="transaction_sell_line[{{ $loop->index }}][quantity]" required
                    value="@if (isset($product->quantity)) {{preg_match('/\.\d*[1-9]+/', (string)$product->quantity) ? $product->quantity : @num_format($product->quantity)}}@else{{ 1 }} @endif">
                <span class="input-group-btn">
                    <button type="button" class="btn btn-success plus">
                        <span class="dripicons-plus"></span>
                    </button>
                </span>
            </div>

        </td>
        <td style="width: 15%">
            <input type="text" class="form-control sell_price"
                name="transaction_sell_line[{{ $loop->index }}][sell_price]" required
                value="@if (isset($product->sell_price)) {{ @num_format($product->sell_price) }}@else{{ 0 }} @endif">
        </td>



        <td style="width: @if(session('system_mode')  != 'restaurant') 11% @else 15% @endif">

            <div class="input-group">
                <input type="hidden" class="form-control product_discount_type  discount_type{{$product->product_id}}"
                   name="transaction_sell_line[{{$loop->index}}][product_discount_type]"
                   value="@if(!empty($product->product_discount_type)){{$product->product_discount_type}}@else{{0}}@endif">
                    <input type="hidden" class="form-control product_discount_value  discount_value{{$product->product_id}}"
                   name="transaction_sell_line[{{$loop->index}}][product_discount_value]"
                   value="@if(!empty($product->product_discount_value)){{@num_format($product->product_discount_value)}}@else{{0}}@endif">
                    <button type="button" class="btn btn-lg" id="search_button"><span class="plus_sign_text"></span></button>
                    <input type="text" class="form-control product_discount_amount  discount_amount{{$product->product_id}}"
                        name="transaction_sell_line[{{$loop->index }}][product_discount_amount]" readonly
                        value="@if(!empty($product->product_discount_amount)){{@num_format($product->product_discount_amount)}}@else{{0}}@endif">
            </div>
        </div>
        </td>
        <td style="width: @if(session('system_mode')  != 'restaurant') 11% @else 10% @endif padding:1.7rem !important;">
            <input type="hidden" value="{{$product->product_id}}" class="p-id"/>
            @if(auth()->user()->can('sp_module.sales_promotion.view')
                    || auth()->user()->can('sp_module.sales_promotion.create_and_edit')
                    || auth()->user()->can('sp_module.sales_promotion.delete'))
                    <select class="custom-select custom-select-sm  discount_category discount_category{{$product->product_id}}" style="">
                        <option selected>select</option>
                        @if(!empty($product_all_discounts_categories))
                            @foreach($product_all_discounts_categories as $discount)
                                    <option value="{{$discount->id}}"  {{(isset($product->discount_category) && $product->discount_category==$discount->discount_category)?'selected':''}}>{{$discount->discount_category}}</option>
                            @endforeach
                        @endif
                    </select>
            @else
                <select class="custom-select custom-select-sm  discount_category discount_category{{$product->product_id}}" style=""
                     disabled="disabled">
                    <option selected>select</option>
                    @if(!empty($product_all_discounts_categories))
                        @foreach($product_all_discounts_categories as $discount)
                                <option value="{{$discount->id}}">{{$discount->discount_category}}</option>
                        @endforeach
                    @endif
                </select>
            @endif
        </td>
        </td>
        <td style="width: 15%">
            <span class="sub_total_span">{{ preg_match('/\.\d*[1-9]+/', (string)$product->sub_total) ? $product->sub_total : @num_format($product->sub_total) }}</span>
            <input type="hidden" class="form-control sub_total"
                name="transaction_sell_line[{{ $loop->index }}][sub_total]"
                value="{{ preg_match('/\.\d*[1-9]+/', (string)$product->sub_total) ? $product->sub_total : @num_format($product->sub_total) }}">
        </td>
        <td style="width: 15%">
            <button type="button" class="btn btn-danger btn-sx remove_row"><i class="fa fa-times"></i></button>
        </td>
    </tr>
@empty
@endforelse
