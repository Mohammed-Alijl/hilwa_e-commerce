<?php

namespace App\Http\Controllers;

use App\Http\Requests\Timeslot\CreateRequest;
use App\Http\Requests\Timeslot\EditRequest;
use App\Http\Requests\Timeslot\IndexRequest;
use App\Http\Requests\Timeslot\StoreRequest;
use App\Http\Requests\Timeslot\UpdateRequest;

class TimeslotController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:view_timeslot', ['only' => ['index','show']]);
        $this->middleware('permission:add_timeslot', ['only' => ['create','store']]);
        $this->middleware('permission:edit_timeslot', ['only' => ['edit','update']]);
        $this->middleware('permission:delete_timeslot', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index(IndexRequest $request)
    {
        return $request->run();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(CreateRequest $request)
    {
        return $request->run();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        return $request->run();
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
    public function edit(EditRequest $request, string $id)
    {
        return $request->run($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, string $id)
    {
        return $request->run($id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
