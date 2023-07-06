@extends('layouts.adminbeautyapp')
@vite('resources/css/pages/table.css')

@section('content')
    <!-- Container start ----- -->
    <section class="container p-6">

        {{-- page-head start --}}
        <div class="page-head">
            <div>
                <h2 class="h2">關鍵字群組</h2>
            </div>

        </div>
        {{-- page-head ends --}}

        {{-- table container start --}}
        <div>

            @livewireStyles
            @livewire('categorytable')
            @livewireScripts

            {{-- add category --}}
            <form class="w-full gap-2 flex my-8" action="{{route('category.store')}}" method="POST">
                @csrf
                <div class="field w-full max-w-[50%]" >
                    <input id="addCategoryInput" type="text" class="input {{ $errors->any() ? 'input-warning' : '' }}" placeholder="輸入群組名稱" name="bp_category">
                    <p class="help danger" id="helpInfo"></p>
                    @if ($errors->any())
                    @foreach ($errors->all() as $error)
                        <span class="invalid-feedback" role="alert">
                            <p class="help danger">{{ $error }}</p>
                        </span>
                    @endforeach
                @endif
                </div>

                <div class="flex gap-2 h-9">

                    <button class="button primary-btn">
                        新增群組
                    </button>
                    <button class="button secondary-btn" type="button" id="cancelAddBtn">
                        取消
                    </button>

                </div>

            </form>

        </div>
        {{-- table container ends --}}


        {{-- import script --}}
        <script src="{{ asset('javascript/category-list.js') }}"></script>


    </section>
    <!-- Container ends ------ -->

    @include('Sucess')
@endsection
