<?php

namespace App\Http\Controllers;

use App\Http\Requests\Zone\CreateRequest;
use App\Http\Requests\Zone\DestroyRequest;
use App\Http\Requests\Zone\EditRequest;
use App\Http\Requests\Zone\IndexRequest;
use App\Http\Requests\Zone\StoreRequest;
use App\Http\Requests\Zone\UpdateRequest;
use Illuminate\Http\Request;

class ZoneController extends Controller
{
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
    public function destroy(DestroyRequest $request,string $id)
    {
        return $request->run($id);
    }
}
