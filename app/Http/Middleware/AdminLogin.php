<?php

namespace App\Http\Middleware;

use Closure;

class AdminLogin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
//        dd(!session('user'));
        if (!session('user')) {
            return redirect('admin/login');
        } else {//如果已登录的话，请求登陆页让其返回到 用户中心首页
//            dd($request);
            if ($request['pathInfo'] === '/admin/login') {
                return redirect('admin/index');
            }
        }

        return $next($request);
    }
}
