
@extends('layouts.adminultrasearchapp')

@section('content')
<div class="iframe">
    @include('breadcrumbs')
    <section class="container is-fluid">
        <br>
        <form method="POST" action="{{route('search.store')}}" enctype="multipart/form-data">
            @csrf

        </form>
    </section>
</div>
@endsection
