<?php

namespace App\Http\Requests\Product;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class ProductUpdateRequest extends FormRequest
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
        $product = request('product');

        return [
            'name' => 'required|min:2|max:100',
            'slug' => ['required', 'min:2', 'max:100', 'string', Rule::unique('products', 'slug')->ignore($product->id)],
            'description' => 'nullable|string',
            'image' => 'nullable|mimes:png',
            'price' => 'required|numeric|min:1',
            'stock' => 'required|integer|min:1',
            'sku' => ['nullable', 'min:2', 'string', Rule::unique('products', 'sku')->ignore($product->sku)],
            'is_visible' => 'required|boolean',
            'brand_id' => "nullable|exists:brands,id",
            'category_id' => "nullable|exists:categories,id",
        ];
    }
}
