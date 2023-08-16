<?php

namespace App\Repositories;

use App\Interfaces\BasicRepositoryInterface;
use App\Models\AttributeValue;
use App\Traits\AttachmentTrait;

class AttributeValueRepository implements BasicRepositoryInterface
{
    use AttachmentTrait;

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
        if ($files = $request->file('image_value')) {
            $imageName = $this->save_attachment($files, "img/attributes");
            $value->frontend_type_value = $imageName;

        }
        if ($request->filled('color_code_value')) {
            $value->frontend_type_value = $request->color_code_value;
        }
        $value->save();
    }

    public function update($request, $id)
    {
        $value = AttributeValue::findOrFail($id);
        $value->name = $request->name;
        if ($files = $request->file('image_value')) {
            if ($value->frontend_type_value != null)
                $this->delete_attachment('img/attributes/' . $value->frontend_type_value);
            $imageName = $this->save_attachment($files, "img/attributes");
            $value->frontend_type_value = $imageName;

        }
        if ($request->filled('color_code_value')) {
            $value->frontend_type_value = $request->color_code_value;
        }

        $value->save();
    }

    public function delete($id)
    {
        $value = AttributeValue::findOrFail($id);
        if ($value->frontend_type_value != null)
            $this->delete_attachment('img/attributes/' . $value->frontend_type_value);
        $value->delete();
    }
}
