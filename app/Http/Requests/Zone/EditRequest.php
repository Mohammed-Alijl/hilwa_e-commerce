<?php

namespace App\Http\Requests\Zone;

use App\Models\State;
use App\Models\Store;
use App\Models\Zone;
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
        $zone = Zone::find($id);
        $stores = Store::get();
        $states = State::get();
        $postal_codes = implode(',',$zone->postal_codes);

        return view('Front-end.zones.edit',compact('zone','stores','states','postal_codes'));
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
