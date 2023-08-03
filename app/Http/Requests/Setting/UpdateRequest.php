<?php

namespace App\Http\Requests\Setting;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
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
            'display_name' => 'nullable|string',
            'namespace' => 'nullable|string',
            'key' => 'nullable|string',
            'type' => 'nullable|in:string,integer,float,boolean,color',
            'value' => 'nullable',
        ];
    }

    public function messages()
    {
        return [
            'display_name.string' => __('failed_messages.setting.display_name.string'),
            'namespace.string' => __('failed_messages.setting.namespace.string'),
            'key.string' => __('failed_messages.setting.key.string'),
            'key.unique' => __('failed_messages.setting.key.unique'),
            'type.in' => __('failed_messages.setting.type.in'),
            'value.required' => __('failed_messages.setting.value.required'),
        ];
    }
}
