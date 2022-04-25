<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;

class ProductCreateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return auth()->user()->is_admin;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'name' => 'required|min:2|max:100',
            'slug' => 'required|unique:products,slug|min:2|max:100|string',
            'description' => 'nullable|string',
            'image' => 'required|mimes:png',
            'price' => 'required|numeric|min:1',
            'stock' => 'required|integer|min:1',
            'sku' => 'nullable|unique:products,sku',
            'is_visible' => 'required|boolean',
            'brand_id' => "nullable|exists:brands,id",
            'category_id' => "nullable|exists:categories,id",
        ];
    }
}
