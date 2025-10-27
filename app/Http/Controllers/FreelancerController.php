<?php

   namespace App\Http\Controllers;

   use App\Models\Ad;
   use App\Models\AdSubmission;
   use App\Models\FreelancerPayment;
   use App\Models\FreelancerPaymentSetting;
   use Illuminate\Http\Request;
   use Illuminate\Support\Facades\Auth;
   use Illuminate\Support\Facades\Session;
   use Illuminate\Support\Facades\Log;
   use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

   class FreelancerController extends Controller
   {
       public function showFreelancerAds(Request $request)
       {
           $query = Ad::where('status', 'paid')->where('posted_status', 'not_posted');

           if ($request->has('ad_type') && in_array($request->input('ad_type'), ['prepaid', 'postpaid'])) {
               $query->where('type', $request->input('ad_type'));
           }

           if ($request->has('budget')) {
               $budget = $request->input('budget');
               if ($budget === '1') {
                   $query->where('total', '<', 50);
               } elseif ($budget === '2') {
                   $query->whereBetween('total', [50, 100]);
               } elseif ($budget === '3') {
                   $query->whereBetween('total', [100, 200]);
               } elseif ($budget === '4') {
                   $query->where('total', '>=', 200);
               }
           }

           $ads = $query->get();

           Log::info('Freelancer ads fetched', ['count' => $ads->count(), 'filters' => $request->all()]);

           return view('freelancer.ads', compact('ads'));
       }

       public function claimAd($ad)
       {
           $adSubmission = AdSubmission::where('freelancer_id', Auth::id())->where('ad_id', $ad)->first();
           if ($adSubmission) {
               return redirect()->route('freelancer.ads')->with('already_claimed', $ad);
           }

           Session::put('intended_ad_id', $ad);

           if (!Auth::check()) {
               return redirect()->route('freelancer.login.form');
           }

           if (Auth::user()->role !== 'freelancer') {
               return redirect()->route('dashboard')->with('error', '프리랜서로 등록해야 광고를 실행할 수 있습니다.');
           }

           return redirect()->route('freelancer.ads');
       }

       public function submitLinks(Request $request)
       {
           if (Auth::user()->role !== 'freelancer') {
               return redirect()->route('dashboard')->with('error', '프리랜서로 등록해야 링크를 제출할 수 있습니다.');
           }

           $validated = $request->validate([
               'ad_id' => 'required|exists:ads,id',
               'sns_link' => 'required|array|min:1',
               'sns_link.*' => 'required|url',
           ]);

           $ad = Ad::find($validated['ad_id']);
           if (count($validated['sns_link']) != $ad->quantity) {
               return back()->withErrors(['sns_link' => '광고 수량(' . $ad->quantity . '개)에 맞는 SNS 링크 수를 입력하세요.']);
           }

           $reward = $ad->type === 'prepaid' ? 0.5 : 10; // Adjust as needed

           AdSubmission::create([
               'freelancer_id' => Auth::id(),
               'ad_id' => $validated['ad_id'],
               'sns_links' => $validated['sns_link'],
               'reward' => $reward,
               'status' => 'pending',
           ]);

           Log::info('SNS links submitted', ['freelancer_id' => Auth::id(), 'ad_id' => $validated['ad_id'], 'sns_links' => $validated['sns_link']]);

           return redirect()->route('freelancer.dashboard')->with('success', 'SNS 링크가 제출되었습니다. 검토 중입니다.');
       }

       public function deleteSubmission($id)
       {
           $submission = AdSubmission::where('freelancer_id', Auth::id())->findOrFail($id);
           $submission->delete();
           Log::info('Ad submission deleted', ['freelancer_id' => Auth::id(), 'submission_id' => $id]);
           return redirect()->route('freelancer.dashboard')->with('success', '광고 제출이 삭제되었습니다.');
       }

       public function dashboard()
       {
           $submissions = Auth::user()->adSubmissions()->with('ad')->get();
           $totalAds = $submissions->count();
           $totalEarnings = $submissions->where('status', 'paid')->sum('reward');
           $verifiedAds = $submissions->where('status', 'approved')->count();

           return view('freelancer.dashboard', compact('submissions', 'totalAds', 'totalEarnings', 'verifiedAds'));
       }

       public function paymentSettings()
       {
           $paymentSetting = Auth::user()->paymentSettings;
           return view('freelancer.payment-settings', compact('paymentSetting'));
       }

      public function savePaymentSettings(Request $request)
    {
        $validated = $request->validate([
            'full_name' => 'required|string|max:255',
            'paypal_email' => [
                'required',
                'email',
                'max:255',
                \Illuminate\Validation\Rule::unique('freelancer_payment_settings', 'paypal_email')
                    ->ignore(Auth::user()->paymentSettings?->id ?? null),
            ],
            'country' => 'required|string|max:100',
        ]);

        $user = Auth::user();

        FreelancerPaymentSetting::updateOrCreate(
            ['freelancer_id' => $user->id],
            [
                'full_name' => $validated['full_name'],
                'paypal_email' => $validated['paypal_email'],
                'country' => $validated['country'],
                'is_verified' => false,
            ]
        );

        Log::info('Payment settings saved', [
            'freelancer_id' => $user->id,
            'paypal_email' => $validated['paypal_email'],
        ]);

        return redirect()->route('freelancer.payment-settings')
            ->with('success', '결제 정보가 저장되었습니다.');
    }


       public function paymentHistory()
       {
           $payments = Auth::user()->payments()->latest()->get();
           return view('freelancer.payment-history', compact('payments'));
       }

       public function signout()
       {
           Auth::logout();
           return redirect()->route('home')->with('success', '로그아웃되었습니다.');
       }

        public function promotionalCenter()
    {
        $user = Auth::user();
        $referralLink = $user->referral_link;
        $totalEarnings = $user->referrals()->where('status', 'paid')->sum('earning');
        $pendingEarnings = $user->referrals()->where('status', 'pending')->sum('earning');

        return view('freelancer.promotional-center', compact('referralLink', 'totalEarnings', 'pendingEarnings'));
    }
   }
   