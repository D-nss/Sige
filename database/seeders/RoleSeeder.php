<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create(['name' => 'super', 'guard_name' => 'web_user'])->givePermissionTo(
            'user-list',
            'user-create',
            'user-edit',
            'user-delete',
            'role-list',
            'role-create',
            'role-edit',
            'role-delete'
        );

        Role::create(['name' => 'admin', 'guard_name' => 'web_user'])->givePermissionTo(
            'user-list',
            'user-create',
            'user-edit',
            'user-delete'
        );

        Role::create(['name' => 'user','guard_name' => 'web_user']);
    }
}
