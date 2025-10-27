<!DOCTYPE html>
<html lang="en" data-bs-theme="dark" data-pwa="true">

<head>
    <meta charset="utf-8">
    <meta name="viewport"
        content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, viewport-fit=cover">
    <title>@yield('title')</title>
    <meta name="description" content="SNS Ad Platform Admin Dashboard">
    <meta name="keywords" content="SNS Ad Platform">
    <meta name="author" content="SNS Ad Platform">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <link rel="manifest" href="{{ asset('assets-admin/manifest.json') }}">
    <script src="{{ asset('assets-admin/js/theme-switcher.js') }}"></script>
    <link rel="preload" href="{{ asset('assets-admin/fonts/inter-variable-latin.woff2') }}" as="font" type="font/woff2"
        crossorigin>
    <link rel="preload" href="{{ asset('assets-admin/icons/finder-icons.woff2') }}" as="font" type="font/woff2"
        crossorigin>
    <link rel="stylesheet" href="{{ asset('assets-admin/icons/finder-icons.min.css') }}">
    <link rel="preload" href="{{ asset('assets-admin/css/theme.min.css') }}" as="style">
    <link rel="preload" href="{{ asset('assets-admin/css/theme.rtl.min.css') }}" as="style">
    <link rel="stylesheet" href="{{ asset('assets-admin/css/theme.min.css') }}" id="theme-styles">
    <script src="{{ asset('assets-admin/js/customizer.min.js') }}"></script>
</head>

<body data-bs-theme="dark">
    <header class="navbar navbar-expand-lg bg-body navbar-sticky sticky-top z-fixed px-0" data-sticky-element>
        <div class="container">
            <button type="button" class="navbar-toggler me-3 me-lg-0" data-bs-toggle="offcanvas"
                data-bs-target="#navbarNav" aria-controls="navbarNav" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <a class="navbar-brand py-1 py-md-2 py-xl-1 me-2 me-sm-n4 me-md-n5 me-lg-0"
                href="{{ route('admin.dashboard') }}">Admin Logo</a>
            <nav class="offcanvas offcanvas-start" id="navbarNav" tabindex="-1" aria-labelledby="navbarNavLabel">
                <div class="offcanvas-header py-3">
                    <h5 class="offcanvas-title" id="navbarNavLabel">관리자 메뉴</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
                <div class="offcanvas-body pt-2 pb-4 py-lg-0 mx-lg-auto">
                    <ul class="navbar-nav position-relative">
                        <li class="nav-item py-lg-2 me-lg-n1 me-xl-0">
                            <a class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}"
                                href="{{ route('admin.dashboard') }}">대시보드</a>
                        </li>
                        <li class="nav-item py-lg-2 me-lg-n1 me-xl-0">
                            <a class="nav-link {{ request()->routeIs('admin.ads') ? 'active' : '' }}"
                                href="{{ route('admin.ads') }}">광고 관리</a>
                        </li>
                        <li class="nav-item py-lg-2 me-lg-n1 me-xl-0">
                            <a class="nav-link {{ request()->routeIs('admin.submissions') ? 'active' : '' }}"
                                href="{{ route('admin.submissions') }}">제출 관리</a>
                        </li>
                        <li class="nav-item py-lg-2 me-lg-n1 me-xl-0">
                            <a class="nav-link {{ request()->routeIs('admin.users') ? 'active' : '' }}"
                                href="{{ route('admin.users') }}">사용자 관리</a>
                        </li>
                        <li class="nav-item py-lg-2 me-lg-n1 me-xl-0">
                            <a class="nav-link {{ request()->routeIs('admin.payments') ? 'active' : '' }}"
                                href="{{ route('admin.payments') }}">결제 관리</a>
                        </li>

                    </ul>
                </div>
            </nav>
            <div class="d-flex gap-sm-1">
                <div class="dropdown">
                    <a class="btn btn-icon btn-outline-secondary fs-lg border-0 animate-shake me-2" href="#"
                        role="button" data-bs-toggle="dropdown" aria-expanded="false" aria-label="My account">
                        <i class="fi-user animate-target"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" style="--fn-dropdown-spacer: .5rem">
                        @auth
                            <li><span class="h6 dropdown-header">{{ Auth::user()->email }}</span></li>
                            <li><a class="dropdown-item" href="{{ route('admin.dashboard') }}"><i
                                        class="fi-layers opacity-75 me-2"></i>관리자 대시보드</a></li>
                            <li><a class="dropdown-item" href="{{ route('admin.ads') }}"><i
                                        class="fi-ad opacity-75 me-2"></i>광고 관리</a></li>
                            <li><a class="dropdown-item" href="{{ route('admin.submissions') }}"><i
                                        class="fi-check opacity-75 me-2"></i>제출 관리</a></li>
                            <li><a class="dropdown-item" href="{{ route('admin.users') }}"><i
                                        class="fi-users opacity-75 me-2"></i>사용자 관리</a></li>
                            <li><a class="dropdown-item" href="{{ route('admin.payments') }}"><i
                                        class="fi-credit-card opacity-75 me-2"></i>결제 관리</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="{{ route('admin.signout') }}"><i
                                        class="fi-log-out opacity-75 me-2"></i>로그아웃</a></li>
                        @else
                            <li><a class="dropdown-item" href="{{ route('admin.login.form') }}"><i
                                        class="fi-log-in opacity-75 me-2"></i>관리자 로그인</a></li>
                        @endauth
                    </ul>
                </div>
            </div>
        </div>
    </header>

    <main class="content-wrapper">
        <div class="container pt-4 pt-sm-5 pb-5 mb-xxl-3">
            <div class="row pt-2 pt-sm-0 pt-lg-2 pb-2 pb-sm-3 pb-md-4 pb-lg-5">
                <aside class="col-lg-3" style="margin-top: -105px">
                    <div class="offcanvas-lg offcanvas-start sticky-lg-top pe-lg-3 pe-xl-4" id="accountSidebar">
                        <div class="d-none d-lg-block" style="height: 105px"></div>
                        <div class="offcanvas-header d-lg-block py-3 p-lg-0">
                            <div class="d-flex flex-row flex-lg-column align-items-center align-items-lg-start">
                                <div class="pt-lg-3 ps-3 ps-lg-0">
                                    <p class="fs-sm mb-0">@auth {{ Auth::user()->email }} @else 게스트 @endauth</p>
                                </div>
                            </div>
                            <button type="button" class="btn-close d-lg-none" data-bs-dismiss="offcanvas"
                                data-bs-target="#accountSidebar" aria-label="Close"></button>
                        </div>
                        <div class="offcanvas-body d-block pt-2 pt-lg-4 pb-lg-0">
                            <nav class="list-group list-group-borderless">
                                @auth
                                    @if (Auth::user()->role === 'admin')
                                        <a class="list-group-item list-group-item-action d-flex align-items-center {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}"
                                            href="{{ route('admin.dashboard') }}">
                                            <i class="fi-layers fs-base opacity-75 me-2"></i>관리자 대시보드
                                        </a>
                                        <a class="list-group-item list-group-item-action d-flex align-items-center {{ request()->routeIs('admin.ads') ? 'active' : '' }}"
                                            href="{{ route('admin.ads') }}">
                                            <i class="fi-ad fs-base opacity-75 me-2"></i>광고 관리
                                        </a>
                                        <a class="list-group-item list-group-item-action d-flex align-items-center {{ request()->routeIs('admin.submissions') ? 'active' : '' }}"
                                            href="{{ route('admin.submissions') }}">
                                            <i class="fi-check fs-base opacity-75 me-2"></i>제출 관리
                                        </a>
                                        <a class="list-group-item list-group-item-action d-flex align-items-center {{ request()->routeIs('admin.users') ? 'active' : '' }}"
                                            href="{{ route('admin.users') }}">
                                            <i class="fi-users fs-base opacity-75 me-2"></i>사용자 관리
                                        </a>
                                        <a class="list-group-item list-group-item-action d-flex align-items-center {{ request()->routeIs('admin.payments') ? 'active' : '' }}"
                                            href="{{ route('admin.payments') }}">
                                            <i class="fi-credit-card fs-base opacity-75 me-2"></i>결제 관리
                                        </a>
                                        <a class="list-group-item list-group-item-action d-flex align-items-center {{ request()->routeIs('admin.referral-settings') ? 'active' : '' }}"
                                            href="{{ route('admin.referral-settings') }}">
                                            <i class="fi-settings fs-base opacity-75 me-2"></i>추천 설정
                                        </a>
                                        <form action="{{ route('admin.signout') }}" method="POST">
        @csrf
        <button type="submit" class="dropdown-item"><i class="fi-log-out opacity-75 me-2"></i>로그아웃</button>
    </form>
                                       
                                    @endif
                                @endauth
                            </nav>
                        </div>
                    </div>
                </aside>
                <div class="col-lg-9">
                    @yield('content')
                </div>
            </div>
        </div>
    </main>

    <footer class="footer bg-body border-top pt-5" data-bs-theme="dark">
        <div class="container pt-sm-2 pt-md-3 pt-lg-4 pb-4">
            <div class="text-center pt-4 pb-md-2">
                <p class="text-body-secondary fs-sm mb-0">©2025. All Rights Reserved.</p>
            </div>
            <div class="d-lg-none" style="height: 3.75rem"></div>
        </div>
    </footer>

    <button type="button"
        class="fixed-bottom z-sticky w-100 btn btn-lg btn-dark border-0 border-top border-light border-opacity-10 rounded-0 pb-4 d-lg-none"
        data-bs-toggle="offcanvas" data-bs-target="#accountSidebar" aria-controls="accountSidebar"
        data-bs-theme="light">
        <i class="fi-sidebar fs-base me-2"></i>계정 메뉴
    </button>

    <div class="floating-buttons position-fixed top-50 end-0 z-sticky me-3 me-xl-4 pb-4">
        <a class="btn-scroll-top btn btn-sm bg-body border-0 rounded-pill shadow animate-slide-end" href="#top">
            맨 위
            <i class="fi-arrow-right fs-base ms-1 me-n1 animate-target"></i>
            <span class="position-absolute top-0 start-0 w-100 h-100 border rounded-pill z-0"></span>
            <svg class="position-absolute top-0 start-0 w-100 h-100 z-1" viewBox="0 0 62 32" fill="none"
                xmlns="http://www.w3.org/2000/svg">
                <rect x=".75" y=".75" width="60.5" height="30.5" rx="15.25" stroke="currentColor" stroke-width="1.5"
                    stroke-miterlimit="10"></rect>
            </svg>
        </a>
    </div>

    <script src="{{ asset('assets-admin/js/theme.min.js') }}"></script>
</body>

</html>