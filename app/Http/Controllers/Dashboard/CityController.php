<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Requests\City\StoreRequest;
use App\Http\Requests\City\UpdateRequest;
use App\Models\City;
use App\Models\State;

class CityController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:view_city', ['only' => ['index', 'show']]);
        $this->middleware('permission:add_city', ['only' => ['create', 'store']]);
        $this->middleware('permission:edit_city', ['only' => ['edit', 'update']]);
        $this->middleware('permission:delete_city', ['only' => ['destroy']]);
    }

    public function index()
    {
        $cities = City::get();
        $states = State::get();
        $rowNumber = 1;
        return view('dashboard.cities.index', compact('cities', 'rowNumber', 'states'));
    }

    public function store(StoreRequest $request)
    {
        $city = new City();
        $city->name = $request->name;
        $city->state_id = $request->state_id;
        $city->save();
        return redirect()->back()->with('add-success', __('success_messages.city.add.success'));
    }

    public function update(UpdateRequest $request)
    {
        $city = City::find($request->id);
        if (!$city)
            abort(404);
        if ($request->filled('name'))
            $city->name = $request->name;
        if ($request->filled('state_id'))
            $city->state_id = $request->state_id;
        $city->save();
        return redirect()->back()->with('edit-success', __('success_messages.city.edit.success'));
    }

    public function getCityZones($id)
    {
        $city = City::find($id);
        $zones = $city->zones->where('status', 1)->pluck('name', 'id');
        return json_decode($zones);
    }
}
