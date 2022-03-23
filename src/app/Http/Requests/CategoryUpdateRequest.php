<?php

namespace App\Http\Requests;

use Illuminate\Http\Request;
use Illuminate\Foundation\Http\FormRequest;

class CategoryUpdateRequest extends FormRequest
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
        Request::instance()->id ? $id = Request::instance()->id : $id = '';

        return [
            'name' => 'required|max:40|min:3',
            'file_path' => "nullable|min:3|max:250|unique:categories,file_path,$id",
            'slug' => "required|min:0|max:40|unique:categories,slug,$id"
        ];
    }
}
