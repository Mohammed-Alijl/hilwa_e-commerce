<?php

namespace App\Repositories;

use App\Interfaces\BasicRepositoryInterface;
use App\Models\AddressType;

class AddressTypeRepository implements BasicRepositoryInterface
{
    public function getAll()
    {
        return AddressType::get();
    }

    public function find($id)
    {
        return AddressType::findOrFail($id);
    }

    public function create($data)
    {
        // TODO: Implement create() method.
    }

    public function update($data, $id)
    {
        // TODO: Implement update() method.
    }

    public function delete($id)
    {
        // TODO: Implement delete() method.
    }
}
