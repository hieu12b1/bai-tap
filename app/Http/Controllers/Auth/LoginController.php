<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            // Nếu là admin thì truy cập luôn vào trang admin
            if (Auth::check() && Auth::user()->role === User::ROLE_ADMIN) {
                return redirect()->route('admin.dashboard');
            }
            return redirect()->intended('/');
        }

        return redirect()->back()->withErrors([
            'email' => 'Sai địa chỉ email.',
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        return redirect('/login');
    }
}

