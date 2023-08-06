<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Requests\Store\StoreRequest;
use App\Http\Requests\Store\UpdateRequest;
use App\Repositories\LanguageRepository;
use App\Repositories\StateRepository;
use App\Repositories\StoreRepository;

class StoreController extends Controller
{
    function __construct(
        private StoreRepository    $storeRepository,
        private StateRepository    $stateRepository,
        private LanguageRepository $languageRepository
    )
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
        $stores = $this->storeRepository->getAll();
        return view('dashboard.stores.index', compact('stores', 'rowNumber'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $states = $this->stateRepository->getAll();
        return view('dashboard.stores.create', compact('states'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        $this->storeRepository->create($request);
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
        $store = $this->storeRepository->find($id);
        $languages = $this->languageRepository->getAll();
        $states = $this->stateRepository->getAll();
        return view('dashboard.stores.edit', compact('store', 'languages', 'states'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, string $id)
    {
        $this->storeRepository->update($request, $id);
        return redirect()->route('stores.index')->with('edit-success', __('success_messages.store.edit.success'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $store = $this->storeRepository->find($id);
        if ($store->zones->count() > 0) {
            return redirect()->route('stores.index')->with('delete-failed', __('failed_messages.store.delete.failed'));
        } else {
            $this->storeRepository->delete($id);
            return redirect()->route('stores.index')->with('delete-success', __('success_messages.store.delete.success'));
        }
    }

    public function getStoreLanguages($langId, $storeId)
    {
        $storeTranslation = $this->storeRepository->getStoreLanguages($langId, $storeId);

        if (!$storeTranslation) {
            return json_decode('');
        }
        return response()->json(['store_name' => $storeTranslation->name]);
    }
}
