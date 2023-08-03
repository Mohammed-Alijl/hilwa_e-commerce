<?php

namespace App\Http\Requests\Store;

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
            'name'=>'required|string|unique:store_translations,name|max:255',
            'email'=>'required|email|unique:stores,email',
            'mobile_number' => 'required|size:8|unique:stores,mobile_number',
            'open_time' => 'required|date_format:H:i',
            'close_time' => 'required|date_format:H:i|after:open_time',
            'city_id' => 'required|numeric|exists:cities,id',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'zip_code' => 'required|string|regex:/^\d{3,10}(,\d{3,10})*$/',
            'status' => 'required|boolean',
        ];
    }
}
