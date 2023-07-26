<?php

namespace App\Http\Requests\Unit;

use App\Models\UnitTranlsation;
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

    public function run(){
        $unitTranslation = UnitTranlsation::where('unit_id', $this->id)
            ->where('language_id', $this->language_id)
            ->first();
        if(!$unitTranslation){
            $unitTranslation = new UnitTranlsation();
            $unitTranslation->language_id = $this->language_id;
            $unitTranslation->unit_id = $this->id;
        }
        $unitTranslation->name = $this->name;
        $unitTranslation->save();
        return redirect()->back()->with('edit-success',__('success_messages.unit.edit.success'));
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'id'=>'required|numeric|exists:units,id',
            'language_id'=>'required|numeric|exists:languages,id',
            'name'=>'required|string|max:255'
        ];
    }
}
