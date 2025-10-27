<!DOCTYPE html>
<html lang="en" data-bs-theme="dark" data-pwa="true">
<head>
    <meta charset="utf-8">
    <meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, viewport-fit=cover">

    <title>Ad Payment Section</title>
    <meta name="description" content="Complete your ad payment">
    <meta name="keywords" content="advertising, payment, ad platform">
    <meta name="author" content="Ad Platform">

    <!-- Webmanifest -->
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <link rel="manifest" href="{{ asset('assets-advertiser/manifest.json') }}">

    <!-- Fonts -->
    <link rel="preload" href="{{ asset('assets-advertiser/fonts/inter-variable-latin.woff2') }}" as="font" type="font/woff2" crossorigin>
    <link rel="preload" href="{{ asset('assets-advertiser/icons/finder-icons.woff2') }}" as="font" type="font/woff2" crossorigin>
    <link rel="stylesheet" href="{{ asset('assets-advertiser/icons/finder-icons.min.css') }}">

    <!-- Bootstrap + Theme styles -->
    <link rel="preload" href="{{ asset('assets-advertiser/css/theme.min.css') }}" as="style">
    <link rel="preload" href="{{ asset('assets-advertiser/css/theme.rtl.min.css') }}" as="style">
    <link rel="stylesheet" href="{{ asset('assets-advertiser/css/theme.min.css') }}" id="theme-styles">

    <!-- Stripe.js -->
    <script src="https://js.stripe.com/v3/"></script>

    <!-- Scripts -->
    <script src="{{ asset('assets-advertiser/js/theme-switcher.js') }}"></script>
    <script src="{{ asset('assets-advertiser/js/customizer.min.js') }}"></script>
</head>

<body data-bs-theme="dark">

    <!-- Navigation bar -->
    <header class="navbar navbar-expand-lg bg-body navbar-sticky sticky-top z-fixed px-0">
        <div class="container">
            <!-- Mobile menu toggler -->
            <button type="button" class="navbar-toggler me-3 me-lg-0" data-bs-toggle="offcanvas" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- Logo -->
            <a class="navbar-brand py-1 py-md-2 py-xl-1 me-2 me-sm-n4 me-md-n5 me-lg-0" href="{{ route('home') }}">
                Logo
            </a>

            <!-- Offcanvas menu -->
            <nav class="offcanvas offcanvas-start" id="navbarNav" tabindex="-1" aria-labelledby="navbarNavLabel">
                <div class="offcanvas-header py-3">
                    <h5 class="offcanvas-title" id="navbarNavLabel">둘러보기 (Browse)</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
                <div class="offcanvas-body pt-2 pb-4 py-lg-0 mx-lg-auto">
                    <ul class="navbar-nav position-relative">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('home') }}">홈 (Home)</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="{{ route('adApplicationPage') }}">대시보드 페이지 (Dashboard)</a>
                        </li>
                    </ul>
                </div>
            </nav>

            <!-- Account dropdown -->
            <div class="d-flex gap-sm-1">
                <div class="dropdown">
                    <a class="btn btn-icon btn-outline-secondary fs-lg border-0 animate-shake me-2" href="#" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false" aria-label="My account">
                        <i class="fi-user animate-target"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" style="--fn-dropdown-spacer: .5rem">
                        <li><span class="h6 dropdown-header">{{ auth()->user()->email ?? 'Guest' }}</span></li>
                        <li>
                            <a class="dropdown-item" href="{{ route('adApplicationPage') }}">
                                <i class="fi-layers opacity-75 me-2"></i>My Ads
                            </a>
                        </li>
                        <li><hr class="dropdown-divider"></li>
                        <li>
                            <a class="dropdown-item" href="{{ route('logout') }}">
                                <i class="fi-log-out opacity-75 me-2"></i>Sign out
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </header>

    <!-- Page content -->
    <main class="content-wrapper">
        <div class="container pt-3 pt-sm-4 pt-md-5 pb-5">
            <div class="row pt-lg-2 pt-xl-3 pb-1 pb-sm-2 pb-md-3 pb-lg-4 pb-xl-5">
                <!-- Sidebar navigation -->
                <aside class="col-lg-3 col-xl-4 mb-3" style="margin-top: -100px">
                    <div class="sticky-top overflow-y-auto" style="padding-top: 100px">
                        <ul class="nav flex-lg-column flex-nowrap gap-4 gap-lg-0 text-nowrap pb-2 pb-lg-0">
                            <li class="nav-item">
                                <a class="nav-link d-inline-flex px-0 px-lg-3 pe-none">
                                    <i class="fi-check-circle fs-lg me-2"></i>광고 제작 섹션 (Ad Creation)
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link d-inline-flex px-0 px-lg-3 pe-none">
                                    <i class="fi-check-circle fs-lg me-2"></i>매장 소개 섹션 (Store Introduction)
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link d-inline-flex px-0 px-lg-3 active" aria-current="page">
                                    <i class="fi-arrow-right-circle d-none d-lg-inline-flex fs-lg me-2"></i>
                                    <i class="fi-arrow-down-circle d-lg-none fs-lg me-2"></i>광고 결제 섹션 (Ad Payment)
                                </a>
                            </li>
                        </ul>
                    </div>
                </aside>

                <!-- Main form -->
                <div class="col-lg-9 col-xl-8">
                    <h1 class="h2 mb-4">광고 결제 섹션 (Ad Payment Section)</h1>

                    <!-- Display success/error messages -->
                    @if (session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif
                    @if (session('error'))
                        <div class="alert alert-danger">{{ session('error') }}</div>
                    @endif

                    <!-- Ad Summary -->
                    <div class="card mb-4">
                        <div class="card-header">
                            <h3 class="h5">광고 요약 (Ad Summary)</h3>
                        </div>
                        <div class="card-body">
                            <p><strong>광고 제목 (Ad Title):</strong> {{ $adData['title'] ?? 'N/A' }}</p>
                            <p><strong>매장 이름 (Store Name):</strong> {{ $adData['store']['name'] ?? 'N/A' }}</p>
                            <p><strong>광고 유형 (Ad Type):</strong> {{ $adData['type'] == 'prepaid' ? '선불 광고 (Prepaid)' : '후불 광고 (Postpaid)' }}</p>
                            @if (!empty($adData['media']))
                                <p><strong>광고 미디어 (Ad Media):</strong></p>
                                <div class="row row-cols-2 row-cols-sm-3 g-2">
                                    @foreach ($adData['media'] as $file)
                                        <div class="col">
                                            @if (in_array(pathinfo($file, PATHINFO_EXTENSION), ['mp4', 'mov', 'avi']))
                                                <video src="{{ asset('storage/' . $file) }}" controls class="w-100 rounded border" style="max-height: 100px;"></video>
                                            @else
                                                <img src="{{ asset('storage/' . $file) }}" class="w-100 rounded border" style="max-height: 100px;">
                                            @endif
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Payment Form -->
                    <form action="{{ route('adPaymentSection.post') }}" method="POST" id="payment-form">
                        @csrf

                        <div class="mb-4">
                            <label for="adType" class="form-label">광고 유형 (Ad Type)</label>
                            <input type="text" class="form-control form-control-lg" id="adType"
                                value="{{ $adData['type'] == 'prepaid' ? '선불 광고 (Prepaid)' : '후불 광고 (Postpaid)' }}"
                                disabled>
                        </div>

                        <div class="mb-4">
                            <label for="quantity" class="form-label">수량 (Quantity)</label>
                            <input type="number" class="form-control form-control-lg" id="quantity" name="quantity"
                                placeholder="1-100개 (1-100)" min="1" max="100" value="{{ old('quantity', 1) }}" required>
                            @error('quantity')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="mb-4" style="max-width: 390px">
                            <label for="price" class="form-label">금액 (Amount)</label>
                            <div class="position-relative">
                                <i class="fi-dollar-sign fs-lg position-absolute top-50 start-0 translate-middle-y ms-3"></i>
                                <input type="number" class="form-control form-control-lg form-icon-start" id="price"
                                    value="{{ old('price', $adData['type'] == 'prepaid' ? 1.5 : 50) }}" disabled>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label class="form-label fs-base">결제 수단 (Payment Method)*</label>
                            <div class="vstack gap-2">
                                <div class="form-check mb-1">
                                    <input type="radio" class="form-check-input" id="creditCard" name="paymentMethod"
                                        value="creditCard" {{ old('paymentMethod', 'creditCard') == 'creditCard' ? 'checked' : '' }} required>
                                    <label for="creditCard" class="form-check-label">신용카드 (Credit Card)</label>
                                </div>
                                <div class="form-check mb-1">
                                    <input type="radio" class="form-check-input" id="paypal" name="paymentMethod"
                                        value="paypal" {{ old('paymentMethod') == 'paypal' ? 'checked' : '' }}>
                                    <label for="paypal" class="form-check-label">페이팔 (PayPal)</label>
                                </div>
                            </div>
                            @error('paymentMethod')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div id="creditCardForm" style="display: {{ old('paymentMethod', 'creditCard') == 'creditCard' ? 'block' : 'none' }};" class="mb-4">
                            <h5>카드 정보 (Card Details)</h5>
                            <div id="card-element" class="form-control p-3 border"></div>
                            <input type="hidden" name="stripeToken" id="stripeToken">
                            <small class="text-muted">테스트 카드: 4242 4242 4242 4242, 만료 12/34, CVC 123 (Test card: 4242 4242 4242 4242, Exp 12/34, CVC 123)</small>
                            <div id="card-errors" class="text-danger mt-2"></div>
                        </div>

                        <button type="submit" class="btn btn-primary animate-slide-end ms-auto">결제 완료 (Complete Payment)</button>
                    </form>
                </div>
            </div>
        </div>
    </main>

    <!-- Footer / Progress -->
    <footer class="sticky-bottom bg-body pb-3">
        <div class="progress rounded-0" role="progressbar" aria-label="Progress" aria-valuenow="100" aria-valuemin="0"
            aria-valuemax="100" style="height: 4px">
            <div class="progress-bar bg-dark d-none-dark" style="width: 100%"></div>
            <div class="progress-bar bg-light d-none d-block-dark" style="width: 100%"></div>
        </div>
        <div class="container d-flex gap-3 pt-3">
            <div id="total" class="h5 mb-0"></div>
        </div>
    </footer>

    <!-- Scripts -->
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const unitPrice = {{ $adData['type'] == 'prepaid' ? 1.5 : 50 }};
            const quantityInput = document.getElementById('quantity');
            const priceInput = document.getElementById('price');
            const total = document.getElementById('total');

            function updateTotal() {
                const quantity = Math.min(Math.max(parseInt(quantityInput.value) || 1, 1), 100);
                const totalAmount = quantity * unitPrice;
                priceInput.value = totalAmount.toFixed(2);
                total.textContent = `합계: $${totalAmount.toFixed(2)} (Total: $${totalAmount.toFixed(2)})`;
            }

            quantityInput.addEventListener('input', updateTotal);
            updateTotal(); // Initial calculation
        });

        // Stripe.js integration
        const stripe = Stripe('{{ env('STRIPE_KEY') }}');
        const elements = stripe.elements();
        const cardElement = elements.create('card', {
            style: {
                base: {
                    fontSize: '16px',
                    color: '#ffffff',
                    '::placeholder': {
                        color: '#6c757d',
                    },
                },
                invalid: {
                    color: '#dc3545',
                },
            },
        });
        cardElement.mount('#card-element');

        // Toggle credit card form
        document.querySelectorAll('input[name="paymentMethod"]').forEach(radio => {
            radio.addEventListener('change', function() {
                document.getElementById('creditCardForm').style.display = this.value === 'creditCard' ? 'block' : 'none';
            });
        });

        // Handle form submission
        const form = document.getElementById('payment-form');
        form.addEventListener('submit', async function(e) {
            e.preventDefault();
            const cardErrors = document.getElementById('card-errors');
            cardErrors.textContent = '';

            if (document.querySelector('input[name="paymentMethod"]:checked').value !== 'creditCard') {
                form.submit(); // Submit for PayPal
                return;
            }

            const {token, error} = await stripe.createToken(cardElement);
            if (error) {
                cardErrors.textContent = error.message;
            } else {
                document.getElementById('stripeToken').value = token.id;
                form.submit();
            }
        });
    </script>

    <script src="{{ asset('assets-advertiser/js/theme.min.js') }}"></script>
    <script src="{{ asset('assets-advertiser/js/theme-switcher.js') }}"></script>
</body>
</html>
