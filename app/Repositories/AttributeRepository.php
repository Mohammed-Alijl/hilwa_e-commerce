<?php

namespace App\Repositories;

use App\Interfaces\BasicRepositoryInterface;
use App\Models\Attribute;
use App\Models\AttributeTranslation;

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
        $attribute->entity_id = $request->entity_id;
        $attribute->display_order = $request->display_order;
        $attribute->isBoolean = $request->isBoolean;
        $attribute->status = $request->status;
        $attribute->save();
        $attributeTranslation = new AttributeTranslation();
        $attributeTranslation->name = $request->name;
        $attributeTranslation->attribute_id = $attribute->id;
        $attributeTranslation->language_id = 1;
        $attributeTranslation->save();
    }

    public function update($request, $id)
    {
        $attribute = Attribute::findOrFail($id);
        $attributeTranslation = AttributeTranslation::where('language_id', $request->language_id)->where('attribute_id', $id)->first();
        if (!$attributeTranslation) {
            $attributeTranslation = new AttributeTranslation();
            $attributeTranslation->language_id = $request->language_id;
            $attributeTranslation->attribute_id = $id;
        }
        $attributeTranslation->name = $request->name;
        $attributeTranslation->save();

        $attribute->entity_id = $request->entity_id;
        $attribute->display_order = $request->display_order;
        $attribute->isBoolean = $request->isBoolean;
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
        return AttributeTranslation::where('attribute_id', $attributeId)
            ->where('language_id', $langId)
            ->first();
    }

}
