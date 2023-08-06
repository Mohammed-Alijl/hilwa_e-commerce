<?php

namespace App\Repositories;


use App\Interfaces\BasicRepositoryInterface;
use App\Models\User;
use App\Traits\AttachmentTrait;
use Illuminate\Support\Facades\Hash;

class CustomerRepository implements BasicRepositoryInterface
{
    use AttachmentTrait;

    public function getAll()
    {
        return User::where('type', 'customer')->get();
    }

    public function find($id)
    {
        return User::findOrFail($id);
    }


    public function create($data): User
    {
        $customer = new User();
        $customer->name = $data['first_name'] . ' ' . $data['last_name'];
        $customer->email = $data['email'];
        $customer->password = Hash::make($data['password']);
        $customer->mobile_number = $data['mobile_number'];
        $customer->image = $data['image'];
        $customer->type = 'customer';
        $customer->save();
        return $customer;
    }

    public function update($data, $id)
    {
        $customer = User::findOrFail($id);
        $customer->name = $data['name'];
        $customer->email = $data['email'];
        if (isset($data['password']))
            $customer->password = Hash::make($data['password']);
        $customer->mobile_number = $data['mobile_number'];
        if (isset($data['image']))
            $customer->image = $data['image'];
        $customer->type = 'customer';
        return $customer->save();
    }

    public function delete($id): bool
    {
        $customer = User::findOrFail($id);
        if ($customer->image != 'default.png')
            $this->delete_attachment('img/customers/' . $customer->image);
        return $customer->delete();
    }

}
