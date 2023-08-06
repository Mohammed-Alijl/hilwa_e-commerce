<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Requests\Zone\StoreRequest;
use App\Http\Requests\Zone\UpdateRequest;
use App\Repositories\StateRepository;
use App\Repositories\StoreRepository;
use App\Repositories\ZoneRepository;

class ZoneController extends Controller
{
    function __construct(private ZoneRepository $zoneRepository, private StateRepository $stateRepository, private StoreRepository $storeRepository)
    {
        $this->middleware('permission:view_zone', ['only' => ['index', 'show']]);
        $this->middleware('permission:add_zone', ['only' => ['create', 'store']]);
        $this->middleware('permission:edit_zone', ['only' => ['edit', 'update']]);
        $this->middleware('permission:delete_zone', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $zones = $this->zoneRepository->getAll();
        $rowNumber = 1;
        return view('dashboard.zones.index', compact('zones', 'rowNumber'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $stores = $this->storeRepository->getActiveStores();
        $states = $this->stateRepository->getAll();
        return view('dashboard.zones.create', compact('stores', 'states'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        $this->zoneRepository->create($request);
        return redirect()->route('zones.index')->with('add-success', __('success_messages.zone.add.success'));
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
        $zone = $this->zoneRepository->find($id);
        $stores = $this->storeRepository->getActiveStores();
        $states = $this->stateRepository->getAll();
        $postal_codes = implode(',', $zone->postal_codes);

        return view('dashboard.zones.edit', compact('zone', 'stores', 'states', 'postal_codes'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, string $id)
    {
        $this->zoneRepository->update($request, $id);
        return redirect()->route('zones.index')->with('edit-success', __('success_messages.zone.edit.success'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->zoneRepository->delete($id);
        return redirect()->back()->with('delete-success', __('success_messages.zone.delete.success'));
    }
}
