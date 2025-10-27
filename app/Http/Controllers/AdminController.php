<?php

namespace App\Http\Controllers;

use App\Models\Ad;
use App\Models\AdSubmission;
use App\Models\User;
use App\Models\ReferralBonus;
use App\Models\FreelancerPayment;
use App\Models\FreelancerPaymentSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Models\Referral;

class AdminController extends Controller
{
    public function dashboard()
    {
        $totalAds = Ad::count();
        $pendingAds = Ad::where('status', 'pending')->count();
        $totalSubmissions = AdSubmission::count();
        $pendingSubmissions = AdSubmission::where('status', 'pending')->count();
        $totalUsers = User::count();
        $totalPayments = FreelancerPayment::sum('amount');

        return view('admin.dashboard', compact('totalAds', 'pendingAds', 'totalSubmissions', 'pendingSubmissions', 'totalUsers', 'totalPayments'));
    }

    public function manageAds(Request $request)
    {
        $query = Ad::with('user');
        if ($request->has('status') && in_array($request->input('status'), ['pending', 'paid', 'rejected'])) {
            $query->where('status', $request->input('status'));
        }
        $ads = $query->latest()->paginate(10);
        return view('admin.ads', compact('ads'));
    }

    public function approveAd($id)
    {
        $ad = Ad::findOrFail($id);
        $ad->update(['status' => 'paid']);
        Log::info('Ad approved by admin', ['ad_id' => $id, 'admin_id' => Auth::id()]);
        return redirect()->route('admin.ads')->with('success', '광고가 승인되었습니다.');
    }

    public function rejectAd($id)
    {
        $ad = Ad::findOrFail($id);
        $ad->update(['status' => 'rejected']);
        Log::info('Ad rejected by admin', ['ad_id' => $id, 'admin_id' => Auth::id()]);
        return redirect()->route('admin.ads')->with('success', '광고가 거부되었습니다.');
    }

    public function manageSubmissions(Request $request)
    {
        $query = AdSubmission::with(['freelancer', 'ad']);
        if ($request->has('status') && in_array($request->input('status'), ['pending', 'approved', 'rejected'])) {
            $query->where('status', $request->input('status'));
        }
        $submissions = $query->latest()->paginate(10);
        return view('admin.submissions', compact('submissions'));
    }

   public function approveSubmission($id)
{
    $submission = AdSubmission::findOrFail($id);
    $submission->update(['status' => 'approved']);

    // Create ad submission payment
    FreelancerPayment::create([
        'freelancer_id' => $submission->freelancer_id,
        'payment_id' => 'PAY-' . strtoupper(bin2hex(random_bytes(8))),
        'amount' => $submission->reward,
        'method' => 'paypal',
        'status' => 'processing',
        'evidence' => null,
        'paid_at' => now(),
    ]);

    // Check for referral bonus
    $user = User::find($submission->freelancer_id);
    if ($user->referred_by_id) {
        $referral = Referral::where('referred_id', $user->id)
            ->where('status', 'pending')
            ->first();
        if ($referral) {
            $referral->update(['status' => 'paid']);
            FreelancerPayment::create([
                'freelancer_id' => $referral->referrer_id,
                'payment_id' => 'REF-' . strtoupper(bin2hex(random_bytes(8))),
                'amount' => $referral->earning,
                'method' => 'paypal',
                'status' => 'processing',
                'evidence' => null,
                'paid_at' => now(),
            ]);
        }
    }

    Log::info('Submission approved by admin', ['submission_id' => $id, 'admin_id' => Auth::id()]);
    return redirect()->route('admin.submissions')->with('success', '제출이 승인되었습니다.');
}
    public function rejectSubmission($id)
    {
        $submission = AdSubmission::findOrFail($id);
        $submission->update(['status' => 'rejected']);
        Log::info('Submission rejected by admin', ['submission_id' => $id, 'admin_id' => Auth::id()]);
        return redirect()->route('admin.submissions')->with('success', '제출이 거부되었습니다.');
    }

    public function manageUsers(Request $request)
    {
        $query = User::query();
        if ($request->has('role') && in_array($request->input('role'), ['freelancer', 'advertiser', 'admin'])) {
            $query->where('role', $request->input('role'));
        }
        $users = $query->latest()->paginate(10);
        return view('admin.users', compact('users'));
    }

    public function updateUserRole(Request $request, $id)
    {
        $validated = $request->validate([
            'role' => 'required|in:freelancer,advertiser,admin',
        ]);
        $user = User::findOrFail($id);
        $user->update(['role' => $validated['role']]);
        Log::info('User role updated by admin', ['user_id' => $id, 'new_role' => $validated['role'], 'admin_id' => Auth::id()]);
        return redirect()->route('admin.users')->with('success', '사용자 역할이 업데이트되었습니다.');
    }

    public function managePayments()
    {
        $payments = FreelancerPayment::with('freelancer')->latest()->paginate(10);
        return view('admin.payments', compact('payments'));
    }

    public function signout()
    {
        Auth::logout();
        return redirect()->route('home')->with('success', '로그아웃되었습니다.');
    }

     public function referralSettings()
    {
        $bonus = ReferralBonus::first() ?? ReferralBonus::create(['bonus_amount' => 5.00]);
        return view('admin.referral-settings', compact('bonus'));
    }

    public function updateReferralBonus(Request $request)
    {
        $validated = $request->validate([
            'bonus_amount' => 'required|numeric|min:0',
        ]);

        $bonus = ReferralBonus::updateOrCreate([], ['bonus_amount' => $validated['bonus_amount']]);
        Referral::where('status', 'pending')->update(['earning' => $validated['bonus_amount']]);

        Log::info('Referral bonus updated by admin', ['bonus_amount' => $validated['bonus_amount'], 'admin_id' => Auth::id()]);

        return redirect()->route('admin.referral-settings')->with('success', '추천 보너스가 업데이트되었습니다.');
    }
    
}
