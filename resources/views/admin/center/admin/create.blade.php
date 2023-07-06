@extends('layouts.admincenterapp')

@section('content')

    <!-- Container start ----- -->
    <section class="container p-6">

        <!-- form start ------ -->
        <form method="POST" action="{{ route('admins.store') }}" enctype="multipart/form-data">
            @csrf
            <!-- page-head start ----- -->
            <div class="page-head flex justify-between">
                <div>
                    <h2 class="h2">新增管理員</h2>
                </div>
                <div class="flex gap-2">
                    <button class="button primary-btn"> 儲存 </button>
                    <button class="button secondary-btn" id="cancel" type="button">取消操作</button>
                </div>
            </div>
            <!-- page-head ends ------ -->

            <!-- form section start ------ -->
            <section class="flex flex-col gap-6">

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                    <!-- 管理者名稱 -->
                    <div class="field">
                        <label class="label">
                            管理者名稱
                            <span class="text-xs">*必填</span>
                        </label>
                        <input class="input" type="text" placeholder="輸入管理者名稱" maxlength="10" required name="name"
                            id="name" value="{{ old('name') }}">
                        <p class="help">長度限制 10 中文字</p>
                    </div>

                    <!-- 電子郵件 email-->
                    <div class="field">
                        <label class="label">E-mail</label>
                        <input class="input" type="text" placeholder="輸入電郵" name="email" value="{{ old('email') }}">
                        <p class="help">綁定 e-mail 後可透過 e-mail 認證重設新密碼</p>
                    </div>

                    <!-- 帳號 -->
                    <div class="field">
                        <label class="label">
                            帳號
                            <span class="text-xs">*必填</span>
                        </label>
                        <input class="input" type="text" placeholder="輸入管理者帳號" maxlength="25" required name="account"
                            id="account" value="{{ old('account') }}">
                        <p class="help">長度限制 15 英文/數字</p>
                    </div>

                    <!-- 密碼 -->
                    <div class="field">
                        <label class="label">
                            密碼
                            <span class="text-xs">*必填</span>
                        </label>
                        <input class="input" type="text" placeholder="輸入密碼" maxlength="20" required name="password"
                            id="password" value="61261370"readonly=readonly>
                    </div>

                </div>

                <hr>

                {{-- 帳號等級及權限設定 --}}
                <div class="grid gap-4 grid-cols-1 md:grid-cols-3">

                    <!-- 帳號等級 -->
                    <div class="field ">
                        <label class="label">帳號等級</label>
                        <div class="relative">
                            <span class="input-icon right-0 pr-3">
                                <i class="fa-solid fa-caret-down"></i>
                            </span>
                            <select class="input select" name="role" id="role_selecter">
                                <option value="">選擇帳號等級</option>
                                <option value="admin_a" {{ old('role') == 'admin_a' ? 'selected' : '' }}>後台全域管理員
                                </option>
                                <option value="admin_b" {{ old('role') == 'admin_b' ? 'selected' : '' }}>單獨平台主管</option>
                                <option value="admin_c" {{ old('role') == 'admin_c' ? 'selected' : '' }}>一般後台管理員
                                </option>
                            </select>
                        </div>
                    </div>

                    <!-- 管理之平台 -->
                    <div class="field ">
                        <label class="label">管理之平台</label>
                        <div class="relative">
                            <span class="input-icon right-0 pr-3">
                                <i class="fa-solid fa-caret-down"></i>
                            </span>
                            <select class="input select" name="platform" id="platform_selecter">
                                <option value="">請選擇平台</option>
                                <option value="admin_b_beauty" {{ old('platform') == 'beauty' ? 'selected' : '' }}>美容百科
                                </option>
                                <option value="admin_b_mirror" {{ old('platform') == 'mirror' ? 'selected' : '' }}>美容鏡
                                </option>
                            </select>
                        </div>
                    </div>

                    <!-- 職位 -->
                    <div class="field">
                        <label class="label">職位</label>
                        <div class="relative">
                            <span class="input-icon right-0 pr-3">
                                <i class="fa-solid fa-caret-down"></i>
                            </span>
                            <select class="input select" name="lvc" id="lvc_selecter">
                                <option value="">選擇帳號職位</option>
                            </select>
                        </div>
                    </div>

                </div>

            </section>
            <!-- form section ends ------ -->

        </form>
        <!-- form ends ------ -->
    </section>
    <!-- Container ends ------ -->



    <script>
        //random code
        /*     const random=document.getElementById('random');
            random.addEventListener('click',function(){
                password();
            })

            function password()
            {
                var chars = "0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ";
                var passwordLength = 5;
                var password = "";
                for (var i = 0; i <= passwordLength; i++) {
                var randomNumber = Math.floor(Math.random() * chars.length);
                password += chars.substring(randomNumber, randomNumber +1);
                }
                document.getElementById('password').value = password;
            } */

        //value
        var beauty_roles = {!! json_encode($beauty_roles) !!};
        var mirror_roles = {!! json_encode($mirror_roles) !!};
        //selecter
        const role_selecter = document.getElementById('role_selecter');
        const platform_selecter = document.getElementById('platform_selecter');
        const lvc_selecter = document.getElementById('lvc_selecter');

        platform_selecter.disabled = true;
        lvc_selecter.disabled = true;

        if (role_selecter.value == "admin_b") {
            platform_selecter.disabled = false;
        }

        if (role_selecter.value == "admin_c") {
            platform_selecter.disabled = false;
            lvc_selecter.disabled = false;
            switch (platform_selecter.value) {
                case ('admin_b_beauty'):
                    lvc_beauty();
                    break;
                case ('admin_b_mirror'):
                    lvc_mirror();
                    break;
            }

        }


        role_selecter.addEventListener('change', function() {
            if (role_selecter.value == "admin_b" || role_selecter.value == "admin_c") {
                platform_selecter.disabled = false;
            } else {
                platform_selecter.disabled = true;
                platform_selecter.selectedIndex = 0;
                lvc_selecter.selectedIndex = 0;
            }

            if (role_selecter.value == "admin_c") {
                lvc_selecter.disabled = false;
            } else {
                lvc_selecter.disabled = true;
            }
        });

        platform_selecter.addEventListener('change', function() {
            lvc_selecter.length = 1;
            switch (platform_selecter.value) {
                case ('admin_b_beauty'):
                    lvc_beauty();
                    break;
                case ('admin_b_mirror'):
                    lvc_mirror();
                    break;
            }
        });

        function lvc_beauty() {
            for (var i = 0; i < beauty_roles.length; i++) {
                option = document.createElement('option');
                option.value = beauty_roles[i].name;
                option.text = beauty_roles[i].c_name;
                lvc_selecter.add(option);
            };
        }

        function lvc_mirror() {
            for (var i = 0; i < mirror_roles.length; i++) {
                option = document.createElement('option');
                option.value = mirror_roles[i].name;
                option.text = mirror_roles[i].c_name;
                lvc_selecter.add(option);
            };
        }
    </script>

    <!-- home-section ends----------------- -->
    @include('Sucess')

    <!-- import javascript -->
@endsection
