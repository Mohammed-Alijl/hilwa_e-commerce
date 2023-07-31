<?php

namespace App\Http\Requests\Role;

use Illuminate\Foundation\Http\FormRequest;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

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
        $role = new Role();
        $role->name = $this->name;
        $role->guard_name = 'admin';
        $role->save();

        $permissions = Permission::whereIn('name', $this->permission)->get();
        $role->syncPermissions($permissions);

        return redirect()->route('roles.index')->with('add-success', __('success_messages.role.add'));
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255|unique:roles',
            'permission' => 'required|array',
        ];
    }
}
