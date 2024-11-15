<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'translations' => $this->translations,
            'product_class_id' => $this->product_class_id,
            'image' => !empty($this->getFirstMediaUrl('products')) ? $this->getFirstMediaUrl('products') : null,
            'sku' => $this->sku,
            'size_id' => $this->size_id,
            'is_service' => $this->is_service,
            'product_details' => $this->product_details,
            'purchase_price' => $this->purchase_price,
            'sell_price' => $this->sell_price,
            'discount_type' => $this->discount_type,
            'discount' => $this->discount,
            'discount_start_date' => $this->discount_start_date,
            'discount_end_date' => $this->discount_end_date,
            'type' => $this->type,
            'active' => $this->active,
            'variations' => $this->variations,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
