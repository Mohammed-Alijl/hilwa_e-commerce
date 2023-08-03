<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Requests\Timeslot\StoreRequest;
use App\Http\Requests\Timeslot\UpdateRequest;
use App\Models\Day;
use App\Models\Timeslot;

class TimeslotController extends Controller
{
    function __construct()
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
        $days = Day::get();
        $rowNumber = 1;
        return view('dashboard.timeslots.index', compact('days', 'rowNumber'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $days = Day::get();
        return view('dashboard.timeslots.create', compact('days'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        $timeslot = new Timeslot();
        $timeslot->day_id = $request->day_id;
        $timeslot->start_time = $request->start_time;
        $timeslot->end_time = $request->end_time;
        $timeslot->total_order = $request->total_order;
        $timeslot->display_order = $request->display_order;
        $timeslot->save();
        $day = Day::find($request->day_id);
        $day->delivery_available = 1;
        $day->save();
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
        $day = Day::findOrFail($id);
        $days = Day::get();
        return view('dashboard.timeslots.edit', compact('day', 'days'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, string $id)
    {
        $fields = ['start_time', 'end_time', 'total_order', 'display_order', 'timeslot_id'];
        if (!$this->hasEqualArrayCount($request, $fields)) {
            return redirect()->back()->withErrors('Some Thing Error');
        }
        foreach ($request->start_time as $index => $start_time) {
            $timeslot = Timeslot::find($request->timeslot_id[$index]);
            $timeslot->start_time = $request->start_time[$index];
            $timeslot->end_time = $request->end_time[$index];
            $timeslot->total_order = $request->total_order[$index];
            $timeslot->display_order = $request->display_order[$index];
            $timeslot->save();
        }
        return redirect()->route('timeslots.index')->with('edit-success', __('success_messages.timeslot.edit.success'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    private function hasEqualArrayCount($request, $fields)
    {
        $count = count($request->{$fields[0]});
        foreach ($fields as $field) {
            if (count($request->{$field}) !== $count) {
                return false;
            }
        }
        return true;
    }
}
