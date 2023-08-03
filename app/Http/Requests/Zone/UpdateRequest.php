<?php

namespace App\Http\Requests\Zone;

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
            'name'=>'string|min:3|max:30|unique:zones,name,' . $this->route('zone'),
            'city_id'=>'numeric|exists:cities,id',
            'store_id'=>'numeric|exists:stores,id',
            'status'=>'boolean',
            'postal_codes' => 'string|regex:/^\d{3,10}(,\d{3,10})*$/',
        ];
    }

    public function messages()
    {
        return[
        'name.string'=>__('failed_messages.zone.name.string'),
        'name.min'=>__('failed_messages.zone.name.min'),
        'name.max'=>__('failed_messages.zone.name.max'),
        'name.unique'=>__('failed_messages.zone.name.unique'),
        'city_id.numeric'=>__('failed_messages.zone.city_id.numeric'),
        'city_id.exists'=>__('failed_messages.zone.city_id.exists'),
        'store_id.numeric'=>__('failed_messages.zone.store_id.numeric'),
        'store_id.exists'=>__('failed_messages.zone.store_id.exists'),
        'status.boolean'=>__('failed_messages.zone.status.boolean'),
        'postal_codes.string'=>__('failed_messages.zone.postal_codes.string'),
        'postal_codes.regex'=>__('failed_messages.zone.postal_codes.regex'),
        ];
    }
}
