@extends('layouts.adminLoginTailwind')
@section('content')

    <body class="container bg-100 mx-auto mb-20 space-y-8">

        {{-- Heading --}}
        <section class="p-6 w-full space-y-8">
            <h2 class="text-3xl font-bold">Heading</h2>
            <div class="flex flex-col gap-4">
                <h2 class="h2">Heading 2</h2>
                <h3 class="h3">Heading 3</h3>
                <h5 class="h5">Heading 5</h5>
            </div>
        </section>

        {{-- Button --}}
        <section class="p-6 w-full space-y-8">
            <h2 class="text-3xl font-bold">Buttons</h2>

            {{-- Primary Btn --}}
            <div>
                <h5 class="text-xl mb-4">
                    Primary Btn
                </h5>

                <div class="space-x-8">
                    <button class="button primary-btn small-btn" type="button">
                        <span class="mr-0.5">
                            <i class="fa-brands fa-facebook"></i>
                        </span>
                        Small
                    </button>
                    <button class="button primary-btn" type="button">
                        <span class="mr-0.5">
                            <i class="fa-brands fa-facebook"></i>
                        </span>
                        Default
                    </button>
                    <button class="button primary-btn large-btn" type="button">
                        <span class="mr-0.5">
                            <i class="fa-brands fa-facebook"></i>
                        </span>
                        Large
                    </button>
                </div>

            </div>

            {{-- Disable Primary Btn --}}
            <div>
                <h5 class="text-xl mb-4">
                    Disable Primary Btn
                </h5>

                <div class="space-x-8">
                    <button class="button primary-btn small-btn" type="button" disabled>
                        <span class="mr-0.5">
                            <i class="fa-brands fa-facebook"></i>
                        </span>
                        Small
                    </button>
                    <button class="button primary-btn" type="button" disabled>
                        <span class="mr-0.5">
                            <i class="fa-brands fa-facebook"></i>
                        </span>
                        Default
                    </button>
                    <button class="button primary-btn large-btn" type="button" disabled>
                        <span class="mr-0.5">
                            <i class="fa-brands fa-facebook"></i>
                        </span>
                        Large
                    </button>
                </div>
            </div>

            {{-- Loader Primary Btn --}}
            <div>
                <h5 class="text-xl mb-4">
                    Loader Primary Btn
                </h5>

                <div class="flex gap-6">

                    <button class="button primary-btn w-80" type="button" id="loaderBtn">
                        Loader Btn
                    </button>

                    <button class="button primary-btn loader-btn w-80" type="button" disabled>
                        <div class="loader-in-btn"></div>
                    </button>

                </div>

                <p class="help">
                    搭配 loaderBtn.js, button 加上寬度限制會比較好看
                </p>

            </div>

            {{-- Secondary Btn --}}
            <div>
                <h5 class="text-xl mb-4">
                    Secondary Btn
                </h5>

                <div class="space-x-8">
                    <button class="button secondary-btn small-btn" type="button">
                        <span class="mr-0.5">
                            <i class="fa-brands fa-facebook"></i>
                        </span>
                        Small
                    </button>
                    <button class="button secondary-btn" type="button">
                        <span class="mr-0.5">
                            <i class="fa-brands fa-facebook"></i>
                        </span>
                        Default
                    </button>
                    <button class="button secondary-btn large-btn" type="button">
                        <span class="mr-0.5">
                            <i class="fa-brands fa-facebook"></i>
                        </span>
                        Large
                    </button>
                </div>

            </div>

            {{-- Disable Secondary Btn --}}
            <div>
                <h5 class="text-xl mb-4">
                    Disable Secondary Btn
                </h5>

                <div class="space-x-8">
                    <button class="button secondary-btn small-btn" type="button" disabled>
                        <span class="mr-0.5">
                            <i class="fa-brands fa-facebook"></i>
                        </span>
                        Small
                    </button>
                    <button class="button secondary-btn" type="button" disabled>
                        <span class="mr-0.5">
                            <i class="fa-brands fa-facebook"></i>
                        </span>
                        Default
                    </button>
                    <button class="button secondary-btn large-btn" type="button" disabled>
                        <span class="mr-0.5">
                            <i class="fa-brands fa-facebook"></i>
                        </span>
                        Large
                    </button>
                </div>

            </div>

            {{-- Gray Btn --}}
            <div>
                <h5 class="text-xl mb-4">
                    Gray Btn
                </h5>

                <div class="space-x-8">
                    <button class="button gray-btn small-btn" type="button">
                        <span class="mr-0.5">
                            <i class="fa-brands fa-facebook"></i>
                        </span>
                        Small
                    </button>
                    <button class="button gray-btn" type="button">
                        <span class="mr-0.5">
                            <i class="fa-brands fa-facebook"></i>
                        </span>
                        Default
                    </button>
                    <button class="button gray-btn large-btn" type="button">
                        <span class="mr-0.5">
                            <i class="fa-brands fa-facebook"></i>
                        </span>
                        Large
                    </button>
                </div>

            </div>

            {{-- Disable Gray Btn --}}
            <div>
                <h5 class="text-xl mb-4">
                    Disable Gray Btn
                </h5>

                <div class="space-x-8">
                    <button class="button gray-btn small-btn" type="button" disabled>
                        <span class="mr-0.5">
                            <i class="fa-brands fa-facebook"></i>
                        </span>
                        Small
                    </button>
                    <button class="button gray-btn" type="button" disabled>
                        <span class="mr-0.5">
                            <i class="fa-brands fa-facebook"></i>
                        </span>
                        Default
                    </button>
                    <button class="button gray-btn large-btn" type="button" disabled>
                        <span class="mr-0.5">
                            <i class="fa-brands fa-facebook"></i>
                        </span>
                        Large
                    </button>
                </div>

            </div>

            {{-- Danger Btn --}}
            <div>
                <h5 class="text-xl mb-4">
                    Danger
                </h5>

                <div class="space-x-8">
                    <button class="button danger-btn small-btn" type="button">
                        <span class="mr-0.5">
                            <i class="fa-brands fa-facebook"></i>
                        </span>
                        Small
                    </button>
                    <button class="button danger-btn" type="button">
                        <span class="mr-0.5">
                            <i class="fa-brands fa-facebook"></i>
                        </span>
                        Default
                    </button>
                    <button class="button danger-btn large-btn" type="button">
                        <span class="mr-0.5">
                            <i class="fa-brands fa-facebook"></i>
                        </span>
                        Large
                    </button>
                </div>

            </div>

            {{-- Disable Danger Btn --}}
            <div>
                <h5 class="text-xl mb-4">
                    Disable Danger
                </h5>

                <div class="space-x-8">
                    <button class="button danger-btn small-btn" type="button" disabled>
                        <span class="mr-0.5">
                            <i class="fa-brands fa-facebook"></i>
                        </span>
                        Small
                    </button>
                    <button class="button danger-btn" type="button" disabled>
                        <span class="mr-0.5">
                            <i class="fa-brands fa-facebook"></i>
                        </span>
                        Default
                    </button>
                    <button class="button danger-btn large-btn" type="button" disabled>
                        <span class="mr-0.5">
                            <i class="fa-brands fa-facebook"></i>
                        </span>
                        Large
                    </button>
                </div>

            </div>

            {{-- Danger-outlined Btn --}}
            <div>
                <h5 class="text-xl mb-4">
                    Danger-outlined
                </h5>

                <div class="space-x-8">
                    <button class="button danger-outlined-btn small-btn" type="button">
                        <span class="mr-0.5">
                            <i class="fa-brands fa-facebook"></i>
                        </span>
                        Small
                    </button>
                    <button class="button danger-outlined-btn" type="button">
                        <span class="mr-0.5">
                            <i class="fa-brands fa-facebook"></i>
                        </span>
                        Default
                    </button>
                    <button class="button danger-outlined-btn large-btn" type="button">
                        <span class="mr-0.5">
                            <i class="fa-brands fa-facebook"></i>
                        </span>
                        Large
                    </button>
                </div>

            </div>

            {{-- Disable danger-outlined Btn --}}
            <div>
                <h5 class="text-xl mb-4">
                    Disabel Danger-outlined
                </h5>

                <div class="space-x-8">
                    <button class="button danger-outlined-btn small-btn" type="button" disabled>
                        <span class="mr-0.5">
                            <i class="fa-brands fa-facebook"></i>
                        </span>
                        Small
                    </button>
                    <button class="button danger-outlined-btn" type="button" disabled>
                        <span class="mr-0.5">
                            <i class="fa-brands fa-facebook"></i>
                        </span>
                        Default
                    </button>
                    <button class="button danger-outlined-btn large-btn" type="button" disabled>
                        <span class="mr-0.5">
                            <i class="fa-brands fa-facebook"></i>
                        </span>
                        Large
                    </button>
                </div>

            </div>

            {{-- Tex Btn --}}
            <div>
                <h5 class="text-xl mb-4">
                    Text Btn
                </h5>

                <div class="space-x-8">
                    <button class="text-btn small-btn" type="button">
                        Small
                    </button>
                    <button class="text-btn" type="button">
                        Default
                    </button>
                    <button class="text-btn large-btn" type="button">
                        Large
                    </button>
                </div>

            </div>

            {{-- Disable Tex Btn --}}
            <div>
                <h5 class="text-xl mb-4">
                    Disable Text Btn
                </h5>

                <div class="space-x-8">
                    <button class="text-btn small-btn" type="button" disabled>
                        Small
                    </button>
                    <button class="text-btn" type="button" disabled>
                        Default
                    </button>
                    <button class="text-btn large-btn" type="button" disabled>
                        Large
                    </button>
                </div>

            </div>

            {{-- Circular Btn --}}
            <div class="space-y-4">
                <h5 class="text-xl mb-4">
                    Circular
                </h5>

                <div class="flex gap-x-4 items-center">
                    Primary:
                    <button class="circular-btn small-circular primary-btn">
                        <i class="fa-solid fa-xmark"></i>
                    </button>
                    <button class="circular-btn primary-btn">
                        <i class="fa-solid fa-xmark"></i>
                    </button>
                    <button class="circular-btn large-circular primary-btn">
                        <i class="fa-solid fa-xmark"></i>
                    </button>
                </div>

                <div class="flex gap-x-4 items-center">
                    Danger:
                    <button class="circular-btn small-circular danger-btn">
                        <i class="fa-solid fa-xmark"></i>
                    </button>
                    <button class="circular-btn danger-btn">
                        <i class="fa-solid fa-xmark"></i>
                    </button>
                    <button class="circular-btn large-circular danger-btn">
                        <i class="fa-solid fa-xmark"></i>
                    </button>
                </div>

                <div class="flex gap-x-4 items-center">
                    Disable:
                    <button class="circular-btn small-circular primary-btn" disabled>
                        <i class="fa-solid fa-xmark"></i>
                    </button>
                    <button class="circular-btn primary-btn" disabled>
                        <i class="fa-solid fa-xmark"></i>
                    </button>
                    <button class="circular-btn large-circular primary-btn" disabled>
                        <i class="fa-solid fa-xmark"></i>
                    </button>
                </div>

            </div>


        </section>

        {{-- Tags --}}
        <section class="p-6 w-full space-y-8">
            <h3 class="text-3xl font-bold">Tags</h3>

            {{-- Small Size --}}
            <div>
                <h5 class="text-xl mb-4">
                    Small
                </h5>
                <div class="flex gap-4">
                    {{-- 未儲存 --}}
                    <span class="tag small-tag is-unsave">
                        未儲存
                        <button type="button" class="tag-btn">
                            <i class="fa-solid fa-xmark"></i>
                        </button>
                    </span>
                    {{-- 停用 --}}
                    <span class="tag small-tag is-suspended">
                        停用
                        <button type="button" class="tag-btn">
                            <i class="fa-solid fa-xmark"></i>
                        </button>
                    </span>
                    {{-- 排成發布 --}}
                    <span class="tag small-tag is-schedule">
                        排程發布
                        <button type="button" class="tag-btn">
                            <i class="fa-solid fa-xmark"></i>
                        </button>
                    </span>
                    {{-- 已發布 --}}
                    <span class="tag small-tag is-published">
                        已發布
                        <button type="button" class="tag-btn">
                            <i class="fa-solid fa-xmark"></i>
                        </button>
                    </span>
                    {{-- 草稿 --}}
                    <span class="tag small-tag is-draft">
                        草稿
                        <button type="button" class="tag-btn">
                            <i class="fa-solid fa-xmark"></i>
                        </button>
                    </span>
                    {{-- 關鍵字 --}}
                    <span class="tag small-tag is-keyword">
                        關鍵字
                        <button type="button" class="tag-btn">
                            <i class="fa-solid fa-xmark"></i>
                        </button>
                    </span>

                </div>
            </div>

            {{-- Default Size --}}
            <div>
                <h5 class="text-xl mb-4">
                    Default
                </h5>
                <div class="flex gap-4">
                    {{-- 未儲存 --}}
                    <span class="tag is-unsave">
                        未儲存
                        <button type="button" class="tag-btn">
                            <i class="fa-solid fa-xmark"></i>
                        </button>
                    </span>
                    {{-- 停用 --}}
                    <span class="tag is-suspended">
                        停用
                        <button type="button" class="tag-btn">
                            <i class="fa-solid fa-xmark"></i>
                        </button>
                    </span>
                    {{-- 排成發布 --}}
                    <span class="tag is-schedule">
                        排程發布
                        <button type="button" class="tag-btn">
                            <i class="fa-solid fa-xmark"></i>
                        </button>
                    </span>
                    {{-- 已發布 --}}
                    <span class="tag is-published">
                        已發布
                        <button type="button" class="tag-btn">
                            <i class="fa-solid fa-xmark"></i>
                        </button>
                    </span>
                    {{-- 草稿 --}}
                    <span class="tag is-draft">
                        草稿
                        <button type="button" class="tag-btn">
                            <i class="fa-solid fa-xmark"></i>
                        </button>
                    </span>
                    {{-- 關鍵字 --}}
                    <span class="tag is-keyword">
                        關鍵字
                        <button type="button" class="tag-btn">
                            <i class="fa-solid fa-xmark"></i>
                        </button>
                    </span>

                </div>
            </div>

            {{-- Large Size --}}
            <div>
                <h5 class="text-xl mb-4">
                    Large
                </h5>
                <div class="flex gap-4">
                    {{-- 未儲存 --}}
                    <span class="tag large-tag is-unsave">
                        未儲存
                        <button type="button" class="tag-btn">
                            <i class="fa-solid fa-xmark"></i>
                        </button>
                    </span>
                    {{-- 停用 --}}
                    <span class="tag large-tag is-suspended">
                        停用
                        <button type="button" class="tag-btn">
                            <i class="fa-solid fa-xmark"></i>
                        </button>
                    </span>
                    {{-- 排程發布 --}}
                    <span class="tag large-tag is-schedule">
                        排程發布
                        <button type="button" class="tag-btn">
                            <i class="fa-solid fa-xmark"></i>
                        </button>
                    </span>
                    {{-- 已發布 --}}
                    <span class="tag large-tag is-published">
                        已發布
                        <button type="button" class="tag-btn">
                            <i class="fa-solid fa-xmark"></i>
                        </button>
                    </span>
                    {{-- 草稿 --}}
                    <span class="tag large-tag is-draft">
                        草稿
                        <button type="button" class="tag-btn">
                            <i class="fa-solid fa-xmark"></i>
                        </button>
                    </span>
                    {{-- 關鍵字 --}}
                    <span class="tag large-tag is-keyword">
                        關鍵字
                        <button type="button" class="tag-btn">
                            <i class="fa-solid fa-xmark"></i>
                        </button>
                    </span>
                </div>
            </div>

        </section>

        {{-- Form --}}
        <section class="p-6 w-full space-y-8"">
            <h3 class="text-3xl font-bold">Form</h3>

            {{-- Upload File --}}
            <div class="flex flex-col gap-4">

                {{-- <label for="file-upload" class="upload-label w-40">
                    <i class="fas fa-upload"></i>
                    <span>上傳圖片</span>
                    <input id="file-upload" name="file-upload" type="file" class="sr-only">
                </label> --}}

                <div class="field">
                    <label class="label">
                        Upload File
                    </label>
                    <input class="upload-input" type="file" />
                </div>

            </div>

            {{-- Field --}}
            <div class="flex flex-col gap-4">

                {{-- class 內加入  {{ $errors->any() ? 'input-warning' : '' }} 加入判斷錯誤後的 input 變化 --}}

                {{-- Normal --}}
                <div class="field">
                    <label for="" class="label">Noraml</label>
                    <input type="text" class="input" placeholder="Enter Something">
                    <p class="help">We'll only use this for spam.</p>
                </div>

                {{-- Normal Left Icon --}}
                <div class="field">
                    <label for="email" class="label">Normal</label>
                    <div class="relative">
                        <span class="input-icon left-0 pl-3">
                            <i class="fa-solid fa-envelope"></i>
                        </span>
                        <input type="email" name="email" id="email" class="input input-leftIcon"
                            placeholder="you@example.com">
                    </div>
                    <p class="help">We'll only use this for spam.</p>
                </div>

                {{-- Normal Right Icon --}}
                <div class="field">
                    <label class="label">Normal</label>
                    <div class="relative">
                        <span class="input-icon right-0 pr-3">
                            <button class="clearBtn">
                                <i class="fa-solid fa-xmark"></i>
                            </button>
                        </span>
                        <input type="text" class="input input-rightIcon">
                    </div>
                    <p class="help">搭配 clearInput.js 清除 input 內容, 同頁面內同時使用多個 input 也可</p>
                    <p class="help">使用 .clearBtn 抓取 btn</p>
                    <p class="help">如果右邊 icon 不是要清除內容可把 button 拿掉</p>
                </div>

                {{-- Password Input --}}
                <div class="field">
                    <label for="password" class="label">Password</label>
                    <div class="relative">
                        <input type="password" class="input input-rightIcon" placeholder="********">
                        <span class="input-icon right-0 pr-3">
                            <button class="eyeBtn" type="button">
                                <i class="fa-solid fa-eye"></i>
                            </button>
                        </span>
                    </div>
                    <p class="help">搭配 passwordInput.js </p>
                </div>

                {{-- Password Input II--}}
                <div class="field">
                    <label for="password" class="label">Password II</label>
                    <div class="relative">
                        <input type="password" class="input input-rightIcon" placeholder="********">
                        <span class="input-icon right-0 pr-3">
                            <button class="eyeBtn" type="button">
                                <i class="fa-solid fa-eye"></i>
                            </button>
                        </span>
                    </div>
                    <p class="help">搭配 passwordInput.js </p>
                </div>

                {{-- Danger --}}
                <div class="field">
                    <label for="" class="label danger">Danger</label>
                    <input type="text" class="input input-warning" placeholder="Enter Something">
                    <p class="help danger">We'll only use this for spam.</p>
                </div>

                {{-- Success --}}
                <div class="field">
                    <label for="" class="label">Success</label>
                    <input type="text" class="input" placeholder="Enter Something">
                    <p class="help success">We'll only use this for spam.</p>
                </div>

                {{-- Disable --}}
                <div class="field">
                    <label for="" class="label disabled">Disable</label>
                    <input type="text" class="input" placeholder="Enter Something" disabled>
                    <p class="help disabled">We'll only use this for spam.</p>
                </div>

                {{-- Select --}}
                <div class="field">
                    <label for="location" class="label">Location</label>
                    <div class="relative">
                        <span class="input-icon right-0 pr-3">
                            <i class="fa-solid fa-caret-down"></i>
                        </span>
                        <select id="location" name="location" class="input select">
                            <option>United States</option>
                            <option selected>Canada</option>
                            <option>Mexico</option>
                        </select>
                    </div>
                </div>

            </div>

            {{-- Checkbox --}}
            <div class="flex gap-8">
                {{-- with comment --}}
                <div class="checkbox-container">
                    <div class="flex h-6 items-center">
                        <input id="comments1" name="comments" type="checkbox" class="checkbox">
                    </div>
                    <div class="ml-1">
                        <label for="comments1" class="label mb-0">Comments</label>
                        <p id="comments-description" class="help">Get notified when someones posts a comment on a
                            posting.</p>
                    </div>
                </div>

                {{-- only label --}}
                <div class="checkbox-container">
                    <div class="flex h-6 items-center">
                        <input id="comments2" name="comments" type="checkbox" class="checkbox">
                    </div>
                    <div class="ml-1">
                        <label for="comments2" class="label mb-0">Comments</label>
                    </div>
                </div>

            </div>


        </section>

        {{-- import script --}}
        <script src="{{ asset('javascript/input/passwordInput.js') }}"></script>
        <script src="{{ asset('javascript/input/clearInput.js') }}"></script>
        <script src="{{ asset('javascript/loaderBtn.js') }}"></script>


    </body>

    </html>
@endsection
