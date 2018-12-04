<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;

class AdminAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        //共享登录用户信息
        $user = Auth::guard('admin')->user();
        
        View::share('adminUser', $user);

        //查找该用户的菜单信息

        //查看当前请求路由
        $route = get_current_url();
        session(['route'=>$route]);

        
        return $next($request);
    }
}
