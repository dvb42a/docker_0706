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
                    <span> 後臺管理介面 </span>
                </a>
            </div>
        </nav>
        <!-- Nav ends ------ -->


        <!-- Container start ----- -->
        <section class="container mx-auto">

            <!-- Crad start ----- -->
            <form class="bg-white rounded-lg shadow-lg px-8 py-12 mt-28 flex flex-col gap-6 items-center max-w-lg mx-auto"
                method="POST" action="{{ route('account.verifyEmailSubmit') }}">
                @csrf

                <div>
                    <h3 class="h3"> 驗證電郵地址 </h3>
                </div>

                {{-- Content --}}
                <div class="text-center">
                    @if (Session::has('message') or isset($message))

                        <p id="message">
                            驗證信件已送出，請檢查已輸入之電郵。
                        </p>

                    @else
                        <div class="field">
                            <label class="label"> 已綁定之電郵地址:{{ Auth::guard('admin')->user()->email }} </label>
                            <p class="help">
                                在開始使用Kings後臺管理介面前，必須先與電郵地址進行綁定。
                            </p>
                        </div>
                    @endif
                </div>
                <div class="flex gap-4">
                    <button class="button primary-btn w-52 flex justify-center" id="loaderBtn">
                        @if ($cooldown_at > time() )
                            <span id="buttonText"><span id="timer"><div class="loader-in-btn"></div></span></span>
                        @else
                            <span >點我送出驗證信件</span>
                        @endif
                    </button>

                    <a class="button secondary-btn" href="{{ route('admin.logout') }}">
                        <i class="fa-solid fa-right-from-bracket"></i>
                        登出
                    </a>
                </div>


            </form>
            <!-- Crad ends ------ -->
        </section>
        <!-- Container ends ------ -->
        <script>
            const last_send_date = '{{$cooldown_at}}';

            const submit = document.getElementById('submit');
            var message = document.getElementById('message');
            const buttonText = document.getElementById('buttonText');
            var timerdisplay = document.getElementById("timer");
            let loaderBtn = document.getElementById('loaderBtn');
            loaderBtn.addEventListener('click', () => {
                loaderBtn.disable = true;
                loaderBtn.classList.add('loader-btn');
                loaderBtn.innerText = '';
                loaderBtn.innerHTML = '<div class="loader-in-btn"></div>';
            })




            var now = new Date();
            var tableTime = '{{$cooldown_at}}';
            var tableDateTime = new Date(Date.parse(tableTime));

            // 計算現在時間和資料表時間之間的時間差（以毫秒為單位）
            var timeDifference = tableDateTime - now;

            if (!isNaN(timeDifference))
            {
                loaderBtn.disabled = true;
                start();
            }
            // 定義倒數計時的函數
            function start()
            {
                function countdown() {
                    // 計算剩餘時間
                    var remainingTime = new Date(timeDifference);

                    // 獲取剩餘時間的小時、分鐘和秒
                    var hours = remainingTime.getUTCHours();
                    var minutes = remainingTime.getUTCMinutes();
                    var seconds = remainingTime.getUTCSeconds();

                    // 將時間格式化為字串，例如 00:00:00
                    var formattedTime = ('0' + minutes).slice(-2) + '分' + ('0' + seconds).slice(-2)+'秒後可再次送出';

                    // 更新倒數計時的顯示
                    //console.log(formattedTime);
                    timerdisplay.innerText=formattedTime;

                    // 更新時間差
                    timeDifference -= 1000; // 每秒減去 1000 毫秒

                    // 如果時間差為負數，表示倒數計時結束，可以執行相應的操作
                    if (timeDifference <= 0) {
                        clearInterval(timer); // 停止計時器
                        loaderBtn.disabled = false;
                        buttonText.innerText = "";
                        buttonText.innerText = "點我送出驗證信件";
                    }

                }
                var timer = setInterval(countdown, 1000); // 每秒觸發一次 countdown 函數
                //console.log(timeDifference);
                // 初始化倒數計時
                //countdown();

                // 每秒更新倒數計時
            }
        </script>

    </body>
@endsection
