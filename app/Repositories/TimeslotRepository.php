<?php

namespace App\Repositories;

use App\Interfaces\BasicRepositoryInterface;
use App\Models\Day;
use App\Models\Timeslot;

class TimeslotRepository implements BasicRepositoryInterface
{
    public function getAll()
    {
        return Timeslot::get();
    }

    public function find($id)
    {
        return Timeslot::findOrFail($id);
    }

    public function create($request)
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
    }

    public function update($request, $id)
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
    }

    public function delete($id)
    {
        // TODO: Implement delete() method.
    }

    public function getDays()
    {
        return Day::get();
    }

    public function findDay($id)
    {
        return Day::findOrFail($id);
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
