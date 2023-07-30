<?php

namespace App\Http\Requests\Attribute;

use App\Models\Attribute;
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
        $attribute = Attribute::findOrFail($id);
        //here should edit it to check if there any category or product use this attribute should prevent delete
        $attribute->delete();
        return redirect()->route('attributes.index')->with('delete-success',__('success_messages.attribute.delete.success'));
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
