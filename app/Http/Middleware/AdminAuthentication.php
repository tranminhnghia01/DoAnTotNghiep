<?php

namespace App\Http\Middleware;

use App\Models\Housekeeper;
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
        $user_id = Auth::user()->user_id;
        $housekeeper = Housekeeper::where("housekeeper_id", $user_id)->first();
        // dd($housekeeper);
        if( Auth::check() && Auth::user()->role_id == 1 ){
            return $next($request);
        }
        if(Auth::check() && $housekeeper == true ){
            if($housekeeper->status == '1'){
                Auth::logout();
                $msg = 'Tài khoản này đang chờ duyệt, bạn vui lòng sử dụng tài khoản khác hoặc thử lại sau! xin cảm ơn.';
                $style = 'warning';
                return redirect('/login')->with(compact('msg','style'));
            }else{
                return $next($request);

            }
        }
        else{
            Auth::logout();
            $msg = 'Bạn không có quyền truy cập vào trang Web này. Vùi lòng thử lại!';
            $style = 'danger';
            return redirect('/login')->with(compact('msg','style'));
        }
    }
}
