<?php

namespace App\Http\Requests\Customer;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

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
            'first_name' => 'string|max:30',
            'last_name' => 'string|max:30',
            'email' => 'email|unique:users,email,' . $this->route('customer'),
            'password' => 'same:confirm-password',
            'pic' => 'nullable|file|mimes:jpeg,jpg,png,svg|max:5000',
            'mobile_number' => 'size:8|unique:users,mobile_number,' . $this->route('customer'),
            'latitude' => 'array|required',
            'latitude.*' => 'required|numeric',
            'longitude' => 'array|required',
            'longitude.*' => 'required|numeric',
            'isDefault' => 'array|required',
            'isDefault.*' => 'required|boolean',
            'address_type' => 'required|array',
            'address_type.*' => 'required|exists:address_types,id',
            'use_for' => 'required|array',
            'use_for.*' => ['required', Rule::in(['delivery', 'billing']),],
            'status' => 'required|array',
            'status.*' => 'required|boolean',
        ];
    }
}
