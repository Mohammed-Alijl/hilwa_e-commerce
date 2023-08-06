<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Requests\User\StoreRequest;
use App\Http\Requests\User\UpdateRequest;
use App\Models\User;
use App\Repositories\RoleRepository;
use App\Repositories\StateRepository;
use App\Repositories\UserRepository;
use App\Traits\AttachmentTrait;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class AdminController extends Controller
{
    private $userRepository, $stateRepository, $roleRepository;
    use AttachmentTrait;

    function __construct(UserRepository $userRepository, StateRepository $stateRepository, RoleRepository $roleRepository)
    {
        $this->userRepository = $userRepository;
        $this->stateRepository = $stateRepository;
        $this->roleRepository = $roleRepository;
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
        $users = $this->userRepository->getAll();
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
        $roles = $this->roleRepository->getAll();
        $states = $this->stateRepository->getAll();
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
            $adminData = $request->only(['first_name','last_name','email','mobile_number','password','roles_name','city_id','code','address']);
            $adminData += ['limit_state'=>$request->has('limit_state')];
            $adminData += ['image' => $request->file('pic') ? $this->save_attachment($request->file('pic'), "img/admins") : 'default.png'];
            $user = $this->userRepository->create($adminData);

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
            $user = $this->userRepository->find($id);
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
            $user = $this->userRepository->find($id);
            if ($user->roles->pluck('name', 'name')->first() == "Admin")
                abort(403);
            $roles = Role::pluck('name', 'name')->all();
            $userRole = $user->roles->pluck('name', 'name')->first();
            $states = $this->stateRepository->getAll();
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
       $this->userRepository->update($request,$id);
                return redirect()->route('users.index')->with('edit-success', __('success_messages.data.edit'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $this->userRepository->delete($request->id);
        return redirect()->back()->with('delete-message', __('success_messages.user.destroy'));

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
