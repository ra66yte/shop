<?php
namespace App\Traits;

use App\Models\Role;
use App\Models\Permission;

trait HasRolesAndPermissions
{

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'users_roles');
    }

    public function permissions()
    {
        return $this->belongsToMany(Permission::class, 'users_permissions');
    }

    public function hasRole(... $roles ) {
        if ($roles) {
            foreach ($roles as $role) {
                if ($this->roles->contains('slug', $role)) {
                    return true;
                }
            }
        } else {
            if ($this->roles->count() > 0) {
                return true;
            }
        }

        return false;
    }
    public function hasPermission($permission)
    {
        return (bool) $this->permissions->where('slug', $permission)->count();
    }

    public function hasPermissionTo($permission)
    {
        return $this->hasPermissionThroughRole($permission) || $this->hasPermission($permission->slug);
    }


    public function hasPermissionThroughRole($permission)
    {
        foreach ($permission->roles as $role){
            if ($this->roles->contains($role)) {
                return true;
            }
        }
        return false;
    }


    public function getAllPermissions(array $permissions)
    {
        return Permission::whereIn('slug', $permissions)->get();
    }

    public function givePermissionsTo(... $permissions)
    {
        $permissions = $this->getAllPermissions($permissions);
        if ($permissions === null) {
            return $this;
        }
        $this->permissions()->saveMany($permissions);
        return $this;
    }

    public function deletePermissions(... $permissions)
    {
        $permissions = $this->getAllPermissions($permissions);
        $this->permissions()->detach($permissions);
        return $this;
    }

    public function refreshPermissions(... $permissions )
    {
        $this->permissions()->detach();
        return $this->givePermissionsTo($permissions);
    }

}
