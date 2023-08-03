<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Requests\User\StoreRequest;
use App\Http\Requests\User\UpdateRequest;
use App\Models\Admin;
use App\Models\State;
use App\Models\User;
use App\Traits\AttachmentTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class AdminController extends Controller
{
    use AttachmentTrait;

    function __construct()
    {
        $this->middleware('permission:view_user', ['only' => ['index', 'show']]);
        $this->middleware('permission:add_user', ['only' => ['create', 'store']]);
        $this->middleware('permission:edit_user', ['only' => ['edit', 'update']]);
        $this->middleware('permission:delete_user', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = Admin::orderBy('id', 'DESC')->get();
        $rowNumber = 1;
        return view('dashboard.users.index', compact('users', 'rowNumber'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::all();
        $states = State::get();
        return view('dashboard.users.create', compact('roles', 'states'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request)
    {
        try {
            $user = new Admin();
            $user->first_name = $request->first_name;
            $user->last_name = $request->last_name;
            $user->email = $request->email;
            $user->mobile_number = $request->mobile_number;
            $user->password = Hash::make($request->password);
            $user->roles_name = $request->roles_name;
            $user->city_id = $request->city_id;
            $user->code = $request->code;
            $user->address = $request->address;
            $user->limit_state = $request->has('limit_state');
            if ($files = $request->file('pic')) {
                $imageName = $this->save_attachment($files, "img/admins");
            } else
                $imageName = 'default.png';
            $user->image = $imageName;
            $user->save();

            $user->assignRole($request->roles_name);

            return redirect()->route('users.index')
                ->with('add-success', __('success_messages.user.add.success'));
        } catch (Exception $ex) {
            return redirect()->back()->withErrors('failed', $ex->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $user = Admin::findOrFail($id);
            $userRole = $user->roles->pluck('name', 'name')->all();
            return view('dashboard.users.show', compact('user', 'userRole'));
        } catch (\Exception $ex) {
            return redirect()->back()->withErrors($ex->getMessage());
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try {
            $user = Admin::findOrFail($id);
            if ($user->roles->pluck('name', 'name')->first() == "Admin")
                abort(403);
            $roles = Role::pluck('name', 'name')->all();
            $userRole = $user->roles->pluck('name', 'name')->first();
            $states = State::get();
            return view('dashboard.users.edit', compact('user', 'roles', 'userRole', 'states'));
        } catch (Exception $ex) {
            return redirect()->back()->withErrors($ex->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, $id)
    {
        try {
            $user = Admin::findOrFail($id);
            if ($request->filled('password')) {
                $user->password = Hash::make($request->password);
                $user->save();
                return redirect()->route('users.index')->with('edit-success', __('success_messages.password.change'));
            }
            if ($request->filled('first_name'))
                $user->first_name = $request->first_name;
            if ($request->filled('last_name'))
                $user->last_name = $request->last_name;
            if ($request->filled('email'))
                $user->email = $request->email;
            if ($request->filled('mobile_number'))
                $user->mobile_number = $request->mobile_number;
            if ($request->filled('city_id'))
                $user->city_id = $request->city_id;
            if ($request->filled('roles_name'))
                $user->roles_name = $request->roles_name;
            if ($files = $request->file('pic')) {
                if ($user->image != 'default.png')
                    $this->delete_attachment('img/admins/' . $user->image);
                $imageName = $this->save_attachment($files, "img/admins");
                $user->image = $imageName;
            }
            if ($user->save()) {
                DB::table('model_has_roles')->where('model_id', $id)->delete();
                $user->assignRole($request->roles_name);
                return redirect()->route('users.index')->with('edit-success', __('success_messages.data.edit'));
            } else
                return redirect()->withErrors(__('failed_messages.failed'));
        } catch (Exception $ex) {
            return redirect()->back()->withErrors($ex->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        try {
            $user = Admin::find($request->id);
            if (!$user)
                return redirect()->back()->withErrors(__('failed_messages.user.notFound'));
            if ($user->image != 'default.png')
                $this->delete_attachment('img/admins/' . $user->image);
            if ($user->delete()) {
                return redirect()->back()->with('delete-message', __('success_messages.user.destroy'));
            } else
                return redirect()->back()->withErrors(__('failed_messages.failed'));
        } catch (\Exception $ex) {
            return redirect()->back()->withErrors($ex->getMessage());
        }
    }


    public function checkEmail(Request $request)
    {
        $email = $request->input('email');
        $exists = User::where('email', $email)->exists();

        return response()->json(['exists' => $exists]);
    }

    public function checkMobile(Request $request)
    {
        $mobileNumber = $request->input('mobile_number');
        $exists = User::where('mobile_number', $mobileNumber)->exists();

        return response()->json(['exists' => $exists]);
    }

    public function checkCode(Request $request)
    {
        $code = $request->input('code');
        $exists = User::where('code', $code)->exists();

        return response()->json(['exists' => $exists]);
    }
}
