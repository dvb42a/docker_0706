<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Article Preview </title>

    <!-- import font awesome -->
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.css'
        integrity='sha512-FA9cIbtlP61W0PRtX36P6CGRy0vZs0C2Uw26Q1cMmj3xwhftftymr0sj8/YeezDnRwL9wtWw8ZwtCiTDXlXGjQ=='
        crossorigin='anonymous' />

    <!-- import CSS -->
    @vite('resources/css/app.css')

</head>

<body class="relative">

    <!-- NavBar -->
    <nav
        class="bg-white/80 hover:shadow-lg ease-in-out duration-300 z-50 w-full p-4 fixed top-0 flex justify-center items-center text-gray-700">
        <div class="flex justify-between w-full max-w-6xl">

            {{-- logo --}}
            <div class="font-bold text-xl lg:text-4xl flex items-center">
                <a class="flex gap-2 items-center" href="#">
                    <i class="fa-brands fa-pied-piper-alt"></i>
                    <span>美容百科</span>
                </a>
            </div>

            {{-- menu --}}
            <ul class="hidden lg:flex items-center gap-10">

                <li class="flex items-center gap-2 font-semibold leading-6 truncate">
                    <a href="#">
                        皮膚科學
                    </a>
                </li>
                <li class="flex items-center gap-2 font-semibold leading-6 truncate">
                    <a href="#">
                        肌膚QA
                    </a>
                </li>
                <li class="flex items-center gap-2 font-semibold leading-6 truncate">
                    <a href="#">
                        醫學美容
                    </a>
                </li>

                {{-- buttons --}}
                <div class="flex gap-6">
                    <button class="text-btn" type="button"> 註冊 </button>
                    <button class="button primary-btn hover:text-white" type="button"> 登入 </button>
                </div>

            </ul>

            <div class="text-xl p-2 lg:hidden felx items-center justify-center">
                <i class="fa-solid fa-bars"></i>
            </div>

        </div>
    </nav>

    <section class="w-full flex flex-col items-center">

        <!-- 放文章首圖跟標題 -->
        <section class="w-full top-0" background>

            @if ($image != null)
                <img
                    src="{{ asset('media/content_banner_image/' . $image->km_name) }}"
                    alt="{{ $image->km_cnt }}"
                    class="object-cover">
            @endif

        </section>

        <!-- 主要文章內容 -->
        <section class="my-20 w-full max-w-6xl flex flex-col gap-6 items-center p-4">

            <h1 class="font-bold text-4xl leading-6">
                {{ $saved_content->bp_subsection_title }}
            </h1>

            <div class="flex flex-col gap-4 items-center w-full">

                @if ($saved_content->bp_subsection_intro != null)
                <div class="w-full">
                    {{ $saved_content->bp_subsection_intro }}
                </div>
                @endif
                @if ($saved_content->content_index->bp_subsectioncnt_index != null)
                <div>
                    {!! $saved_content->content_index->bp_subsectioncnt_index !!}
                </div>
                @endif
            </div>

        </section>

    </section>


    <hr>

    <!-- 文章尾端 -->
    <footer class="w-full bg-slate-200/60 h-20 lg:h-40 flex gap-4 justify-center items-center text-xs lg:text-sm">

        <div class="w-full max-w-6xl text-gray-500 flex items-center gap-4 justify-center">
            © 2023 Tailwind Labs Inc. All rights reserved.
        </div>

    </footer>

</body>

</html>





<html>

<head>
    <title>{{ $saved_content->bp_subsection_title }}</title>
</head>


</html>
