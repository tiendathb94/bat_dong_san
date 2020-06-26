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
        $role = $this->user->find(Auth::user()->id)->roles()->pluck('roles.id');
        $per = $this->permission->whereIn('role_id', $role)->pluck('route')->toArray();
        $route = \Request::route()->getName();
        
        if( in_array(\Request::route()->getName(), $per) ){
            return $next($request);
        }
        $message = [
            'status' => 'error',
            'text' => 'Bạn không có quyền thực thi, vui lòng kiểm tra lại.'
        ];
        return back()->with('message', $message);

    }
}
