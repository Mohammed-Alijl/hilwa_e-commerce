<?php

namespace App\Http\Requests\Attribute;

use App\Models\Attribute;
use App\Models\Entity;
use App\Models\Language;
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
        $languages = Language::get();
        $attribute = Attribute::find($id);
        $entities = Entity::get();
        return view('Front-end.attributes.edit',compact('languages','attribute','entities'));
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
