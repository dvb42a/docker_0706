@extends('layouts.adminloginapp')

@section('content')
    <!-- import CSS -->
    {{-- <link rel="stylesheet" href="{{ asset('css/page-style/login-page.css') }}"> --}}

    <body>
        <!-- Nav start ----- -->
        <nav class="nav z-20" role="navigation" aria-label="main navigation">
            <div>
                <a class="nav-title" href="{{ route('admin.main') }}">
                    <i class="fa-solid fa-swatchbook"></i>
                    <span> 首次登入設定 </span>
                </a>
            </div>
        </nav>
        <!-- Nav ends ------ -->

        <!-- Container start ----- -->
        <section class="container p-6 mx-auto">
            <!-- Crad start ----- -->
            <form class="bg-white rounded-lg shadow-lg px-8 py-12 mt-28 flex flex-col gap-8 items-center max-w-lg mx-auto"
                method="POST" action="{{ route('account.verifysubmit') }}">
                @csrf
                <h3 class="h3"> 帳號首次登入基本設定(1/1) </h3>

                @if (Session::has('message'))
                    {{ Session::get('message') }}
                @else
                    <div class="flex flex-col gap-4 w-full">

                        {{-- Enter Email --}}
                        <div class="field">
                            <label class="label"> 驗證電郵地址 </label>
                            <div class="relative rounded-md shadow-sm">
                                <span class="input-icon left-0 pl-3">
                                    <i class="fa-solid fa-envelope"></i>
                                </span>
                                <input class="input input-leftIcon" type="text" placeholder=" " id="text"
                                    name="email" value="{{ Auth::guard('admin')->user()->email }}">
                            </div>
                        </div>

                        {{-- Enter Password --}}
                        <div class="field">
                            <label class="label"> 輸入新密碼 </label>
                            <div class="relative">
                                <input id="password"  name="new_password"  type="password" class="input input-rightIcon {{ $errors->has('new_password') ? 'input-warning' : '' }}" placeholder="********">
                                <span class="input-icon right-0 pr-3">
                                    <button class="eyeBtn" type="button">
                                        <i class="fa-solid fa-eye"></i>
                                    </button>
                                </span>
                            </div>
                        </div>

                        {{-- Comfirm --}}
                        <div class="field">
                            <label class="label"> 再次輸入密碼 </label>
                            <div class="relative">
                                <input id="password"  name="new_password_confirmation"  type="password" class="input input-rightIcon {{ $errors->has('new_password_confirmation') ? 'input-warning' : '' }}" placeholder="********">
                                <span class="input-icon right-0 pr-3">
                                    <button class="eyeBtn" type="button">
                                        <i class="fa-solid fa-eye"></i>
                                    </button>
                                </span>
                            </div>

                            @if ($errors->any())
                                @foreach ($errors->all() as $error)
                                    <span class="invalid-feedback" role="alert">
                                        <p class="help danger">{{ $error }}</p>
                                    </span>
                                @endforeach
                            @endif
                            @if (Session::has('message'))
                                <p class="help">
                                    {{ Session::get('message') }}
                                </p>
                            @endif
                            @if (Session::has('error'))
                                <p class="help">
                                    <span class="invalid-feedback" role="alert">
                                        <p class="help is-danger">{{ Session::get('error') }}</p>
                                    </span>
                                </p>
                            @endif
                        </div>
                    </div>

                    <div class="flex gap-4">
                        <button class="button primary-btn" id="loaderBtn"> 送出 </button>
                        <a href="{{ route('admin.logout') }}" class="button secondary-btn">
                            <i class="fa-solid fa-right-from-bracket"></i>

                            登出
                        </a>
                    </div>
                @endif

            </form>

            <!-- Box ends ------ -->
        </section>
        <!-- Container ends ------ -->

        {{-- import script --}}
        <script src="{{ asset('javascript/login-record.js') }}"></script>
        <script src="{{ asset('javascript/loaderbtn.js') }}"></script>
        <script src="{{ asset('javascript/input/passwordinput.js') }}"></script>
    </body>
@endsection
