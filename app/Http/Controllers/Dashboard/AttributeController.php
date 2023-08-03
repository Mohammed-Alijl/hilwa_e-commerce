<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Requests\Attribute\StoreRequest;
use App\Http\Requests\Attribute\UpdateRequest;
use App\Models\Attribute;
use App\Models\AttributeTranslation;
use App\Models\Entity;
use App\Models\Language;

class AttributeController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:view_attribute', ['only' => ['index', 'show']]);
        $this->middleware('permission:add_attribute', ['only' => ['create', 'store']]);
        $this->middleware('permission:edit_attribute', ['only' => ['edit', 'update']]);
        $this->middleware('permission:delete_attribute', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $attributes = Attribute::get();
        $rowNumber = 1;
        return view('dashboard.attributes.index', compact('attributes', 'rowNumber'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $entities = Entity::get();
        return view('dashboard.attributes.create', compact('entities'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
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
        return redirect()->route('attributes.index')->with('add-success', __('success_messages.attribute.add.success'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $languages = Language::get();
        $attribute = Attribute::find($id);
        $entities = Entity::get();
        return view('dashboard.attributes.edit', compact('languages', 'attribute', 'entities'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, string $id)
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
        return redirect()->route('attributes.index')->with('edit-success', __('success_messages.attribute.edit.success'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $attribute = Attribute::findOrFail($id);
        //here should edit it to check if there any category or product use this attribute should prevent delete
        $attribute->delete();
        return redirect()->route('attributes.index')->with('delete-success', __('success_messages.attribute.delete.success'));
    }

    public function getAttributeLanguages($langId, $attributeId)
    {
        $attributeTranslation = AttributeTranslation::where('attribute_id', $attributeId)
            ->where('language_id', $langId)
            ->first();

        if (!$attributeTranslation) {
            return json_decode('');
        }
        return response()->json(['attribute_name' => $attributeTranslation->name]);
    }
}
