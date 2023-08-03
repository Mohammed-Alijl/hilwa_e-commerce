<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Requests\Unit\StoreRequest;
use App\Http\Requests\Unit\UpdateRequest;
use App\Models\Language;
use App\Models\Unit;
use App\Models\UnitTranlsation;

class UnitController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:view_unit', ['only' => ['index', 'show']]);
        $this->middleware('permission:add_unit', ['only' => ['create', 'store']]);
        $this->middleware('permission:edit_unit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:delete_unit', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $rowNumber = 1;
        $units = Unit::get();
        $languages = Language::get();
        return view('dashboard.units.index', compact('rowNumber', 'units', 'languages'));
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
        $unit = new Unit();
        $unit->save();
        $unitTranslation = new UnitTranlsation();
        $unitTranslation->unit_id = $unit->id;
        $unitTranslation->language_id = 1;
        $unitTranslation->name = $request->name;
        $unitTranslation->save();
        return redirect()->back()->with('add-success', __('success_messages.unit.add.success'));
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
        return redirect()->back()->with('edit-success', __('success_messages.unit.edit.success'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $unit = Unit::findOrFail($id);
        //here should edit it when you make product to check if any product use the unit prevent delete
        $unit->delete();
        return redirect()->back()->with('delete-success', __('success_messages.unit.delete.success'));
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
