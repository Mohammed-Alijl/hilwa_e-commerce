<?php

namespace App\Http\Requests\User;

use App\Models\State;
use Illuminate\Foundation\Http\FormRequest;
use Spatie\Permission\Models\Role;

class CreateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    public function run(){
        $roles = Role::all();
        $states = State::get();
        return view('Front-end.admins.create',compact('roles','states'));
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            //
        ];
    }
}
