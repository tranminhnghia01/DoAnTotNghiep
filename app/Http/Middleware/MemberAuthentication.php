<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class MemberAuthentication
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    public function handle($request, Closure $next)
        {
            if (Auth::check()== false) {
            return $next($request);
        }
        if( Auth::check() && Auth::user()->role_id == 3 ){
            return $next($request);
        }else{
            Auth::logout();
            $msg = 'Tài khoản của bạn không có quyền truy cập vào trang này. Vui lòng đăng ký hoặc dùng tài khoản khác!';
            $style='danger';
           return redirect()->route('home.login')->with(compact('msg','style'));
        }
    }
}
