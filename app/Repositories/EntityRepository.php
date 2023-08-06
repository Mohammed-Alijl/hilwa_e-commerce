<?php

namespace App\Repositories;

use App\Interfaces\BasicRepositoryInterface;
use App\Models\Entity;

class EntityRepository implements BasicRepositoryInterface
{
    public function getAll()
    {
        return Entity::get();
    }

    public function find($id)
    {
        return Entity::findOrFail($id);
    }

    public function create($request)
    {
        // TODO: Implement create() method.
    }

    public function update($request, $id)
    {
        // TODO: Implement update() method.
    }

    public function delete($id)
    {
        // TODO: Implement delete() method.
    }

}
