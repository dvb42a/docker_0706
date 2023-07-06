@extends('layouts.adminbeautyapp')

@section('content')
    <section class="container p-6">


        {{-- page-head start --}}
        <div class="page-head justify-between items-center">

            <div class="flex gap-6 items-center">

                <div class="flex flex-col">
                    <div class="h2 underline-offset-8 decoration-dashed decoration-cyan-700" id="categoryName"
                        contenteditable="false">
                        {{ $category->bp_category }}
                    </div>
                    <p class="help text-danger" id="helpInfo"></p>
                </div>

                <div class="flex gap-2 h-9">
                    <button class="button secondary-btn" type="button" id="editNameBtn">
                        <span class="mr-0.5">
                            <i class="fa-solid fa-pen-to-square"></i>
                        </span>
                        修改名稱
                    </button>

                    <button class="button primary-btn hidden" type="button" id="saveCategoryNameBtn">
                        保存
                    </button>

                    <button class="button secondary-btn hidden" type="button" id="cancelEditBtn">
                        取消
                    </button>
                </div>


            </div>


            <div class="flex gap-2">

                <button class="button primary-btn" id="submitBtn">
                    儲存變更
                </button>
                <button class="button secondary-btn">取消</button>
            </div>

        </div>
        {{-- page-head ends --}}

        {{-- form --}}
        <form id="form" action="{{ route('category.update', $category->bp_category_id) }}" method="POST"
            class="flex">
            @csrf
            @method('PATCH')
            {{-- 群組名稱 --}}
            <input type="text" id="categoryNameInput" class="input hidden" name="bp_category">

            {{-- 關鍵字數值 --}}
            {{-- input values are dropped at JS file --}}
        </form>


        {{-- keywprd-group --}}
        <div class="w-full flex gap-8">

            {{-- database --}}
            <div class="w-full max-width-[50%] space-y-2">

                <h3 class="h3">資料庫關鍵字</h3>

                <p class="text-sm text-gray-600">
                    點選關鍵字即加入到關鍵字到群組內
                </p>

                {{-- filter input --}}
                <div class="field">
                    <div class="relative">
                        <span class="input-icon right-0 pr-3">
                            <button class="clearBtn">
                                <i class="fa-solid fa-xmark"></i>
                            </button>
                        </span>
                        <input type="text" class="input input-rightIcon" placeholder="輸入關鍵字" id="filterDatabaseInput">
                    </div>
                </div>

                {{-- keyword container --}}
                <div class="bg-white p-2 rounded border border-slate-300 h-[540px] overflow-auto space-y-3"
                    id="databaseKeywordContainer">

                    {{-- <span class="tag is-keyword m-1 cursor-pointer">關鍵字</span> --}}

                </div>

            </div>

            {{-- group --}}
            <div class="w-full max-width-[50%] space-y-2">

                <h3 class="h3">群組內關鍵字</h3>

                <p class="text-sm text-gray-600">
                    顯示已在群組內的關鍵字
                </p>


                {{-- filter input --}}
                <div class="field">
                    <div class="relative">
                        <span class="input-icon right-0 pr-3">
                            <button class="clearBtn">
                                <i class="fa-solid fa-xmark"></i>
                            </button>
                        </span>
                        <input type="text" class="input input-rightIcon" placeholder="輸入關鍵字" id="filterCategoryInput">
                    </div>
                </div>

                {{-- keyword container --}}
                <div class="bg-white p-2 rounded border border-slate-300 h-[540px] space-y-3" id="categoryKeywordContainer">

                    {{-- <span class="tag is-keyword m-1">
                        關鍵字
                        <button type="button" class="tag-btn">
                            <i class="fa-solid fa-xmark"></i>
                        </button>
                    </span> --}}

                </div>

                {{-- buttons --}}
                <div class="flex gap-2 justify-end">
                    <button class="button secondary-btn" type="button" id="clearAllBtn">
                        全部清除
                    </button>
                </div>

            </div>


        </div>

        {{-- import script --}}
        <script src="{{ asset('javascript/input/clearInput.js') }}"></script>
        <script src="{{ asset('javascript/category_set-keyword.js') }}"></script>

        <script>
            let id = "{{ $category->bp_category_id }}";
            // console.log(id);

            // get API
            databaseApi(id);
        </script>

    </section>
    @include('Sucess')
@endsection
