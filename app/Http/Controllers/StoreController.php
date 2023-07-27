<?php

namespace App\Http\Controllers;

use App\Http\Requests\Store\IndexRequest;
use Illuminate\Http\Request;

class StoreController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:view_store', ['only' => ['index','show']]);
        $this->middleware('permission:add_store', ['only' => ['create','store']]);
        $this->middleware('permission:edit_store', ['only' => ['edit','update']]);
        $this->middleware('permission:delete_store', ['only' => ['destroy']]);
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
    public function store(Request $request)
    {
        //
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
