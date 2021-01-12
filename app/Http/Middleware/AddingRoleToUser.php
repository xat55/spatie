<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class AddingRoleToUser
{
    /**
    * Handle an incoming request.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  \Closure  $next
    * @return mixed
    */
    public function handle(Request $request, Closure $next, $role)
    {
        $user = auth()->user();
        $rolesCount = Role::where('name', $role)->count();
        $roles = $user->getRoleNames();

        if (0 === $roles->count()) {
            app()[PermissionRegistrar::class]->forgetCachedPermissions();

            if (0 === $rolesCount) {
                $roleUser = Role::create(['name' => $role]);
                $user->assignRole($roleUser);
                $permissions = Permission::pluck('name');

                foreach ($permissions as $permission) {
                    $roleUser->givePermissionTo($permission);
                }
            } else {
                $user->assignRole($role);
            }
        }

        return $next($request);
    }
}
