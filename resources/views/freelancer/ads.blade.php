<!DOCTYPE html>
<html lang="en" data-bs-theme="dark" data-pwa="true">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, viewport-fit=cover">
    <title>Freelancer Ads</title>
    <meta name="description" content="Freelancer Ads Listing Page">
    <meta name="keywords" content="Freelancer Ads">
    <meta name="author" content="Ad Platform">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <link rel="manifest" href="{{ asset('assets-freelancer/manifest.json') }}">
    <script src="{{ asset('assets-freelancer/js/theme-switcher.js') }}"></script>
    <link rel="preload" href="{{ asset('assets-freelancer/fonts/inter-variable-latin.woff2') }}" as="font" type="font/woff2" crossorigin>
    <link rel="preload" href="{{ asset('assets-freelancer/icons/finder-icons.woff2') }}" as="font" type="font/woff2" crossorigin>
    <link rel="stylesheet" href="{{ asset('assets-freelancer/icons/finder-icons.min.css') }}">
    <link rel="preload" href="{{ asset('assets-freelancer/css/theme.min.css') }}" as="style">
    <link rel="preload" href="{{ asset('assets-freelancer/css/theme.rtl.min.css') }}" as="style">
    <link rel="stylesheet" href="{{ asset('assets-freelancer/css/theme.min.css') }}" id="theme-styles">
    <script src="{{ asset('assets-freelancer/js/customizer.min.js') }}"></script>
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
    <style>
        .news-ticker {
            background-color: #1a252f;
            color: #ffffff;
            padding: 10px 0;
            overflow: hidden;
            white-space: nowrap;
            position: relative;
            z-index: 1000;
        }
        .news-ticker span {
            display: inline-block;
            padding-left: 100%;
            animation: marquee 15s linear infinite;
        }
        @keyframes marquee {
            0% { transform: translateX(0); }
            100% { transform: translateX(-100%); }
        }
        .download-btn {
            position: absolute;
            bottom: 10px;
            right: 10px;
            z-index: 3;
            background-color: rgba(0, 0, 0, 0.7);
            border: none;
            padding: 5px 10px;
            font-size: 0.9rem;
        }
        .download-btn:hover {
            background-color: rgba(0, 0, 0, 0.9);
        }
        .media-error {
            color: #dc3545;
            font-size: 0.9rem;
            text-align: center;
            padding: 10px;
        }
    </style>
</head>
<body data-bs-theme="dark">
    <!-- News Ticker -->
    <div class="news-ticker">
        <span>프리랜서 여러분, 환영합니다! 👋 수익을 시작하려면 간단히: 광고를 선택하고 다운로드한 후, 소셜 미디어에 게시하고, 게시 링크를 검증 및 결제를 위해 제출하세요.</span>
    </div>

    <!-- Connect form modal -->
    <div class="modal fade" id="connectModal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">광고 실행</h5>
                    <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form class="modal-body needs-validation" action="{{ route('freelancer.submitLinks') }}" method="POST" novalidate>
                    @csrf
                    @if ($errors->has('sns_link'))
                        <div class="alert alert-danger">{{ $errors->first('sns_link') }}</div>
                    @endif
                    <div class="mb-3">
                        <input type="hidden" name="ad_id" id="modal_ad_id" value="">
                        <input type="text" class="form-control" id="modal_store_name" placeholder="Store Name" required disabled>
                        <div class="invalid-feedback">고객 이름</div>
                    </div>
                    <div class="mb-3">
                        <input type="text" class="form-control" id="modal_content_type" placeholder="Content Type" required disabled>
                        <div class="invalid-feedback">콘텐츠 유형</div>
                    </div>
                    <div id="sns_links_container" class="mb-3">
                        <!-- SNS links will be generated here by JS -->
                    </div>
                    <button type="submit" class="btn btn-lg btn-primary w-100">링크 제출</button>
                </form>
            </div>
        </div>
    </div>

    <!-- Navigation bar -->
    <header class="navbar navbar-expand-lg bg-body navbar-sticky sticky-top z-fixed px-0" data-sticky-element>
        <div class="container">
            <button type="button" class="navbar-toggler me-3 me-lg-0" data-bs-toggle="offcanvas" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <a class="navbar-brand py-1 py-md-2 py-xl-1 me-2 me-sm-n4 me-md-n5 me-lg-0" href="{{ route('home') }}">Logo</a>
            <nav class="offcanvas offcanvas-start" id="navbarNav" tabindex="-1" aria-labelledby="navbarNavLabel">
                <div class="offcanvas-header py-3">
                    <h5 class="offcanvas-title" id="navbarNavLabel">둘러보기</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
                <div class="offcanvas-body pt-2 pb-4 py-lg-0 mx-lg-auto">
                    <ul class="navbar-nav position-relative">
                        <li class="nav-item py-lg-2 me-lg-n1 me-xl-0">
                            <a class="nav-link" href="{{ route('home') }}">홈</a>
                        </li>
                        <li class="nav-item py-lg-2 me-lg-n1 me-xl-0">
                            <a class="nav-link active" href="{{ route('freelancer.ads') }}">새 게시물 만들기</a>
                        </li>
                    </ul>
                </div>
            </nav>
            <div class="d-flex gap-sm-1">
                <div class="dropdown">
                    <a class="btn btn-icon btn-outline-secondary fs-lg border-0 animate-shake me-2" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false" aria-label="My account">
                        <i class="fi-user animate-target"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" style="--fn-dropdown-spacer: .5rem">
                        @auth
                            <li><span class="h6 dropdown-header">{{ Auth::user()->email }}</span></li>
                            <li><a class="dropdown-item" href="{{ route('freelancer.dashboard') }}"><i class="fi-layers opacity-75 me-2"></i>광고 작업 대시보드</a></li>
                            <li><a class="dropdown-item" href="{{ route('freelancer.payment-settings') }}"><i class="fi-credit-card opacity-75 me-2"></i>결제 정보</a></li>
                            <li><a class="dropdown-item" href="{{ route('freelancer.payment-history') }}"><i class="fi-receipt opacity-75 me-2"></i>결제 내역</a></li>
                            <li><a class="dropdown-item" href="{{ route('freelancer.promotional-center') }}"><i class="fi-share opacity-75 me-2"></i>프로모션 센터</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="{{ route('freelancer.signout') }}"><i class="fi-log-out opacity-75 me-2"></i>로그아웃</a></li>
                        @else
                            <li><a class="dropdown-item" href="{{ route('freelancer.login.form') }}"><i class="fi-log-in opacity-75 me-2"></i>로그인</a></li>
                            <li><a class="dropdown-item" href="{{ route('freelancer.register.form') }}"><i class="fi-user-plus opacity-75 me-2"></i>등록</a></li>
                        @endauth
                    </ul>
                </div>
            </div>
        </div>
    </header>

    <!-- Page content -->
    <main class="content-wrapper">
        <div class="container pt-4 pt-sm-5 pb-5 mb-xxl-3">
            <div class="row pt-2 pt-sm-0 pt-lg-2 pb-2 pb-sm-3 pb-md-4 pb-lg-5">
                <!-- Filter sidebar -->
                <aside class="col-lg-3">
                    <div class="offcanvas-lg offcanvas-start pe-lg-2 pe-xl-3 pe-xxl-4" id="filterSidebar">
                        <div class="offcanvas-header border-bottom py-3">
                            <h3 class="h5 offcanvas-title">필터</h3>
                            <button type="button" class="btn-close d-lg-none" data-bs-dismiss="offcanvas" data-bs-target="#filterSidebar" aria-label="Close"></button>
                        </div>
                        <div class="offcanvas-body d-block">
                            <!-- Filters -->
                            <form action="{{ route('freelancer.ads') }}" method="GET">
                                <!-- Ad Type -->
                                <div class="pb-4 mb-2 mb-xl-3">
                                    <h4 class="h6">광고 유형</h4>
                                    <div class="d-flex flex-column gap-2">
                                        <div class="form-check">
                                            <input type="radio" class="form-check-input" name="ad_type" id="ad-type-prepaid" value="prepaid" {{ request('ad_type') == 'prepaid' ? 'checked' : '' }}>
                                            <label class="form-check-label fs-sm" for="ad-type-prepaid">Prepaid</label>
                                        </div>
                                        <div class="form-check">
                                            <input type="radio" class="form-check-input" name="ad_type" id="ad-type-postpaid" value="postpaid" {{ request('ad_type') == 'postpaid' ? 'checked' : '' }}>
                                            <label class="form-check-label fs-sm" for="ad-type-postpaid">Postpaid</label>
                                        </div>
                                        <div class="form-check">
                                            <input type="radio" class="form-check-input" name="ad_type" id="ad-type-all" value="" {{ !request('ad_type') ? 'checked' : '' }}>
                                            <label class="form-check-label fs-sm" for="ad-type-all">All</label>
                                        </div>
                                    </div>
                                </div>
                                <!-- Budget -->
                                <div class="pb-4 mb-2 mb-xl-3">
                                    <h4 class="h6">예산</h4>
                                    <div class="d-flex flex-column gap-2">
                                        <div class="form-check">
                                            <input type="radio" class="form-check-input" name="budget" id="budget-4" value="4" {{ request('budget') == '4' ? 'checked' : '' }}>
                                            <label class="form-check-label fs-sm" for="budget-4">$$$$ (≥ $200)</label>
                                        </div>
                                        <div class="form-check">
                                            <input type="radio" class="form-check-input" name="budget" id="budget-3" value="3" {{ request('budget') == '3' ? 'checked' : '' }}>
                                            <label class="form-check-label fs-sm" for="budget-3">$$$ ($100 - $200)</label>
                                        </div>
                                        <div class="form-check">
                                            <input type="radio" class="form-check-input" name="budget" id="budget-2" value="2" {{ request('budget') == '2' ? 'checked' : '' }}>
                                            <label class="form-check-label fs-sm" for="budget-2">$$ ($50 - $100)</label>
                                        </div>
                                        <div class="form-check">
                                            <input type="radio" class="form-check-input" name="budget" id="budget-1" value="1" {{ request('budget') == '1' ? 'checked' : '' }}>
                                            <label class="form-check-label fs-sm" for="budget-1">$ (< $50)</label>
                                        </div>
                                        <div class="form-check">
                                            <input type="radio" class="form-check-input" name="budget" id="budget-all" value="" {{ !request('budget') ? 'checked' : '' }}>
                                            <label class="form-check-label fs-sm" for="budget-all">All</label>
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-sm btn-primary mt-2">필터 적용</button>
                            </form>
                        </div>
                    </div>
                </aside>

                <!-- Account listings content -->
                <div class="col-lg-9">
                    <h1 class="h2 pb-2 pb-lg-3">프리랜서 광고</h1>
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
                        <div class="tab-pane fade show active" id="published" role="tabpanel" aria-labelledby="published-tab">
                            <div class="vstack gap-4" id="publishedSelection">
                                @forelse ($ads as $ad)
                                    <article class="card hover-effect-opacity overflow-hidden">
                                        <div class="row g-0">
                                            <div class="col-sm-4 position-relative bg-body-tertiary" style="min-height: 220px">
                                                <div class="d-flex flex-column gap-2 align-items-start position-absolute top-0 start-0 z-3 pt-1 pt-sm-0 ps-1 ps-sm-0 mt-2 mt-sm-3 ms-2 ms-sm-3">
                                                    <span class="badge text-bg-info d-inline-flex align-items-center">
                                                        인증됨
                                                        <i class="fi-shield ms-1"></i>
                                                    </span>
                                                </div>
                                                <div class="swiper h-100 z-2" data-swiper='{
                                                        "pagination": {"el": ".swiper-pagination"},
                                                        "navigation": {"prevEl": ".btn-prev", "nextEl": ".btn-next"},
                                                        "breakpoints": {"991": {"allowTouchMove": false}}
                                                    }'>
                                                    <div class="swiper-wrapper h-100">
                                                        @if (!empty($ad->media) && is_array(json_decode($ad->media, true)))
                                                            @foreach (json_decode($ad->media, true) as $index => $media)
                                                                <div class="swiper-slide position-relative">
                                                                    @if (str_contains($media, '.mp4'))
                                                                        <video class="position-absolute top-0 start-0 w-100 h-100 object-fit-cover" controls>
                                                                            <source src="{{ asset('storage/' . $media) }}" type="video/mp4">
                                                                            Your browser does not support the video tag.
                                                                        </video>
                                                                    @else
                                                                        <img src="{{ asset('storage/' . $media) }}" class="position-absolute top-0 start-0 w-100 h-100 object-fit-cover" alt="Ad Image">
                                                                    @endif
                                                                    <span class="position-absolute top-0 start-0 w-100 h-100" style="background: linear-gradient(180deg, rgba(0,0,0, 0) 0%, rgba(0,0,0, .16) 100%)"></span>
                                                                    <a href="{{ asset('storage/' . $media) }}" download class="btn btn-primary btn-sm download-btn">
                                                                        <i class="fi-download me-1"></i> 다운로드
                                                                    </a>
                                                                </div>
                                                            @endforeach
                                                        @else
                                                            <div class="swiper-slide position-relative">
                                                                <img src="{{ asset('assets-freelancer/img/listings/contractors/01.jpg') }}" class="position-absolute top-0 start-0 w-100 h-100 object-fit-cover" alt="Placeholder Image">
                                                                <span class="position-absolute top-0 start-0 w-100 h-100" style="background: linear-gradient(180deg, rgba(0,0,0, 0) 0%, rgba(0,0,0, .16) 100%)"></span>
                                                                <a href="{{ asset('assets-freelancer/img/listings/contractors/01.jpg') }}" download class="btn btn-primary btn-sm download-btn">
                                                                    <i class="fi-download me-1"></i> 다운로드
                                                                </a>
                                                            </div>
                                                        @endif
                                                    </div>
                                                    @if (!empty($ad->media) && is_array(json_decode($ad->media, true)) && count(json_decode($ad->media, true)) > 1)
                                                        <div class="position-absolute top-50 start-0 z-1 translate-middle-y d-none d-lg-block hover-effect-target opacity-0 ms-3">
                                                            <button type="button" class="btn btn-sm btn-prev btn-icon btn-light bg-light rounded-circle animate-slide-start" aria-label="Prev">
                                                                <i class="fi-chevron-left fs-lg animate-target"></i>
                                                            </button>
                                                        </div>
                                                        <div class="position-absolute top-50 end-0 z-1 translate-middle-y d-none d-lg-block hover-effect-target opacity-0 me-3">
                                                            <button type="button" class="btn btn-sm btn-next btn-icon btn-light bg-light rounded-circle animate-slide-end" aria-label="Next">
                                                                <i class="fi-chevron-right fs-lg animate-target"></i>
                                                            </button>
                                                        </div>
                                                        <div class="swiper-pagination bottom-0 z-1 mb-2" data-bs-theme="light"></div>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-sm-8 d-flex p-3 p-sm-4" style="min-height: 255px">
                                                <div class="row flex-lg-nowrap g-0 position-relative pt-1 pt-sm-0">
                                                    <button type="button" class="btn btn-icon btn-outline-secondary rounded-circle position-absolute top-0 end-0 z-2" data-bs-toggle="tooltip" data-bs-custom-class="tooltip-sm" title="Bookmark" aria-label="Bookmark">
                                                        <i class="fi-bookmark fs-base"></i>
                                                    </button>
                                                    <div class="col-lg-8 pe-lg-4">
                                                        <div class="d-flex align-items-center pe-5 pe-lg-0 pb-2 mb-1">
                                                            <h3 class="h6 mb-0">
                                                                <a class="hover-effect-underline stretched-link" href="#">광고 : #{{ $ad->id }}</a>
                                                            </h3>
                                                        </div>
                                                        <div class="fs-sm mb-2 mb-lg-3">
                                                            <span class="fw-medium text-dark-emphasis"><b>고객 이름 :</b> {{ $ad->store_name }}</span>
                                                            <i class="fi-bullet fs-base align-middle"></i>
                                                            <span class="fw-medium text-dark-emphasis"><b>콘텐츠 유형 :</b> {{ !empty($ad->media) && is_array(json_decode($ad->media, true)) && str_contains(json_decode($ad->media, true)[0], '.mp4') ? '동영상' : '이미지' }}</span>
                                                            <div class="fw-medium text-dark-emphasis"><b>마감일 :</b> {{ $ad->created_at->addDays(30)->format('Y-m-d') }}</div>
                                                        </div>
                                                        <p class="fs-sm mb-0"><b>광고 설명 :</b> {{ $ad->description }}</p>
                                                        <p class="fs-sm mb-0"><b>보상 :</b> ${{ number_format($ad->total / $ad->quantity, 2) }} per job</p>
                                                    </div>
                                                    <hr class="vr flex-shrink-0 d-none d-lg-block m-0">
                                                    <div class="col-lg-4 d-flex flex-column pt-3 pt-lg-5 ps-lg-4">
                                                        <ul class="list-unstyled pb-2 pb-lg-4 mb-3">
                                                            <li class="d-flex align-items-center gap-1">
                                                                <i class="fi-star-filled text-warning"></i>
                                                                <span class="fs-sm text-secondary-emphasis">4.7</span>
                                                            </li>
                                                        </ul>
                                                        <a href="{{ route('freelancer.claim', $ad->id) }}" class="btn btn-outline-dark position-relative z-2 mt-auto" onclick="setModalData({{ $ad->id }}, '{{ $ad->store_name }}', '{{ !empty($ad->media) && is_array(json_decode($ad->media, true)) && str_contains(json_decode($ad->media, true)[0], '.mp4') ? '동영상' : '이미지' }}', {{ $ad->quantity }})">
                                                            <i class="fi-take me-2"></i>
                                                            광고 가져가기
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </article>
                                @empty
                                    <p class="text-center">현재 활성 광고가 없습니다.</p>
                                @endforelse
                            </div>
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

    <!-- Sidebar toggle button -->
    <button type="button" class="fixed-bottom z-sticky w-100 btn btn-lg btn-dark border-0 border-top border-light border-opacity-10 rounded-0 pb-4 d-lg-none" data-bs-toggle="offcanvas" data-bs-target="#filterSidebar" aria-controls="filterSidebar" data-bs-theme="light">
        <i class="fi-sidebar fs-base me-2"></i>
        필터
    </button>

    <!-- Back to top button -->
    <div class="floating-buttons position-fixed top-50 end-0 z-sticky me-3 me-xl-4 pb-4">
        <a class="btn-scroll-top btn btn-sm bg-body border-0 rounded-pill shadow animate-slide-end" href="#top">
            맨 위
            <i class="fi-arrow-right fs-base ms-1 me-n1 animate-target"></i>
            <span class="position-absolute top-0 start-0 w-100 h-100 border rounded-pill z-0"></span>
            <svg class="position-absolute top-0 start-0 w-100 h-100 z-1" viewBox="0 0 62 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                <rect x=".75" y=".75" width="60.5" height="30.5" rx="15.25" stroke="currentColor" stroke-width="1.5" stroke-miterlimit="10"></rect>
            </svg>
        </a>
    </div>

    <!-- Bootstrap + Theme scripts -->
    <script src="{{ asset('assets-freelancer/js/theme.min.js') }}"></script>
    <script>
        function setModalData(adId, storeName, contentType, quantity) {
            document.getElementById('modal_ad_id').value = adId;
            document.getElementById('modal_store_name').value = storeName;
            document.getElementById('modal_content_type').value = contentType;

            const container = document.getElementById('sns_links_container');
            container.innerHTML = ''; // Clear previous inputs

            for (let i = 1; i <= quantity; i++) {
                const div = document.createElement('div');
                div.className = 'mb-3';
                div.innerHTML = `
                    <label for="sns_link_${i}" class="form-label">SNS 링크 ${i}</label>
                    <input type="text" class="form-control" name="sns_link[]" id="sns_link_${i}" placeholder="예: https://instagram.com/post/123" required>
                    <div class="invalid-feedback">유효한 SNS 링크를 입력하세요.</div>
                `;
                container.appendChild(div);
            }
        }

        @if (session('already_claimed'))
            document.addEventListener('DOMContentLoaded', function () {
                alert('이미 이 광고를 제출했습니다. 다른 광고를 확인하세요.');
            });
        @endif

        @if (session('intended_ad_id'))
            document.addEventListener('DOMContentLoaded', function () {
                const ad = {!! json_encode(\App\Models\Ad::find(session('intended_ad_id'))) !!};
                if (ad) {
                    setModalData(ad.id, ad.store_name, '{{ !empty($ad->media) && is_array(json_decode($ad->media, true)) && str_contains(json_decode($ad->media, true)[0], '.mp4') ? '동영상' : '이미지' }}', ad.quantity);
                    const myModal = new bootstrap.Modal(document.getElementById('connectModal'));
                    myModal.show();
                }
                {{ session()->forget('intended_ad_id') }}
            });
        @endif

        document.querySelectorAll('.swiper').forEach(swiper => {
            new Swiper(swiper, JSON.parse(swiper.dataset.swiper));
        });
    </script>
</body>
</html>
