@extends('layouts.adminbeautyapp')

@section('content')
    <script src="//apps.bdimg.com/libs/jquery/1.10.2/jquery.min.js"></script>
    <script src="//apps.bdimg.com/libs/jqueryui/1.10.4/jquery-ui.min.js"></script>
    <link rel="stylesheet" href="//apps.bdimg.com/libs/jqueryui/1.10.4/css/jquery-ui.min.css">

    <!-- Container start ----- -->
    <section class="container p-6">
        <!-- form start ------ -->
        <form method="POST" action="{{ route('media.store') }}" id="form" enctype="multipart/form-data">
            @csrf

            <!-- page-head start ----- -->
            <div class="page-head justify-between">
                <div>
                    <h2 class="h2">新增媒體</h2>
                </div>
                <div class="flex gap-2">
                    <button class="button primary-btn bg-primary" id="saveBtn" type="button"> 新增 </button>
                    <a href="{{ route('media.show', $id) }}" class="button secondary-btn"> 取消 </a>
                </div>
            </div>
            <input type="hidden" id="file_id" name="file_id" value="{{ $setting->kmc_id }}">
            <!-- page-head ends ------ -->


            <!-- form-content section start ------ -->
            <section class="form-content">
                <!--
                            資料錯誤要加提示紅框, 在 <input> 標籤內加上 class="is-danger"
                            提示文字加在 <div class="field"> 內 input 下面
                            <p class="help">長度限制 25 中文字</p>
                        -->
                <div class="flex gap-4">

                    <!-- left -->
                    <div class="flex-1 min-w-[400px]">
                        <img class="object-cover" id="demo">
                    </div>

                    <!-- right -->
                    <div class="flex-1 flex flex-col gap-4">

                        <!-- 媒體名稱 -->
                        <div class="field">
                            <label class="label">媒體名稱 </label>
                            <input class="input" type="text" placeholder="輸入媒體名稱" name="km_cname"
                                value="{{ old('km_cname') }}" required>
                            <p class="help">名字長度限制為 25 個半形文字並於送出後無法更改</p>
                        </div>


                        <!-- 上傳檔案 -->
                        <div class="file has-name is-fullwidth">
                            <input class="upload-input" type="file" name="file" id="file" />
                        </div>

                        <!-- 圖片上傳限制條件 -->
                            <ul class="flex flex-col">
                                <!--
                                        符合條件: <li> 加上 class="is-checked" , 文字前加上
                                        <span class="check-icon">
                                            <i class="fa-solid fa-check"></i>
                                        </span>

                                    不符合條件: <li> 加上 class="is-failed",  文字前加上
                                        <span class="check-icon">
                                            <i class="fa-solid fa-xmark"></i>
                                        </span>
                                    -->
                                <li class="img-type">
                                    <span class="check-icon" id="icon_type_true" hidden>
                                        <i class="fa-solid fa-check"></i>
                                    </span>
                                    <span class="check-icon" id="icon_type_false" hidden>
                                        <i class="fa-solid fa-xmark"></i>
                                    </span>
                                    格式限制：<span>jpg, png, png, gif</span>
                                </li>
                                <li class="img-size">
                                    <span class="check-icon" id="icon_size_true" hidden>
                                        <i class="fa-solid fa-check"></i>
                                    </span>
                                    <span class="check-icon" id="icon_size_false" hidden>
                                        <i class="fa-solid fa-xmark"></i>
                                    </span>
                                    圖片尺寸：
                                    @if ($setting->kmc_width == null && $setting->kmc_height == null)
                                        <span id="file_limited_width">無限制</span>
                                    @else
                                        <span id="file_limited_width">{{ $setting->kmc_width }}</span> x <span
                                            id="file_limited_height">{{ $setting->kmc_height }}</span>px
                                    @endif
                                </li>
                                <li class="img-filesize">
                                    <span class="check-icon" id="icon_file_true" hidden>
                                        <i class="fa-solid fa-check"></i>
                                    </span>
                                    <span class="check-icon" id="icon_file_false" hidden>
                                        <i class="fa-solid fa-xmark"></i>
                                    </span>
                                    檔案大小限制：<span id="file_limited_file">{{ $setting->kmc_file_limited }}</span>MB
                                </li>
                            </ul>

                    </div>

                </div>

                <div class="flex my-4 gap-4">
                    <!-- 媒體描述 -->
                    <div class="field flex-1">
                        <label class="label">媒體描述</label>
                        <div class="control">
                            <textarea class="textarea h-[232px]" placeholder="輸入文字" name="km_cnt" value="{{ old('km_cnt') }}"></textarea>
                        </div>
                    </div>

                    <!-- 關鍵字 -->
                    <div class="flex-1 flex flex-col gap-2">
                        <div class="keyword-head">
                            <label class="label">關鍵字</label>
                        </div>

                        <div class="flex gap-2">
                            <!-- Input -->
                            <div class="field" id="tag">
                                <input class="input" type="text" id="addInput" placeholder="輸入關鍵字">
                                <p class="help is-danger hide" id="repeatInfo">
                                    重複建立關鍵字
                                </p>
                                <p class="help is-danger hide" id="emptyInfo">
                                    不可以空白
                                </p>
                                <p class="help is-danger hide" id="noDataInfo">
                                    資料庫無此關鍵字
                                </p>
                            </div>

                            <div class="flex gap-2 h-9">
                                <button class="button primary-btn" type="button" id="addBtn">加入</button>
                                <button class="button danger-btn bg-danger" type="button" id="delBtn">全部清空</button>
                            </div>
                        </div>

                        <div class="h-40 textarea space-x-2 space-y-1" id="tagContainer">
                            <!-- <span class="tag is-rounded is-info">
                                    關鍵字
                                    <button class="delete is-small"></button>
                                </span> -->
                        </div>

                        <!-- Data select -->
                        <div class="box hide">
                            <h3 class="title is-3"> Data Test </h3>
                            <div class="data-select">
                                <select name="" id="dataSelect" multiple>
                                    <!-- <option value="0" default>Default</option> -->
                                </select>
                            </div>
                        </div>

                    </div>

                </div>

            </section>
            <!-- form-content section ends ------ -->

        </form>
        <!-- form ends ------ -->

    </section>
    <!-- Container ends ------ -->

    <script src="{{ asset('javascript/keyword_mediaEdit.js') }}"></script>
    <script src='{{ asset('javascript/media_upload.js') }}' type='text/javascript'></script>
    <script src='{{ asset('javascript/media_keyword.js') }}' type='text/javascript'></script>

    @include('Sucess')
@endsection
