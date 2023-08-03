<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Requests\Setting\StoreRequest;
use App\Http\Requests\Setting\UpdateRequest;
use App\Models\Setting;
use App\Models\ZipCode;

class SettingController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:view_setting', ['only' => ['index', 'show']]);
        $this->middleware('permission:add_setting', ['only' => ['create', 'store']]);
        $this->middleware('permission:edit_setting', ['only' => ['edit', 'update']]);
        $this->middleware('permission:delete_setting', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $settings = Setting::get();
        $setting = new Setting();
        $zipCodes = ZipCode::get();
        return view('dashboard.settings.index', compact('settings', 'setting', 'zipCodes'));
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
    public function store(StoreRequest $request)
    {
        try {
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
            return redirect()->back();
        } catch (\Exception $ex) {
            return redirect()->back()->withErrors($ex->getMessage());
        }
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
    public function update(UpdateRequest $request)
    {
        try {
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
            if ($setting->save())
                return redirect()->route('settings.index');
            else
                return redirect()->back()->withErrors('failed', 'Failed to edit the setting');
        } catch (\Exception $ex) {
            return redirect()->back()->withErrors($ex->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $setting = Setting::findOrFail($id);
            if ($setting->delete())
                return redirect()->route('settings.index')->with('delete-success', __('success_messages.setting.delete'));
            else
                return redirect()->back()->withErrors('failed', 'failed to delete the setting');
        } catch (\Exception $ex) {
            return redirect()->back()->withErrors($ex->getMessage());
        }
    }
}
