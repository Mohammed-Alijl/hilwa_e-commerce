<?php

namespace App\Http\Requests\Customer;

use App\Models\AddressType;
use App\Models\State;
use Illuminate\Foundation\Http\FormRequest;

class CreateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function run(){
        $states = State::get();
        $address_types = AddressType::get();
        return view('Front-end.customers.create',compact('states','address_types'));
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            //
        ];
    }
}
