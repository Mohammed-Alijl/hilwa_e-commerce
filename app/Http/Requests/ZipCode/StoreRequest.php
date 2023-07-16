<?php

namespace App\Http\Requests\ZipCode;

use App\Models\ZipCode;
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

    public function run(){
        $zipCode = new ZipCode();
        $zipCode->zip_code = $this->input('zip_code');
        $zipCode->save();

        return response()->json(['zip_code' => $zipCode->zip_code]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'zip_code' => 'required|numeric|unique:zip_codes,zip_code',
        ];
    }
}
