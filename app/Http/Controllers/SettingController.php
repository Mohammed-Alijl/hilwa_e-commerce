<?php

namespace App\Http\Controllers;

use App\Http\Requests\Setting\DestroyRequest;
use App\Http\Requests\Setting\IndexRequest;
use App\Http\Requests\Setting\StoreRequest;
use App\Http\Requests\Setting\UpdateRequest;

class SettingController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:view_setting', ['only' => ['index','show']]);
        $this->middleware('permission:add_setting', ['only' => ['create','store']]);
        $this->middleware('permission:edit_setting', ['only' => ['edit','update']]);
        $this->middleware('permission:delete_setting', ['only' => ['destroy']]);
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
    public function create()
    {
        //
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
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request)
    {
        return $request->run();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DestroyRequest $request, string $id)
    {
        return $request->run($id);
    }
}
