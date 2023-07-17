<?php

namespace App\Http\Requests\Role;

use Illuminate\Foundation\Http\FormRequest;
use Spatie\Permission\Models\Role;

class ShowRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function run($id,$methods,$models){
        $role = Role::find($id);
        if(!$role)
            return abort(404);

        $rolePermissions = $role->permissions->pluck('name')->toArray();

        return view('Front-end.roles.show',compact('role','rolePermissions','methods','models'));
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
