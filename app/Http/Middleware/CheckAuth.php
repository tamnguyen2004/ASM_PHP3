<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Kiểm tra xem người dùng đã đăng nhập chưa
        if (!Auth::check()) {
            // Nếu chưa đăng nhập, chuyển hướng đến trang đăng nhập
            return redirect()->route('login')->with('error', 'Bạn cần đăng nhập để truy cập.');
        }

        // Kiểm tra xem người dùng có phải là admin không
        if (Auth::user()->role !== 'admin') {
            // Nếu không phải admin, chuyển hướng về trang chính
            return redirect('/')->with('error', 'Bạn không có quyền truy cập admin.');
        }

        // Cho phép tiếp tục nếu là admin
        return $next($request);
    }
}
