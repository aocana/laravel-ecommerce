<?php

namespace App\Http\Requests\Category;

use Illuminate\Foundation\Http\FormRequest;

class CategoryUpdateRequest extends FormRequest
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
        $category = request('category');

        return [
            'name' => 'required|max:40|min:3',
            'image' => "nullable|min:3|max:250|unique:categories,image,$category->id",
            'slug' => "required|min:0|max:40|unique:categories,slug,$category->id"
        ];
    }
}
