<?php

namespace App\Repositories;

use App\Interfaces\BasicRepositoryInterface;
use App\Models\Admin;
use App\Traits\AttachmentTrait;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleRepository implements BasicRepositoryInterface
{
    use AttachmentTrait;

    protected $methods = ['view', 'add', 'edit', 'delete'];
    protected $models = ['dashboard', 'order', 'customer', 'driver', 'contact-request', 'review', 'category', 'product',
        'attribute', 'return', 'comment', 'advertisement', 'marketing', 'coupon', 'unit', 'store', 'setting', 'timeslot', 'user',
        'role', 'city', 'zone', 'log', 'reward', 'cms-page', 'holiday', 'chat', 'order-status', 'pre-sales-customer', 'payment-services'];

    public function getAll()
    {
        return Role::orderBy('id', 'Asc')->get();
    }

    public function find($id): Admin
    {
        return Role::findOrFail($id);
    }

    public function create($request)
    {
        $role = new Role();
        $role->name = $request->name;
        $role->guard_name = 'admin';
        $role->save();
        $permissions = Permission::whereIn('name', $request->permission)->get();
        $role->syncPermissions($permissions);
    }

    public function update($request, $id)
    {
        $role = Role::findOrFail($id);
        $role->name = $request->name;
        $role->save();
        $permissions = Permission::whereIn('name', $request->permission)->get();
        $role->syncPermissions($permissions);
    }

    public function delete($id)
    {
        $role = Role::findOrFail($id);
        $role->delete();
    }

    public function getPermissions()
    {
        return Permission::get();
    }

    public function getMethods()
    {
        return $this->methods;
    }

    public function getModels()
    {
        return $this->models;
    }

}
