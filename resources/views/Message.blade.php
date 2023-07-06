@extends('layouts.adminloginapp')

@section('content')
    <!-- import CSS -->
    <link rel="stylesheet" href="{{ asset('css/page-style/login-page.css') }}">
    <body>
        <!-- Nav start ----- -->
        <nav class="navbar is-fixed-top has-shadow" role="navigation" aria-label="main navigation">
            <div class="navbar-start">
                <a class="navbar-item title is-3" href="{{'/'}}">
                    <i class="fa-solid fa-swatchbook"></i>
                    <span class="site-title"> 後臺管理介面 </span>
                </a>
            </div>
        </nav>
        <!-- Nav ends ------ -->
        <!-- iframe start ----- -->
        <section class="iframe">
            <!-- Container start ----- -->
            <section class="container is-fluid">
                <!-- Box start ----- -->
                <center>
                    @if(isset($message))
                        {{$message}}
                    @endif
                    <br><br><br>
                    <div class="buttons">
                        <a href="{{route('admin.main')}}"> 按我回到系統 </a>
                    </div>
                </center>
                <!-- Box ends ------ -->
            </section>
            <!-- Container ends ------ -->
        </section>
        <!-- iframe ends ------ -->
        <script src="{{asset('javascript/login-record.js')}}"></script>
    </body>

@endsection
