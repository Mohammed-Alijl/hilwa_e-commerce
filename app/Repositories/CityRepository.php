<?php

namespace App\Repositories;

use App\Interfaces\BasicRepositoryInterface;
use App\Models\City;

class CityRepository implements BasicRepositoryInterface
{
    public function getAll()
    {
        return City::get();
    }

    public function find($id)
    {
        return City::find($id);
    }

    public function create($data)
    {
        $city = new City();
        $city->name = $data['name'];
        $city->state_id = $data['state_id'];
        $city->save();
        return $city;
    }

    public function update($data, $id)
    {
        $city = City::findOrFail($id);
        $city->name = $data['name'];
        $city->state_id = $data['state_id'];
        $city->save();
    }

    public function delete($id)
    {
        // TODO: Implement delete() method.
    }
}
