<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- sucess UI -->
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <!-- import jQuery -->
    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js'
        integrity='sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA=='
        crossorigin='anonymous'></script>

    <title> 帳號資料 </title>

    <!-- import font awesome -->
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.css'
        integrity='sha512-HHsOC+h3najWR7OKiGZtfhFIEzg5VRIPde0kB0bG2QRidTQqf+sbfcxCTB16AcFB93xMjnBIKE29/MjdzXE+qw=='
        crossorigin='anonymous' />

    <!-- import CSS -->
    @vite('resources/css/app.css')
    @vite('resources/css/layout.css')
    @vite('resources/css/components/Nav.css')
    @vite('resources/css/components/SideMenu.css')
    @vite('resources/css/components/Breadcrumb.css')

</head>

<body>
    <!-- Nav start ----- -->
    @include('layouts.adminAccountapp')
    <!-- Nav ends ------ -->

    <!-- Breadcrumb start ----- -->
    @include('breadcrumbs')
    <!-- Breadcrumb ends ------ -->

    <!-- Container start ----- -->
    <section class="container mx-auto">
        <form method="POST" action="{{ route('acocunt.newemail.submit') }}" enctype="multipart/form-data"
            class="mt-28">
            @csrf
            <!-- Card start ----- -->
            <div class="bg-white rounded-lg shadow-lg px-8 py-12 mt-20 flex flex-col gap-8 items-center max-w-lg mx-auto">

                <h3 class="h3"> 重設 Email </h3>


                <div class="space-y-4 w-full">

                    {{-- Enter Password --}}
                    <div class="field">
                        <label class="label"> 輸入密碼 </label>
                        <div class="relative">
                            <span class="input-icon right-0 pr-3">
                                <button class="eyeBtn" type="button">
                                    <i class="fa-solid fa-eye"></i>
                                </button>
                            </span>
                            <input id="password"  name="current_password"  type="password" class="input input-rightIcon {{ $errors->has('current_password') ? 'input-warning' : '' }}" placeholder="********">
                        </div>
                    </div>

                    {{-- Enter Email --}}
                    <div class="field">
                        <label class="label"> 輸入新的 Email </label>
                        <div class="control">
                            <input class="input" type="text" placeholder="輸入電郵地址" maxlength="50" required
                                name="email">
                        </div>
                    </div>

                </div>

                {{-- Buttons --}}
                <div class="flex gap-4">
                    <button class="button primary-btn">
                        送出
                    </button>
                    <button class="button secondary-btn" type="button" id="return"
                        onclick="location.href='{{ route('admin.main') }}'">
                        取消
                    </button>
                </div>
            </div>
            <!-- Card ends ------ -->
        </form>
    </section>
    <!-- Container ends ------ -->

    @include('Sucess')
</body>
<script src="{{ asset('javascript/input/passwordInput.js') }}"></script>

</html>
