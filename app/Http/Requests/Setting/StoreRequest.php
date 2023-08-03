<?php

namespace App\Http\Requests\Setting;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
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
            'display_name' => 'required|string',
            'namespace' => 'required|string',
            'key' => 'required|string|unique:settings',
            'type' => 'required|in:string,integer,float,boolean,color',
        ];
    }

    public function messages()
    {
        return [
            'display_name.required' => __('failed_messages.setting.display_name.required'),
            'display_name.string' => __('failed_messages.setting.display_name.string'),
            'namespace.required' => __('failed_messages.setting.namespace.required'),
            'namespace.string' => __('failed_messages.setting.namespace.string'),
            'key.required' => __('failed_messages.setting.key.required'),
            'key.string' => __('failed_messages.setting.key.string'),
            'key.unique' => __('failed_messages.setting.key.unique'),
            'type.required' => __('failed_messages.setting.type.required'),
            'type.in' => __('failed_messages.setting.type.in'),
            'value.required' => __('failed_messages.setting.value.required'),
        ];
    }
}
