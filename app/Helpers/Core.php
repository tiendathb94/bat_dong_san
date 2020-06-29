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


function renderSlug($str)
{
    $str = trim(mb_strtolower($str));
    $str = preg_replace('/(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)/', 'a', $str);
    $str = preg_replace('/(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)/', 'e', $str);
    $str = preg_replace('/(ì|í|ị|ỉ|ĩ)/', 'i', $str);
    $str = preg_replace('/(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)/', 'o', $str);
    $str = preg_replace('/(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)/', 'u', $str);
    $str = preg_replace('/(ỳ|ý|ỵ|ỷ|ỹ)/', 'y', $str);
    $str = preg_replace('/(đ)/', 'd', $str);
    $str = preg_replace('/[^a-z0-9-\s]/', '', $str);
    $str = preg_replace('/([\s]+)/', '-', $str);
    return $str;
}

if (!function_exists('getAllCategoriesNews'))  
{ 
    function getAllCategoriesNews(){
        $categories = [];
        $categories = DB::table('categories')->where('destination_entity', News::class)->get();
        return $categories;
    }
}  
