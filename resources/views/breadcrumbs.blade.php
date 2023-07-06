<!-- Breadcrumb start ----- -->
<nav class="breadcrumb" aria-label="breadcrumbs">
    <ul>

        @switch(Route::currentRouteName())

            {{-- ===== Beauty ===== --}}

            {{-- ===== Dashboard===== --}}
            @case('admin.beauty.main')
                @include('breadcrumbs.beauty.index')
            @break

            {{-- ===== 網站設定 ===== --}}
            {{-- 首頁設定 --}}
            @case('admin.beauty.pagesetting')
                @include('breadcrumbs.beauty.index')
                @include('breadcrumbs.beauty.pageSetting')
            @break

            {{-- 更換 baneer --}}
            @case('bannersetting.index')
                @include('breadcrumbs.beauty.index')
                @include('breadcrumbs.beauty.bannerSetting')
            @break;


            {{-- ===== content ===== --}}
            {{-- 章節管理 --}}
            @case('chapter.index')
                @include('breadcrumbs.beauty.index')
                @include('breadcrumbs.beauty.chapter')
            @break

            {{-- 文章列表 --}}
            @case('content.index')
                @include('breadcrumbs.beauty.index')
                @include('breadcrumbs.beauty.content')
            @break

            @case('section.show')
                @include('breadcrumbs.beauty.index')
                @include('breadcrumbs.beauty.content')
            @break


            {{-- 編輯文章 --}}
            @case('content.edit')
                @include('breadcrumbs.beauty.index')
                @include('breadcrumbs.beauty.content')
                @include('breadcrumbs.beauty.contentEdit')
            @break

            {{-- 新增文章--}}
            @case('content.create')
                @include('breadcrumbs.beauty.index')
                @include('breadcrumbs.beauty.contentEdit')
            @break
            {{-- 文章垃圾桶 --}}
            @case('section.softdeleteIndex')
                @include('breadcrumbs.beauty.index')
                @include('breadcrumbs.beauty.content')
            @break

            {{-- ===== media ===== --}}
            {{-- 類別列表 --}}
            @case('mediaCategory.index')
                @include('breadcrumbs.beauty.index')
                @include('breadcrumbs.beauty.mediaCategory')
            @break

            {{-- 新增類別 --}}
            @case('mediaCategory.create')
                @include('breadcrumbs.beauty.index')
                @include('breadcrumbs.beauty.mediaCategory')
                @include('breadcrumbs.beauty.mediaCategoryCreate')
            @break

            {{-- 媒體列表 --}}
            @case('mediaFile.show')
                @include('breadcrumbs.beauty.index')
                @include('breadcrumbs.beauty.mediaCategory')
                @include('breadcrumbs.beauty.mediaFile')
            @break

            {{-- 媒體資訊 --}}
            @case('media.edit')
                @include('breadcrumbs.beauty.index')
                @include('breadcrumbs.beauty.mediaCategory')
                @include('breadcrumbs.beauty.mediaFile')
                @include('breadcrumbs.beauty.mediaEdit')
            @break

            {{-- 新增媒體 --}}
            @case('media.show')
                @include('breadcrumbs.beauty.index')
                @include('breadcrumbs.beauty.mediaCategory')
                @include('breadcrumbs.beauty.mediaFile')
                @include('breadcrumbs.beauty.mediaCreate')
            @break

            {{-- 媒體庫垃圾桶 --}}
            @case('mediaFile.mediaFileTrash')
                @include('breadcrumbs.beauty.index')
                @include('breadcrumbs.beauty.mediaCategory')
                @include('breadcrumbs.beauty.mediaDelete')
            @break

            {{-- ===== keyword ===== --}}
            {{-- 關鍵字群組 --}}
            @case('category.index')
                @include('breadcrumbs.beauty.index')
                @include('breadcrumbs.beauty.category')
            @break

            {{-- 關鍵字群組設定 --}}
            @case('category.edit')
                @include('breadcrumbs.beauty.index')
                @include('breadcrumbs.beauty.category')
                @include('breadcrumbs.beauty.categoryshow')
            @break


            {{-- 關鍵字列表 --}}
            @case('keyword.index')
                @include('breadcrumbs.beauty.index')
                @include('breadcrumbs.beauty.keyword')
            @break

            {{-- 關聯字關聯列表 --}}
            @case('keyword.show')
                @include('breadcrumbs.beauty.index')
                @include('breadcrumbs.beauty.keyword')
                @include('breadcrumbs.beauty.keywordshow')
            @break


            {{-- ===== Account ===== --}}
            {{-- 帳號資料 --}}
            @case('admin.main')
                @include('breadcrumbs.account.index')
            @break

            {{-- 登入紀錄 --}}
            @case('account.loginhistory')
                @include('breadcrumbs.account.index')
                @include('breadcrumbs.account.log')
            @break

            {{-- 變更 email --}}
            @case('account.newemail')
                @include('breadcrumbs.account.index')
                @include('breadcrumbs.account.email')
            @break

            {{-- 重設密碼 --}}
            @case('account.renewpassword')
                @include('breadcrumbs.account.index')
                @include('breadcrumbs.account.password')
            @break


            {{-- ===== Center ===== --}}
            {{-- Dashboard --}}
            @case('admin.center.main')
                @include('breadcrumbs.center.index')
            @break

            {{-- 管理員帳號列表 --}}
            @case('admins.index')
                @include('breadcrumbs.center.index')
                @include('breadcrumbs.center.adminlist')
            @break

            {{-- 新增管理員 --}}
            @case('admins.create')
                @include('breadcrumbs.center.index')
                @include('breadcrumbs.center.adminlist')
                @include('breadcrumbs.center.create_admin')
            @break

        @endswitch
    </ul>
</nav>
<!-- Breadcrumb ends ------ -->
