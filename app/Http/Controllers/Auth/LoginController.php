<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/dashboard';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }

    /**
     * Handle post-login redirect.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  mixed  $user
     * @return \Illuminate\Http\RedirectResponse
     */
    protected function authenticated(Request $request, $user)
    {
        \Log::info('Post-login redirect', ['user_id' => $user->id, 'intended_url' => session('url.intended'), 'ad_data' => session('ad_data')]);
        if (session('ad_data')) {
            return redirect()->route('adPaymentSection')->with('success', '로그인 성공! 결제 페이지로 이동합니다.');
        }
        $intendedUrl = session('url.intended', $this->redirectTo);
        session()->forget('url.intended');
        return redirect($intendedUrl);
    }
}
