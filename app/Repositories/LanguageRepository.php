<?php

namespace App\Repositories;

use App\Interfaces\BasicRepositoryInterface;
use App\Models\Language;

class LanguageRepository implements BasicRepositoryInterface
{
    public function getAll()
    {
        return Language::get();
    }

    public function find($id)
    {
        return Language::findOrFail($id);
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
