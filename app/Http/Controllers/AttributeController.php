<?php

namespace App\Http\Controllers;

use App\Http\Requests\Attribute\CreateRequest;
use App\Http\Requests\Attribute\IndexRequest;
use App\Http\Requests\Attribute\StoreRequest;
use Illuminate\Http\Request;

class AttributeController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:view_attribute', ['only' => ['index','show']]);
        $this->middleware('permission:add_attribute', ['only' => ['create','store']]);
        $this->middleware('permission:edit_attribute', ['only' => ['edit','update']]);
        $this->middleware('permission:delete_attribute', ['only' => ['destroy']]);
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
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
