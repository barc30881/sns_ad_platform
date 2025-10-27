<!DOCTYPE html>
<html lang="en" data-bs-theme="dark" data-pwa="true">
<meta http-equiv="content-type" content="text/html;charset=utf-8" />

<head>
  <meta charset="utf-8">

  <!-- Viewport -->
  <meta name="viewport"
    content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, viewport-fit=cover">

  <!-- SEO Meta Tags -->
  <title>Ad Application Page</title>
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
      <button type="button" class="navbar-toggler me-3 me-lg-0" data-bs-toggle="offcanvas" data-bs-target="#navbarNav"
        aria-controls="navbarNav" aria-label="Toggle navigation">
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
              <a class="nav-link" href="https://ad-platform.onrender.com" role="button" data-bs-toggle="dropdown"
                data-bs-trigger="hover" aria-expanded="false">홈</a>

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

        <!-- Theme switcher (light/dark/auto) -->
        <div class="dropdown">
          <button type="button" class="theme-switcher btn btn-icon btn-outline-secondary fs-lg border-0 animate-scale"
            data-bs-toggle="dropdown" aria-expanded="false" aria-label="Toggle theme (light)">
            <span class="theme-icon-active d-flex animate-target">
              <i class="fi-sun"></i>
            </span>
          </button>
          <ul class="dropdown-menu start-50 translate-middle-x"
            style="--fn-dropdown-min-width: 9rem; --fn-dropdown-spacer: .5rem">
            <li>
              <button type="button" class="dropdown-item active" data-bs-theme-value="light" aria-pressed="true">
                <span class="theme-icon d-flex fs-base me-2">
                  <i class="fi-sun"></i>
                </span>
                <span class="theme-label">Light</span>
                <i class="item-active-indicator fi-check ms-auto"></i>
              </button>
            </li>
            <li>
              <button type="button" class="dropdown-item" data-bs-theme-value="dark" aria-pressed="false">
                <span class="theme-icon d-flex fs-base me-2">
                  <i class="fi-moon"></i>
                </span>
                <span class="theme-label">Dark</span>
                <i class="item-active-indicator fi-check ms-auto"></i>
              </button>
            </li>
            <li>
              <button type="button" class="dropdown-item" data-bs-theme-value="auto" aria-pressed="false">
                <span class="theme-icon d-flex fs-base me-2">
                  <i class="fi-auto"></i>
                </span>
                <span class="theme-label">Auto</span>
                <i class="item-active-indicator fi-check ms-auto"></i>
              </button>
            </li>
          </ul>
        </div>

        <!-- Account dropdown (Logged in state) -->
        <div class="dropdown">
          <a class="btn btn-icon btn-outline-secondary fs-lg border-0 animate-shake me-2" href="#" role="button"
            data-bs-toggle="dropdown" aria-expanded="false" aria-label="My account">
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
                  <i class="fi-arrow-right-circle d-none d-lg-inline-flex fs-lg me-2"></i>
                  <i class="fi-arrow-down-circle d-lg-none fs-lg me-2"></i>
                  광고 제작 섹션
                </a>
              </li>
              <li class="nat-item">
                <a class="nav-link d-inline-flex px-0 px-lg-3 disabled">
                  <i class="fi-circle fs-lg me-2"></i>
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
          <h1 class="h2 mb-n2 mb-lg-3">광고 만들기를 시작하세요</h1>
           <!-- Display success/error messages -->
                    @if (session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif
                    @if (session('error'))
                        <div class="alert alert-danger">{{ session('error') }}</div>
                    @endif
          <form action="{{ route('storeAdApplicationPage') }}" method="POST" enctype="multipart/form-data">
            @csrf
            

            {{-- Ad Title --}}
            <div class="pb-4 mb-2 mt-3 pt-3">
              <label for="adTitle" class="form-label">광고 제목 *</label>
              <input name="adTitle" type="text" class="form-control form-control-lg" id="adTitle"
                placeholder="예: 가게 할인 광고" required="" value="{{ old('adTitle') }}">
              @error('adTitle')
                <small class="text-danger">{{ $message }}</small>
              @enderror
            </div>
            {{-- Description --}}
            <div class="pb-4 mb-2">
              <label for="description" class="form-label fs-base">간단한 설명 *</label>
              <textarea class="form-control form-control-lg bg-transparent" id="description"
                placeholder="광고 내용 요약 (50자 이내)" rows="4" name="description">{{ old('description') }}</textarea>
              @error('description')
                <small class="text-danger">{{ $message }}</small>
              @enderror
            </div>

            {{-- Upload --}}
            <div class="col-lg-9 col-xl-8">
              <label for="UploadAd" class="form-label fs-base">광고 업로드 *</label>

              <div class="border rounded p-3">
                <div class="row row-cols-2 row-cols-sm-3 g-2" id="previewContainer">



                  <!-- Upload button -->
                  <div class="col">
                    <div id="uploadTrigger"
                      class="d-flex align-items-center justify-content-center position-relative h-100 cursor-pointer bg-body-tertiary border border-2 border-dotted rounded p-3">
                      <div class="text-center">
                        <i class="fi-plus-circle fs-4 text-secondary-emphasis mb-2"></i>
                        <div class="hover-effect-underline stretched-link fs-sm fw-medium">광고 크리에이티브 업로드 (이미지, 배너 또는
                          동영상)</div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <!-- Hidden file input -->
              <input type="file" name="creatives[]" id="UploadAd" accept="image/*,video/*" multiple hidden>

              @error('creatives')
                <small class="text-danger">{{ $message }}</small>
              @enderror
            </div>
            {{-- Type --}}
            <div class="pt-3 mt-3 mb-n2">

              <label for="adTypeSelection" class="form-label fs-base">광고 유형 선택*</label>
              <div class="vstack gap-2">
                <div class="form-check mb-1">
                  <input type="radio" class="form-check-input" id="prepaid" value="prepaid" name="adTypeSelection"
                    checked="" {{ old('adTypeSelection') == 'prepaid' ? 'checked' : '' }}>
                  <label for="prepaid" class="form-check-label"><strong>선불 광고</strong> — 사용한 만큼만 결제하세요. 100회 노출당 $1.5부터
                    시작합니다.</label>
                </div>
                <div class="form-check mb-1">
                  <input type="radio" class="form-check-input" id="postpaid" value="postpaid" name="adTypeSelection" {{ old('adTypeSelection') == 'postpaid' ? 'checked' : '' }}>
                  <label for="postpaid" class="form-check-label"><strong>후불 광고</strong> — 먼저 시작하고 나중에 결제하세요. 등록비
                    $50.</label>
                </div>
              </div>
              @error('adTypeSelection')
                <small class="text-danger">{{ $message }}</small>
              @enderror
            </div>


        </div>
      </div>
    </div>
  </main>


  <!-- Prev / Next navigation (Footer) -->
  <footer class="sticky-bottom bg-body pb-3">
    <div class="progress rounded-0" role="progressbar" aria-label="Dark example" aria-valuenow="14.29" aria-valuemin="0"
      aria-valuemax="100" style="height: 4px">
      <div class="progress-bar bg-dark d-none-dark" style="width: 33.33%"></div>
      <div class="progress-bar bg-light d-none d-block-dark" style="width: 33.33%"></div>
    </div>
    <div class="container d-flex gap-3 pt-3">
      <button type="submit" class="btn btn-primary animate-slide-end ms-auto">스토어 정보로 계속하기</button>


      <i class="fi-arrow-right animate-target fs-base ms-2 me-n1"></i>
      </a>
    </div>
  </footer>



  </form>



  <script>
    document.addEventListener('DOMContentLoaded', () => {
      const uploadInput = document.getElementById('UploadAd');
      const uploadBox = document.getElementById('uploadTrigger');
      const previewContainer = document.getElementById('previewContainer');

      //  Click box to open file explorer
      uploadBox.addEventListener('click', () => uploadInput.click());

      //  Handle file preview
      uploadInput.addEventListener('change', (event) => {
        const files = Array.from(event.target.files);

        // Clear any existing previews (fresh selection)
        previewContainer.querySelectorAll('.col.position-relative').forEach(el => el.remove());

        files.forEach(file => {
          const col = document.createElement('div');
          col.className = 'col position-relative';

          // Remove button
          const removeBtn = document.createElement('button');
          removeBtn.innerHTML = '&times;';
          removeBtn.className = 'btn btn-sm btn-light position-absolute top-0 end-0 m-1 rounded-circle';
          removeBtn.style.zIndex = '10';
          removeBtn.addEventListener('click', (e) => {
            e.preventDefault();
            col.remove();
          });

          // Preview image or video
          let previewElement;
          if (file.type.startsWith('image/')) {
            previewElement = document.createElement('img');
            previewElement.src = URL.createObjectURL(file);
          } else if (file.type.startsWith('video/')) {
            previewElement = document.createElement('video');
            previewElement.src = URL.createObjectURL(file);
            previewElement.controls = true;
          } else {
            return;
          }

          previewElement.className = 'w-100 h-100 object-fit-cover rounded border';
          previewElement.style.maxHeight = '180px';

          col.appendChild(previewElement);
          col.appendChild(removeBtn);

          // Insert before upload box
          previewContainer.insertBefore(col, uploadBox.closest('.col'));
        });
      });
    });
  </script>


  <!-- Bootstrap + Theme scripts -->

  <script src="{{ asset('assets-advertiser/js/theme.min.js') }}"></script>
  <script src="{{ asset('assets-advertiser/js/theme-switcher.js') }}"></script>

</body>
<!-- Mirrored from finder-html.createx.studio/add-property-type.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 10 Aug 2025 15:57:25 GMT -->

</html>