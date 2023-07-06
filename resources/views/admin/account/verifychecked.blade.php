@extends('layouts.adminloginapp')

@section('content')

    <body>
        <!-- Nav start ----- -->
        <nav class="nav z-20" role="navigation" aria-label="main navigation">
            <div>
                <a class="nav-title" href="{{ route('admin.main') }}">
                    <i class="fa-solid fa-swatchbook"></i>
                    <span> 後臺管理介面 </span>
                </a>
            </div>
        </nav>
        <!-- Nav ends ------ -->
        <!-- Nav ends ------ -->

        <!-- Container start ----- -->
        <section class="container mx-auto">
            <form class="bg-white rounded-lg shadow-lg px-8 py-12 mt-28 flex flex-col gap-6 items-center max-w-lg mx-auto">
                <!-- Card start ----- -->
                <div>
                    <h3 class="h3"> 驗證電郵地址 </h3>
                </div>

                <div class="flex flex-col gap-4">
                    @if (isset($message))
                        {{ $message }}
                    @endif
                    @if (isset($error))
                        {{ $error }}
                    @endif
                    <br>
                    <div class="flex justify-center">
                        <a class="button secondary-btn" href="{{ route('admin.main') }}"> 按我回到系統 </a>
                    </div>
                </div>
            </form>
            <!-- Card ends ------ -->
        </section>
        <!-- Container ends ------ -->

        {{-- import script --}}
        <script src="{{ asset('javascript/login-record.js') }}"></script>

    </body>
@endsection
