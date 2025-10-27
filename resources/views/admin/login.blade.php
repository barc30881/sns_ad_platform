<!DOCTYPE html>
<html lang="en" data-bs-theme="dark" data-pwa="true">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, viewport-fit=cover">
    <title>관리자 로그인</title>
    <meta name="description" content="SNS Ad Platform Admin Login">
    <meta name="keywords" content="SNS Ad Platform">
    <meta name="author" content="SNS Ad Platform">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <link rel="manifest" href="{{ asset('assets-admin/manifest.json') }}">
    <script src="{{ asset('assets-admin/js/theme-switcher.js') }}"></script>
    <link rel="preload" href="{{ asset('assets-admin/fonts/inter-variable-latin.woff2') }}" as="font" type="font/woff2" crossorigin>
    <link rel="preload" href="{{ asset('assets-admin/icons/finder-icons.woff2') }}" as="font" type="font/woff2" crossorigin>
    <link rel="stylesheet" href="{{ asset('assets-admin/icons/finder-icons.min.css') }}">
    <link rel="preload" href="{{ asset('assets-admin/css/theme.min.css') }}" as="style">
    <link rel="preload" href="{{ asset('assets-admin/css/theme.rtl.min.css') }}" as="style">
    <link rel="stylesheet" href="{{ asset('assets-admin/css/theme.min.css') }}" id="theme-styles">
    <script src="{{ asset('assets-admin/js/customizer.min.js') }}"></script>
</head>
<body data-bs-theme="dark">
    <div class="container d-flex flex-column min-vh-100 justify-content-center py-5">
        <div class="card mx-auto" style="max-width: 400px;">
            <div class="card-body p-4">
                <h2 class="card-title text-center mb-4">관리자 로그인</h2>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        @foreach ($errors->all() as $error)
                            {{ $error }}<br>
                        @endforeach
                    </div>
                @endif
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
                <form action="{{ route('admin.login') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="email" class="form-label">이메일</label>
                        <input type="email" name="email" id="email" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">비밀번호</label>
                        <input type="password" name="password" id="password" class="form-control" required>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">로그인</button>
                </form>
                <div class="text-center mt-3">
                    <a href="{{ route('home') }}">홈으로 돌아가기</a>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('assets-admin/js/theme.min.js') }}"></script>
</body>
</html>
