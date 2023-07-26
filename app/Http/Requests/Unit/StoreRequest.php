<?php

namespace App\Http\Requests\Unit;

use App\Models\Unit;
use App\Models\UnitTranlsation;
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
        $unit = new Unit();
        $unit->save();
        $unitTranslation = new UnitTranlsation();
        $unitTranslation->unit_id = $unit->id;
        $unitTranslation->language_id = 1;
        $unitTranslation->name = $this->name;
        $unitTranslation->save();
        return redirect()->back()->with('add-success',__('success_messages.unit.add.success'));
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name'=>'required|string|max:255'
        ];
    }
}
