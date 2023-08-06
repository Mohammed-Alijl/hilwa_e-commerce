<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Requests\City\StoreRequest;
use App\Http\Requests\City\UpdateRequest;
use App\Repositories\CityRepository;
use App\Repositories\StateRepository;

class CityController extends Controller
{
    private $cityRepository;
    private $stateRepository;

    function __construct(CityRepository $cityRepository, StateRepository $stateRepository)
    {
        $this->cityRepository = $cityRepository;
        $this->stateRepository = $stateRepository;
        $this->middleware('permission:view_city', ['only' => ['index', 'show']]);
        $this->middleware('permission:add_city', ['only' => ['create', 'store']]);
        $this->middleware('permission:edit_city', ['only' => ['edit', 'update']]);
        $this->middleware('permission:delete_city', ['only' => ['destroy']]);
    }

    public function index()
    {
        $cities = $this->cityRepository->getAll();
        $states = $this->stateRepository->getAll();
        $rowNumber = 1;
        return view('dashboard.cities.index', compact('cities', 'rowNumber', 'states'));
    }

    public function store(StoreRequest $request)
    {
        $this->cityRepository->create($request->only(['name', 'state_id']));
        return redirect()->back()->with('add-success', __('success_messages.city.add.success'));
    }

    public function update(UpdateRequest $request)
    {
        $this->cityRepository->update($request->only(['name', 'state_id']), $request->id);
        return redirect()->back()->with('edit-success', __('success_messages.city.edit.success'));
    }

    public function getCityZones($id)
    {
        $city = $this->cityRepository->find($id);
        $zones = $city->zones->where('status', 1)->pluck('name', 'id');
        return json_decode($zones);
    }
}
