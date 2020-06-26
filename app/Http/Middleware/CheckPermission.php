<?php

namespace App\Http\Middleware;

use App\Permissions;
use App\Role;
use App\User;
use Closure;
use Illuminate\Support\Facades\Auth;

class CheckPermission
{

    private $user;
    private $permission;

    public function __construct(User $user, Permissions $permission) {
        $this->user = $user;
        $this->permission = $permission;

    }
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if($this->user->role == 'super_admin') {
            return $next($request);
        }
        $role = $this->user->find(Auth::user()->id)->roles()->pluck('roles.id');
        $perm = $this->permission->whereIn('role_id', $role)->pluck('route')->toArray();
        $route = \Request::route()->getName();
        
        if( in_array(\Request::route()->getName(), $perm) ){
            return $next($request);
        }
        $message = [
            'status' => 'danger',
            'text' => 'Bạn không có quyền truy cập, vui lòng kiểm tra lại.'
        ];
        return back()->with('message', $message);

    }
}
