<?php

namespace Database\Seeders;

use App\Models\User;
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
        $user = new User();
        $user->first_name = 'Mohammed';
        $user->last_name = ' Alajel';
        $user->email = 'admin@admin.com';
        $user->mobile_number = 69997391;
        $user->password = bcrypt('123456789');
        $user->image = 'default.jpg';
        $user->code = 'Mohammed';
        $user->roles_name = ['Admin'];
        $user->city_id = 1;
        $user->save();

        $role = Role::create(['name' => 'Admin']);

        $permissions = Permission::pluck('id','id')->all();

        $role->syncPermissions($permissions);

        $user->assignRole([$role->id]);
    }
}
