<?php

namespace App\Http\Controllers;

use App\Models\Ad;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Stripe\Exception\CardException;
use Stripe\Stripe;
use Srmklive\PayPal\Services\PayPal as PayPalClient;
use Illuminate\Support\Facades\Log;

class AdvertiserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->only(['showDashboard', 'processAdPayment', 'paypalSuccess', 'paypalCancel']);
        Stripe::setApiKey(env('STRIPE_SECRET'));
    }

    /**
     * Show the advertiser dashboard with paid ads
     */
    public function showDashboard()
    {
        if (session('ad_data')) {
            \Log::info('Redirecting to payment section from dashboard', ['ad_data' => session('ad_data')]);
            return redirect()->route('adPaymentSection')->with('success', '로그인 성공! 결제 페이지로 이동합니다.');
        }
        $ads = auth()->user()->ads()->where('status', 'paid')->get();
        return view('advertiser.dashboard', compact('ads'));
    }

    /**
     * Load adApplicationPage view
     */
    public function adApplicationPage()
    {
        return view('advertiser.adApplicationPage');
    }

    /**
     * Handle Ad Application form submission
     */
    public function storeAdApplicationPage(Request $request)
    {
        $validated = $request->validate([
            'adTitle' => 'required|string|max:255',
            'description' => 'required|string|max:500',
            'creatives' => 'required|array|min:1',
            'creatives.*' => 'file|mimes:jpeg,png,jpg,mp4,mov,avi|max:20480',
            'adTypeSelection' => 'required|in:prepaid,postpaid',
        ], [
            'adTitle.required' => '광고 제목을 입력하세요.',
            'description.required' => '광고 설명을 입력하세요.',
            'creatives.required' => '광고 이미지를(를) 업로드해야 합니다.',
            'creatives.*.mimes' => '이미지 또는 동영상 파일만 업로드할 수 있습니다 (jpg, png, mp4 등).',
            'creatives.*.max' => '각 파일은 최대 20MB까지만 업로드할 수 있습니다.',
            'adTypeSelection.required' => '광고 유형을 선택하세요.',
        ]);

        $filePaths = [];
        if ($request->hasFile('creatives')) {
            foreach ($request->file('creatives') as $file) {
                $path = $file->store('ads', 'public');
                $normalizedPath = str_replace('\\', '/', $path);
                $filePaths[] = $normalizedPath;
                \Log::info('File uploaded', ['path' => $normalizedPath, 'filename' => $file->getClientOriginalName()]);
            }
        } else {
            \Log::warning('No files uploaded in creatives field');
        }

        session([
            'ad_data' => [
                'title' => $validated['adTitle'],
                'description' => $validated['description'],
                'type' => $validated['adTypeSelection'],
                'media' => $filePaths,
            ]
        ]);

        \Log::info('Ad data stored in session', ['ad_data' => session('ad_data')]);

        return redirect()
            ->route('storeIntroductionSection')
            ->with('success', '1단계가 완료되었습니다 — 광고 정보가 저장되었습니다. 스토어 정보로 이동하세요.');
    }

    /**
     * Load store introduction section view
     */
    public function storeIntroductionSection()
    {
        $adData = session('ad_data', []);
        if (empty($adData)) {
            return redirect()->route('adApplicationPage')->with('error', '광고 정보를 먼저 입력하세요.');
        }
        return view('advertiser.storeIntroduction', compact('adData'));
    }

    /**
     * Handle Store Introduction Section form submission
     */
    public function storeIntroductionSectionPost(Request $request)
    {
        $validated = $request->validate([
            'storeName' => 'required|string|max:255',
            'description' => 'required|string|max:500',
        ], [
            'storeName.required' => '매장 이름을 입력하세요.',
            'description.required' => '매장 설명을 입력하세요.',
        ]);

        $adData = session('ad_data', []);
        $adData['store'] = [
            'name' => $validated['storeName'],
            'description' => $validated['description'],
        ];

        session(['ad_data' => $adData]);

        \Log::info('Store data added to session', ['ad_data' => session('ad_data')]);

        return redirect()
            ->route('adPaymentSection')
            ->with('success', '매장 정보가 성공적으로 저장되었습니다!');
    }

    /**
     * Show the ad payment page
     */
    public function showAdPaymentSection(Request $request)
    {
        $adData = session('ad_data');
        if (!$adData) {
            return redirect()->route('adApplicationPage')->with('error', '광고 정보를 먼저 입력하세요.');
        }
        \Log::info('Showing payment section', ['ad_data' => session('ad_data')]);
        return view('advertiser.adPaymentSection', compact('adData'));
    }

    /**
     * Save ad data to database after successful payment
     */
    protected function saveAdToDatabase($adData, $paymentDetails, $transactionId, $status = 'paid')
    {
        $user = Auth::user();
        $media = $adData['media'] ?? [];
        $normalizedMedia = array_map(function ($path) {
            $normalized = str_replace('\\', '/', $path);
            if (!file_exists(storage_path('app/public/' . $normalized))) {
                \Log::error('Media file not found', ['file' => $normalized]);
            }
            return $normalized;
        }, $media);

        Ad::create([
            'user_id' => $user->id,
            'title' => $adData['title'] ?? 'Untitled Ad',
            'description' => $adData['description'] ?? '',
            'type' => $adData['type'] ?? 'prepaid',
            'media' => json_encode($normalizedMedia),
            'store_name' => $adData['store']['name'] ?? 'Unknown Store',
            'store_description' => $adData['store']['description'] ?? '',
            'quantity' => $paymentDetails['quantity'],
            'total' => $paymentDetails['total'],
            'payment_method' => $paymentDetails['paymentMethod'],
            'transaction_id' => $transactionId,
            'status' => $status,
            'posted_status' => 'not_posted',
        ]);

        \Log::info('Ad saved to database', [
            'user_id' => $user->id,
            'title' => $adData['title'] ?? 'Untitled Ad',
            'posted_status' => 'not_posted',
        ]);
    }

    /**
     * Process the ad payment
     */
    public function processAdPayment(Request $request)
    {
        \Log::info('Processing payment request', [
            'authenticated' => Auth::check(),
            'session_ad_data' => session('ad_data'),
            'url' => $request->url(),
            'method' => $request->method(),
        ]);

        if (!Auth::check()) {
            session(['url.intended' => route('adPaymentSection')]);
            \Log::info('Unauthenticated user, redirecting to register', [
                'intended_url' => session('url.intended'),
                'ad_data' => session('ad_data'),
            ]);
            return redirect()->route('register')->with('error', '결제를 완료하려면 먼저 계정을 등록하세요. (Please sign up to complete the payment.)');
        }

        $validated = $request->validate([
            'quantity' => 'required|integer|min:1|max:100',
            'paymentMethod' => 'required|in:creditCard,paypal',
        ], [
            'quantity.required' => '수량을 입력하세요. (Quantity is required.)',
            'quantity.min' => '수량은 1개 이상이어야 합니다. (Quantity must be at least 1.)',
            'quantity.max' => '수량은 100개를 초과할 수 없습니다. (Quantity cannot exceed 100.)',
            'paymentMethod.required' => '결제 수단을 선택하세요. (Please select a payment method.)',
        ]);

        $adData = session('ad_data', []);
        if (empty($adData)) {
            return redirect()->route('adApplicationPage')->with('error', '광고 정보를 먼저 입력하세요.');
        }

        foreach ($adData['media'] ?? [] as $media) {
            $normalizedMedia = str_replace('\\', '/', $media);
            if (!file_exists(storage_path('app/public/' . $normalizedMedia))) {
                \Log::error('Media file missing before payment', ['file' => $normalizedMedia]);
                return redirect()->route('adApplicationPage')->with('error', '업로드된 미디어 파일을 찾을 수 없습니다. 다시 업로드하세요.');
            }
        }

        $unitPrice = $adData['type'] == 'prepaid' ? 1.5 : 50;
        $total = $validated['quantity'] * $unitPrice;

        $user = Auth::user();
        $paymentMethod = $validated['paymentMethod'];

        session(['quantity' => $validated['quantity'], 'total' => $total]);

        \Log::info('Processing payment', ['user_id' => $user->id, 'payment_method' => $paymentMethod, 'total' => $total]);

        if ($paymentMethod === 'creditCard') {
            try {
                $charge = \Stripe\Charge::create([
                    'amount' => $total * 100,
                    'currency' => 'usd',
                    'source' => $request->stripeToken,
                    'description' => 'Ad Payment for ' . $user->email,
                    'metadata' => [
                        'quantity' => $validated['quantity'],
                        'ad_type' => $adData['type'] ?? 'prepaid',
                    ],
                ]);

                if ($charge->status === 'succeeded') {
                    $this->saveAdToDatabase($adData, [
                        'quantity' => $validated['quantity'],
                        'total' => $total,
                        'paymentMethod' => $paymentMethod,
                    ], $charge->id);
                    session()->forget(['ad_data', 'uploaded_creatives', 'quantity', 'total']);
                    return redirect()->route('dashboard')->with('success', '결제가 성공적으로 완료되었습니다! 대시보드로 이동하여 광고를 확인하세요. (Payment completed successfully! Redirected to dashboard to view your ad.)');
                } else {
                    return back()->with('error', '결제 처리 중 오류가 발생했습니다. (Payment processing error.)');
                }
            } catch (CardException $e) {
                return back()->with('error', '카드 결제 오류: ' . $e->getError()->message);
            } catch (\Exception $e) {
                return back()->with('error', '결제 중 오류가 발생했습니다: ' . $e->getMessage());
            }
        } elseif ($paymentMethod === 'paypal') {
            $provider = new PayPalClient;
            $provider->setApiCredentials(config('paypal'));
            $provider->getAccessToken();

            $payment = $provider->createOrder([
                'intent' => 'CAPTURE',
                'purchase_units' => [
                    [
                        'amount' => [
                            'currency_code' => 'USD',
                            'value' => number_format($total, 2, '.', ''),
                        ],
                        'description' => 'Ad Payment for ' . $user->email,
                        'custom_id' => $user->id . '_' . time(),
                    ],
                ],
                'application_context' => [
                    'return_url' => route('paypal.success'),
                    'cancel_url' => route('paypal.cancel'),
                ],
            ]);

            if (isset($payment['id']) && isset($payment['links'])) {
                session(['paypal_order_id' => $payment['id']]);
                foreach ($payment['links'] as $link) {
                    if ($link['rel'] === 'approve') {
                        return redirect()->away($link['href']);
                    }
                }
            }
            return back()->with('error', 'PayPal 결제 초기화 오류. (PayPal payment initialization error.)');
        }

        return back()->with('error', '지원되지 않는 결제 방법입니다. (Unsupported payment method.)');
    }

    /**
     * Handle PayPal payment success
     */
    public function paypalSuccess(Request $request)
    {
        $orderId = session('paypal_order_id');
        if (!$orderId) {
            return redirect()->route('adPaymentSection')->with('error', 'PayPal 주문 ID가 없습니다. (No PayPal order ID.)');
        }

        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $provider->getAccessToken();

        $payment = $provider->capturePaymentOrder($orderId);
        if (isset($payment['status']) && $payment['status'] === 'COMPLETED') {
            $adData = session('ad_data', []);
            $this->saveAdToDatabase($adData, [
                'quantity' => session('quantity', 1),
                'total' => session('total', 0),
                'paymentMethod' => 'paypal',
            ], $payment['id']);
            session()->forget(['ad_data', 'uploaded_creatives', 'paypal_order_id', 'quantity', 'total']);
            return redirect()->route('dashboard')->with('success', 'PayPal 결제가 성공적으로 완료되었습니다! 대시보드로 이동하여 광고를 확인하세요. (PayPal payment completed successfully! Redirected to dashboard to view your ad.)');
        }

        return redirect()->route('adPaymentSection')->with('error', 'PayPal 결제 확인 실패. (PayPal payment confirmation failed.)');
    }

    /**
     * Handle PayPal payment cancellation
     */
    public function paypalCancel(Request $request)
    {
        session()->forget(['paypal_order_id', 'quantity', 'total']);
        return redirect()->route('adPaymentSection')->with('error', '결제가 취소되었습니다. (Payment canceled.)');
    }

        public function signout(Request $request)
    {
        Log::info('Advertiser signed out', ['user_id' => Auth::id(), 'email' => Auth::user()->email]);
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('home')->with('success', '로그아웃되었습니다.');
    }
}
