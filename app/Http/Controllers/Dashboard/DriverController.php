<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Requests\Driver\StoreRequest;
use App\Http\Requests\Driver\UpdateRequest;
use App\Repositories\DriverRepository;
use App\Repositories\StateRepository;

class DriverController extends Controller
{
    public function __construct(private DriverRepository $driverRepository, private StateRepository $stateRepository)
    {
        $this->middleware('permission:view_driver', ['only' => ['index', 'show']]);
        $this->middleware('permission:add_driver', ['only' => ['create', 'store']]);
        $this->middleware('permission:edit_driver', ['only' => ['edit', 'update']]);
        $this->middleware('permission:delete_driver', ['only' => ['destroy']]);
    }


    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $drivers = $this->driverRepository->getAll();
        return view('dashboard.drivers.index', compact('drivers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $states = $this->stateRepository->getAll();
        return view('dashboard.drivers.create', compact('states'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        $this->driverRepository->create($request);
        return redirect()->route('drivers.index')
            ->with('add-success', __('success_messages.driver.add.success'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $driver = $this->driverRepository->find($id);
        return view('dashboard.drivers.show', compact('driver'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $driver = $this->driverRepository->find($id);
        $states = $this->stateRepository->getAll();
        return view('dashboard.drivers.edit', compact('driver', 'states'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, string $id)
    {
        $this->driverRepository->update($request, $id);
        return redirect()->route('drivers.index')->with('edit-success', __('success_messages.driver.edit.success'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->driverRepository->delete($id);
        return redirect()->route('drivers.index')->with('delete-success', __('success_messages.driver.delete.success'));
    }
}
