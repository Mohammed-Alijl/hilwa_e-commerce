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
        $zone = Zone::findOrFail($id);
        if ($request->filled('name'))
            $zone->name = $request->name;
        if ($request->filled('store_id'))
            $zone->store_id = $request->store_id;
        if ($request->filled('city_id'))
            $zone->city_id = $request->city_id;
        if ($request->filled('status'))
            $zone->status = $request->status;
        if ($request->filled('postal_codes')) {
            $postalCodes = explode(',', $request->postal_codes);
            $postalCodes = array_map('trim', $postalCodes);
            $zone->postal_codes = $postalCodes;
        }
        $zone->save();
    }

    public function delete($id)
    {
        $zone = Zone::findOrFail($id);
        $zone->delete();
    }

}
