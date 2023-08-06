<?php

namespace App\Repositories;

use App\Interfaces\BasicRepositoryInterface;
use App\Models\State;

class StateRepository implements BasicRepositoryInterface
{
    public function getAll()
    {
        return State::get();
    }

    public function find($id): State
    {
        return State::findOrFail($id);
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
