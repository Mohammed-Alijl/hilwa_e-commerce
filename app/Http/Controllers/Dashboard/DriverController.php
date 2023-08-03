<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Requests\Driver\StoreRequest;
use App\Http\Requests\Driver\UpdateRequest;
use App\Models\State;
use App\Models\User;
use App\Traits\AttachmentTrait;
use Illuminate\Support\Facades\Hash;

class DriverController extends Controller
{
    use AttachmentTrait;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $drivers = User::where('type', 'driver')->get();
        return view('dashboard.drivers.index', compact('drivers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $states = State::get();
        return view('dashboard.drivers.create', compact('states'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        $driver = new User();
        $driver->name = $request->first_name . " " . $request->last_name;
        $driver->email = $request->email;
        $driver->mobile_number = $request->mobile_number;
        $driver->password = Hash::make($request->password);
        $driver->zone_id = $request->zone_id;
        $driver->address = $request->address;
        if ($files = $request->file('pic')) {
            $imageName = $this->save_attachment($files, "img/drivers");
        } else
            $imageName = 'default.png';
        $driver->status = $request->status;
        $driver->image = $imageName;
        $driver->type = 'driver';
        $driver->save();
        return redirect()->route('drivers.index')
            ->with('add-success', __('success_messages.driver.add.success'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $driver = User::find($id);
        return view('dashboard.drivers.show', compact('driver'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $driver = User::findOrFail($id);
        $states = State::get();
        return view('dashboard.drivers.edit', compact('driver', 'states'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, string $id)
    {
        $driver = User::findOrFail($id);
        if ($request->filled('name'))
            $driver->name = $request->name;
        if ($request->filled('password'))
            $driver->password = Hash::make($request->password);
        if ($request->filled('email'))
            $driver->email = $request->email;
        if ($request->filled('address'))
            $driver->address = $request->address;
        if ($request->filled('zone_id'))
            $driver->zone_id = $request->zone_id;
        if ($request->filled('status'))
            $driver->status = $request->status;
        if ($files = $request->file('pic')) {
            if ($driver->image != 'default.png')
                $this->delete_attachment('img/drivers/' . $driver->image);
            $imageName = $this->save_attachment($files, "img/drivers");
            $driver->image = $imageName;
        }
        $driver->save();
        return redirect()->route('drivers.index')->with('edit-success', __('success_messages.driver.edit.success'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $driver = User::findOrFail($id);
        if ($driver->image != 'default.png')
            $this->delete_attachment('img/drivers/' . $driver->image);
        $driver->delete();
        return redirect()->route('drivers.index')->with('delete-success', __('success_messages.driver.delete.success'));
    }
}
