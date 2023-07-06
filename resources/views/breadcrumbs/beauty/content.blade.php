<li
    class="{{ Request::routeIs('content.index') ? 'is-active' : '' }}
            {{ Request::routeIs('section.show') ? 'is-active' : '' }}
">

    <span>
        <i class="fa-solid fa-arrow-right"></i>
    </span>

    <a href="{{ route('content.index') }}">
        <span>
            <i class="fa-solid fa-list-ul"></i>
        </span>
        <span> 文章列表 </span>
    </a>
</li>
