<?php

namespace App\Http\Controllers;


use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // Sử dụng kiến thức master layout
    // xây dựng giao diện trang login và register
    public function showLoginForm()
    {
        return view('auth.login'); // Kiểm tra xem có file 'resources/views/auth/login.blade.php' không
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        if (Auth::attempt($credentials)) {

            return redirect()->route('admin.dashboard'); // Đảm bảo route này tồn tại
        }

        return back()->withErrors(['email' => 'Thông tin đăng nhập không chính xác.']);
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
    public function showRegistrationForm()
    {
        return view('auth.register'); // Đảm bảo có file 'resources/views/auth/register.blade.php'
    }

    public function register(Request $request)
    {
        $data=$request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8|confirmed',
        ]);


        
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => $data['password'],
            'role' => User::ROLE_USER,
            
        ]);

        Auth::login($user);

        return redirect()->route('admin.dashboard'); // Chuyển hướng sau khi đăng ký thành công
    }
}
