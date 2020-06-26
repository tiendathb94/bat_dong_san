<?php

use App\Permissions;
use Illuminate\Support\Facades\Auth;

function checkPermission($permName)
{
    static $rolesMappedNames, $permissions;

    if (!$rolesMappedNames) {
        $role = Auth::user()->find(Auth::user()->id)->roles()->select(['roles.name', 'roles.id'])->get();
        $rolesMappedNames = [];
        foreach ($role->toArray() as $r) {
            $rolesMappedNames[$r['name']] = $r['id'];
        }
    }

    if (isset($rolesMappedNames['super_admin'])) {
        return true;
    }

    if (!$permissions) {
        $permissions = Permissions::whereIn('role_id', array_values($rolesMappedNames))->pluck('route')->toArray();
    }

    if (in_array($permName, $permissions)) {
        return true;
    }

    return false;
}
