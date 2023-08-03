<?php

namespace App\Http\Requests\Driver;

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
            'first_name' => 'required|max:255|string',
            'last_name' => 'required|max:255|string',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|same:confirm-password',
            'pic' => 'nullable|file|mimes:jpeg,jpg,png,svg|max:5000',
            'mobile_number' => 'required|size:8|unique:users,mobile_number',
            'zone_id' => 'required|numeric|exists:zones,id',
            'address' => 'string|max:255',
            'status' => 'required|boolean',
        ];
    }
}
