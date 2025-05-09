<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    public function handle($request, Closure $next)
    {
        // Kiểm tra xem người dùng đã đăng nhập chưa với guard admin
        if (!Auth::guard('admin')->check()) {
            return redirect()->route('login')->withErrors(['error' => 'Vui lòng đăng nhập để truy cập.']);
        }

        // Kiểm tra xem người dùng có id = 1 không (admin)
        if (Auth::guard('admin')->user()->id != 1) {
            Auth::guard('admin')->logout(); // Nếu không phải admin, đăng xuất người dùng
            return redirect()->route('login')->withErrors(['error' => 'Bạn không có quyền truy cập vào khu vực admin.']);
        }

        return $next($request);
    }
}
