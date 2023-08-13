<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
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
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name'=>'required|max:255|string',
            'display_order'=>'required|numeric',
            'parent_category'=>'numeric|exists:categories,id,' . $this->route('category'),
            'status'=>'required|boolean',
            'image'=>'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'color_code' => ['required', 'regex:/^#([0-9a-f]{3}|[0-9a-f]{6})$/i'],
        ];
    }
}