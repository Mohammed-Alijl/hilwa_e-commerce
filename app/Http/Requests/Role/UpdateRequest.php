<?php

namespace App\Http\Requests\Role;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Route;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class UpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function run($id){
        $role = Role::find($id);
        if(!$role)
            abort(404);
        if ($this->filled('name'))
        $role->name = $this->name;
        $role->save();
        $permissions = Permission::whereIn('name', $this->permission)->get();
        $role->syncPermissions($permissions);

        return redirect()->route('roles.index')
            ->with('edit-success',__('success_messages.role.edit'));
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'string|max:255|unique:roles,name,' . $this->route('role'),
            'permission' => 'required|array',
        ];
    }
}
