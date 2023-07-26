<?php

namespace App\Http\Controllers;

use App\Http\Requests\Unit\DestroyRequest;
use App\Http\Requests\Unit\IndexRequest;
use App\Http\Requests\Unit\StoreRequest;
use App\Http\Requests\Unit\UpdateRequest;
use App\Models\UnitTranlsation;

class UnitController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:view_unit', ['only' => ['index','show']]);
        $this->middleware('permission:add_unit', ['only' => ['create','store']]);
        $this->middleware('permission:edit_unit', ['only' => ['edit','update']]);
        $this->middleware('permission:delete_unit', ['only' => ['destroy']]);
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
    public function create()
    {
        //
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
    public function edit(string $id)
    {
        //
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
    public function destroy(DestroyRequest $request, string $id)
    {
        return $request->run($id);
    }

    public function getUnitLanguages($langId, $unitId)
    {
        $unitTranslation = UnitTranlsation::where('unit_id', $unitId)
            ->where('language_id', $langId)
            ->first();

        if (!$unitTranslation) {
            return json_decode('');
        }
        return response()->json(['unit_name' => $unitTranslation->name]);
    }
}
