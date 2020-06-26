<?php

use App\Permissions;
use Illuminate\Support\Facades\Auth;

function checkPermission($permName)
{
    if(auth()->user()->roles()->where('name', 'super_admin')->count()) {
        return true;
    }
    $role = Auth::user()->roles()->pluck('roles.id');
    $permissions = Permissions::whereIn('role_id', $role)->pluck('route')->toArray();

    if (in_array($permName, $permissions)) {
        return true;
    }

    return false;
}
