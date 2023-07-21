<?php

namespace App\Http\Requests\Customer;

use App\Models\Customer;
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
        $customer = Customer::find($id);
        if(!$customer)
            abort(404);
        $customer->delete();
        return redirect()->back()->with('delete-success',__('success_messages.customer.delete.success'));
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
