<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function changeActive($id)
    {
        $user = User::where('id',$id)->firstOrFail();
        $user->active = $user->active == 1 ? 0 : 1;
        $user->save();
    }
}
