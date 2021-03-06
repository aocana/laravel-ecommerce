<?php

namespace App\Http\Requests\Category;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class CategoryUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->user()->is_admin;
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        $category = request('category');

        return [
            'name' => 'required|max:40|min:3',
            'slug' => ['required', 'min:2', 'max:20', 'string', Rule::unique('categories', 'slug')->ignore($category->id)],
        ];
    }
}
