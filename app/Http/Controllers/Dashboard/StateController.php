<?php

namespace App\Http\Controllers\Dashboard;

use App\Repositories\StateRepository;
use Illuminate\Http\Request;

class StateController extends Controller
{
    public function __construct(private StateRepository $stateRepository)
    {
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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

    public function getStateCities($id)
    {
        $state = $this->stateRepository->find($id);
        $cities = $state->cities->pluck('name', 'id');
        return json_encode($cities);
    }
}
