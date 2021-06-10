<?php

namespace Database\Seeders;

use App\Models\User;
use Hash;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class ParentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role = Role::create(['name' => 'parent']);
        $permission = Permission::create(['name' => 'show attendance']);
        $role->givePermissionTo($permission);
        $permission->assignRole($role);

        $user = new User();
        $user->name = "Wali Murid 1";
        $user->email = "wali1@gmail.com";
        $user->password = Hash::make("12345678");
        $user->save();
        $user->assignRole($role->name);
    }
}
