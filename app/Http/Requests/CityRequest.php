<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CityRequest extends FormRequest
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
            'name' => 'required|string|max:30',
            'state_id' => 'required|numeric|exists:states,id'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => __('failed_messages.city.name.required'),
            'name.string' => __('failed_messages.city.name.string'),
            'name.max' => __('failed_messages.city.name.max'),
            'state_id.required' => __('failed_messages.city.state_id.required'),
            'state_id.numeric' => __('failed_messages.city.state_id.numeric'),
            'state_id.exists' => __('failed_messages.city.state_id.exists'),
        ];
    }
}
