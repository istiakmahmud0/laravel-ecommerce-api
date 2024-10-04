<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'category_id' => $this->category->id,
            'category_name' => $this->category->category_name,
            'title' => $this->title,
            'slug' => $this->slug,
            'product_img' => $this->getFirstMediaUrl('product_images'),
            'price' => $this->price,
            'quantity' => $this->quantity,
            'sku' => $this->sku,
            'rating' => $this->rating,
            'short_description' => $this->short_description,
            'long_description' => $this->long_description,
        ];
    }
}
