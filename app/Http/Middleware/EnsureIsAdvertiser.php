<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EnsureIsAdvertiser
{
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::check()) {
            return redirect()->route('advertiser.login.form')->with('error', '광고주로 로그인해야 이 기능에 접근할 수 있습니다.');
        }

        if (Auth::user()->role !== 'advertiser') {
            return redirect()->route('freelancer.register.form')->with('error', '광고주로 등록해야 이 기능에 접근할 수 있습니다.');
        }

        return $next($request);
    }
}