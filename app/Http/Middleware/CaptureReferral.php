<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use App\Models\User;

class CaptureReferral
{
    public function handle(Request $request, Closure $next)
    {
        if ($request->has('ref')) {
            $referralCode = $request->query('ref');
            $referrer = User::where('referral_code', $referralCode)->first();
            if ($referrer) {
                Cookie::queue('referral_code', $referralCode, 60 * 24 * 30); // 30 days
            }
        }
        return $next($request);
    }
}
