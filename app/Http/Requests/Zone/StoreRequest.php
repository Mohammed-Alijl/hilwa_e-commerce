<?php

namespace App\Http\Requests\Zone;

use App\Models\Zone;
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
        $postalCodes = explode(',', $this->postal_codes);
        $postalCodes = array_map('trim', $postalCodes);
        $zone = new Zone();
        $zone->name = $this->name;
        $zone->city_id = $this->city_id;
        $zone->status = $this->status;
        $zone->store_id = $this->store_id;
        $zone->postal_codes = $postalCodes;
        $zone->save();
        return redirect()->route('zones.index')->with('add-success',__('success_messages.zone.add.success'));
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name'=>'required|string|min:3|max:30|unique:zones,name',
            'city_id'=>'required|numeric|exists:cities,id',
            'store_id'=>'required|numeric|exists:stores,id',
            'status'=>'required|boolean',
            'postal_codes' => 'required|string|regex:/^\d{3,10}(,\d{3,10})*$/',
        ];
    }
}
