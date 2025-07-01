<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(Request $request)
{
    // Xác thực dữ liệu đầu vào
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users',
        'password' => 'required|string|min:8|confirmed',
    ]);

    // Tạo người dùng mới
    User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password),
    ]);

    // Không đăng nhập ngay sau khi đăng ký
    return redirect()->route('login')->with('success', 'Đăng ký thành công! Vui lòng đăng nhập.');
}


    public function showRegisterForm()
    {
        return view('auth.register');
    }
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            return redirect()->route('dashboard');
        }

        return back()->withErrors(['login' => 'Email hoặc mật khẩu không đúng']);
    }
    public function showLoginForm(){
        return view('auth.login');
    }
    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}