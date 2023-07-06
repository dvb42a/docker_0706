
@extends('layouts.adminbeautyapp')

@section('content')

<div class="container">

    <section class="flex">

        <div class="w-[220px] bg-slate-100">
            @include('admin.beauty.section.side_group')
        </div>
        @include('admin.beauty.content.indexAll')

    </section>

</div>
<!-- iframe ends ------ -->
@endsection
