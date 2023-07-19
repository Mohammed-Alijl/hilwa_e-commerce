<?php

namespace App\Http\Requests\Zone;

use App\Models\Zone;
use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function run($id)
    {
        $zone = Zone::find($id);
        if (!$zone)
            abort(404);
        if ($this->filled('name'))
            $zone->name = $this->name;
        if ($this->filled('store_id'))
            $zone->store_id = $this->store_id;
        if ($this->filled('city_id'))
            $zone->city_id = $this->city_id;
        if ($this->filled('status'))
            $zone->status = $this->status;
        if ($this->filled('postal_codes')) {
            $postalCodes = explode(',', $this->postal_codes);
            $postalCodes = array_map('trim', $postalCodes);
            $zone->postal_codes = $postalCodes;
        }
        $zone->save();
        return redirect()->route('zones.index')->with('edit-success',__('success_messages.zone.edit.success'));
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name'=>'string|min:3|max:30|unique:zones,name,' . $this->route('zone'),
            'city_id'=>'numeric|exists:cities,id',
            'store_id'=>'numeric|exists:stores,id',
            'status'=>'boolean',
            'postal_codes' => 'string|regex:/^\d{3,10}(,\d{3,10})*$/',
        ];
    }
}
