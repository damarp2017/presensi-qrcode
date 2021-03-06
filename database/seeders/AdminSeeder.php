<?php

namespace Database\Seeders;

use App;
use App\Models\User;
use Hash;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role = Role::create(['name' => 'admin']);
        $permission = Permission::create(['name' => 'manage everything']);
        $role->givePermissionTo($permission);
        $permission->assignRole($role);
        $user = new User();

        $user->name = "Administrator";
        $user->email = "admin@gmail.com";
        $user->password = Hash::make("12345678");
        $user->save();

        $user->assignRole($role->name);
    }
}
