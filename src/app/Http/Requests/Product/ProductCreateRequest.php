<?php

namespace App\Http\Requests\Product;

use App\Models\Brand;
use App\Models\Category;
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
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        $brands = Brand::all()->pluck('id')->implode(',');
        $categories = Category::all()->pluck('id')->implode(',');

        return [
            'name' => 'required|min:2|max:100',
            'slug' => 'required|unique:products,slug|min:2|max:100',
            'image' => 'nullable|mimes:png|min:2|max:250',
            'stripe_id' => 'nullable|unique:products,stripe_id|min:2',
            'price' => 'required|numeric|min:1',
            'stock' => 'required|integer|min:1',
            'sku' => 'nullable|unique:products,sku',
            'is_visible' => 'required|boolean',
            'brand_id' => "nullable|in:$brands",
            'category_id' => "nullable|in:$categories",
        ];
    }
}
