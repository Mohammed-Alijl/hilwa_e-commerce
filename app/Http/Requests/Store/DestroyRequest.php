<?php

namespace App\Http\Requests\Store;

use App\Models\Store;
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
        $store = Store::findOrFail($id);
        if($store->zones->count() > 0){
            return redirect()->route('stores.index')->with('delete-failed',__('failed_messages.store.delete.failed'));
        }else{
            $store->delete();
            return redirect()->route('stores.index')->with('delete-success',__('success_messages.store.delete.success'));
        }
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
