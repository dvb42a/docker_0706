@extends('layouts.adminbeautyapp')

@section('content')


    <!-- Container start ----- -->
    <section class="container p-6" id="container">
        <!-- page-head start ----- -->
        <div class="page-head">
            <div>
                <h2 class="h2"> {{ $setting->kmc_name }} </h2>
            </div>
        </div>
        <!-- page-head ends ------ -->
        @livewireStyles
        @livewire('mediaimagetable', ['media_id' => $setting->kmc_id])
        @livewireScripts
        <!-- pagination -->
    </section>
    <!-- Container ends ------ -->

    <script src="{{ asset('javascript/all-select.js') }}"></script>
    <script>
        var imgMedia = "";
        var modalMedia = "";

        recatchrelations();
        preview();

        function recatchrelations() {
            imgMedia = document.querySelectorAll('.media-image');
            modalMedia = document.querySelectorAll('.media-modal');
        };

        function preview() {
            imgMedia.forEach(img => {
                img.addEventListener('mouseover', (event) => {
                    var parent = img.parentElement;
                    var modal = parent.querySelector('.media-modal');
                    window.addEventListener('mousemove', (e) => {
                        let x = e.pageX;
                        let y = e.pageY;
                        // console.log("pageX: ",e.pageX, "pageY: ", e.pageY, "clientX: ", e.clientX, "clientY:", e.clientY)
                        getImgPosition(x, y);
                    });

                    function getImgPosition(x, y) {
                        let top = y / 20;
                        let left = Math.round(x / 30 + 5);
                        // console.log(top, left);
                        modal.style = `left: ${left}vw; top: ${top}vh`;
                    };
                    modal.hidden = false;
                });
                img.addEventListener('mouseout', (event) => {
                    var parent = img.parentElement;
                    var modal = parent.querySelector('.media-modal');
                    modal.hidden = true;
                });
            })
        };
        window.addEventListener('contentChanged', event => {
            recatchrelations();
            preview();
            //console.log(imgMedia);
        });
    </script>


    @include('Sucess')
@endsection
