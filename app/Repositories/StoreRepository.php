<?php

namespace App\Repositories;

use App\Interfaces\BasicRepositoryInterface;
use App\Models\Store;
use App\Models\StoreTranslation;

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
    }

    public function update($request, $id)
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
        return StoreTranslation::where('store_id', $storeId)
            ->where('language_id', $langId)
            ->first();
    }

    public function getActiveStores()
    {
        return Store::where('status', 1)->get();
    }

}
