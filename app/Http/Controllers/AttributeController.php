<?php

namespace App\Http\Controllers;

use App\Http\Requests\Attribute\CreateRequest;
use App\Http\Requests\Attribute\EditRequest;
use App\Http\Requests\Attribute\IndexRequest;
use App\Http\Requests\Attribute\StoreRequest;
use App\Http\Requests\Attribute\UpdateRequest;
use App\Models\AttributeTranslation;
use Illuminate\Http\Request;

class AttributeController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:view_attribute', ['only' => ['index','show']]);
        $this->middleware('permission:add_attribute', ['only' => ['create','store']]);
        $this->middleware('permission:edit_attribute', ['only' => ['edit','update']]);
        $this->middleware('permission:delete_attribute', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index(IndexRequest $request)
    {
        return $request->run();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(CreateRequest $request)
    {
        return $request->run();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        return $request->run();
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
    public function edit(EditRequest $request, string $id)
    {
        return $request->run($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, string $id)
    {
        return $request->run($id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function getAttributeLanguages($langId, $attributeId){
        $attributeTranslation = AttributeTranslation::where('attribute_id', $attributeId)
            ->where('language_id', $langId)
            ->first();

        if (!$attributeTranslation) {
            return json_decode('');
        }
        return response()->json(['attribute_name' => $attributeTranslation->name]);
    }
}
