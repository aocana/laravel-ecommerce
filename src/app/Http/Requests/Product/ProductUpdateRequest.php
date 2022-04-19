<?php

namespace App\Http\Requests\Product;

use App\Models\Brand;
use App\Models\Category;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class ProductUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        $product = request('product');
        $brands = Brand::all()->pluck('id')->implode(',');
        $categories = Category::all()->pluck('id')->implode(',');

        return [
            'name' => 'required|min:2|max:100',
            'slug' => ['required', 'min:2', 'max:100', 'string', Rule::unique('products', 'slug')->ignore($product->id)],
            'image' => 'nullable|mimes:png|min:2|max:250',
            'price' => 'required|numeric|min:1',
            'stock' => 'required|integer|min:1',
            'sku' => ['nullable', 'min:2', 'string', Rule::unique('products', 'sku')->ignore($product->sku)],
            'is_visible' => 'required|boolean',
            'brand_id' => "nullable|in:$brands",
            'category_id' => "nullable|in:$categories",
        ];
    }
}
