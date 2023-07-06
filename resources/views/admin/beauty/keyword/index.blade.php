@extends('layouts.adminbeautyapp')

@section('content')
    @livewireStyles

    <!-- Container start ----- -->
    <section class="container p-6">
        <!-- page-head start ----- -->
        <div class="page-head justify-between">
            <div>
                <h2 class="h2"> 關鍵字列表 </h2>
            </div>

            <div class="flex">
                <button class="button primary-btn" id="addKeywordBtn" onclick="showForm()">
                    <span>
                        <i class="fa-solid fa-plus"></i>
                    </span>
                    新增關鍵字
                </button>
            </div>

        </div>
        <!-- page-head ends ------ -->

        <!-- Add keyword -->
        <div id="addkeywordForm" class="hide">

            <form method="POST" action="{{ route('keyword.store') }}" enctype="multipart/form-data"
                class="p-6 bg-white shadow rounded mb-6 duration-200 ease-linear z-10 relative flex flex-col gap-6">
                @csrf

                {{-- form head --}}
                <div class="flex justify-between">

                    <h5 class="h5">
                        新增關鍵字
                    </h5>


                    {{-- close btn --}}
                    <div id="closeBtn">
                        <button class="circular-btn small-circular secondary-btn" type="button" onclick="hideForm()">
                            <i class="fa-solid fa-xmark"></i>
                        </button>
                    </div>
                </div>


                {{-- form content --}}
                <div id="add-keyword" class="grid grid-cols-1 md:grid-cols-2 gap-4">
{{--                     @if($errors->has('bp_hashtag.*'))
                        @foreach($errors->get('bp_hashtag.*') as $errors)
                            @foreach($errors as $error)
                                <li>{{ $error }}</li>
                                <script>
                                    console.log(@json($error))
                                </script>
                            @endforeach
                        @endforeach
                    @endif --}}
                    {{-- input --}}
                    @if (old('bp_hashtag'))
                        @foreach( old('bp_hashtag') as $key=> $bp_hashtag)
                                @if ($loop->first )
                                    <div class="flex gap-2 w-full">
                                        <div class="field w-full">
                                            <input class="input  {{$errors->has('bp_hashtag.0') ? 'input-warning' : ''}} " type="text" placeholder="輸入關鍵字" name="bp_hashtag[]"
                                                maxlength="25" value="{{ $bp_hashtag }}">
                                            @if($errors->has('bp_hashtag.'.$key))
                                                <p class="help danger">關鍵字已存在</p>
                                            @else
                                                <p class="help">長度限制 25 中/英文字</p>
                                            @endif
                                        </div>
                                    </div>
                                @else
                                <div class="flex gap-2 w-full">
                                    <div class="field w-full">
                                        <input class="input  {{$errors->has('bp_hashtag.'.$key) ? 'input-warning' : ''}}" type="text" placeholder="輸入關鍵字" name="bp_hashtag[{{$key}}]"
                                            maxlength="25" value="{{ $bp_hashtag }}">

                                            @if($errors->has('bp_hashtag.'.$key))
                                                <p class="help danger">關鍵字已存在</p>
                                            @else
                                                <p class="help">長度限制 25 中/英文字</p>
                                            @endif

                                    </div>
                                    <button type="button" class="button secondary-btn h-9 recreate">
                                        <i class="fa-solid fa-xmark"></i>
                                    </button>
                                </div>
                                @endif
                        @endforeach
                        <script>
                            const ReturnBackErrorKeyword='{{$errors}}';
                            console.log(ReturnBackErrorKeyword);

                            let addkeywordFormError = document.getElementById('addkeywordForm');
                            const addKeywordBtnError = document.getElementById('addKeywordBtn');

                            addkeywordFormError.classList.remove('hide');
                            addKeywordBtnError.classList.add('hide');

                            // delBtn function
                            let formContentError = document.getElementById('add-keyword');
                            let delInputBtn = document.querySelectorAll('.recreate');
                            delInputBtn.forEach((btn, index) => {
                                btn.addEventListener('click', (e) => {
                                     console.log(e.target.parentElement);
                                    formContentError.removeChild(e.target.parentElement);
                                })
                            })
                        </script>
                    @else
                        <div class="flex gap-2 w-full">
                            <div class="field w-full">
                                <input class="input" type="text" placeholder="輸入關鍵字" name="bp_hashtag[]" maxlength="25" ">
                                    <p class="help">長度限制 25 中/英文字</p>
                                </div>
                            </div>
                    @endif

                                {{-- input --}}
                                {{-- <div class="flex gap-2 w-full">
                        <div class="field w-full">
                            <input class="input" type="text" placeholder="輸入關鍵字" name="bp_hashtag"
                                maxlength="25">
                            <p class="help">長度限制 25 中/英文字</p>
                        </div>
                        <button class="button secondary-btn h-9">
                            <i class="fa-solid fa-xmark"></i>
                        </button>
                    </div> --}}

                            </div>

                            {{-- Btns --}}
                            <div class="flex justify-between gap-2">

                                <div class="flex flex-col gap-1 w-48">
                                    <button class="button secondary-btn" id="addInputBtn" type="button">
                                        <span class="mr-0 5">
                                            <i class="fa-solid fa-plus"></i>
                                        </span>
                                        新增欄位
                                    </button>
                                    <p class="text-sm danger hidden" id="limitInfo">
                                        最多同時新增 10 個關鍵字
                                    </p>
                                </div>

                                <button class="button primary-btn h-9 w-28">送出</button>
                            </div>

            </form>
        </div>

        @livewire('keywordtable')
        @livewireScripts

    </section>
    <!-- Container ends ------ -->

    @include('Sucess')

    <!-- import script -->
    <script src="{{ asset('javascript/keyword_addnew.js') }}"></script>

    <script src="{{ asset('javascript/keyword-list.js') }}"></script>
    <script>
        keywordChanged();
        window.addEventListener('keywordChanged', event => {
            keywordChanged();
        });
    </script>
@endsection
