<?php

namespace App\Http\Requests\Store;

use App\Models\Language;
use App\Models\State;
use App\Models\Store;
use Illuminate\Foundation\Http\FormRequest;

class EditRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function run($id){
        $store = Store::find($id);
        $languages = Language::get();
        $states = State::get();
        return view('Front-end.stores.edit',compact('store','languages','states'));
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
