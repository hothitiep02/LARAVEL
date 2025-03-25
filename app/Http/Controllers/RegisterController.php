<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    public function showregister(){
        return view('auth.register');
    }
    public function register(ProductRequest $request) // Sử dụng RegisterRequest
    {
        $user = User::create([
            'email' => $request->email,
            'full_name' => $request->full_name,
            'password' => bcrypt($request->password),
            'c_password' => bcrypt($request->password),
        ]);

        auth::login($user);

        return redirect()->route('register')->with('success', 'Đăng ký thành công!');
    }

    public function showLoginForm()
    {
        return view('auth.login'); // Trả về giao diện đăng nhập
    }

    public function login(ProductRequest $request)
    {
        // Validate dữ liệu đầu vào
        $request->validate([
            'email' => 'required|email',
            'pw' => 'required|min:6',
        ]);

        // Thử đăng nhập
        $credentials = ['email' => $request->email, 'password' => $request->pw];

        if (Auth::attempt($credentials)) {
            return redirect()->route('index')->with('success', 'Đăng nhập thành công!');
        }

        return redirect()->back()->with('error', 'Email hoặc mật khẩu không đúng.');
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login')->with('success', 'Bạn đã đăng xuất.');
    }
}
