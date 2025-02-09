<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'category_id' => ['required'],
            'title' => ['required', 'string'],
            // 'product_img' => ['sometimes', 'image', 'mimes:png,jpg,jpeg,gif', 'max:2048'],
            'price' => ['required', 'numeric'],
            'quantity' => ['required', 'numeric'],
            'sku' => ['required', 'numeric'],
            'rating' => ['required', 'numeric'],
            'short_description' => ['required', 'string'],
            'long_description' => ['required', 'string'],
        ];
    }
}
