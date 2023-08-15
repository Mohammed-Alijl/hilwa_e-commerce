<?php

namespace App\Repositories;

use App\Interfaces\BasicRepositoryInterface;
use App\Models\Language;
use App\Models\Store;

class StoreRepository implements BasicRepositoryInterface
{
    public function getAll()
    {
        return Store::get();
    }

    public function find($id)
    {
        return Store::findOrFail($id);
    }

    public function create($request)
    {
        $store = new Store();
        $store->name = $request->name;
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
    }

    public function update($request, $id)
    {
        $store = Store::findOrFail($id);
        $store->setTranslation('name',Language::findOrFail($request->language_id)->code,$request->name);
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
    }

    public function delete($id)
    {
        $store = Store::findOrFail($id);
        $store->delete();
    }

    public function getStoreLanguages($langId, $storeId)
    {
        return $this->find($storeId)->getTranslation('name',Language::findOrFail($langId)->code);
    }

    public function getActiveStores()
    {
        return Store::where('status', 1)->get();
    }

}
