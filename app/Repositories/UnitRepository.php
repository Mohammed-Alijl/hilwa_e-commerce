<?php

namespace App\Repositories;

use App\Interfaces\BasicRepositoryInterface;
use App\Models\Unit;
use App\Models\UnitTranlsation;

class UnitRepository implements BasicRepositoryInterface
{
    public function getAll()
    {
        return Unit::get();
    }

    public function find($id)
    {
        return Unit::findOrFail($id);
    }

    public function create($request)
    {
        $unit = new Unit();
        $unit->save();
        $unitTranslation = new UnitTranlsation();
        $unitTranslation->unit_id = $unit->id;
        $unitTranslation->language_id = 1;
        $unitTranslation->name = $request->name;
        $unitTranslation->save();
    }

    public function update($request, $id)
    {
        $unitTranslation = UnitTranlsation::where('unit_id', $request->id)
            ->where('language_id', $request->language_id)
            ->first();
        if (!$unitTranslation) {
            $unitTranslation = new UnitTranlsation();
            $unitTranslation->language_id = $request->language_id;
            $unitTranslation->unit_id = $request->id;
        }
        $unitTranslation->name = $request->name;
        $unitTranslation->save();
    }

    public function delete($id)
    {
        $unit = Unit::findOrFail($id);
        //here should edit it when you make product to check if any product use the unit prevent delete
        $unit->delete();
    }

    public function getUnitLanguages($langId, $unitId)
    {
        return UnitTranlsation::where('unit_id', $unitId)
            ->where('language_id', $langId)
            ->first();
    }

}
