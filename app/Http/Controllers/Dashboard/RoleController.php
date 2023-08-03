<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Requests\Role\StoreRequest;
use App\Http\Requests\Role\UpdateRequest;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        $this->middleware('permission:view_role', ['only' => ['index', 'show']]);
        $this->middleware('permission:add_role', ['only' => ['create', 'store']]);
        $this->middleware('permission:edit_role', ['only' => ['edit', 'update']]);
        $this->middleware('permission:delete_role', ['only' => ['destroy']]);
    }

    protected $methods = ['view', 'add', 'edit', 'delete'];
    protected $models = ['dashboard', 'order', 'customer', 'driver', 'contact-request', 'review', 'category', 'product',
        'attribute', 'return', 'comment', 'advertisement', 'marketing', 'coupon', 'unit', 'store', 'setting', 'timeslot', 'user',
        'role', 'city', 'zone', 'log', 'reward', 'cms-page', 'holiday', 'chat', 'order-status', 'pre-sales-customer', 'payment-services'];

    public function getMethods()
    {
        return $this->methods;
    }

    public function getModels()
    {
        return $this->models;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Role::orderBy('id', 'Asc')->paginate(5);
        $rowNumber = 1;
        return view('dashboard.roles.index', compact('roles', 'rowNumber'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $permission = Permission::get();
        $methods = $this->getMethods();
        $models = $this->getModels();
        return view('dashboard.roles.create', compact('permission', 'methods', 'models'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request)
    {
        $role = new Role();
        $role->name = $request->name;
        $role->guard_name = 'admin';
        $role->save();

        $permissions = Permission::whereIn('name', $request->permission)->get();
        $role->syncPermissions($permissions);

        return redirect()->route('roles.index')->with('add-success', __('success_messages.role.add'));
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $role = Role::findOrFail($id);
        $rolePermissions = $role->permissions->pluck('name')->toArray();
        $methods = $this->getMethods();
        $models = $this->getModels();

        return view('dashboard.roles.show', compact('role', 'rolePermissions', 'methods', 'models'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $role = Role::findOrFail($id);
        if ($role->name == "Admin")
            abort(403);
        $permissions = Permission::get();
        $rolePermissions = $role->permissions->pluck('name')->toArray();
        $methods = $this->getMethods();
        $models = $this->getModels();

        return view('dashboard.roles.edit', compact('role', 'permissions', 'rolePermissions', 'methods', 'models'));
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
        $role = Role::findOrFail($id);
        if ($request->filled('name'))
            $role->name = $request->name;
        $role->save();
        $permissions = Permission::whereIn('name', $request->permission)->get();
        $role->syncPermissions($permissions);

        return redirect()->route('roles.index')
            ->with('edit-success', __('success_messages.role.edit'));

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $role = Role::findOrFail($request->id);
        $role->delete();
        return redirect()->route('roles.index')
            ->with('delete-success', __('success_messages.role.destroy'));
    }
}
