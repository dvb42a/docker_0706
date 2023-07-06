@extends('layouts.adminbeautyapp')
@section('content')

    <!-- Container start ----- -->
    <section class="container p-6 flex justify-center items-center">

        @livewireStyles
        @livewire('content-create')
        @livewireScripts

    </section>
    <!-- Container ends ------ -->
@endsection
