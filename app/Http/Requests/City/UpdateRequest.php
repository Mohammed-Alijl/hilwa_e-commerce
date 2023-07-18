<?php

namespace App\Http\Requests\City;

use App\Models\City;
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
        $city = City::find($this->id);
        if(!$city)
            abort(404);
        if ($this->filled('name'))
            $city->name = $this->name;
        if ($this->filled('state_id'))
            $city->state_id = $this->state_id;
        $city->save();
        return redirect()->back()->with('edit-success',__('success_messages.city.edit.success'));
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name'=>'string|max:30',
            'state_id'=>'numeric|exists:states,id'
        ];
    }

    public function messages()
    {
        return [
          'name.string'=>__('failed_messages.city.name.string'),
          'name.max'=>__('failed_messages.city.name.max'),
          'state_id.numeric'=>__('failed_messages.city.state_id.numeric'),
          'state_id.exists'=>__('failed_messages.city.state_id.exists'),
        ];
    }
}
