@vite('resources/css/app.css')
@vite('resources/css/layout.css')
@vite('resources/css/components/Nav.css')
@vite('resources/css/components/SideMenu.css')
@vite('resources/css/components/Breadcrumb.css')

<!-- Nav start ----- -->
<nav class="nav z-20" role="navigation" aria-label="main navigation">
    <div>
        <a class="nav-title" href="{{ route('admin.main') }}" id="DisplayPlatform">
            <i class="fa-solid fa-user"></i>
            <span> Kings管理員帳號個人頁面</span>
        </a>
    </div>
</nav>

<!-- Nav ends ------ -->
<script src="{{ asset('javascript/locations/check-location.js') }}"></script>
<script src="{{ asset('javascript/locations/platformselect.js') }}"></script>
