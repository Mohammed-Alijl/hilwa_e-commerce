<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = new Admin();
        $admin->first_name = 'Mohammed';
        $admin->last_name = ' Alajel';
        $admin->email = 'admin@admin.com';
        $admin->mobile_number = '69997391';
        $admin->password = bcrypt('123456789');
        $admin->image = 'default.png';
        $admin->code = 'Mohammed';
        $admin->address = 'Aljala';
        $admin->roles_name = ['Admin'];
        $admin->city_id = 1;
        $admin->limit_state = true;
        $admin->save();

        $role = Role::create(['name' => 'Admin', 'guard_name' => 'admin']);

        $permissions = Permission::where('guard_name', 'admin')->pluck('id')->all();

        $role->syncPermissions($permissions);

        $admin->assignRole([$role->id]);

    }
}
