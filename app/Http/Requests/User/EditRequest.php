<?php

namespace App\Http\Requests\User;

use App\Models\Admin;
use App\Models\State;
use App\Models\User;
use Exception;
use Illuminate\Foundation\Http\FormRequest;
use Spatie\Permission\Models\Role;

class EditRequest extends FormRequest
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

    public function run($id)
    {
        try {
            $user = Admin::find($id);
            if (!$user)
                return redirect()->back()->withErrors(__('failed_messages.user.notFound'));
            if ($user->roles->pluck('name', 'name')->first() == "Admin")
                abort(403);
            $roles = Role::pluck('name', 'name')->all();
            $userRole = $user->roles->pluck('name', 'name')->first();
            $states = State::get();
            return view('Front-end.admins.edit', compact('user', 'roles', 'userRole', 'states'));
        } catch (Exception $ex) {
            return redirect()->back()->withErrors($ex->getMessage());
        }
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
