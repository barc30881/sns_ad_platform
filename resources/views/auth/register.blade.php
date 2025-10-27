<!DOCTYPE html>
<html lang="en" >
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration | Advertiser</title>
    <link href="{{ asset('assets-home/dist/output.css') }}" rel="stylesheet">
    <script src="https://unpkg.com/flowbite@1.5.3/dist/flowbite.js"></script>
</head>

<body >

    <!-- Header -->
    <header>
        <nav class="bg-white border-gray-200 px-4 lg:px-6 py-2.5 dark:bg-gray-800">
            <div class="flex flex-wrap justify-between items-center mx-auto max-w-screen-xl">
                <a href="{{ route('home') }}" class="flex items-center">
                    <span class="self-center text-xl font-semibold whitespace-nowrap dark:text-white">로고 (Logo)</span>
                </a>
                <div class="flex items-center lg:order-2">
                    <a href="{{ route('home') }}"
                        class="text-white bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 font-medium rounded-lg text-sm px-4 lg:px-5 py-2 lg:py-2.5 mr-2 dark:bg-primary-600 dark:hover:bg-primary-700 focus:outline-none dark:focus:ring-primary-800">
                        시작하기 (Get Started)
                    </a>
                    <button data-collapse-toggle="mobile-menu-2" type="button"
                        class="inline-flex items-center p-2 ml-1 text-sm text-gray-500 rounded-lg lg:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600"
                        aria-controls="mobile-menu-2" aria-expanded="false">
                        <span class="sr-only">Open main menu</span>
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z"
                                clip-rule="evenodd"></path>
                        </svg>
                        <svg class="hidden w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </button>
                </div>
                <div class="hidden justify-between items-center w-full lg:flex lg:w-auto lg:order-1" id="mobile-menu-2">
                    <ul class="flex flex-col mt-4 font-medium lg:flex-row lg:space-x-8 lg:mt-0">
                        <li>
                            <a href="{{ route('register') }}"
                                class="block py-2 pr-4 pl-3 text-white rounded bg-primary-700 lg:bg-transparent lg:text-primary-700 lg:p-0 dark:text-white"
                                aria-current="page">광고주 (Advertiser)</a>
                        </li>
                        <li>
                            <a href="#"
                                class="block py-2 pr-4 pl-3 text-gray-700 border-b border-gray-100 hover:bg-gray-50 lg:hover:bg-transparent lg:border-0 lg:hover:text-primary-700 lg:p-0 dark:text-gray-400 lg:dark:hover:text-white dark:hover:bg-gray-700 dark:hover:text-white lg:dark:hover:bg-transparent dark:border-gray-700">
                                프리랜서 (Freelancer)
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <!-- Main Content -->
    <section class="bg-gray-50 dark:bg-gray-900">
        <div class="grid max-w-screen-xl px-4 py-8 mx-auto lg:gap-20 lg:py-16 lg:grid-cols-12">
            <div class="w-full p-6 mx-auto bg-white rounded-lg shadow dark:bg-gray-800 sm:max-w-xl lg:col-span-6 sm:p-8">
                <a href="{{ route('home') }}" class="inline-flex items-center mb-4 text-xl font-semibold text-gray-900 dark:text-white">
                    로고 (Logo)
                </a>
                <h1 class="mb-2 text-2xl font-bold leading-tight tracking-tight text-gray-900 dark:text-white">
                    계정을 생성하세요 (Create an Account)
                </h1>
                <p class="text-sm font-light text-gray-500 dark:text-gray-300">
                    등록하고 광고 캠페인을 지금 시작하세요. (Sign up and start your ad campaign now.) 
                    이미 계정이 있으신가요? (Already have an account?) 
                    <a href="{{ route('login') }}" class="font-medium text-primary-600 hover:underline dark:text-primary-500">
                        여기서 로그인하세요 (Log in here)
                    </a>.
                </p>

                <!-- Display success/error messages -->
                @if (session('error'))
                    <div class="alert alert-danger mt-4">{{ session('error') }}</div>
                @endif
                @if ($errors->any())
                    <div class="alert alert-danger mt-4">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form class="mt-4 space-y-6 sm:mt-6" action="{{ route('register') }}" method="POST">
                    @csrf
                    <div class="space-y-3">
                        <div>
                            <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                귀하의 이메일 (Your Email)
                            </label>
                            <input type="email" name="email" id="email"
                                class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="name@company.com" value="{{ old('email') }}" required>
                            @error('email')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div>
                            <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                비밀번호 (Password)
                            </label>
                            <input type="password" name="password" id="password" placeholder="••••••••"
                                class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                required>
                            @error('password')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div>
                            <label for="password_confirmation" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                비밀번호 확인 (Confirm Password)
                            </label>
                            <input type="password" name="password_confirmation" id="password_confirmation" placeholder="••••••••"
                                class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                required>
                        </div>
                        <div class="flex items-start">
                            <div class="flex items-center h-5">
                                <input id="terms" name="terms" type="checkbox"
                                    class="w-4 h-4 border border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-primary-300 dark:bg-gray-700 dark:border-gray-600 dark:focus:ring-primary-600 dark:ring-offset-gray-800"
                                    required>
                            </div>
                            <div class="ml-3 text-sm">
                                <label for="terms" class="font-light text-gray-500 dark:text-gray-300">
                                    회원가입을 완료하면 <strong>Logo 광고주 계정</strong>이 생성되며,
                                    <a href="#" class="font-medium text-primary-600 dark:text-primary-500 hover:underline">
                                        이용약관 (Terms of Service)
                                    </a>
                                    및
                                    <a href="#" class="font-medium text-primary-600 dark:text-primary-500 hover:underline">
                                        개인정보 처리방침 (Privacy Policy)
                                    </a>
                                    에 동의하는 것으로 간주됩니다.
                                    (By completing registration, a <strong>Logo Advertiser Account</strong> is created, and you agree to the
                                    <a href="#" class="font-medium text-primary-600 dark:text-primary-500 hover:underline">Terms of Service</a> and
                                    <a href="#" class="font-medium text-primary-600 dark:text-primary-500 hover:underline">Privacy Policy</a>.)
                                </label>
                            </div>
                        </div>
                    </div>
                    <button type="submit"
                        class="w-full text-white bg-primary-600 hover:bg-primary-700 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
                        등록하고 광고 캠페인을 지금 시작하세요 (Register and Start Your Ad Campaign Now)
                    </button>
                </form>
            </div>
            <div class="mr-auto place-self-center lg:col-span-6">
                <img class="hidden mx-auto lg:flex"
                    src="https://flowbite.s3.amazonaws.com/blocks/marketing-ui/authentication/illustration.svg"
                    alt="illustration">
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="p-4 py-8 bg-white md:p-8 lg:p-10 dark:bg-gray-800">
        <div class="mx-auto max-w-screen-xl text-center">
            <div class="sm:items-center sm:justify-between sm:flex">
                <a href="{{ route('home') }}" class="flex items-center mb-4 text-2xl font-semibold text-gray-900 lg:mb-0 dark:text-white">
                    로고 (Logo)
                </a>
                <div class="flex justify-center mt-4 space-x-6 sm:mt-0">
                    <span class="block text-sm text-gray-500 dark:text-gray-400">©2025. All Rights Reserved.</span>
                </div>
            </div>
        </div>
    </footer>

</body>
</html>