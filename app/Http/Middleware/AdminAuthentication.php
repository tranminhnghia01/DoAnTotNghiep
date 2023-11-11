<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class AdminAuthentication
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    public function handle($request, Closure $next)
    {
        if( Auth::check() && Auth::user()->level == 0 ){
            return $next($request);
        }
        if(Auth::check() && Auth::user()->level == 1 ){
            return $next($request);
        }
        else{
            Auth::logout();
            $msg = 'Bạn không có quyền truy cập vào trang Web này. Vùi lòng thử lại!';
            $style = 'danger';
            return redirect('/login')->with(compact('msg','style'));
        }
    }
}
