<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminAuthController extends Controller
{
    public function showLogin()
    {
        return view('admin.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            if ($user->role === 'admin') {
                $request->session()->regenerate();
                return redirect()->route('admin.dashboard')->with('success', '관리자 로그인 성공');
            }
            Auth::logout();
            return back()->withErrors(['email' => '관리자 계정만 로그인할 수 있습니다.']);
        }

        return back()->withErrors(['email' => '이메일 또는 비밀번호가 잘못되었습니다.']);
    }
}
