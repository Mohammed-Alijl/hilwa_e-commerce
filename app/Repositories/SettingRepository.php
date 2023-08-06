<?php

namespace App\Repositories;

use App\Interfaces\BasicRepositoryInterface;
use App\Models\Setting;
use App\Models\ZipCode;

class SettingRepository implements BasicRepositoryInterface
{
    public function getAll()
    {
        return Setting::get();
    }

    public function find($id)
    {
        return Setting::findOrFail($id);
    }

    public function create($request)
    {
        $setting = new Setting();
        $setting->display_name = $request->display_name;
        $setting->namespace = $request->namespace;
        $setting->key = $request->key;
        if ($request->filled('value'))
            $setting->value = $request->value;
        else
            $setting->value = $request->boolean_value;

        $setting->type = $request->type;
        $setting->save();
    }

    public function update($request, $id)
    {
        $setting = Setting::findOrFail($request->id);
        if ($request->filled('display_name'))
            $setting->display_name = $request->display_name;
        if ($request->filled('namespace'))
            $setting->namespace = $request->namespace;
        if ($request->filled('key'))
            $setting->key = $request->key;
        if ($request->filled('value'))
            $setting->value = $request->value;
        else $setting->value = $request->boolean_value;
        if ($request->filled('type'))
            $setting->type = $request->type;
        $setting->save();
    }

    public function delete($id)
    {
        $setting = Setting::findOrFail($id);
        return $setting->delete();
    }

    public function getZipCodes()
    {
        return ZipCode::get();
    }

    public function addZipCode($request)
    {
        $zipCode = new ZipCode();
        $zipCode->zip_code = $request->input('zip_code');
        $zipCode->save();
        return $zipCode;
    }

    public function staticSetting($request)
    {
        $staticSetting = \App\Models\StaticSetting::first();
        $staticSetting->update_open = $request->has('update_open');
        $staticSetting->confirm_place_order = $request->has('confirm_place_order');
        $staticSetting->create_new_order_back_office = $request->has('create_new_order_back_office');
        $staticSetting->show_unavailable_offers = $request->has('show_unavailable_offers');

        $staticSetting->save();
    }

}
