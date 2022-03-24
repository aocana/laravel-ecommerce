<?php

namespace App\Http\Requests\Category;

use Illuminate\Foundation\Http\FormRequest;

class CategoryCreateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     * @return array
     */
    public function rules(): array
    {
        return [
            'name' => 'required|min:3|max:40',
            'image' => 'unique:categories,image|mimes:png|nullable|min:3|max:250',
            'slug' => 'required|unique:categories,slug|min:3|max:40'
        ];
    }
}
