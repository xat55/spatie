<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;
use Illuminate\Support\Facades\Hash;

class PermissionsSeeder extends Seeder
{
    /**
    * Run the database seeds.
    *
    * @return void
    */
    public function run()
    {
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // create permissions
        Permission::create(['name' => 'edit articles']);
        Permission::create(['name' => 'delete articles']);
        Permission::create(['name' => 'publish articles']);
        Permission::create(['name' => 'unpublish articles']);

        // create role 'banned'
        Role::create(['name' => 'banned']);

        // gets all permissions via Gate::before rule; see AuthServiceProvider
        $roleAdmin = Role::create(['name' => 'admin']);

        $admin = \App\Models\User::factory()->create([
            'name' => 'admin',
            'email' => 'admin@mail.ru',
            'password' => Hash::make(12345678)
        ]);
        $admin->assignRole($roleAdmin);

        // $roleAdmin->givePermissionTo('edit articles');
        // $roleAdmin->givePermissionTo('delete articles');
        // $roleAdmin->givePermissionTo('publish articles');
        // $roleAdmin->givePermissionTo('unpublish articles');
    }
}
