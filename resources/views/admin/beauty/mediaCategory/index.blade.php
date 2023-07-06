@extends('layouts.adminbeautyapp')
@section('content')

    @livewireStyles

    <!-- Container start ----- -->
    <section class="container p-6">
        <!-- page-head start ----- -->
        <div class="page-head">
            <div>
                <h2 class="h2"> 媒體庫 </h2>
            </div>
        </div>
        <!-- page-head ends ------ -->
        @livewire('mediacategorytable')
        @livewireScripts
    </section>
    <!-- Container ends ------ -->

    @include('Sucess')
@endsection
