@extends('layouts.adminbeautyapp')

@section('content')
    <script src="//apps.bdimg.com/libs/jquery/1.10.2/jquery.min.js"></script>
    <script src="//apps.bdimg.com/libs/jqueryui/1.10.4/jquery-ui.min.js"></script>
    <link rel="stylesheet" href="//apps.bdimg.com/libs/jqueryui/1.10.4/css/jquery-ui.min.css">

    @vite('resources/css/pages/chapter.css')

    <div>

        @include('loader')

        <!-- Container start ----- -->
        <section class="container p-6 main-content">

            <!-- page-head start ----- -->
            <div class="page-head justify-between">
                <div>
                    <h2 class="h2">章節管理</h2>
                </div>

                {{-- save Btn --}}
                <div class="flex gap-2">
                    <button class="button primary-btn bg-primary" type="button" id="saveChangeBtn">套用變更</button>
                    <button class="button secondary-btn" type="button" id="cancelBtn">取消</button>
                </div>

            </div>
            <!-- page-head ends ------ -->


            <!-- tab-content start ----- -->
            <div class="my-4 flex flex-col gap-2">

                <p class="text-sm">每章節最多只能選取十個關鍵字。</p>

                {{-- Chapter Container --}}
                <div class="grid gird-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 my-2 w-full" id="allContainer">

                    {{-- 皮膚科學 --}}
                    <div class="tabAll">

                        {{-- chapter title --}}
                        <div class="chapter-title">

                            {{-- Title --}}
                            <div class="tab">
                                <span class="mr-1">
                                    <i class="fa-solid fa-book-open"></i>
                                </span>
                                <span> 皮膚科學 </span>
                            </div>

                        </div>

                        {{-- Container --}}
                        <div>
                            <p class="text-danger hidden font-bold animate-bounce orderUpInfo">
                                已經是第一個了!
                            </p>

                            {{-- keyword List --}}
                            <div class="tab-container"></div>

                            <p class="text-danger hidden font-bold animate-bounce orderDownInfo">
                                已經是最後一個了!
                            </p>
                        </div>

                        {{-- input & btn --}}
                        <div class="flex gap-2 mt-10">
                            <div class="field w-full">
                                <input type="text" class="input tabInput" placeholder="輸入關鍵字" id="tabInput_1">
                                <p class="helpInfo help danger"></p>
                            </div>
                            <button class="tabBtn button primary-btn h-9" type="button" value="tab1">
                                <span class="mr-0.5">
                                    <i class="fa-solid fa-plus"></i>
                                </span>
                                增加
                            </button>
                        </div>

                    </div>

                    {{-- 保養新知 --}}
                    <div class="talAll">
                        {{-- chapter title --}}
                        <div class="chapter-title">

                            {{-- Title --}}
                            <div class="tab" contenteditable="false">
                                <span class="mr-1">
                                    <i class="fa-solid fa-book-open"></i>
                                </span>
                                <span> 保養新知 </span>
                            </div>

                        </div>

                        {{-- Container --}}
                        <div>
                            <p class="text-danger hidden font-bold animate-bounce orderUpInfo">
                                已經是第一個了!
                            </p>

                            {{-- keyword List --}}
                            <div class="tab-container"></div>

                            <p class="text-danger hidden font-bold animate-bounce orderDownInfo">
                                已經是最後一個了!
                            </p>
                        </div>

                        {{-- input & btn --}}
                        <div class="flex gap-2 mt-10">
                            <div class="field w-full">
                                <input type="text" class="input tabInput" placeholder="輸入關鍵字" id="tabInput_2">
                                <p class="helpInfo help danger"></p>
                            </div>
                            <button class="tabBtn button primary-btn h-9" type="button" value="tab2">
                                <span class="mr-0.5">
                                    <i class="fa-solid fa-plus"></i>
                                </span>
                                增加
                            </button>
                        </div>

                    </div>


                    {{-- 醫學美容 --}}
                    <div class="tabAll">
                        {{-- chapter title --}}
                        <div class="chapter-title">

                            {{-- Title --}}
                            <div class="tab" contenteditable="false">
                                <span class="mr-1">
                                    <i class="fa-solid fa-book-open"></i>
                                </span>
                                <span> 醫學美容 </span>
                            </div>

                        </div>

                        {{-- Container --}}
                        <div>
                            <p class="text-danger hidden font-bold animate-bounce orderUpInfo">
                                已經是第一個了!
                            </p>

                            {{-- keyword List --}}
                            <div class="tab-container"></div>

                            <p class="text-danger hidden font-bold animate-bounce orderDownInfo">
                                已經是最後一個了!
                            </p>
                        </div>

                        {{-- input & btn --}}
                        <div class="flex gap-2 mt-10">
                            <div class="field w-full">
                                <input type="text" class="input tabInput" placeholder="輸入關鍵字" id="tabInput_3">
                                <p class="helpInfo help danger"></p>
                            </div>
                            <button class="tabBtn button primary-btn h-9" type="button" value="tab3">
                                <span class="mr-0.5">
                                    <i class="fa-solid fa-plus"></i>
                                </span>
                                增加
                            </button>
                        </div>
                    </div>

                </div>

            </div>
            <!-- tab-content ends ------ -->

            {{-- Input --}}
            <form method="POST" action="{{ route('chapter.hashtagCreate') }}" enctype="multipart/form-data"
                id="create_section" class="hidden">
                @csrf

                <span>
                    {{-- 送出 data --}}
                    <input type="text" class="input" name="chapter" id="chapter" value="ta1">
                </span>

            </form>


        </section>
        <!-- Container ends ------ -->

        {{-- import script --}}
        <script src="{{ asset('javascript/content-manageNew.js') }}"></script>


    </div>
@endsection
