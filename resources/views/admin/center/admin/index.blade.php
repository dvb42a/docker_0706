@extends('layouts.admincenterapp')

@section('content')
    <!-- Container start ----- -->
    <section class="container p-6" id="container">

        <!-- page-head ---- -->
        <div class="page-head justify-between">
            <h3 class="h2">Kings全域後台管理員帳號</h3>

            <button class="button primary-btn h-10" onclick="window.open ('{{ route('admins.create') }}','__blank')"
                type="button">
                新增管理員帳號
            </button>
        </div>


        @livewireStyles
        @livewire('center.adminstable')
        @livewireScripts

    </section>
    <!-- Container ends ------ -->

    {{-- import script --}}
    <script src="{{ asset('javascript/all-select.js') }}"></script>



    @include('Sucess')
@endsection
