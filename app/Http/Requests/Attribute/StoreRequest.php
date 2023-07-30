<?php

namespace App\Http\Requests\Attribute;

use App\Models\Attribute;
use App\Models\AttributeTranslation;
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
        $attribute = new Attribute();
        $attribute->entity_id = $this->entity_id;
        $attribute->display_order = $this->display_order;
        $attribute->isBoolean = $this->isBoolean;
        $attribute->status = $this->status;
        $attribute->save();
        $attributeTranslation = new AttributeTranslation();
        $attributeTranslation->name = $this->name;
        $attributeTranslation->attribute_id = $attribute->id;
        $attributeTranslation->language_id = 1;
        $attributeTranslation->save();
        return redirect()->route('attributes.index')->with('add-success',__('success_messages.attribute.add.success'));
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name'=>'required|string|max:255',
            'entity_id'=>'required|numeric|exists:entities,id',
            'display_order'=>'required|numeric',
            'isBoolean'=>'required|boolean',
            'status'=>'required|boolean',
        ];
    }
}
