<?php

use App\Entities\News;
use App\Entities\Project;
use App\Permissions;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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

function getDifferentTime($time)
{
    $text = '';
    if($time) {
        $now = Carbon\Carbon::now();
        $minuteDifferent = $now->diffInMinutes($time);
        $hourDifferrent = number_format($minuteDifferent / 60);
        $dayDifferent = number_format($hourDifferrent / 24);
        
        if ($minuteDifferent < 60) {
            $text = $minuteDifferent . ' phút trước';
        } else if ($hourDifferrent < 24) {
            $text = $hourDifferrent . ' giờ trước';
        } else if ($dayDifferent < 7) {
            $text = $dayDifferent . ' ngày trước';
        } else {
            $text = $time->format('d/m/y H:s');
        }
    }
    return $text;
}


