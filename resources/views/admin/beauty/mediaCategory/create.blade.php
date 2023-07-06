@extends('layouts.adminbeautyapp')

@section('content')
    <!-- Container start ----- -->
    <section class="container p-6">

        <!-- form start ------ -->
        <form method="POST" action="{{ route('mediaCategory.store') }}" enctype="multipart/form-data">
            @csrf
            <!-- page-head start ----- -->
            <div class="page-head justify-between">
                <div>
                    <h2 class="h2">新增類別</h2>
                </div>
                <div class="flex gap-2">
                    <button class="button primary-btn"> 儲存 </button>
                    <button class="button secondary-btn" id="cancel" type="button">取消操作</button>
                </div>
            </div>
            <!-- page-head ends ------ -->

            <!-- form section start ------ -->
            <section class="flex flex-col gap-6">

                <div class="flex flex-col lg:flex-row gap-4">

                    <!-- 類別名稱 -->
                    <div class="field w-full">
                        <label class="label">類別名稱</label>
                        <input class="input" type="text" placeholder="輸入類別名稱" maxlength="25" required name="kmc_name"
                            id="kmc_name" value="{{ old('kmc_name') }}">
                        <p class="help">長度限制 25 中文字</p>
                    </div>

                    <!-- 檔案類型 -->
                    <div class="field w-60">
                        <label class="label">檔案類型</label>
                        <div class="relative">
                            <span class="input-icon right-0 pr-3">
                                <i class="fa-solid fa-caret-down"></i>
                            </span>
                            <select class="input select" name="type">
                                <option value="photo" {{ old('type') == 'photo' ? 'selected' : '' }}>圖片</option>
                                <option value="video" {{ old('type') == 'video' ? 'selected' : '' }}>影片</option>
                            </select>
                        </div>
                    </div>

                </div>

                <div class="flex flex-col lg:flex-row gap-4">

                    <!-- 使用位置 -->
                    <div class="field w-full">
                        <label class="label">使用位置</label>
                        <div class="relative">
                            <span class="input-icon right-0 pr-3">
                                <i class="fa-solid fa-caret-down"></i>
                            </span>
                            <select class="input select" required name="situation">
                                <option value="" default>選擇媒體使用位置</option>
                                <option value="1" {{ old('situation') == '1' ? 'selected' : '' }}>主題內容</option>
                                <option value="2" {{ old('situation') == '2' ? 'selected' : '' }}>專欄課程</option>
                                <option value="3" {{ old('situation') == '3' ? 'selected' : '' }}>講師</option>
                                <option value="4" {{ old('situation') == '4' ? 'selected' : '' }}>Banner</option>
                                <option value="5" {{ old('situation') == '5' ? 'selected' : '' }}>廣告</option>
                                <option value="6" {{ old('situation') == '6' ? 'selected' : '' }} disabled>自訂</option>
                            </select>
                        </div>
                    </div>

                    <!-- 路徑資料夾名稱 -->
                    <div class="field w-full">
                        <label class="label">路徑資料夾名稱</label>
                        <input class="input" type="text" placeholder="輸入路徑資料夾名稱" required name="position"
                            value="{{ old('position') }}" maxlength="25">
                        <p class="help">長度限制 25 英文字</p>
                    </div>

                </div>

                <div class="flex flex-col lg:flex-row gap-4">

                    <!-- 尺寸限制 -->
                    <div class="field">
                        <label class="label">尺寸限制</label>
                        <div class="flex items-center gap-2 w-full">
                            <div class="relative">
                                <input class="input input-leftIcon" type="text" name="img_width"
                                    value="{{ old('img_width') }}">
                                <span class="input-icon left-0 pl-3">
                                    寬
                                </span>
                                <span class="input-icon right-0 pr-3">
                                    px
                                </span>
                            </div>
                            <span class="icon">
                                <i class="fa-solid fa-x"></i>
                            </span>
                            <div class="relative">
                                <input class="input input-leftIcon" type="text" name="img_height"
                                    value="{{ old('img_height') }}">
                                <span class="input-icon left-0 pl-3">
                                    高
                                </span>
                                <span class="input-icon right-0 pr-3">
                                    px
                                </span>
                            </div>
                        </div>
                        <p class="help">建議尺寸依照版面需要即可</p>
                    </div>

                    <!-- 檔案大小限制 -->
                    <div class="field">
                        <label class="label">檔案大小限制</label>
                        <div class="relative rounded-md shadow-sm">
                            <input class="input" type="text" placeholder="輸入媒體檔案大小限制" name="filelimited"
                                value="{{ old('filelimited') }}">
                            <span class="input-icon right-0 pr-3">
                                MB
                            </span>
                        </div>
                        <p class="help">建議檔案大小不要超過 3 MB</p>
                    </div>

                    <!-- 縮圖限制 -->
                    <div class="field w-80">
                        <label class="label">縮圖設定</label>

                        <div class="flex gap-4 items-center">
                            {{-- Check input --}}
                            <div class="checkbox-container">
                                <div class="flex h-6 items-center">
                                    <input type="checkbox" id="abbrCheck" name="resize"
                                        {{ old('resize') == 'on' ? 'checked' : '' }}>
                                </div>
                                <div class="ml-1">
                                    <label for="comments" class="label mb-0">是否需要縮圖</label>
                                </div>
                            </div>

                            {{-- 縮圖比例 --}}
                            <div class="relative w-full">
                                <span class="input-icon right-0 pr-3">
                                    <i class="fa-solid fa-caret-down"></i>
                                </span>
                                <select class="select input" id="selectScale" name="smallimg_setting">
                                    <option>縮圖比例</option>
                                    @foreach ($ziped_rates as $key => $ziped_rate)
                                        <option value="{{ $loop->iteration }}"
                                            {{ old('smallimg_setting') == $key ? 'selected' : '' }}
                                            {{ $loop->iteration == 3 ? 'selected' : '' }}>{{ $ziped_rate }}%</option>
                                    @endforeach
                                </select>
                            </div>
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
        const selectScale = document.getElementById("selectScale");
        const cancelBtn = document.getElementById("cancel");
        const check = document.getElementById('abbrCheck');

        // 設定在 checked 的情況下才可選擇縮圖比例
        if (check.checked == true) {
            selectScale.disabled = false;
        } else {
            selectScale.disabled = true;
        }

        $("#abbrCheck").on("change", function() {
            var $checkbox = $(this);
            if ($("input:checked").length === 0) {
                // console.log("unchecked");
                selectScale.disabled = true;
            } else {
                selectScale.disabled = false;
                // console.log("checked");
            }
        });
        cancelBtn.addEventListener("click", () => {
            window.location.reload();
        })
    </script>

    <!-- home-section ends----------------- -->
    @include('Sucess')

    <!-- import javascript -->
@endsection
