@extends('layouts.adminbeautyapp')
@section('content')
    @livewireStyles
    <script src="{{ asset('ckeditor5/build/ckeditor.js') }}"></script>
    <script src="//apps.bdimg.com/libs/jquery/1.10.2/jquery.min.js"></script>
    <script src="//apps.bdimg.com/libs/jqueryui/1.10.4/jquery-ui.min.js"></script>
    <link rel="stylesheet" href="//apps.bdimg.com/libs/jqueryui/1.10.4/css/jquery-ui.min.css">
    <script defer src="https://unpkg.com/@alpinejs/focus@3.x.x/dist/cdn.min.js"></script>

    <style>
        .ck-editor__editable_inline {
            /* 設定最低高度 */
            height: 100vh;
        }
    </style>

    <!-- Loader -->
    @include('loader')

    <!-- Container start ----- -->
    <section class="container p-6 main-content">

        <!-- form start ------ -->
        <form id="edit_content" method="POST" action="{{ route('content.update', $saved_content->bp_subsection_id) }}"
            enctype="multipart/form-data">
            @csrf
            @method('PATCH')
            <!-- page-head start ----- -->
            <div class="page-head flex justify-between items-center">
                <div>
                    <h2 class="h2"> 新增文章 </h2>
                </div>
                <!-- article statue -->
                <div>
                    <!-- <span class="tag large-tag">文章狀態：</span> -->
                    <!-- 未儲存 is-unsave, 草稿 is-draft, 排程發布 is-schedule, 已發布 is-published, 停用 is-suspended -->

                    @switch($saved_content->bp_subsection_state)
                        @case(0)
                            <span class="tag large-tag is-draft" id="ContentStateDisplay">草稿</span>
                        @break

                        @case(1)
                            <span class="tag large-tag is-schedule" id="ContentStateDisplay">排程發布</span>
                        @break

                        @case(2)
                            <span class="tag large-tag is-published" id="ContentStateDisplay">已發布</span>
                        @break

                        @case(3)
                            <span class="tag large-tag is-suspended" id="ContentStateDisplay">已停用</span>
                        @break
                    @endswitch
                </div>
            </div>
            <!-- page-head ends ------ -->
            <h5 class="h5 my-4">步驟二:建立文章內容及設定</h5>

            <!-- form section start ------ -->
            <section class="w-full flex flex-col md:flex-row gap-6">

                <!-- 資料錯誤要加提示紅框, 在<input> 標籤內加上class="input-warning" 提示文字加在 <div class="field"> 內 input 下面 <p class="help">長度限制 25中文字</p> -->

                <!-- left -->
                <div class="w-full flex flex-col gap-4">

                    <!-- 文章標題 -->
                    <div class="field">
                        <label class="label"> 文章標題 </label>
                        <input class="input" type="text" placeholder="請輸入文章標題" name="bp_subsection_title"
                            value="{{ $saved_content->bp_subsection_title }}">
                    </div>

                    <!-- 文章引言 -->
                    <div class="field">
                        <label class="label"> 文章引言 </label>
                        <textarea class="textarea" placeholder="請輸入文章引言" name="bp_subsection_intro">{{ $saved_content->bp_subsection_intro }}{{ old('bp_subsection_intro') }}</textarea>
                    </div>

                    {{-- TODO JS 失效 --}}
                    <!-- 關鍵字 -->
                    <div class="field gap-2">

                        <div class="flex gap-2 items-center">
                            <label class="label">關鍵字 </label>
                            <a class="text-sm" href="{{ route('keyword.index') }}" target="_blank"> 沒有所需關鍵字嗎?</a>
                        </div>

                        <div class="flex gap-2">
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
                                <button class="button primary-btn bg-primary" id="addBtn" type="button">加入</button>
                                <button class="button danger-btn bg-danger" type="button" id="delBtn">全部清空</button>
                            </div>
                        </div>

                        {{-- tag container --}}
                        <div class="h-40 textarea space-x-2 space-y-1" id="tagContainer">

                            {{-- <span class="tag is-keyword">
                                關鍵字
                                <button type="button" class="tag-btn">
                                    <i class="fa-solid fa-xmark"></i>
                                </button>
                            </span> --}}

                        </div>
                    </div>

                    <!-- 文章定位 -->
                    <div class="field">
                        <label class="label"> 文章定位:</label>
                        <div class="flex gap-4 w-full ml-1">
                            <div class="flex gap-1 items-center" title="勾選後於美容鏡檢測結果為等級1時優先顯示此文章">
                                <input type="checkbox" name="bp_type_keep" value="1" id="type_keep">
                                <label for="type_keep">保養知識類型</label>
                            </div>
                            <div class="flex gap-1 items-center" title="勾選後於美容鏡檢測結果為等級2時優先顯示此文章">
                                <input type="checkbox" name="bp_type_fix" value="1" id="type_fix">
                                <label for="type_fix">改善狀態類型</label>
                            </div>
                            <div class="flex gap-1 items-center" title="勾選後於美容鏡檢測結果為等級3時優先顯示此文章">
                                <input type="checkbox" name="bp_type_info" value="1" id="type_info">
                                <label for="type_info">資訊分享類型</label>
                            </div>
                        </div>
                    </div>

                    {{-- 其他設定 --}}
                    <div class="field">
                        <label class="label"> 其他設定 </label>
                        <div class="flex gap-4 ml-1">
                            <div class="flex gap-1 items-center">

                                <input type="checkbox" name="bp_subsection_member_only" value="1" checked="checked"
                                    {{ $saved_content->bp_subsection_member_only == '1' ? 'checked' : '' }}>
                                <label for="">
                                    會員限定
                                </label>
                            </div>
                            <div class="flex gap-1 items-center">
                                <input type="checkbox" name="bp_display_rating" value="1"
                                    {{ $saved_content->bp_display_rating == '1' ? 'checked' : '' }}>
                                <label for="">
                                    優先顯示
                                </label>
                            </div>

                        </div>
                    </div>
                    <br>

                </div>

                {{-- right --}}
                <div class="w-full flex flex-col gap-4">

                    <!-- 指定日期 -->
                    @if ($saved_content->bp_subsection_state != 2 and $saved_content->bp_subsection_state != 3)

                        <div class="flex gap-2 flex-col">
                            <div class="flex gap-2">
                                <label class="label"> 指定日期 </label>
                                <p class="help">未指定日期即以當前時間發布</p>
                            </div>

                            <div class="flex flex-row gap-2 items-center">

                                <div class="checkbox-container">
                                    <div class="flex h-6 items-center">
                                        <input type="checkbox" id="specialDate" name="checked_date"
                                            {{ old('checked_date') != null ? 'checked' : '' }}
                                            {{ $saved_content->bp_subsection_enabled_date != null ? 'checked' : '' }}>
                                    </div>
                                    <div class="ml-1">
                                        <label for="specialDate" class="label whitespace-nowrap">
                                            排程發布
                                        </label>
                                    </div>

                                </div>
                                <input class="input" type="datetime-local" name="post_date"
                                    @if ($saved_content->bp_subsection_enabled_date != null) value="{{ $saved_content->bp_subsection_enabled_date }}" @endif
                                    id="datePicker" step="1">
                            </div>

                        </div>
                    @else
                        <!-- 顯示設定 -->
                        <!-- 僅文章已發表後才出現 -->
                        <div class="field">
                            <label class="label"> 顯示設定 </label>
                            <div class="relative">
                                <span class="input-icon right-0 pr-3">
                                    <i class="fa-solid fa-caret-down"></i>
                                </span>
                                <select class="input select" id="statusSelect" name="bp_subsection_state">
                                    <option value="2"
                                        {{ $saved_content->bp_subsection_state == '2' ? 'selected' : '' }}>已發布
                                    </option>
                                    <option value="3"
                                        {{ $saved_content->bp_subsection_state == '3' ? 'selected' : '' }}>停用
                                    </option>
                                </select>
                            </div>
                            <p class="help">選擇停用可讓前端不要顯示文章</p>
                        </div>

                    @endif

                    <!-- 文章首圖 -->
                    <div class="flex flex-col gap-2">
                        <label class="label"> 文章首圖(比例問題)</label>
                        <div id="preview">
                            <img id="demo" alt=""
                                @if ($first_image != null) src="@if ($first_image->km_state == 1) {{ asset('media/content_banner_image/' . $first_image->km_name) }} @else{{ asset('media/hidden/' . $first_image->km_name) }} @endif"
                                @endif>
                        </div>

                        <!-- 上傳檔案 -->

                        <div class="flex gap-2 justify-between">
                            <input class="upload-input" type="file" name="file" id="file" />
                            @if($saved_content->bp_subsection_state !=2 )
                                <button class="button danger-btn bg-danger" type="button" id="removeimage">
                                    刪除圖片
                                </button>
                            @endif
                        </div>


                        <!-- 圖片上傳限制條件 -->
                        <ul class="flex flex-col gap-1 mb-12">
                            <li class="img-type">
                                <span class="check-icon" id="icon_type_true" hidden>
                                    <i class="fa-solid fa-check"></i>
                                </span>
                                <span class="check-icon" id="icon_type_false" hidden>
                                    <i class="fa-solid fa-xmark"></i>
                                </span>
                                格式限制：<span>jpg, jepg, png, svg </span>
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

                        </ul>

                    </div>

                </div>

            </section>
            <!-- form section ends ------ -->

            <!-- Edit content start ------->
            <section class="flex gap-6">

                <!-- ck editer container -->
                <div class="w-full flex flex-col gap-2">
                    <textarea id="editor" name="bp_subsection_cnt" placeholder="請在這裡填寫內容">
                        {{ old('bp_subsection_cnt') }} {{ $saved_content->Content_index->bp_subsectioncnt_index }}
                    </textarea>
                    <span class="text-sm text-gray-400 tracking-wider">
                        @if (isset($saved_content->updated_at))
                            最後儲存時間為:
                            <span class="ml-1">
                                {{ $saved_content->updated_at }}
                            </span>
                        @endif
                    </span>
                </div>

                <!-- media center sidebar start ----- -->
                @livewire('mediatable')
                @livewireScripts
                <!-- media center sidebar ends ------ -->

            </section>
            <!-- Edit content ends -------->

            <!-- edit-footer -->
            <div class="flex gap-4 justify-center mt-8">
                <input type="hidden" name="submit_type" id="submit_type">
                <button class="button secondary-btn" type="button" id="previewBtn"> 預覽文章 </button>
                @if ($saved_content->bp_subsection_state == 0)
                    <button class="button primary-btn bg-primary" type="button" id="driftBtn"> 儲存草稿 </button>
                @endif
                <button class="button primary-btn bg-primary" type="button" id="saveBtn">
                    @if ($saved_content->bp_subsection_state == 0)發布
                    @else
                        更新@endif
                </button>
                <button class="button danger-outlined-btn" type="button" id="refresh"> 取消操作 </button>
            </div>

        </form>
        <!-- Form ends ------ -->

    </section>
    <!-- Container ends ------ -->


    <!-- import script -->
    <script src="{{ asset('javascript/add-article.js') }}"></script>
    <script src="{{ asset('javascript/keyword-tag.js') }}"></script>
    <script src="{{ asset('javascript/refreshBtn.js') }}"></script>
    <script src='{{ asset('javascript/banner_upload.js') }}' type='text/javascript'></script>
    {{-- <script src="{{ asset('javascript/prevent-refresh.js') }}" ></script> --}}

    <script>
        ClassicEditor
            .create(document.querySelector('#editor'), {})
            .then(editor => {
                window.editor = editor;
            })
            .catch(err => {
                console.error(err.stack);
            });
    </script>
    <script>
        // 暫時用假裝的 URL 代替, 之後應該用 nowUrl
        // let url = 'http://127.0.0.1/root/beauty/content/76/edit';

        // 網址處理過程
        var nowUrl = window.location.href;
        let setUrl = nowUrl.substring(nowUrl.lastIndexOf('/'), -1);
        let id = setUrl.substring(setUrl.lastIndexOf('/') + 1);
        //console.log('nowUrl:', nowUrl, 'id:', id);

        // API 位置
        let urlApi = link + `/api/contentHashtag/${id}`;
        //console.log(urlApi);


        // 原先關鍵字紀錄 API
        //const objectDataUrl = 'https://raw.githubusercontent.com/dvb42a/API_RAWkinglyproject/main/contentWithTag.json';

        // on Load
        // 這個 ObjectDataUrl 之後要替換
        databaseApi(urlApi); // 獲取 關鍵字資料庫
    </script>
    <script>
        function preview() {
            window.open("{{ route('content.preview', $saved_content->bp_subsection_id) }}", '_blank');
        }
    </script>
    <script>
        var content_state = {!! $saved_content->bp_subsection_state !!};
        contentState(content_state);
    </script>

    @include('Sucess')
@endsection
