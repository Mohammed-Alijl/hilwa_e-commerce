<?php

namespace App\Repositories;

use App\Interfaces\BasicRepositoryInterface;
use App\Models\Admin;
use App\Traits\AttachmentTrait;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserRepository implements BasicRepositoryInterface
{
    use AttachmentTrait;

    public function getAll()
    {
        return Admin::get();
    }

    public function find($id): Admin
    {
        return Admin::findOrFail($id);
    }

    public function create($data)
    {
        $user = new Admin();
        $user->first_name = $data['first_name'];
        $user->last_name = $data['last_name'];
        $user->email = $data['email'];
        $user->mobile_number = $data['mobile_number'];
        $user->password = Hash::make($data['password']);
        $user->roles_name = $data['roles_name'];
        $user->city_id = $data['city_id'];
        $user->code = $data['code'];
        $user->address = $data['address'];
        $user->limit_state = $data['limit_state'];
        $user->image = $data['image'];
        $user->save();
        return $user;
    }

    public function update($request, $id)
    {
        $user = Admin::findOrFail($id);
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
            return $user->save();
        }
        if ($request->filled('first_name'))
            $user->first_name = $request->first_name;
        if ($request->filled('last_name'))
            $user->last_name = $request->last_name;
        if ($request->filled('email'))
            $user->email = $request->email;
        if ($request->filled('mobile_number'))
            $user->mobile_number = $request->mobile_number;
        if ($request->filled('city_id'))
            $user->city_id = $request->city_id;
        if ($request->filled('roles_name'))
            $user->roles_name = $request->roles_name;
        if ($files = $request->file('pic')) {
            if ($user->image != 'default.png')
                $this->delete_attachment('img/admins/' . $user->image);
            $imageName = $this->save_attachment($files, "img/admins");
            $user->image = $imageName;
        }
        if ($user->save()) {
            DB::table('model_has_roles')->where('model_id', $id)->delete();
            $user->assignRole($request->roles_name);
        }
    }

    public function delete($id)
    {
        $user = Admin::find($id);
        if ($user->image != 'default.png')
            $this->delete_attachment('img/admins/' . $user->image);
        $user->delete();
    }

}
