@extends('layouts.adminpageapp')

@section('content')

    <!-- Breadcrumb start ----- -->
    @include('breadcrumbs')
    <!-- Breadcrumb ends ------ -->

    <!-- Container start ----- -->
    <section class="container">

        <!-- form start ------ -->
        <form method="POST" action="{{ route('admins.store') }}" enctype="multipart/form-data">
            @csrf
            <!-- page-head start ----- -->
            <div class="page-head">
                <div class="title">
                    <p class="title is-3">新增管理員</p>
                </div>
                <div class="buttons">
                    <button class="button is-primary"> 儲存 </button>
                    <button class="button" id="cancel" type="button">取消操作</button>
                </div>
            </div>
            <!-- page-head ends ------ -->

            <!-- form section start ------ -->
            <section class="form-content">
                <!--
                            資料錯誤要加提示紅框, 在 <input> 標籤內加上 class="is-danger"
                            提示文字加在 <div class="field"> 內 input 下面
                            <p class="help">長度限制 25 中文字</p>
                        -->
                <div class="input-row">
                    <!-- 類別名稱 -->
                    <div class="field cat-name">
                        <label class="label">管理者名稱*</label>
                        <div class="control">
                            <input class="input" type="text" placeholder="輸入管理者名稱" maxlength="10" required
                                name="name" id="name" value="{{ old('name') }}">
                        </div>
                        <p class="help">長度限制 10 中文字</p>
                    </div>
                    <!-- 檔案類型 -->
                    <div class="field">
                        <label class="label">帳號*</label>
                        <div class="control">
                            <input class="input" type="text" placeholder="輸入管理者帳號" maxlength="25" required
                                name="account" id="account" value="{{ old('account') }}">
                        </div>
                        <p class="help">長度限制 15 英文/數字</p>
                    </div>
                </div>
                <div class="input-row">
                    <!-- 使用位置 -->
                    <div class="field media-location">
                        <label class="label">密碼*
                            <div class="control">
                                <input class="input" type="text" placeholder="輸入密碼" maxlength="20" required
                                    name="password" id="password" value="61261370"readonly=readonly>
                            </div>
                    </div>
                    <!-- 路徑資料夾名稱 -->
                    <div class="field">
                        <label class="label">電郵</label>
                        <div class="control">
                            <input class="input" type="text" placeholder="輸入電郵" name="email"
                                value="{{ old('email') }}">
                        </div>
                    </div>
                </div>
                <hr>
                <div class="input-row">
                    <!-- 帳號等級 -->
                    <div class="field size-limit">
                        <label class="label">帳號等級</label>
                        <div class="input-duo">
                            <div class="select">
                                <select name="role" id="role_selecter">
                                    <option value="">選擇帳號等級</option>
                                    <option value="admin_a" {{ old('role') == 'admin_a' ? 'selected' : '' }}>後台全域管理員
                                    </option>
                                    <option value="admin_b" {{ old('role') == 'admin_b' ? 'selected' : '' }}>單獨平台主管</option>
                                    <option value="admin_c" {{ old('role') == 'admin_c' ? 'selected' : '' }}>一般後台管理員
                                    </option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <!-- 管理之平台 -->
                    <div class="field space-limit">
                        <label class="label">管理之平台</label>
                        <div class="select">
                            <select name="platform" id="platform_selecter">
                                <option value="">請選擇平台</option>
                                <option value="admin_b_beauty" {{ old('platform') == 'beauty' ? 'selected' : '' }}>美容百科
                                </option>
                                <option value="admin_b_mirror" {{ old('platform') == 'mirror' ? 'selected' : '' }}>美容鏡
                                </option>
                            </select>
                        </div>
                    </div>
                    <!-- 職位 -->
                    <div class="field space-limit">
                        <label class="label">職位</label>
                        <div class="select">
                            <select name="lvc" id="lvc_selecter">
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

    <!-- home-section ends----------------- -->


    <!-- import javascript -->
@endsection
