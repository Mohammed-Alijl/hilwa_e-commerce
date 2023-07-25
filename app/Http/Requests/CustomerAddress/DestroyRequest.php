<?php

namespace App\Http\Requests\CustomerAddress;

use App\Models\CustomerAddress;
use Illuminate\Foundation\Http\FormRequest;

class DestroyRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function run($id){
        $address = CustomerAddress::find($id);
        if(!$address)
            abort(404);
        $address->delete();
        return redirect()->back()->with('delete-success',__('success_messages.address.delete.success'));
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
