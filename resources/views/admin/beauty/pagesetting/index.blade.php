@extends('layouts.adminbeautyapp')

@section('content')
    <!-- container starts--------------- -->
    <section class="container p-6">
        <!-- page-head start ----- -->
        <div class="page-head">
            <div>
                <h2 class="h2"> 首頁設定 </h2>
            </div>
        </div>
        <!-- page-head ends ------ -->

        <section class="flex flex-col lg:flex-row gap-8">

            <!-- left-side starts----------------- -->
            <div class="flex flex-col space-y-6 flex-1">

                <div class="flex flex-col space-y-6">
                    <h5 class="h5">
                        全域設定
                    </h5>

                    <!-- web-tittle -->
                    <div class="field">
                        <label for="" class="label">網頁標題</label>
                        <input type="text" class="input" placeholder="Enter Something">
                    </div>

                    <!-- Nav Logo -->
                    <div class="flex flex-col md:flex-row gap-4 md:justify-between">

                        <!-- choose image -->
                        <div class="field gap-4">
                            <div class="flex justify-between gap-2 h-9">
                                {{-- upload --}}
                                <input class="upload-input" name="navLogo" type="file" />

                                <!-- Del btn -->
                                <button class="button danger-btn" type="button">
                                    刪除圖片
                                </button>
                            </div>

                            <div class="flex flex-col">
                                <span>圖片尺寸: 1920 x 1080 px</span>
                                <span>格式限制: .jpg, .png </span>
                            </div>
                        </div>

                        <div class="h-40 w-60 flex justify-center items-center border rounded overflow-hidden">
                            <img class="object-cover h-full w-full"
                                src="https://images.unsplash.com/photo-1497752531616-c3afd9760a11?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1170&q=80"
                                alt="">
                        </div>

                    </div>

                    <!-- Site Icon -->
                    <div class="flex flex-col md:flex-row gap-4 md:justify-between">

                        <div class="field space-y-2">
                            <div class="flex justify-between gap-2 h-9">
                                {{-- upload --}}
                                <input class="upload-input" name="siteLogo" type="file" />

                                <!-- Del btn -->
                                <button class="button danger-btn" type="button">
                                    刪除圖片
                                </button>
                            </div>

                            <div class="flex flex-col">
                                <span>圖片尺寸: 1920 x 1080 px</span>
                                <span>格式限制: .jpg, .png </span>
                            </div>
                        </div>

                        <div class="flex w-40 h-40 justify-center items-center border rounded overflow-hidden">
                            <img class="object-cover h-full w-full"
                                src="https://images.unsplash.com/photo-1497752531616-c3afd9760a11?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1170&q=80"
                                alt="">
                        </div>
                    </div>

                </div>

                <div class="flex flex-col space-y-4">
                    <!-- footer setting -->
                    <h5 class="h5">
                        版權宣告
                    </h5>

                    <!-- Author -->
                    <div class="field">
                        <label for="" class="label">Author</label>
                        <input type="text" class="input" placeholder="Enter Something">
                    </div>

                    <!-- Copyright -->
                    <div class="field">
                        <label for="" class="label">Copyright</label>
                        <input type="text" class="input" placeholder="Enter Something">
                    </div>

                </div>

            </div>
            <!-- lift-side ends------------------- -->

            <!-- right-side starts---------------- -->
            <div class="flex flex-col space-y-4 flex-1">
                <h5 class="h5">
                    SEO設定
                </h5>
                <!-- Meta Tittle -->
                <div class="field">
                    <label class="label"> Meta Tittle </label>
                    <input type="text" class="input" placeholder="請輸入文字">
                </div>
                <!-- Meta Keywords -->
                <div class="field">
                    <label class="label"> Meta Keywords </label>
                    <input type="text" class="input" placeholder="請輸入文字">
                </div>
                <!-- Meta Description -->
                <div class="field">
                    <label class="label"> Meta Description </label>
                    <textarea class="input" placeholder="請輸入文字" cols="30" rows="10"></textarea>
                </div>
                <!-- SEO Keywords -->
                <div class="field">
                    <label class="label"> SEO Keywords </label>
                    <input class="input" type="text" placeholder="請輸入文字">
                </div>
            </div>
            <!-- right-side ends------------------- -->

        </section>

    </section>
    <!-- container ends----------------- -->
@endsection
