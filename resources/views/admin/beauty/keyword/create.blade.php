@extends('layouts.adminbeautyapp')

@section('content')
    <link rel="stylesheet" href="{{ asset('css/page-style/add-article.css') }}">
    <div class="iframe">
        <!-- Container start ----- -->
        <section class="container is-fluid">
            @livewireStyles
            @livewire('keywordcreate')
            @livewireScripts
        </section>
        <!-- Container ends ------ -->
    </div>
@endsection
