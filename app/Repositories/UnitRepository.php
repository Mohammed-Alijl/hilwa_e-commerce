<?php

namespace App\Repositories;

use App\Interfaces\BasicRepositoryInterface;
use App\Models\Language;
use App\Models\Unit;

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
        $unit->setTranslation('name','en',$request->name);
        $unit->save();
    }

    public function update($request, $id)
    {
        $unit = Unit::findOrFail($request->id);
        $unit->setTranslation('name',Language::findOrFail($request->language_id)->code,$request->name);
        $unit->save();
    }

    public function delete($id)
    {
        $unit = Unit::findOrFail($id);
        //here should edit it when you make product to check if any product use the unit prevent delete
        $unit->delete();
    }

    public function getUnitLanguages($langId, $unitId)
    {
        $language = Language::findOrFail($langId);
        return $this->find($unitId)->getTranslation('name',$language->code);
    }

}
