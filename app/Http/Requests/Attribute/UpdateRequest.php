<?php

namespace App\Http\Requests\Attribute;

use App\Models\Attribute;
use App\Models\AttributeTranslation;
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
        $attribute = Attribute::findOrFail($id);
        $attributeTranslation = AttributeTranslation::where('language_id', $this->language_id)->where('attribute_id', $id)->first();
        if (!$attributeTranslation) {
            $attributeTranslation = new AttributeTranslation();
            $attributeTranslation->language_id = $this->language_id;
            $attributeTranslation->attribute_id = $id;
        }
        $attributeTranslation->name = $this->name;
        $attributeTranslation->save();

        $attribute->entity_id = $this->entity_id;
        $attribute->display_order = $this->display_order;
        $attribute->isBoolean = $this->isBoolean;
        $attribute->status = $this->status;
        $attribute->save();
        return redirect()->route('attributes.index')->with('edit-success',__('success_messages.attribute.edit.success'));
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'entity_id' => 'required|numeric|exists:entities,id',
            'display_order' => 'required|numeric',
            'isBoolean' => 'required|boolean',
            'status' => 'required|boolean',
        ];
    }
}
