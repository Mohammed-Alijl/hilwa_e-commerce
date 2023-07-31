<?php

namespace App\Http\Requests\Driver;

use App\Models\Driver;
use App\Models\State;
use App\Models\User;
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
        $driver = User::find($id);
        $states = State::get();
        return view('Front-end.drivers.edit',compact('driver','states'));
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
