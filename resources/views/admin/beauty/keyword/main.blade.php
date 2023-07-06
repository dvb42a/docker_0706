@extends('layouts.adminbeautyapp')

@section('content')

    <!-- Container start ----- -->
    <section class="container p-6" id="container">
        <!-- page-head start ----- -->
        <div class="page-head">
            <div>
                <h2 class="h2"> {{ $tag->bp_hashtag }} </h2>
            </div>
        </div>
        @livewireStyles

        <section>
            @livewire('contentkeywordtable', ['content_id' => $tag->bp_tag_id])
        </section>

        <section class="mt-10">
            @livewire('mediakeywordtable', ['media_id' => $tag->bp_tag_id])
            @livewireScripts
        </section>


    </section>
    <!-- Container ends ------ -->


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
