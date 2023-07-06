@extends('layouts.adminbeautyapp')

@section('content')
    {{-- h-screen 可依狀況拿掉 --}}
    <section class="flex h-screen">

        <div class="bg-slate-100">
            @include('admin.beauty.section.side_group')
        </div>

        <section class="w-full p-6">
            <!-- page-head ----- -->
            <div class="page-head flex justify-between">
                <div>
                    <h2 class="h2"> 文章垃圾筒 </h2>
                </div>
            </div>
            @livewireStyles
            @livewire('contenttrashtable')
            @livewireScripts
        </section>
    </section>
@endsection
