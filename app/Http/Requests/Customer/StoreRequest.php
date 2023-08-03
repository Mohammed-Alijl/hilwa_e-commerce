<?php


namespace App\Http\Requests\Customer;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'first_name' => 'required|string|max:30',
            'last_name' => 'required|string|max:30',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|same:confirm-password',
            'pic' => 'nullable|file|mimes:jpeg,jpg,png,svg|max:5000',
            'mobile_number' => 'required|size:8|unique:users,mobile_number',
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




















