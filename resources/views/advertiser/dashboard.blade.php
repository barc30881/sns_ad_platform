
<!DOCTYPE html>
<html lang="en" data-bs-theme="dark" data-pwa="true">
<head>
    <meta charset="utf-8">
    <meta http-equiv="content-type" content="text/html;charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, viewport-fit=cover">

    <title>Advertiser Dashboard</title>
    <meta name="description" content="View your paid advertisements">
    <meta name="keywords" content="advertising, dashboard, ad platform">
    <meta name="author" content="Ad Platform">

    <!-- Webmanifest + Favicon / App icons -->
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <link rel="manifest" href="{{ asset('assets-advertiser/manifest.json') }}">

    <!-- Preloaded local web font (Inter) -->
    <link rel="preload" href="{{ asset('assets-advertiser/fonts/inter-variable-latin.woff2') }}" as="font" type="font/woff2" crossorigin>
    <link rel="preload" href="{{ asset('assets-advertiser/icons/finder-icons.woff2') }}" as="font" type="font/woff2" crossorigin>
    <link rel="stylesheet" href="{{ asset('assets-advertiser/icons/finder-icons.min.css') }}">

    <!-- Bootstrap + Theme styles -->
    <link rel="preload" href="{{ asset('assets-advertiser/css/theme.min.css') }}" as="style">
    <link rel="preload" href="{{ asset('assets-advertiser/css/theme.rtl.min.css') }}" as="style">
    <link rel="stylesheet" href="{{ asset('assets-advertiser/css/theme.min.css') }}" id="theme-styles">

    <!-- Customizer -->
    <script src="{{ asset('assets-advertiser/js/theme-switcher.js') }}"></script>
    <script src="{{ asset('assets-advertiser/js/customizer.min.js') }}"></script>
</head>

<body data-bs-theme="dark">
    <!-- Navigation bar -->
    <header class="navbar navbar-expand-lg bg-body navbar-sticky sticky-top z-fixed px-0" data-sticky-element="">
        <div class="container">
            <!-- Mobile offcanvas menu toggler -->
            <button type="button" class="navbar-toggler me-3 me-lg-0" data-bs-toggle="offcanvas" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- Navbar brand (Logo) -->
            <a class="navbar-brand py-1 py-md-2 py-xl-1 me-2 me-sm-n4 me-md-n5 me-lg-0" href="{{ route('home') }}">
                Logo
            </a>

            <!-- Main navigation -->
            <nav class="offcanvas offcanvas-start" id="navbarNav" tabindex="-1" aria-labelledby="navbarNavLabel">
                <div class="offcanvas-header py-3">
                    <h5 class="offcanvas-title" id="navbarNavLabel">둘러보기 (Browse)</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
                <div class="offcanvas-body pt-2 pb-4 py-lg-0 mx-lg-auto">
                    <ul class="navbar-nav position-relative">
                        <li class="nav-item dropdown py-lg-2 me-lg-n1 me-xl-0">
                            <a class="nav-link" href="{{ route('home') }}" role="button" data-bs-toggle="dropdown"
                                data-bs-trigger="hover" aria-expanded="false">홈 (Home)</a>
                        </li>
                        <li class="nav-item dropdown position-static py-lg-2 me-lg-n1 me-xl-0">
                            <a class="nav-link active" aria-current="page" href="{{ route('dashboard') }}" role="button"
                                data-bs-toggle="dropdown" data-bs-trigger="hover" aria-expanded="false">대시보드 페이지 (Dashboard)</a>
                        </li>
                    </ul>
                </div>
            </nav>

            <!-- Button group -->
            <div class="d-flex gap-sm-1">
                <!-- Account dropdown -->
                <div class="dropdown">
                    <a class="btn btn-icon btn-outline-secondary fs-lg border-0 animate-shake me-2" href="#" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false" aria-label="My account">
                        <i class="fi-user animate-target"></i>
                    </a>
                    <!-- Add ad button -->
                    <a class="btn btn-primary animate-scale" href="{{ route('adApplicationPage') }}">
                        <i class="fi-plus fs-lg animate-target ms-n2 me-1 me-sm-2"></i>
                        Add<span class="d-none d-xl-inline ms-1">Ads</span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" style="--fn-dropdown-spacer: .5rem">
                        <li><span class="h6 dropdown-header">{{ auth()->user()->email ?? 'Guest' }}</span></li>
                        <li>
                            <a class="dropdown-item" href="{{ route('dashboard') }}">
                                <i class="fi-layers opacity-75 me-2"></i>대시보드 페이지 (Dashboard)
                            </a>
                        </li>
                        <li><hr class="dropdown-divider"></li>
                        <li>
                            <form action="{{ route('advertiser.signout') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="list-group-item list-group-item-action d-flex align-items-center">
                                        <i class="fi-log-out fs-base opacity-75 me-2"></i>로그아웃 (Sign out)
                                    </button>
                               </form>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </header>

    <!-- Page content -->
    <main class="content-wrapper">
        <div class="container pt-4 pt-sm-5 pb-5 mb-xxl-3">
            <div class="row pt-2 pt-sm-0 pt-lg-2 pb-2 pb-sm-3 pb-md-4 pb-lg-5">
                <!-- Sidebar navigation -->
                <aside class="col-lg-3" style="margin-top: -105px">
                    <div class="offcanvas-lg offcanvas-start sticky-lg-top pe-lg-3 pe-xl-4" id="accountSidebar">
                        <div class="d-none d-lg-block" style="height: 105px"></div>
                        <div class="offcanvas-header d-lg-block py-3 p-lg-0">
                            <div class="d-flex flex-row flex-lg-column align-items-center align-items-lg-start">
                                <div class="pt-lg-3 ps-3 ps-lg-0">
                                    <p class="fs-sm mb-0">{{ auth()->user()->email ?? 'Guest' }}</p>
                                </div>
                            </div>
                            <button type="button" class="btn-close d-lg-none" data-bs-dismiss="offcanvas" data-bs-target="#accountSidebar" aria-label="Close"></button>
                        </div>
                        <div class="offcanvas-body d-block pt-2 pt-lg-4 pb-lg-0">
                            <nav class="list-group list-group-borderless">
                                <a class="list-group-item list-group-item-action d-flex align-items-center active" aria-current="page" href="{{ route('dashboard') }}">
                                    <i class="fi-layers fs-base opacity-75 me-2"></i>대시보드 페이지 (Dashboard)
                                </a>
                                <a class="list-group-item list-group-item-action d-flex align-items-center" href="{{ route('adApplicationPage') }}">
                                    <i class="fi-plus fs-base opacity-75 me-2"></i>광고 추가 (Add Ad)
                                </a>
                            </nav>
                            <nav class="list-group list-group-borderless pt-3">
                               <form action="{{ route('advertiser.signout') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="list-group-item list-group-item-action d-flex align-items-center">
                                        <i class="fi-log-out fs-base opacity-75 me-2"></i>로그아웃 (Sign out)
                                    </button>
                                </form>  
                            </nav>
                        </div>
                    </div>
                </aside>

                <!-- Account listings content -->
                <div class="col-lg-9">
                    <h1 class="h2 pb-2 pb-lg-3">내 광고 목록 (My Ads)</h1>

                    <!-- Nav pills -->
                    <div class="nav overflow-x-auto mb-2">
                        <ul class="nav nav-pills flex-nowrap gap-2 pb-2 mb-1" role="tablist">
                            <li class="nav-item me-1" role="presentation">
                                <button type="button" class="nav-link text-nowrap active" id="published-tab" data-bs-toggle="pill" data-bs-target="#published" role="tab" aria-controls="published" aria-selected="true">
                                    활성 ({{ $ads->count() }})
                                </button>
                            </li>
                        </ul>
                    </div>

                    <div class="tab-content">
                        <!-- Published tab -->
                        <div class="tab-pane fade show active" id="published" role="tabpanel" aria-labelledby="published-tab">
                            @if ($ads->isEmpty())
                                <div class="alert alert-info">결제된 광고가 없습니다. (No paid ads found.)</div>
                            @else
                                <div class="vstack gap-4" id="publishedSelection">
                                    @foreach ($ads as $ad)
                                        <div class="d-sm-flex align-items-center">
                                            <div class="d-inline-flex position-relative z-2 pt-1 pb-2 ps-2 p-sm-0 ms-2 ms-sm-0 me-sm-2">
                                                <span class="position-absolute top-0 start-0 w-100 h-100 bg-body border rounded d-sm-none"></span>
                                            </div>
                                            <article class="card w-100">
                                                <div class="d-sm-none" style="margin-top: -44px"></div>
                                                <div class="row g-0">
                                              
<div class="col-sm-4 col-md-3 rounded overflow-hidden pb-2 pb-sm-0 pe-sm-2">
    <div class="position-relative d-flex h-100 bg-body-tertiary" style="min-height: 174px">
        @php
            $mediaArray = is_string($ad->media) ? json_decode($ad->media, true) : $ad->media;
            $mediaArray = array_map(function ($path) {
                return str_replace('\\', '/', $path); // Normalize slashes
            }, is_array($mediaArray) ? $mediaArray : []);
            \Log::info('Ad media processing', [
                'ad_id' => $ad->id,
                'media' => $mediaArray,
                'is_array' => is_array($mediaArray),
                'is_empty' => empty($mediaArray),
                'file_exists' => !empty($mediaArray) && file_exists(public_path('storage/' . $mediaArray[0]))
            ]);
        @endphp
        @if (!empty($mediaArray) && is_array($mediaArray) && !empty($mediaArray[0]) && file_exists(public_path('storage/' . $mediaArray[0])))
            @php $firstMedia = $mediaArray[0]; @endphp
            @if (in_array(strtolower(pathinfo($firstMedia, PATHINFO_EXTENSION)), ['mp4', 'mov', 'avi']))
                <video src="{{ asset('storage/' . $firstMedia) }}" class="position-absolute top-0 start-0 w-100 h-100 object-fit-cover" controls></video>
            @else
                <img src="{{ asset('storage/' . $firstMedia) }}" class="position-absolute top-0 start-0 w-100 h-100 object-fit-cover" alt="Ad Image">
            @endif
        @else
            <img src="{{ asset('assets-advertiser/img/placeholder.jpg') }}" class="position-absolute top-0 start-0 w-100 h-100 object-fit-cover" alt="Placeholder">
            @if (empty($mediaArray))
                <span class="text-warning position-absolute top-50 start-50 translate-middle">No media available</span>
            @elseif (!empty($mediaArray[0]) && !file_exists(public_path('storage/' . $mediaArray[0])))
                <span class="text-warning position-absolute top-50 start-50 translate-middle">Media file not found</span>
            @endif
        @endif
        <div class="ratio d-none d-sm-block" style="--fn-aspect-ratio: calc(180 / 240 * 100%)"></div>
        <div class="ratio ratio-16x9 d-sm-none"></div>
    </div>
    <div class="d-flex flex-column gap-2 align-items-start position-absolute top-0 start-0 z-1 pt-1 pt-sm-0 ps-1 ps-sm-0 mt-2 mt-sm-3 ms-2 ms-sm-3">
        <span class="badge text-bg-primary">Paid</span>
    </div>
</div>

                                                    <div class="col-sm-8 col-md-9 align-self-center">
                                                        <div class="card-body d-flex justify-content-between p-3 py-sm-4 ps-sm-2 ps-md-3 pe-md-4 mt-n1 mt-sm-0">
                                                            <div class="position-relative pe-3">
                                                                <span class="badge text-body-emphasis bg-body-secondary mb-2">활성 (Active)</span>
                                                                <div class="fs-sm text-body mb-2"><b>광고 제목:</b> {{ $ad->title }}</div>
                                                                <div class="fs-sm text-body mb-2"><b>광고 설명:</b> {{ $ad->description }}</div>
                                                                <div class="fs-sm text-body mb-2"><b>매장 이름:</b> {{ $ad->store_name }}</div>
                                                                <div class="fs-sm text-body mb-2"><b>수량:</b> {{ $ad->quantity }}</div>
                                                                <div class="h5 mb-2"><b>총액:</b> ${{ number_format($ad->total, 2) }}</div>
                                                                <div class="fs-sm text-body mb-2"><b>결제 방법:</b> {{ $ad->payment_method == 'creditCard' ? '신용카드 (Credit Card)' : '페이팔 (PayPal)' }}</div>
                                                            </div>
                                                            <div class="text-end">
                                                                <div class="fs-xs text-body-secondary mb-3">생성됨: {{ $ad->created_at->format('d/m/Y') }}</div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </article>
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Page footer -->
    <footer class="footer bg-body border-top pt-5" data-bs-theme="dark">
        <div class="container pt-sm-2 pt-md-3 pt-lg-4 pb-4">
            <div class="text-center pt-4 pb-md-2">
                <p class="text-body-secondary fs-sm mb-0">©2025. All Rights Reserved.</p>
            </div>
        </div>
        <div class="d-lg-none" style="height: 3.75rem"></div>
    </footer>

    <!-- Sidebar navigation offcanvas toggle -->
    <button type="button" class="fixed-bottom z-sticky w-100 btn btn-lg btn-dark border-0 border-top border-light border-opacity-10 rounded-0 pb-4 d-lg-none" data-bs-toggle="offcanvas" data-bs-target="#accountSidebar" aria-controls="accountSidebar" data-bs-theme="light">
        <i class="fi-sidebar fs-base me-2"></i>계정 메뉴 (Account Menu)
    </button>

    <!-- Back to top button -->
    <div class="floating-buttons position-fixed top-50 end-0 z-sticky me-3 me-xl-4 pb-4">
        <a class="btn-scroll-top btn btn-sm bg-body border-0 rounded-pill shadow animate-slide-end" href="#top">
            맨 위 (Top)
            <i class="fi-arrow-right fs-base ms-1 me-n1 animate-target"></i>
            <span class="position-absolute top-0 start-0 w-100 h-100 border rounded-pill z-0"></span>
            <svg class="position-absolute top-0 start-0 w-100 h-100 z-1" viewBox="0 0 62 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                <rect x=".75" y=".75" width="60.5" height="30.5" rx="15.25" stroke="currentColor" stroke-width="1.5" stroke-miterlimit="10"></rect>
            </svg>
        </a>
    </div>

    <!-- Bootstrap + Theme scripts -->
    <script src="{{ asset('assets-advertiser/js/theme.min.js') }}"></script>
</body>
</html>
