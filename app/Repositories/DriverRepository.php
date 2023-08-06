<?php

namespace App\Repositories;

use App\Interfaces\BasicRepositoryInterface;
use App\Models\User;
use App\Traits\AttachmentTrait;
use Illuminate\Support\Facades\Hash;

class DriverRepository implements BasicRepositoryInterface
{
    use AttachmentTrait;

    public function getAll()
    {
        return User::where('type', 'driver')->get();
    }

    public function find($id): User
    {
        return User::findOrFail($id);
    }

    public function create($request)
    {
        $driver = new User();
        $driver->name = $request->first_name . " " . $request->last_name;
        $driver->email = $request->email;
        $driver->mobile_number = $request->mobile_number;
        $driver->password = Hash::make($request->password);
        $driver->zone_id = $request->zone_id;
        $driver->address = $request->address;
        if ($files = $request->file('pic')) {
            $imageName = $this->save_attachment($files, "img/drivers");
        } else
            $imageName = 'default.png';
        $driver->status = $request->status;
        $driver->image = $imageName;
        $driver->type = 'driver';
        $driver->save();
        return $driver;
    }

    public function update($request, $id)
    {
        $driver = User::findOrFail($id);
        if ($request->filled('name'))
            $driver->name = $request->name;
        if ($request->filled('password'))
            $driver->password = Hash::make($request->password);
        if ($request->filled('email'))
            $driver->email = $request->email;
        if ($request->filled('address'))
            $driver->address = $request->address;
        if ($request->filled('zone_id'))
            $driver->zone_id = $request->zone_id;
        if ($request->filled('status'))
            $driver->status = $request->status;
        if ($files = $request->file('pic')) {
            if ($driver->image != 'default.png')
                $this->delete_attachment('img/drivers/' . $driver->image);
            $imageName = $this->save_attachment($files, "img/drivers");
            $driver->image = $imageName;
        }
        $driver->save();
    }

    public function delete($id)
    {
        $driver = User::findOrFail($id);
        if ($driver->image != 'default.png')
            $this->delete_attachment('img/drivers/' . $driver->image);
        $driver->delete();
    }

}
