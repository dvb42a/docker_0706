@extends('layouts.adminLoginTailwind')

@section('content')

    <body>
        <!-- Nav start ----- -->
        <nav class="nav" role="navigation"
            aria-label="main navigation">
            <div>
                <a class="nav-title" href="{{ '/' }}">
                    <i class="fa-solid fa-swatchbook"></i>
                    <span> 後臺管理介面 </span>
                    <span>v2.7</span>
                </a>
            </div>
        </nav>
        <!-- Nav ends ------ -->


        <!-- Content Start -->
        <div class="relative flex items-center justify-center">

            <!-- Card -->
            <div class="mt-32 bg-white p-8 flex flex-col items-center justify-center rounded-md shadow-lg w-96">

                <h3 class="text-2xl font-bold mb-4">
                    後台管理入口
                </h3>

                <!-- card content -->
                <form method="POST" action="{{ route('admin.login') }}" class="w-full flex flex-col gap-4">
                    @csrf

                    <!-- 選擇平台 -->
                    <div class="field">
                        <label for="" class="label">選擇登入平台</label>
                        <div class="relative">
                            <span class="input-icon right-0 pr-3">
                                <i class="fa-solid fa-caret-down"></i>
                            </span>
                            <select name="target_location" id="platform" class="input select">
                                <option value="PlatformAdmin" id="PlatformAdmin"> 全域平台管理 </option>
                                <option value="Beauty" id="Beauty"> 美容百科平台 2.2SP </option>
                                <option value="Sport" id="Sport"> 運動百科平台 </option>
                            </select>
                        </div>
                    </div>

                    <!-- 帳號 -->
                    <div class="field">
                        <label for="account" class="label">
                            帳號：
                        </label>
                        <input id="account" name="account" value="{{ old('account') }}" type="text"
                             class="input">
                    </div>

                    <!-- 密碼 -->
                    <div class="field">
                        <label for="password" class="label">密碼：</label>
                        <div class="relative">
                            <input id="password" name="password"  type="password" class="input input-rightIcon {{ $errors->any() ? 'input-warning' : '' }}" placeholder="********">
                            <span class="input-icon right-0 pr-3">
                                <button class="eyeBtn" type="button">
                                    <i class="fa-solid fa-eye"></i>
                                </button>
                            </span>
                        </div>

                        {{-- 判斷是否為空值 --}}
                        @if ($errors->any())
                            @foreach ($errors->all() as $error)
                                <span class="invalid-feedback" role="alert">
                                    <p class="help danger">{{ $error }}</p>
                                </span>
                            @endforeach
                        @endif
                        @if(session()->has('message'))
                        <span class="invalid-feedback" role="alert">
                            <p class="help success">
                                {{ session('message') }}
                            </p>
                        </span>
                        @endif
                    </div>

                    <!-- card bottom -->
                    <div class="flex flex-col w-full gap-2 mt-4">
                        <button id="login" class="button primary-btn">登入</button>
                        <div class="flex justify-end text-sm">
                            <a class="text-gray-600 hover:underline underline-offset-4" href="{{ route('admin.forgetpassword.get') }}">忘記密碼 ?</a>
                        </div>
                    </div>

                </form>

            </div>
            <!-- Content ends -->

            {{-- import script --}}
            <!-- loaderBtn motion is coding in login record -->
            <script src="{{ asset('javascript/login-record.js') }}"></script>
            <script src="{{ asset('javascript/input/passwordInput.js') }}"></script>


    </body>
@endsection
