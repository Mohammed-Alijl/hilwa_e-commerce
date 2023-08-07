<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Requests\SettingRequest;
use App\Models\Setting;
use App\Repositories\SettingRepository;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    function __construct(private SettingRepository $settingRepository)
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
        $settings = $this->settingRepository->getAll();
        $setting = new Setting();
        $zipCodes = $this->settingRepository->getZipCodes();
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
    public function store(SettingRequest $request)
    {
        try {
            $this->settingRepository->create($request);
            return redirect()->back()->with('add-success', __('success_messages.setting.add.success'));
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
    public function update(SettingRequest $request)
    {
        try {
            $this->settingRepository->update($request, $request->id);
            return redirect()->route('settings.index')->with('edit-success', __('success_messages.setting.edit.success'));
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
            if ($this->settingRepository->delete($id))
                return redirect()->route('settings.index')->with('delete-success', __('success_messages.setting.delete.success'));
            else
                return redirect()->back()->withErrors('failed', 'failed to delete the setting');
        } catch (\Exception $ex) {
            return redirect()->back()->withErrors($ex->getMessage());
        }
    }

    public function staticSetting(Request $request)
    {
        $this->settingRepository->staticSetting($request);
        return redirect()->back();
    }

    public function addZipCode(\App\Http\Requests\ZipCodeRequest $request)
    {
        $zipCode = $this->settingRepository->addZipCode($request);
        return response()->json(['zip_code' => $zipCode->zip_code]);
    }
}
