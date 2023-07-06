<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> 美容百科後臺管理介面 </title>

    <!-- sucess UI -->
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

    <!-- import font awesome -->
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css'
        integrity='sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=='
        crossorigin='anonymous' />

    <!-- import jQuery -->
    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js'
        integrity='sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA=='
        crossorigin='anonymous'></script>

    <!-- import CSS -->
    @vite('resources/css/app.css')
    @vite('resources/css/layout.css')
    @vite('resources/css/components/Nav.css')
    @vite('resources/css/components/SideMenu.css')
    @vite('resources/css/components/Breadcrumb.css')


</head>

<body>
    <!-- Nav start ----- -->
    <nav class="nav z-20" role="navigation" aria-label="main navigation">
        <div>
            <a class="nav-title" href="{{ route('admin.beauty.main') }}" id="location">
                <i class="fa-solid fa-swatchbook"></i>
                <span> 美容百科後臺管理介面 v2.2SP</span>
            </a>
        </div>

        @include('layouts.platformselect')
    </nav>
    <!-- Nav ends ------ -->


    <section class="w-full">

        <!-- Side Menu start ----- -->
        <aside class="menu">

            {{-- menu List --}}
            <ul class="menu-list">
                <li>
                    <a href="{{ route('admin.beauty.main') }}"
                        class="menu-title group {{ Request::routeIs('admin.beauty.main') ? 'is-active' : '' }}"
                        id="dashboard">
                        <i class="fa-solid fa-gauge"></i>
                        Dashboard
                    </a>
                </li>

                {{-- web-setting --}}
                <li>
                    <a class="menu-title" id="webSetting">
                        <i class="fa-solid fa-gear"></i>
                        網站設定
                        <i class="arrow-icon fa-solid fa-angle-right"></i>
                    </a>
                    <ul class="sub-menu hidden" id="webSettingMenu">
                        <li>
                            <a href="{{ route('admin.beauty.pagesetting') }}"
                                class="menu-item {{ Request::routeIs('admin.beauty.pagesetting') ? 'is-active' : '' }}">
                                <i class="fa-solid fa-globe"></i>
                                首頁設定
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('bannersetting.index') }}"
                                class="menu-item {{ Request::routeIs('bannersetting.index') ? 'is-active' : '' }}">
                                <i class="fa-solid fa-panorama"></i>
                                更換 Banner
                            </a>
                        </li>
                    </ul>
                </li>

                {{-- TODO member-manage --}}
                <li>
                    <a class="menu-title" id="mamberSetting">
                        <i class="fa-solid fa-users"></i>
                        會員管理
                        <i class="arrow-icon fa-solid fa-angle-right"></i>
                    </a>

                    <ul class="sub-menu hidden">
                        <li>
                            <a href="#" class="menu-item">會員列表</a>
                        </li>
                        <li>
                            <a href="#" class="menu-item">會員等級設定</a>
                        </li>
                        <li>
                            <a href="#" class="menu-item">會員權限設定</a>
                        </li>
                    </ul>

                </li>

                {{-- content-manage --}}
                <li>
                    <a class="menu-title" id="contentManage">
                        <i class="fa-solid fa-newspaper"></i>
                        主題內容管理
                        <i class="arrow-icon fa-solid fa-angle-right"></i>
                    </a>
                    <ul class="sub-menu hidden" id="contentManageMenu">
                        <li>
                            <a href="{{ route('content.index') }}"
                                class="menu-item {{ Request::routeIs('content.index') ? 'is-active' : '' }}
                                                 {{ Request::routeIs('content.edit') ? 'is-active' : '' }}
                                                 {{ Request::routeIs('section.show') ? 'is-active' : '' }}">
                                <i class="fa-solid fa-list-ul"></i>
                                文章列表
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('chapter.index') }}"
                                class="menu-item {{ Request::routeIs('chapter.index') ? 'is-active' : '' }}">
                                <i class="fa-solid fa-pager"></i>
                                章節管理
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('content.create') }}"
                                class="menu-item {{ Request::routeIs('content.create') ? 'is-active' : '' }}">
                                <i class="fa-solid fa-plus"></i>
                                新增文章
                            </a>
                        </li>
                    </ul>
                </li>

                {{-- TODO course-manage --}}
                <li>
                    <a href="#" class="menu-title" id="courseManage">
                        <i class="fa-solid fa-book"></i>
                        專欄課程管理
                        <i class="arrow-icon fa-solid fa-angle-right"></i>
                    </a>
                    <!-- Expandable link section, show/hide based on state. -->
                    <ul class="sub-menu hidden">
                        <li>
                            <a href="#" class="menu-item">Engineering</a>
                        </li>
                        <li>
                            <a href="#" class="menu-item">Human
                                Resources</a>
                        </li>
                        <li>
                            <a href="#" class="menu-item">Customer
                                Success</a>
                        </li>
                    </ul>
                </li>

                {{-- media --}}
                <li>
                    <a href="{{ route('mediaCategory.index') }}"
                        class="menu-title
                        {{ Request::routeIs('mediaCategory.index') ? 'is-active' : '' }}
                        {{ Request::routeIs('media*') ? 'is-active' : '' }}
                        {{ Request::routeIs('mediaFile*') ? 'is-active' : '' }}
                        {{ Request::routeIs('mediaCategory*') ? 'is-active' : '' }}"
                        id="mediaLibrary">
                        <i class="fa-solid fa-photo-film"></i>
                        媒體庫
                    </a>
                </li>

                {{-- TODO reply-manage --}}
                <li>
                    <a href="#" class="menu-title">
                        <i class="fa-solid fa-comment-dots"></i>
                        留言管理
                    </a>
                </li>

                {{-- keyword-manage --}}
                <li>
                    <a class="menu-title" id="keywordManage">
                        <i class="fa-solid fa-hashtag"></i>
                        關鍵字管理
                        <i class="arrow-icon fa-solid fa-angle-right"></i>
                    </a>

                    <ul class="sub-menu hidden" id="keywordMenu">
                        <li>
                            <a href="{{ route('category.index') }}"
                                class="menu-item {{ Request::routeIs('category.index') ? 'is-active' : '' }}">
                                <i class="fa-regular fa-object-group"></i>
                                關鍵字群組
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('keyword.index') }}"
                                class="menu-item {{ Request::routeIs('keyword.index') ? 'is-active' : '' }}">
                                <i class="fa-solid fa-list-ul"></i>
                                關鍵字列表
                            </a>
                        </li>
                    </ul>
                </li>

                {{-- TODO advertisement-manage --}}
                <li>
                    <a href="#" class="menu-title">
                        <i class="fa-solid fa-money-check"></i>
                        廣告管理
                    </a>
                </li>

                {{-- TODO trade-manage --}}
                <li>
                    <a class="menu-title" id="tradeManage">
                        <i class="fa-solid fa-sack-dollar"></i>
                        交易管理
                        <i class="arrow-icon fa-solid fa-angle-right"></i>
                    </a>
                    <!-- Expandable link section, show/hide based on state. -->
                    <ul class="sub-menu hidden">
                        <li>
                            <a href="#" class="menu-item">整體金融狀況</a>
                        </li>
                        <li>
                            <a href="#" class="menu-item">交易紀錄</a>
                        </li>
                    </ul>
                </li>

            </ul>

            @include('layouts.userinfo')

        </aside>
        <!-- Side Menu ends ------ -->

        <script src="{{ asset('javascript/locations/link-url.js') }}"></script>

        <!-- Breadcrumb start ----- -->
        <div class="ml-[240px]">
            @include('breadcrumbs')
        </div>
        <!-- Breadcrumb ends ------ -->

        {{-- 放置頁面內容 --}}
        <section class="relative ml-[240px] top-[68px]">

            @yield('content')

        </section>

    </section>


    {{-- import sideMenu js --}}
    <script src="{{ asset('javascript/beautyAsideMenu.js') }}"></script>

    {{-- import switch platformselect --}}

    <script src="{{ asset('javascript/locations/platformselect.js') }}"></script>

    {{-- locate page --}}
    <script>
        const locationName = "{{ Route::currentRouteName() }}";
        locationActive(locationName);
        console.log('locationName:', locationName);
    </script>

</html>
