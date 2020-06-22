<?php

namespace App\Http\Controllers;

use App\Jobs\SendWelcomeEmail;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;
use Dirape\Token\Token;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class AuthController extends Controller
{
    private $user;
    public function __construct(User $user) {
        $this->user = $user;
    }

    public function registerForm() {
        return view('login.register');
    }

    public function registerStore( Request $request ) {

        request()->validate([
            'email' => 'required|email|unique:users',
            'password' => 'max:30|min:8|required_with:confirm_password|same:confirm_password',
            'confirm_password' => 'max:30|min:8',
            'fullname' =>  'required',
            'gender' => 'required',
            'type' => 'required',
            'tax'   => 'required'
        ],
        [
            'email.required' => 'Email không được để trống',
            'email.unique' => 'Email đã tồn tại',
            'email.email'=> 'Email không đúng định dạng',
            'password.max' => 'Mật khẩu tối đa 30 ký tự',
            'password.min' => 'Mật khẩu tối thiểu 8 ký tự',
            'password.required_with' => 'Mật khẩu không được để trống',
            'password.same' => 'Mật khẩu Không trùng khớp',
            'confirm_password.max' => 'Mật khẩu tối đa 30 ký tự',
            'confirm_password.min' => 'Mật khẩu tối thiểu 8 ký tự', 
            'fullname.required'=> 'Tên đầy đủ không được để trống',
            'tax.required' => 'Mã số thuế / CMND không được để trống'
        ]);
        
        try {

            $dataSave = $request->only('email', 'fullname','tax');

            $dataSave['type'] = (int) $request->type;
            $dataSave['gender'] = (int) $request->gender;
            $dataSave['password'] = bcrypt($request->password);
            $dataSave['remember_token'] =  (new Token())->Unique('users', 'remember_token', 60);
                
            DB::beginTransaction();

            DB::table('users')->insert($dataSave);

            Mail::send('templateEmail.welcome', ['dataSave' => $dataSave], function ($m) use ($dataSave) {
                $m->from('hello@app.com', 'Bất động sản');
    
                $m->to($dataSave['email'], $dataSave['fullname'])->subject('Thông báo xác thực tài khoản!');
            });

            DB::commit();

            return back()->with('success', 'Đăng ký tài khoản thành công! Xác thực tài khoản tại email!');


        } catch (\Exception $e) {

            DB::rollBack();

            $request->flash();

            return back()->with('error', 'Đăng ký thất bại mời thử lại!');

        }
    }

    public function loginForm() {

        return view('login.login');
    }
    
    public function loginStore( Request $request ) {
        
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {

            return redirect()->route('home');
        }
        $request->flash();
        return back()->with('error', 'Sai tài khoản hoặc mật khẩu!');
    }

    public function logout( Request $request ) {
        
        Auth::logout();

        return redirect()->route('home');
    
    }

    public function confirm(Request $request) {

        if( request('email') && request('remember_token') ) {
            $record = DB::table('users')->where('email', request('email'))->where('remember_token', request('remember_token'));
            if( $record->first() ){
                $record->update([
                    'email_verified_at' => now(),
                    'remember_token' => (new Token())->Unique('users', 'remember_token', 60)
                ]);
            return redirect()->route('loginForm')->with('success', 'Xác thực thành công! mời đăng nhập để tiếp tục!');
            }
        }
        return redirect()->route('loginForm')->with('error', 'Xác thực không thành công!');
    }


}
