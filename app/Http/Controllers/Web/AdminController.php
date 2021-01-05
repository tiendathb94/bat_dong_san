<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index(Request $request)
    {
        $keyword = $request->get('keyword','');
        if(!empty($keyword)){
            $users = User::where('fullname', 'LIKE', '%' . $keyword . '%')->paginate(20);
        }else{
            $users = User::paginate(20);
        }
        return view($this->_config['view'], ["users" => $users, "keyword" => $keyword]);
    }
}
