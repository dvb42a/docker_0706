@extends('layouts.adminbeautyapp')

@section('content')
    {{-- h-screen 可依狀況拿掉 --}}
    <section class="flex container">

        <div class="bg-slate-100">
            @include('admin.beauty.section.side_group')
        </div>

        <section class="p-6 w-full">
            <!-- page-head ----- -->
            <div class="page-head flex justify-between h-10">
                <div>
                    <h2 class="h2"> {{ $section->bp_hashtag }} </h2>
                </div>

                {{-- <button class="button primary-btn bg-primary" onclick="window.open('{{ route('content.create') }}','_blank')"
                    type="button">
                    新增文章
                </button> --}}

            </div>
            <!-- page-head ends ------ -->

            @livewireStyles
            @livewire('contentsectiontable', ['content_id' => $section->bp_tag_id])
            @livewireScripts
        </section>
    </section>
@endsection
