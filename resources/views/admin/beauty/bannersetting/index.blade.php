@extends('layouts.adminbeautyapp')

@section('content')

    {{-- container start ---------- --}}
    <section class="container p-6">

        <form method="POST" action="{{ route('bannersetting.store') }}" id="form" enctype="multipart/form-data">
            @csrf
            <section>

                <!-- page-head start ----- -->
                <div class="page-head flex justify-between">
                    <div>
                        <h2 class="h2"> 更換 Banner </h2>
                    </div>
                    <div class="space-x-1">
                        <button class="button primary-btn" id="saveBtn">
                            套用更新
                        </button>
                        <button class="button danger-outlined-btn" type="button" id="refresh"> 取消操作 </button>
                    </div>
                </div>
                <!-- page-head ends ------ -->

                <!-- banner-time start ----- -->
                <div class="field flex flex-col md:flex-row md:items-center md:space-x-4 max-w-1/3 mb-10">
                    <label for="banner_switch" class="label md:whitespace-nowrap">輪播時間設定</label>
                    <input type="number" step="1" min="1" max="10" name="banner_switch"
                        value="{{ $sys_setting->bps_bannerswitch }}" class="input w-32">
                    <label class="label">秒</label>
                </div>

                <!-- banner-time ends ------ -->

                {{-- TODO upload failed --}}
                <!-- banner-setting start ----- -->
                <section class="flex flex-col gap-8">

                    @foreach ($banners as $i => $banner)
                        <!-- banner I -->
                        <div class="flex flex-col-reverse lg:flex-row w-full gap-8 bg-white p-4 rounded shadow">

                            {{-- Left --}}
                            <div class="flex flex-col space-y-2">
                                {{-- Img --}}
                                <div
                                    class="w-full max-w-[1200px] max-h-[320px] overflow-hidden rounded flex items-center justify-center">
                                    <img class="object-center" id="demo{{ $i }}"
                                        @if ($banner->media->km_name != null) src="{{ asset('media/' . $setting->kmc_position . '/' . $banner->media->km_name) }}" @endif>

                                    {{-- For Test --}}
                                    {{-- <img src="https://images.unsplash.com/photo-1685728399140-5650bbcfc015?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1060&q=80" alt=""> --}}
                                </div>

                                <!-- button & input -->
                                <div class="flex flex-col gap-6">
                                    <!-- choose image -->
                                    <div class="flex justify-between gap-2">
                                        {{-- upload --}}
                                        <input class="upload-input" name="file_{{ $i }}" id="file{{ $i }}" type="file" />


                                        <!-- Del btn -->
                                        <button class="button danger-btn" type="button" id="removeimage{{ $i }}">
                                            <span class="mr-0.5">
                                                <i class="fa-solid fa-trash-can"></i>
                                            </span>
                                            刪除圖片
                                        </button>
                                    </div>

                                    <!-- 圖片上傳限制條件 -->
                                    <ul class="flex flex-col text-gray-600">
                                        <li class="img-status" id="img_type{{ $i }}">
                                            <span class="check-icon" id="icon_type_true{{ $i }}" hidden>
                                                <i class="fa-solid fa-check"></i>
                                            </span>
                                            <span class="check-icon" id="icon_type_false{{ $i }}" hidden>
                                                <i class="fa-solid fa-xmark"></i>
                                            </span>
                                            格式限制：<span>jpg, jepg, png, svg </span>
                                        </li>
                                        <li class="img-status" id="img_filesize{{ $i }}">
                                            <span class="check-icon" id="icon_file_true{{ $i }}" hidden>
                                                <i class="fa-solid fa-check"></i>
                                            </span>
                                            <span class="check-icon" id="icon_file_false{{ $i }}" hidden>
                                                <i class="fa-solid fa-xmark"></i>
                                            </span>
                                            檔案大小限制：<span id="file_limited_file">{{ $setting->kmc_file_limited }}</span>MB
                                        </li>
                                        <li class="img-status" id="img_size{{ $i }}">
                                            <span class="check-icon" id="icon_size_true{{ $i }}" hidden>
                                                <i class="fa-solid fa-check"></i>
                                            </span>
                                            <span class="check-icon" id="icon_size_false{{ $i }}" hidden>
                                                <i class="fa-solid fa-xmark"></i>
                                            </span>
                                            圖片尺寸：
                                            @if ($setting->kmc_width == null && $setting->kmc_height == null)
                                                <span id="file_limited_width">無限制</span>
                                            @else
                                                <span id="file_limited_width">{{ $setting->kmc_width }}</span> x
                                                <span id="file_limited_height">{{ $setting->kmc_height }}</span>px
                                            @endif
                                        </li>
                                    </ul>

                                </div>
                            </div>

                            <!-- Right ----- -->
                            <div class="flex flex-col gap-3">

                                <!-- 圖片標題 -->
                                <div class="field">
                                    <label class="label"> 圖片標題 </label>
                                    <input class=" input" type="text" placeholder="輸入廣告檔案名稱"
                                        name="km_cname{{ $i }}" value="{{ $banner->media->km_cname }}">
                                </div>

                                {{-- 優先顯示 --}}
                                <div class="checkbox-container">
                                    <div class="flex h-6 items-center">
                                        <input class="checkbox" type="checkbox" name="first{{ $i }}"
                                            {{ $banner->bpb_first == 'on' ? 'checked' : '' }}>
                                    </div>
                                    <div class="ml-1">
                                        <label for="comments" class="label mb-0">優先顯示</label>
                                    </div>
                                </div>

                                <!-- 圖片連結 -->
                                <div class="field">
                                    <label class="label"> 圖片連結 </label>
                                    <div class="control">
                                        <input class="input" type="text" placeholder="輸入連結"
                                            name="km_link{{ $i }}" value="{{ $banner->bpb_link }}">
                                    </div>
                                </div>

                                <input type="hidden" name="id{{ $i }}" value="{{ $banner->km_id }}">
                            </div>

                        </div>
                    @endforeach


                </section>
                <!-- banner-setting ends ------ -->
        </form>

        </form>
    </section>

    {{-- container ends ---------- --}}
    <script src="{{ asset('javascript/adver_upload.js') }}"></script>
    <script src="{{ asset('javascript/refreshBtn.js') }}"></script>
    <!-- import javascript -->
    @include('Sucess')
@endsection
