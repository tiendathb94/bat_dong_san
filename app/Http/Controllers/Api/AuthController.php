<?php

namespace App\Http\Controllers\Api;
use App\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Dirape\Token\Token;
use Cache;
use DB;
use Mail;
use Hash;
use Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function updateInfo(Request $request)
    {
        $user = auth()->user();
        $data = $request->all();
        if($request->avatar) {
            $avatarName = $user->id . '.' . pathinfo($request->avatar->getClientOriginalName(), PATHINFO_EXTENSION);
            $request->avatar->storePubliclyAs('/avatar', $avatarName);
            $data['avatar'] = $avatarName;
        } else {
            $data['avatar'] = $user->avatar;
        }
        $user->update($data);
        $user->address()->updateOrCreate([
            'addressable_id' => $user->id,
        ],
        [
            'province_id' => $request->province_id,
            'district_id' => $request->district_id,
            'ward_id' => $request->ward_id,
            'address' => $request->address,
        ]);
        dd($user);
    }

    public function information()
    {
        $user = auth()->user();
        $address = $user->address()->first();
        $data = [
            'user' => $user,
            'address' => $address
        ];
        return response()->json($data);
    }
}
