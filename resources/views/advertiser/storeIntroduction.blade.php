<!DOCTYPE html>
<html lang="en" data-bs-theme="dark" data-pwa="true">
<meta http-equiv="content-type" content="text/html;charset=utf-8" />

<head>
    <meta charset="utf-8">

    <!-- Viewport -->
    <meta name="viewport"
        content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, viewport-fit=cover">

    <!-- SEO Meta Tags -->
    <title>Store Introduction Section</title>
    <meta name="description" content="Ad Application Page">
    <meta name="keywords" content="Ad Application Page">
    <meta name="author" content="Ad Application Page">

    <!-- Webmanifest + Favicon / App icons -->
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <!-- Webmanifest -->
    <link rel="manifest" href="{{ asset('assets-advertiser/manifest.json') }}">


    <!-- Theme switcher -->
    <script src="{{ asset('assets-advertiser/js/theme-switcher.js') }}"></script>

    <!-- Fonts -->
    <link rel="preload" href="{{ asset('assets-advertiser/fonts/inter-variable-latin.woff2') }}" as="font"
        type="font/woff2" crossorigin>
    <link rel="preload" href="{{ asset('assets-advertiser/icons/finder-icons.woff2') }}" as="font" type="font/woff2"
        crossorigin>
    <link rel="stylesheet" href="{{ asset('assets-advertiser/icons/finder-icons.min.css') }}">

    <!-- Bootstrap + Theme styles -->
    <link rel="preload" href="{{ asset('assets-advertiser/css/theme.min.css') }}" as="style">
    <link rel="preload" href="{{ asset('assets-advertiser/css/theme.rtl.min.css') }}" as="style">
    <link rel="stylesheet" href="{{ asset('assets-advertiser/css/theme.min.css') }}" id="theme-styles">

    <!-- Customizer -->
    <script src="{{ asset('assets-advertiser/js/customizer.min.js') }}"></script>
</head>


<!-- Body -->

<body data-bs-theme="dark">




    <!-- Navigation bar (Page header) -->
    <header class="navbar navbar-expand-lg bg-body navbar-sticky sticky-top z-fixed px-0" data-sticky-element="">
        <div class="container">

            <!-- Mobile offcanvas menu toggler (Hamburger) -->
            <button type="button" class="navbar-toggler me-3 me-lg-0" data-bs-toggle="offcanvas"
                data-bs-target="#navbarNav" aria-controls="navbarNav" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- Navbar brand (Logo) -->
            <a class="navbar-brand py-1 py-md-2 py-xl-1 me-2 me-sm-n4 me-md-n5 me-lg-0" href="home-real-estate.html">

                Logo
            </a>

            <!-- Main navigation that turns into offcanvas on screens < 992px wide (lg breakpoint) -->
            <nav class="offcanvas offcanvas-start" id="navbarNav" tabindex="-1" aria-labelledby="navbarNavLabel">
                <div class="offcanvas-header py-3">
                    <h5 class="offcanvas-title" id="navbarNavLabel">둘러보기</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
                <div class="offcanvas-body pt-2 pb-4 py-lg-0 mx-lg-auto">
                    <ul class="navbar-nav position-relative">
                        <li class="nav-item dropdown py-lg-2 me-lg-n1 me-xl-0">
                            <a class="nav-link" href="https://ad-platform.onrender.com" role="button"
                                data-bs-toggle="dropdown" data-bs-trigger="hover" aria-expanded="false">홈</a>

                        </li>
                        <li class="nav-item dropdown position-static py-lg-2 me-lg-n1 me-xl-0">
                            <a class="nav-link active" aria-current="page" href="./dashboardPage.html" role="button"
                                data-bs-toggle="dropdown" data-bs-trigger="hover" aria-expanded="false">대시보드 페이지</a>

                        </li>

                    </ul>
                </div>
            </nav>

            <!-- Button group -->
            <div class="d-flex gap-sm-1">


                <!-- Account dropdown (Logged in state) -->
                <div class="dropdown">
                    <a class="btn btn-icon btn-outline-secondary fs-lg border-0 animate-shake me-2" href="#"
                        role="button" data-bs-toggle="dropdown" aria-expanded="false" aria-label="My account">
                        <i class="fi-user animate-target"></i>
                    </a>

                    <ul class="dropdown-menu dropdown-menu-end" style="--fn-dropdown-spacer: .5rem">
                        <li><span class="h6 dropdown-header">Williams@gmail.com</span></li>

                        <li>
                            <a class="dropdown-item" href="account-listings.html">
                                <i class="fi-layers opacity-75 me-2"></i>
                                My Ads
                            </a>
                        </li>




                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li>
                            <a class="dropdown-item" href="https://ad-platform.onrender.com/">
                                <i class="fi-log-out opacity-75 me-2"></i>
                                Sign out
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
                            <li class="nat-item">
                                <a class="nav-link d-inline-flex px-0 px-lg-3 pe-none" aria-current="page">
                                    <i class="fi-check-circle fs-lg me-2"></i>
                                    광고 제작 섹션
                                </a>
                            </li>
                            <li class="nat-item">
                                <a class="nav-link d-inline-flex px-0 px-lg-3 disabled">
                                    <i class="fi-arrow-right-circle d-none d-lg-inline-flex fs-lg me-2"></i>
                                    <i class="fi-arrow-down-circle d-lg-none fs-lg me-2"></i>
                                    매장 소개 섹션
                                </a>
                            </li>
                            <li class="nat-item">
                                <a class="nav-link d-inline-flex px-0 px-lg-3 disabled">
                                    <i class="fi-circle fs-lg me-2"></i>
                                    광고 결제 섹션
                                </a>
                            </li>




                        </ul>
                    </div>
                </aside>


           

                    <div class="col-lg-9 col-xl-8">
                        <h1 class="h2 mb-n2 mb-lg-3">매장 소개 섹션</h1>
                             <form action="{{ route('storeIntroductionSection.post') }}" method="POST">
                    @csrf
                    @if (session('success'))
                        <div class="alert alert-success mt-3">
                            {{ session('success') }}
                        </div>
                    @endif

                        <div class="pb-4 mb-2 mt-3 pt-3">
                            <label for="storeName" class="form-label">매장 이름 *</label>
                            <input name="storeName" type="text" class="form-control form-control-lg" id="storeName"
                                placeholder="예: 맛있는 레스토랑" required="" value="{{ old('storeName') }}">
                            {{-- Inline validation error --}}
                            @error('storeName')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="pb-4 mb-2">
                            <label for="description" class="form-label fs-base">짧은 설명 *</label>
                            <textarea name="description" class="form-control form-control-lg bg-transparent" id="description"
                                placeholder="가게 소개 (100자 이내)" rows="4">{{ old('description') }}</textarea>
                            {{-- Inline validation error --}}
                            @error('description')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        

                    </div>
            </div>
        </div>
    </main>


    <!-- Prev / Next navigation (Footer) -->
    <footer class="sticky-bottom bg-body pb-3">
        <div class="progress rounded-0" role="progressbar" aria-label="Dark example" aria-valuenow="14.29"
            aria-valuemin="0" aria-valuemax="100" style="height: 4px">
            <div class="progress-bar bg-dark d-none-dark" style="width: 66.33%"></div>
            <div class="progress-bar bg-light d-none d-block-dark" style="width: 66.33%"></div>
        </div>
        <div class="container d-flex gap-3 pt-3">
            <a class="btn btn-outline-dark animate-slide-start" href="/ad-application-page">
                <i class="fi-arrow-left animate-target fs-base ms-n1 me-2"></i>
                뒤로
            </a>
            <button type="submit" class="btn btn-dark animate-slide-end ms-auto">
                다음
                <i class="fi-arrow-right animate-target fs-base ms-2 me-n1"></i>
            </button>
        </div>
    </footer>

</form>




    <!-- Bootstrap + Theme scripts -->

    <script src="{{ asset('assets-advertiser/js/theme.min.js') }}"></script>
    <script src="{{ asset('assets-advertiser/js/theme-switcher.js') }}"></script>


</body>

</html>