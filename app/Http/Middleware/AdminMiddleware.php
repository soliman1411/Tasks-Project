<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        if (!Auth::check()) {
            return redirect()->route('login.form')->with('error', 'يجب تسجيل الدخول أولاً');
        }

        if (!Auth::user()->hasRole('admin')) {
            return redirect()->route('tasks.index')->with('error', '⛔ غير مصرح لك بالوصول إلى هذه الصفحة');
        }

        return $next($request);
    }
}
