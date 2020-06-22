<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class RoleController extends Controller
{
    public function addRole(Request $request)
    {
        request()->validate([
            'role_id' => 'required',
            ],
        [
            'role_id.required' => 'Bạn chưa chọn quyền'
        ]);
        
        DB::table('roleUser')->where('user_id', Auth::user()->id)->where('role_id', (int)$request->role_id);
        
    }
}
