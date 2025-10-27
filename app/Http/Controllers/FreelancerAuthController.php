<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Referral;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class FreelancerAuthController extends Controller
{
    public function showRegister()
    {
        return view('freelancer.register');
    }

   public function register(Request $request)
{
    $validated = $request->validate([
        'email' => 'required|email|unique:users,email',
        'password' => 'required|min:8|confirmed',
        'terms' => 'required|accepted',
    ]);

    return DB::transaction(function () use ($validated, $request) {
        $referredById = null;
        $referralCode = Cookie::get('referral_code');
        $referral = null;

        if ($referralCode) {
            $referrer = User::where('referral_code', $referralCode)->first();
            if ($referrer) {
                $referredById = $referrer->id;
                $bonus = \App\Models\ReferralBonus::first()->bonus_amount ?? 5.00;
                $referral = Referral::create([
                    'referrer_id' => $referrer->id,
                    'referred_id' => null,
                    'earning' => $bonus,
                    'status' => 'pending',
                ]);
            }
        }

        $user = User::create([
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role' => 'freelancer',
            'referred_by_id' => $referredById,
        ]);

        if ($referral) {
            $referral->update(['referred_id' => $user->id]);
        }

        Auth::login($user);
        Cookie::queue(Cookie::forget('referral_code'));

        Log::info('Freelancer registered', ['email' => $user->email, 'referred_by' => $referredById]);

        return redirect()->route('freelancer.ads');
    });
}

    public function showLogin()
    {
        return view('freelancer.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            if ($user->role !== 'freelancer') {
                Auth::logout();
                return back()->withErrors(['email' => '프리랜서 계정으로만 로그인할 수 있습니다.']);
            }
            $request->session()->regenerate();
            return redirect()->intended(route('freelancer.ads'));
        }

        return back()->withErrors(['email' => '이메일 또는 비밀번호가 잘못되었습니다.']);
    }
}
