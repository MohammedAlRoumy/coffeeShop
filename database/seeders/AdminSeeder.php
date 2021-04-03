<?php

namespace Database\Seeders;

use App\Models\Admin;
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
        //

        $admin = Admin::create([
            'name' => 'SuperAdmin',
            'email' => 'super_admin@app.com',
            'password' => bcrypt('123456789'),
            'type' => 'admin',
        ]);

        $role = Role::create([
            'name' => 'المالك',
            'guard_name' => 'admin']);

        $permissions = Permission::pluck('id', 'id')->all();

        $role->syncPermissions($permissions);

        $admin->assignRole([$role->id]);
    }
}
