<!-- Container start ----- -->

<section class="w-full p-6">
    <!-- page-head start ----- -->
    <div class="page-head flex justify-between h-10">
        <div>
            <h2 class="h2"> 全部文章 </h2>
        </div>

        <button class="button primary-btn bg-primary"
        onclick="window.open('{{route('content.create')}}','_blank')" type="button">
                新增文章
        </button>
    </div>
    <!-- page-head ends ------ -->

        @livewireStyles
        @livewire('contentalltable')
        @livewireScripts

</section>

<!-- Container ends ------ -->

