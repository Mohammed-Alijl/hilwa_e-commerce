<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AttributeValueRequest extends FormRequest
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
            'name'=>'required|string|max:255',
            'attribute_id'=>'required|numeric|exists:attributes,id',
            'image_value'=>'nullable|image|mimes:jpeg,jpg,png,svg|max:5000',
            'color_code_value'=>['regex:/^#([0-9a-f]{3}|[0-9a-f]{6})$/i'],
        ];
    }
}
