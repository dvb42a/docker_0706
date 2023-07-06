@extends('layouts.adminbeautyapp')

@section('content')
    <script src="//apps.bdimg.com/libs/jquery/1.10.2/jquery.min.js"></script>
    <script src="//apps.bdimg.com/libs/jqueryui/1.10.4/jquery-ui.min.js"></script>
    <link rel="stylesheet" href="//apps.bdimg.com/libs/jqueryui/1.10.4/css/jquery-ui.min.css">


    @include('loader')

    <!-- Container start ----- -->
    <section class="container p-6 main-content">
        <!-- form start ------ -->
        <form method="POST" action="{{ route('media.update', $media->km_id) }}" id="form" enctype="multipart/form-data">
            @csrf
            @method('PATCH')
            <!-- page-head start ----- -->
            <div class="page-head justify-between">
                <div>
                    <h2 class="h2">媒體資訊</h2>
                </div>
                <div class="flex gap-2">
                    <button class="button primary-btn bg-primary" type="button" id="saveBtn"> 更新 </button>

                    <button class="button secondary-btn" onclick="location.href='{{ route('media.edit', $media->km_id) }}'"
                        type="button">
                        取消
                    </button>
                </div>
            </div>
            <!-- page-head ends ------ -->
            <!-- form-content section start ------ -->
            <section class="form-content">

                <div class="flex gap-6">

                    <!-- left -->
                    <div class="flex-1 min-w-[400px]">
                        <img id="demo" class="objecy-contain"
                            src="@if ($media->km_state == 1) {{ asset('media/' . $setting->kmc_position . '/' . $media->km_name) }} @else{{ asset('media/hidden/' . $media->km_name) }} @endif">
                    </div>

                    <!-- right -->
                    <div class="flex flex-col gap-5 flex-1">

                        <!-- 媒體名稱 -->
                        <div class="field">
                            <label class="label">媒體名稱</label>
                            <input class="input disabled" type="text" placeholder="媒體名稱名稱名稱" name="km_cname"
                                value="{{ $media->km_cname }}" readonly="readonly">
                        </div>

                        <!-- 媒體狀態 -->
                        <div class="field">
                            <label class="label">媒體狀態</label>
                            <div class="relative">
                                <span class="input-icon right-0 pr-3">
                                    <i class="fa-solid fa-caret-down"></i>
                                </span>
                                <select class="select input" name="km_state" id="km_state">
                                    <option value="1" {{ $media->km_state == 1 ? 'selected' : '' }}>正常</option>
                                    <option value="2" {{ $media->km_state == 2 ? 'selected' : '' }}>停用</option>
                                </select>

                            </div>

                            <p class="help">若媒體已被使用到文章內，切換停用會使文章內的媒體失效，請謹慎使用</p>

                        </div>

                        <!-- 上傳檔案 -->
                        <div class="file has-name is-fullwidth">
                            <input class="upload-input" type="file" name="file" id="file" />
                        </div>
                        <!-- 圖片上傳限制條件 -->
                        <div>
                            <ul class="flex flex-col gap-1">
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

                </div>

                <div class="flex gap-4 justify-between my-4">

                    <!-- 檔案大小 -->
                    <div class="field flex-1">
                        <label class="label disabled ">檔案大小</label>
                        <input class="input disabled" type="text" placeholder="Text input"
                            value="{{ number_format($media->km_size / 1024 / 1024, 2) }} MB" readonly>
                    </div>

                    <!-- 尺寸 -->
                    <div class="field flex-1">
                        <label class="label disabled">尺寸</label>
                        <input class="input disabled" type="text" placeholder="Text input"
                            value="{{ $media->km_mediawidth }}x{{ $media->km_mediaheight }}px"readonly>
                    </div>

                    <!-- 時間長度 -->
                    <div class="field flex-1">
                        <label class="label disabled">時間長度</label>
                        --
                    </div>

                    <!-- 上傳時間 -->
                    <div class="field flex-1">
                        <label class="label disabled">上傳時間</label>
                        <input class="input disabled" type="datetime" placeholder="Text input"
                            value="{{ $media->created_at }}"readonly>
                    </div>

                </div>

                <div class="flex gap-2">
                    <!-- 媒體描述 -->
                    <div class="field media-describe flex-1">
                        <label class="label">媒體描述</label>
                        <textarea class="textarea h-[220px]" placeholder="輸入文字" required name="km_cnt">{{ $media->km_cnt }}</textarea>
                    </div>

                    <!-- 關鍵字 -->
                    <div class="field flex-1">
                        <label class="label">關鍵字</label>

                        <div class="flex gap-2 mb-1">
                            <!-- Input -->
                            <div class="field">
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
                                <button class="button primary-btn bg-primary" type="button" id="addBtn">加入</button>
                                <button class="button danger-btn bg-danger" type="button" id="delBtn">全部清空</button>
                            </div>
                        </div>

                        {{-- 關鍵字欄位 --}}
                        <div class="h-40 textarea space-x-2 space-y-1" id="tagContainer">
                            {{-- <span class="tag is-keyword">
                                關鍵字
                                <button type="button" class="tag-btn hover:bg-purple-600/20">
                                    <i class="fa-solid fa-xmark"></i>
                                </button>
                            </span> --}}
                        </div>

                        <!-- Data select -->
                        <div class="box hide">
                            <h3 class="h3"> Data Test </h3>
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

    <script>
        // 暫時用假裝的 URL 代替, 之後應該用 nowUrl
        // let url = 'http://127.0.0.1/root/beauty/content/76/edit';

        // 網址處理過程
        var nowUrl = window.location.href;
        let setUrl = nowUrl.substring(nowUrl.lastIndexOf('/'), -1);
        let id = setUrl.substring(setUrl.lastIndexOf('/') + 1);
        //console.log('nowUrl:', nowUrl, 'id:', id);

        // API 位置

        let urlApi = link + `/api/media/${id}`;
        //console.log(urlApi);


        // 原先關鍵字紀錄 API
        //const objectDataUrl = 'https://raw.githubusercontent.com/dvb42a/API_RAWkinglyproject/main/contentWithTag.json';

        // on Load
        // 這個 ObjectDataUrl 之後要替換
        databaseApi(urlApi); // 獲取 關鍵字資料庫
    </script>
    @include('Sucess')
@endsection
