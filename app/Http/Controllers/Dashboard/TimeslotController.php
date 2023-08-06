<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Requests\Timeslot\StoreRequest;
use App\Http\Requests\Timeslot\UpdateRequest;
use App\Repositories\TimeslotRepository;

class TimeslotController extends Controller
{
    function __construct(private TimeslotRepository $timeslotRepository)
    {
        $this->middleware('permission:view_timeslot', ['only' => ['index', 'show']]);
        $this->middleware('permission:add_timeslot', ['only' => ['create', 'store']]);
        $this->middleware('permission:edit_timeslot', ['only' => ['edit', 'update']]);
        $this->middleware('permission:delete_timeslot', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $days = $this->timeslotRepository->getDays();
        $rowNumber = 1;
        return view('dashboard.timeslots.index', compact('days', 'rowNumber'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $days = $this->timeslotRepository->getDays();
        return view('dashboard.timeslots.create', compact('days'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        $this->timeslotRepository->create($request);
        return redirect()->route('timeslots.index')->with('add-success', __('success_messages.timeslot.add.success'));
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
        $day = $this->timeslotRepository->findDay($id);
        $days = $this->timeslotRepository->getDays();
        return view('dashboard.timeslots.edit', compact('day', 'days'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, string $id)
    {
        $this->timeslotRepository->update($request, $id);
        return redirect()->route('timeslots.index')->with('edit-success', __('success_messages.timeslot.edit.success'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }


}
