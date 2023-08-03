<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Requests\Zone\StoreRequest;
use App\Http\Requests\Zone\UpdateRequest;
use App\Models\State;
use App\Models\Store;
use App\Models\Zone;

class ZoneController extends Controller
{
    function __construct()
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
        $zones = Zone::get();
        $rowNumber = 1;
        return view('dashboard.zones.index', compact('zones', 'rowNumber'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $stores = Store::where('status', 1)->get();
        $states = State::get();
        return view('dashboard.zones.create', compact('stores', 'states'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        $postalCodes = explode(',', $request->postal_codes);
        $postalCodes = array_map('trim', $postalCodes);
        $zone = new Zone();
        $zone->name = $request->name;
        $zone->city_id = $request->city_id;
        $zone->status = $request->status;
        $zone->store_id = $request->store_id;
        $zone->postal_codes = $postalCodes;
        $zone->save();
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
        $zone = Zone::find($id);
        $stores = Store::where('status', 1)->get();
        $states = State::get();
        $postal_codes = implode(',', $zone->postal_codes);

        return view('dashboard.zones.edit', compact('zone', 'stores', 'states', 'postal_codes'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, string $id)
    {
        $zone = Zone::findOrFail($id);
        if ($request->filled('name'))
            $zone->name = $request->name;
        if ($request->filled('store_id'))
            $zone->store_id = $request->store_id;
        if ($request->filled('city_id'))
            $zone->city_id = $request->city_id;
        if ($request->filled('status'))
            $zone->status = $request->status;
        if ($request->filled('postal_codes')) {
            $postalCodes = explode(',', $request->postal_codes);
            $postalCodes = array_map('trim', $postalCodes);
            $zone->postal_codes = $postalCodes;
        }
        $zone->save();
        return redirect()->route('zones.index')->with('edit-success', __('success_messages.zone.edit.success'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $zone = Zone::findOrFail($id);
        $zone->delete();
        return redirect()->back()->with('delete-success', __('success_messages.zone.delete.success'));
    }
}
