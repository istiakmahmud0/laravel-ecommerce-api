<?php

namespace App\Http\Requests;


use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CategoryRequest extends FormRequest
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
    public function rules(Request $request): array
    {

        $rules = [
            'category_name' => ['required', 'string', Rule::unique('categories')->ignore($this->route('category'))],
            'category_img' => ['sometimes', 'image', 'mimes:png,jpg,jpeg,gif', 'max:2048']
        ];

        // if ($this->isMethod('post')) {
        //     $rules['category_name'] = 'required';
        // } elseif ($this->isMethod('put') || $this->isMethod('patch')) {

        //     $rules['category_name'] = 'sometimes';
        // }

        return $rules;
    }
}
