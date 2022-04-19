<?php

namespace App\Http\Requests\Brand;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class BrandUpdateRequest extends FormRequest
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
     */
    public function rules(): array
    {
        $brand = request('brand');
        return [
            'name' => 'required|min:2|max:20',
            'image' => "nullable|min:2|max:250|unique:brands,image,$brand->id",
            'slug' => ['required', 'min:2', 'max:20', 'string', Rule::unique('brands', 'slug')->ignore($brand->id)],
        ];
    }
}
