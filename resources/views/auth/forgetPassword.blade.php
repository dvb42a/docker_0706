@extends('layouts.adminloginapp')

@section('content')

    <body>
        <!-- Nav start ----- -->
        <nav class="nav" role="navigation" aria-label="main navigation">
            <div>
                <a class="nav-title" href="{{ '/' }}">
                    <i class="fa-solid fa-swatchbook"></i>
                    <span> 後臺管理介面 </span>
                    <span>v2.7</span>
                </a>
            </div>
        </nav>
        <!-- Nav ends ------ -->

        {{-- Content Start --}}
        <div class="relative">


            <!-- Card -->
            <div class="mt-32 mx-auto w-96 bg-white p-8 flex flex-col rounded-md shadow-lg gap-8">

                <div>
                    <p class="help">
                        <a href="{{ route('admin.login') }}">
                            <i class="fa-solid fa-caret-left"></i>
                            返回登入頁面
                        </a>
                    </p>
                </div>

                <h3 class="text-2xl font-bold mb-4 text-center">
                    重設密碼
                </h3>

                {{-- card content --}}
                <form method="POST" action="{{ route('admin.forgetpassword.post') }}" class="w-full flex flex-col gap-8">
                    @csrf

                    <div class="field">
                        <label class="label"> 輸入註冊時使用的 e-mail </label>
                        <div class="relative">
                            <span class="input-icon left-0 pl-3">
                                <i class="fa-solid fa-envelope"></i>
                            </span>
                            <input class="input input-leftIcon  {{ $errors->any() ? 'input-warning' : '' }}" type="text"
                                placeholder=" " id="text" name="email">
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
                    </div>

                    <button class="button primary-btn" id="submit">
                        送出
                    </button>


                </form>

            </div>
            {{-- Card Ends --}}

        </div>
        {{-- Content Ends --}}


        <script src="{{ asset('javascript/login-record.js') }}"></script>
    </body>

@endsection
