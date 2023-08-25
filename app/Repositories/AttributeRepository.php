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
        $attribute->display_order = $request->display_order;
        $attribute->status = $request->status;
        if($attribute->frontend_type != $request->frontend_type){
            if($attribute->values->count() == 0 || ($attribute->frontend_type == 'menu' && $request->frontend_type == 'list') || ($attribute->frontend_type == 'list' && $request->frontend_type == 'menu') )
                $attribute->frontend_type = $request->frontend_type;
        }
        $attribute->save();
    }

    public function delete($id)
    {
        $attribute = Attribute::findOrFail($id);
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

    public function getActiveAttributes(){
        return Attribute::where('status',1)->get();
    }

}
