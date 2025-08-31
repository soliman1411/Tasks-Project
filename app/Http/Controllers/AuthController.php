<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // عرض نموذج التسجيل
    public function showRegisterForm()
    {
        return view('auth.register');
    }

    // معالجة التسجيل
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
        ]);

         $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password), // تشفير كلمة المرور
        ]);
            $user->assignRole('user');

        return redirect()->route('login.form')->with('success', 'تم التسجيل بنجاح، الرجاء تسجيل الدخول');
    }

    // عرض نموذج تسجيل الدخول
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // معالجة تسجيل الدخول
   public function login(Request $request)
{
    $credentials = $request->validate([
        'email' => 'required|email',
        'password' => 'required',
    ]);

    if (Auth::attempt($credentials)) {
        $request->session()->regenerate();

        // إذا المستخدم هو الأدمن (id=1)
        if (Auth::user()->hasRole('admin')) {
            return redirect()->route('admin.dashboard');
        }
        else{
        return redirect()->route('tasks.index');

        }
    }

    // لو فشل تسجيل الدخول
    return back()->withErrors([
        'email' => 'بيانات الدخول غير صحيحة.',
    ])->withInput();
}

    // تسجيل الخروج
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login.form');
    }
}
