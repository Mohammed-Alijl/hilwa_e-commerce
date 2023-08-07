<?php

namespace App\Repositories;

use App\Interfaces\BasicRepositoryInterface;
use App\Models\Zone;

class ZoneRepository implements BasicRepositoryInterface
{
    public function getAll()
    {
        return Zone::get();
    }

    public function find($id)
    {
        return Zone::findOrFail($id);
    }

    public function create($request)
    {
        $postalCodes = explode(',', $request->postal_codes);
        $postalCodes = array_map('trim', $postalCodes);
        $zone = new Zone();
        $zone->name = $request->name;
        $zone->city_id = $request->city_id;
        $zone->status = $request->status;
        $zone->store_id = $request->store_id;
        $zone->postal_codes = $postalCodes;
        $zone->save();
    }

    public function update($request, $id)
    {
        $postalCodes = explode(',', $request->postal_codes);
        $postalCodes = array_map('trim', $postalCodes);
        $zone = Zone::findOrFail($id);
        $zone->name = $request->name;
        $zone->city_id = $request->city_id;
        $zone->status = $request->status;
        $zone->store_id = $request->store_id;
        $zone->postal_codes = $postalCodes;
        $zone->save();
    }

    public function delete($id)
    {
        $zone = Zone::findOrFail($id);
        $zone->delete();
    }

}
