<?php

namespace App\Repositories;

use App\Interfaces\BasicRepositoryInterface;
use App\Models\Attribute;
use App\Models\AttributeTranslation;
use App\Models\AttributeValue;
use App\Models\Entity;

class AttributeValueRepository implements BasicRepositoryInterface
{
    public function getAll()
    {
        return AttributeValue::get();
    }

    public function find($id)
    {
        return AttributeValue::findOrFail($id);
    }

    public function create($request)
    {
        $value = new AttributeValue();
        $value->name = $request->name;
        $value->attribute_id = $request->attribute_id;
        $value->save();
    }

    public function update($request, $id)
    {
        $value = AttributeValue::findOrFail($id);
        $value->name = $request->name;
        $value->save();
    }

    public function delete($id)
    {
        $value = AttributeValue::findOrFail($id);
        $value->delete();
    }
}
