<?php

namespace App\Repositories;

use App\Interfaces\BasicRepositoryInterface;
use App\Models\Category;

class CategoryRepository implements BasicRepositoryInterface
{
    public function getAll()
    {
        return Category::get();
    }

    public function find($id)
    {
        return Category::findOrFail($id);
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
