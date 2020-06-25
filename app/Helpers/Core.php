<?php

use App\Permissions;
use Illuminate\Support\Facades\Auth;

function checkPermission($permName)
{
    $role = Auth::user()->find(Auth::user()->id)->roles()->pluck('roles.id');
    $permissions = Permissions::whereIn('role_id', $role)->pluck('route')->toArray();

    if (in_array($permName, $permissions)) {
        return true;
    }

    return false;
}
