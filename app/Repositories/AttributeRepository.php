<?php

namespace App\Repositories;

use App\Interfaces\BasicRepositoryInterface;
use App\Models\Attribute;
use App\Models\Language;

class AttributeRepository implements BasicRepositoryInterface
{
    public function getAll()
    {
        return Attribute::get();
    }

    public function find($id)
    {
        return Attribute::findOrFail($id);
    }

    public function create($request)
    {
        $attribute = new Attribute();
        $attribute->setTranslation('name','en',$request->name);
        $attribute->display_order = $request->display_order;
        $attribute->frontend_type = $request->frontend_type;
        $attribute->status = $request->status;
        $attribute->save();
    }

    public function update($request, $id)
    {
        $attribute = Attribute::findOrFail($id);
        $attribute->setTranslation('name',Language::findOrFail($request->language_id)->code,$request->name);
        $attribute->frontend_type = $request->frontend_type;
        $attribute->display_order = $request->display_order;
        $attribute->status = $request->status;
        $attribute->save();
    }

    public function delete($id)
    {
        $attribute = Attribute::findOrFail($id);
        //here should edit it to check if there any category or product use this attribute should prevent delete
        $attribute->delete();
    }

    public function getAttributeLanguages($langId, $attributeId)
    {
        return $this->find($attributeId)->getTranslation('name',Language::findOrFail($langId)->code);
    }

    public function getAttributeValues($id){
        $attribute = Attribute::findOrFail($id);
        return $attribute->values;
    }

}
