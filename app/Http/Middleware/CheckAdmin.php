<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckAdmin
{
    public function handle($request, Closure $next)
    {
        // Kiểm tra xem người dùng đã đăng nhập và có quyền admin chưa
        if (!Auth::check()) {
            // Nếu chưa đăng nhập, chuyển hướng đến trang đăng nhập
            return redirect()->route('login')->with('error', 'You need to log in first.');
        }

        // Kiểm tra xem người dùng có phải là admin không
        if (Auth::user()->role !== 'admin') {
            // Nếu không phải là admin, chuyển hướng đến trang chính
            return redirect('/')->with('error', 'You do not have admin access.');
        }

        return $next($request); // Cho phép tiếp tục nếu là admin
    }
}



