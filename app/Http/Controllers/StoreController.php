<?php

namespace App\Http\Controllers;

use App\Http\Requests\Store\CreateRequest;
use App\Http\Requests\Store\DestroyRequest;
use App\Http\Requests\Store\EditRequest;
use App\Http\Requests\Store\IndexRequest;
use App\Http\Requests\Store\StoreRequest;
use App\Http\Requests\Store\UpdateRequest;
use App\Models\StoreTranslation;
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
    public function destroy(DestroyRequest $request, string $id)
    {
        return $request->run($id);
    }

    public function getStoreLanguages($langId, $storeId){
        $storeTranslation = StoreTranslation::where('store_id', $storeId)
            ->where('language_id', $langId)
            ->first();

        if (!$storeTranslation) {
            return json_decode('');
        }
        return response()->json(['store_name' => $storeTranslation->name]);
    }
}
