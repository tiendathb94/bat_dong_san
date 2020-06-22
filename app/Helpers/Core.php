<?php

use App\Permissions;
use Illuminate\Support\Facades\Auth;

function checkPer($routeName)
{
    $role = Auth::user()->find(Auth::user()->id)->roles()->pluck('roles.id');
    $per = Permissions::whereIn('role_id', $role)->pluck('route')->toArray();
    $route = \Request::route()->getName();
    
    if( in_array($routeName, $per) ){
        return true;
    }
    return false;
}