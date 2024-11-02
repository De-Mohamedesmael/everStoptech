<td colspan="3">
    <table style="border: 0px; width: 100%;">
        <tr>
            <input type="hidden" name="consumption_raw_materials[current_stock]"
                value="{{ preg_match('/\.\d*[1-9]+/', (string) $current_stock) ? $current_stock : @num_format($current_stock) }}">
            <td colspan="2" class="text-center"><label class="mb-0 form-label" for="">@lang('lang.current_stock'):
                    {{ preg_match('/\.\d*[1-9]+/', (string) $current_stock) ? $current_stock : @num_format($current_stock) }}</label>
            </td>
        </tr>
        @foreach ($raw_material_details as $raw_material_detail)
            <tr>
                @if (!empty($raw_material_detail->batch_number))
                    <td class="text-center"><label class="mb-0 form-label" for="">@lang('lang.batch_number'):
                            {{ $raw_material_detail->batch_number }}</label></td>
                @endif
                @if (!empty($raw_material_detail->expiry_date))
                    <td class="text-center"><label class="mb-0 form-label" for="">@lang('lang.expiry_date'):
                            @if (!empty($raw_material_detail->expiry_date))
                                {{ @format_date($raw_material_detail->expiry_date) }}
                            @endif
                        </label>
                    </td>
                @endif
            </tr>
        @endforeach
    </table>
    <table style="border: 0px; width: 100%;">
        @foreach ($consumption_products as $consumption_product)
            <tr>
                @if (!empty($edit))
                    <input type="hidden" name="consumption_details[{{ $loop->index }}][id]"
                        value="{{ $consumption_product->id }}">
                @endif
                <td style="width: 33%;">
                    <input type="hidden" name="consumption_details[{{ $loop->index }}][variation_id]"
                        value="{{ $consumption_product->variation_id }}">
                    <span class="form-label w-100 h-100 mt-1 text-center">
                        {{ $consumption_product->variation->product->name ?? '' }}
                    </span>
                </td>
                @if (!empty($edit))
                    <td style="width: 33%;">
                        {!! Form::text(
                            'consumption_details[' . $loop->index . '][quantity]',
                            !empty($consumption_product) ? $consumption_product->quantity : 0,
                            ['class' => 'form-control modal-input app()->isLocale("ar") ? text-end : text-start'],
                        ) !!}
                    </td>
                @else
                    <td style="width: 33%;">
                        {!! Form::text(
                            'consumption_details[' . $loop->index . '][quantity]',
                            !empty($consumption_product) ? $consumption_product->amount_used : 0,
                            ['class' => 'form-control modal-input app()->isLocale("ar") ? text-end : text-start'],
                        ) !!}
                    </td>
                @endif
                <td style="width: 33%;">
                    <input type="hidden" name="consumption_details[{{ $loop->index }}][unit_id]"
                        value="{{ $consumption_product->unit_id }}">
                    <span class="form-label w-100 h-100 mt-1 text-center">
                        {{ $consumption_product->unit->name ?? '' }}
                    </span>
                </td>
            </tr>
        @endforeach
    </table>

</td>
