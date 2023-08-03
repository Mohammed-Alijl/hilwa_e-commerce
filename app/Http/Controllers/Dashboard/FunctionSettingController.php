<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;

class FunctionSettingController extends Controller
{
    public function staticSetting(Request $request)
    {
        $staticSetting = \App\Models\StaticSetting::first();
        $staticSetting->update_open = $request->has('update_open');
        $staticSetting->confirm_place_order = $request->has('confirm_place_order');
        $staticSetting->create_new_order_back_office = $request->has('create_new_order_back_office');
        $staticSetting->show_unavailable_offers = $request->has('show_unavailable_offers');

        $staticSetting->save();
        return redirect()->back();
    }
}
