<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Requests\Unit\StoreRequest;
use App\Http\Requests\Unit\UpdateRequest;
use App\Repositories\LanguageRepository;
use App\Repositories\UnitRepository;

class UnitController extends Controller
{
    function __construct(private UnitRepository $unitRepository, private LanguageRepository $languageRepository)
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
        $units = $this->unitRepository->getAll();
        $languages = $this->languageRepository->getAll();
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
        $this->unitRepository->create($request);
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
        $this->unitRepository->update($request, $id);
        return redirect()->back()->with('edit-success', __('success_messages.unit.edit.success'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->unitRepository->delete($id);
        return redirect()->back()->with('delete-success', __('success_messages.unit.delete.success'));
    }

    public function getUnitLanguages($langId, $unitId)
    {
        $unitTranslation = $this->unitRepository->getUnitLanguages($langId, $unitId);
        if (!$unitTranslation) {
            return json_decode('');
        }
        return response()->json(['unit_name' => $unitTranslation]);
    }
}
