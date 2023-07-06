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

    <script src="{{ asset('javascript/sideMenu.js') }}"></script>
    <script src="{{ asset('javascript/locations/side-menu-display.js') }}"></script>
    <script src="{{ asset('javascript/locations/platformselect.js') }}"></script>
    <script>
        const locationName = "{{ Route::currentRouteName() }}";
        locationActive(locationName);
        console.log(locationName);
    </script>

</head>

<body>
    <!-- Nav start ----- -->
    @include('layouts.adminAccountapp')
    <!-- Nav ends ------ -->
    <!-- Container start ----- -->
    <section class="container p-6 mx-auto">
        <form method="POST" action="{{ route('admin.submitresetpassword') }}" enctype="multipart/form-data">
            @csrf
            <!-- Card start ----- -->
            <div class="bg-white rounded-lg shadow-lg px-8 py-12 mt-20 flex flex-col gap-8 items-center max-w-lg mx-auto">
                <h3 class="h3"> 重設密碼 </h3>
                    {{-- Inputs --}}
                    <div class="flex flex-col gap-6 w-full">
                        <input type="hidden" name="token" value="{{ $token }}">
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
                        </div>
                        @if($errors->any())
                            @foreach($errors->all() as $error)
                                <span class="invalid-feedback" role="alert">
                                    <p class="help is-danger">{{ $error }}</p>
                                </span>
                            @endforeach
                        @endif
                        @if(Session::has('error'))
                            <span class="invalid-feedback" role="alert">
                                <p class="help is-danger">{{ Session::get('error') }}</p>
                            </span>
                        @endif
                        <button class="button primary-btn">
                            更新
                        </button>
                    </div>
            </div>
            <!-- Card ends ------ -->
        </form>
    </section>
    <!-- Container ends ------ -->
    <script src="{{ asset('javascript/input/passwordInput.js') }}"></script>
</body>
</html>
