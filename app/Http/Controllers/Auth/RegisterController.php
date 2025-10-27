<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/ad-payment-section';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'terms' => ['required', 'accepted'],
        ], [
            'email.required' => '이메일을 입력하세요. (Email is required.)',
            'email.email' => '유효한 이메일 주소를 입력하세요. (Please enter a valid email address.)',
            'email.unique' => '이 이메일은 이미 사용 중입니다. (This email is already in use.)',
            'password.required' => '비밀번호를 입력하세요. (Password is required.)',
            'password.min' => '비밀번호는 최소 8자 이상이어야 합니다. (Password must be at least 8 characters.)',
            'password.confirmed' => '비밀번호 확인이 일치하지 않습니다. (Password confirmation does not match.)',
            'terms.required' => '이용약관에 동의해야 합니다. (You must agree to the terms.)',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        \Log::info('Creating user', ['email' => $data['email'], 'ad_data' => session('ad_data')]);
        return User::create([
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'role' => 'advertiser',
        ]);
    }

    /**
     * Handle post-registration redirect.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  mixed  $user
     * @return \Illuminate\Http\RedirectResponse
     */
    protected function registered(Request $request, $user)
    {
        \Log::info('Post-registration redirect', ['user_id' => $user->id, 'intended_url' => session('url.intended'), 'ad_data' => session('ad_data')]);
        $intendedUrl = session('url.intended', route('dashboard'));
        session()->forget('url.intended');
        return redirect($intendedUrl);
    }
}
