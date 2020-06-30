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
use App\Http\Requests\UpdateInfoRequest;

class AuthController extends Controller
{
    public function updateInfo(UpdateInfoRequest $request)
    {
        $user = auth()->user();
        $data = $request->all();
        $response = [];
        DB::beginTransaction();
        try {
            if($request->avatar) {
                $avatarName = $user->id . '.' . pathinfo($request->avatar->getClientOriginalName(), PATHINFO_EXTENSION);
                $request->avatar->storePubliclyAs('public/' . User::PATH_AVATAR, $avatarName);
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
            DB::commit();
            $response = [
                'status' => 'success',
                'text' => 'Cập nhật thông tin thành công',
                'user' => $user
            ];
        } catch (\Exception $e) {
            DB::rollback();
            $response = [
                'status' => 'danger',
                'text' => $e->getMessage(),
            ];
        }
        
        return response()->json($response);
    }
}
