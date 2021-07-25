<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminLoginMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if(Auth::check()){
            $user=Auth::user();
            if($user->role==1){
                return $next($request);
            }else{
                return redirect('/index')->with(['flag'=>'warning','warning'=>'Tài khoản của bạn không có quyền quản trị: Bạn đang đăng nhập với tư cách người dùng phổ thông']);
            }
        }else{
            return redirect('/login')->with(['flag'=>'danger','notice'=>'Lỗi: Không thể đăng nhập']);
        }
    }
}
