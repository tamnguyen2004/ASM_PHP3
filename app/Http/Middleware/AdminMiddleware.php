<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    public function handle($request, Closure $next)
    {
        // Kiểm tra xem người dùng đã đăng nhập và có vai trò admin
        if (Auth::check() && Auth::user()->role === 'admin') {
            return $next($request); // Cho phép truy cập
        }

        // Nếu không, chuyển hướng tới trang khác (ví dụ: trang lỗi hoặc trang chủ)
        return redirect()->route('client.home')->with('error', 'You do not have admin access');
    }
}


