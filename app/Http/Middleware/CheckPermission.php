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

    public function __construct(Permissions $permission) {
        $this->user = auth()->user();
        $this->permission = $permission;

    }

    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (checkPermission($request->route()->getName())) {
            return $next($request);
        }

        return back()->with('error', 'Bạn không có quyền');
    }
}
