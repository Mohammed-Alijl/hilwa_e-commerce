<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Requests\Store\StoreRequest;
use App\Http\Requests\Store\UpdateRequest;
use App\Models\Language;
use App\Models\State;
use App\Models\Store;
use App\Models\StoreTranslation;

class StoreController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:view_store', ['only' => ['index', 'show']]);
        $this->middleware('permission:add_store', ['only' => ['create', 'store']]);
        $this->middleware('permission:edit_store', ['only' => ['edit', 'update']]);
        $this->middleware('permission:delete_store', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $rowNumber = 1;
        $stores = Store::get();
        return view('dashboard.stores.index', compact('stores', 'rowNumber'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $states = State::get();
        return view('dashboard.stores.create', compact('states'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        $store = new Store();
        $store->email = $request->email;
        $store->mobile_number = $request->mobile_number;
        $store->open_time = $request->open_time;
        $store->close_time = $request->close_time;
        $store->city_id = $request->city_id;
        $store->latitude = $request->latitude;
        $store->longitude = $request->longitude;
        $store->zip_code = $request->zip_code;
        $store->status = $request->status;
        $store->save();
        $storeTranslation = new StoreTranslation();
        $storeTranslation->name = $request->name;
        $storeTranslation->store_id = $store->id;
        $storeTranslation->language_id = 1;
        $storeTranslation->save();
        return redirect()->route('stores.index')->with('add-success', __('success_messages.store.add.success'));
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
        $store = Store::find($id);
        $languages = Language::get();
        $states = State::get();
        return view('dashboard.stores.edit', compact('store', 'languages', 'states'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, string $id)
    {
        $store = Store::findOrFail($id);
        $storeTranslation = StoreTranslation::where('language_id', $request->language_id)->where('store_id', $id)->first();
        if (!$storeTranslation) {
            $storeTranslation = new StoreTranslation();
            $storeTranslation->language_id = $request->language_id;
            $storeTranslation->store_id = $id;
        }
        $storeTranslation->name = $request->name;
        $storeTranslation->save();
        $store->email = $request->email;
        $store->mobile_number = $request->mobile_number;
        if ($request->filled('open_time'))
            $store->open_time = $request->open_time;
        if ($request->filled('close_time'))
            $store->close_time = $request->close_time;
        $store->city_id = $request->city_id;
        $store->latitude = $request->latitude;
        $store->longitude = $request->longitude;
        $store->zip_code = $request->zip_code;
        $store->status = $request->status;
        $store->save();
        return redirect()->route('stores.index')->with('edit-success', __('success_messages.store.edit.success'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $store = Store::findOrFail($id);
        if ($store->zones->count() > 0) {
            return redirect()->route('stores.index')->with('delete-failed', __('failed_messages.store.delete.failed'));
        } else {
            $store->delete();
            return redirect()->route('stores.index')->with('delete-success', __('success_messages.store.delete.success'));
        }
    }

    public function getStoreLanguages($langId, $storeId)
    {
        $storeTranslation = StoreTranslation::where('store_id', $storeId)
            ->where('language_id', $langId)
            ->first();

        if (!$storeTranslation) {
            return json_decode('');
        }
        return response()->json(['store_name' => $storeTranslation->name]);
    }
}
