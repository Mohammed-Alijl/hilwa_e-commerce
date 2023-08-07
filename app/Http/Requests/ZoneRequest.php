<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ZoneRequest extends FormRequest
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
            'name' => 'required|string|min:3|max:30|unique:zones,name,' . $this->route('zone'),
            'city_id' => 'required|numeric|exists:cities,id',
            'store_id' => 'required|numeric|exists:stores,id',
            'status' => 'required|boolean',
            'postal_codes' => 'required|string|regex:/^\d{3,10}(,\d{3,10})*$/',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => __('failed_messages.zone.name.required'),
            'name.string' => __('failed_messages.zone.name.string'),
            'name.min' => __('failed_messages.zone.name.min'),
            'name.max' => __('failed_messages.zone.name.max'),
            'name.unique' => __('failed_messages.zone.name.unique'),
            'city_id.required' => __('failed_messages.zone.city_id.required'),
            'city_id.numeric' => __('failed_messages.zone.city_id.numeric'),
            'city_id.exists' => __('failed_messages.zone.city_id.exists'),
            'store_id.required' => __('failed_messages.zone.store_id.required'),
            'store_id.numeric' => __('failed_messages.zone.store_id.numeric'),
            'store_id.exists' => __('failed_messages.zone.store_id.exists'),
            'status.required' => __('failed_messages.zone.status.required'),
            'status.boolean' => __('failed_messages.zone.status.boolean'),
            'postal_codes.required' => __('failed_messages.zone.postal_codes.required'),
            'postal_codes.string' => __('failed_messages.zone.postal_codes.string'),
            'postal_codes.regex' => __('failed_messages.zone.postal_codes.regex'),

        ];
    }
}
