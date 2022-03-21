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
            'file_path' => 'unique:categories,file_path|nullable|min:3|max:250',
            'slug' => 'unique:categories,slug|required|min:3|max:40'
        ];
    }
}
