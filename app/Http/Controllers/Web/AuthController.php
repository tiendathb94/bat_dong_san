<?php

namespace App\Http\Controllers\Web;
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

class AuthController extends Controller
{
    // [GET] /reset-password
    public function showRequestResetPasswordForm()
    {
        return view($this->_config['view']);
    }

    public function sendPasswordResetToken(Request $request) 
    {   
        $this->validate($request, [
            'email' => 'required|email'
        ],
        [
            'email.required' => 'Email không được để trống',
            'email.email'=> 'Email không đúng định dạng',
        ]);

        $user = User::where('email', $request->email)->first();

        if ($user) {

            $resetPasswordToken = Str::random(32);
            
            Cache::forget($user->getRequestResetPasswordCacheKey());

            Cache::put($user->getRequestResetPasswordCacheKey(), $resetPasswordToken, 60 * 30);

            $saveUser = $user->save();

            if(Cache::get($user->getRequestResetPasswordCacheKey())) {
                $dataSave['email'] = $request->email;
                $dataSave['resetPasswordToken'] = $resetPasswordToken;
                Mail::send('templateEmail.reset-password', ['dataSave' => $dataSave], function ($m) use ($dataSave) {
                    $m->from('hello@app.com', 'Bất động sản');
                    $m->to($dataSave['email'], $dataSave['resetPasswordToken'])->subject('Yêu cầu khôi phục mật khẩu');
                });

                session()->flash('success_message', 'Chúng tôi đã gửi một email tới địa chỉ email của bạn. Vui lòng kiểm tra hộp thư đến và làm theo hướng dẫn bên trong email.');
                return redirect()->back();
            }
        } else {
            session()->flash('error_message', 'Mail bạn gửi chưa đăng ký!');
            return redirect()->back();
        }
    }

    function showPasswordResetForm(Request $request) {
        $user = User::where('email', $request->email)->first();

        if($user !== null) {

            $cacheToken = Cache::get($user->getRequestResetPasswordCacheKey());
    
            if($request->resetPasswordToken !==  $cacheToken) {
                session()->flash('error_message', 'Liên kết đã hết hạn hoặc không hợp lệ');
                return redirect(route($this->_config['redirect']));
            }
    
            if ($user) {
                if (Cache::get($user->getRequestResetPasswordCacheKey())) {
                    return view($this->_config['view']);
                }
            }
        } else {
            session()->flash('error_message', 'Liên kết đã hết hạn hoặc không hợp lệ');
            return redirect(route($this->_config['redirect']));
        }
    }

    public function resetPassword(Request $request) {
        $this->validate($request, [
            'password' => 'required|min:8',
            'verify_password'   =>  'required|same:password',
        ],
        [
            'password.required' => 'Mật khẩu không được để trống',
            'password.min'=> 'Mật khẩu phải dài ít nhất 8 ký tự',
            'verify_password.required'=> 'Xác nhận mật khẩu không thể để trống',
            'verify_password.same' => 'Mật khẩu không giống nhau!!',
        ]);

        $params = $request->all();

        $user = User::where('email', $request->email)->first();

        $cacheToken = Cache::get($user->getRequestResetPasswordCacheKey());

        // Token is valid
        if (!empty($cacheToken) && !empty($params['resetPasswordToken']) && $cacheToken == $params['resetPasswordToken']) {

            Cache::forget($user->getRequestResetPasswordCacheKey());

            $user->password = Hash::make($params['password']);

            $user->save();

            session()->flash('success_message', 'Bạn đã đổi mật khẩu thành công mời đăng nhập!');

            return redirect(route($this->_config['redirect']));
        }
        
        // Token is invalid
        session()->flash('error_message', 'Liên kết đã hết hạn hoặc không hợp lệ đổi mật khẩu không thành công!');

        return redirect(route($this->_config['redirect']));
    }
}
