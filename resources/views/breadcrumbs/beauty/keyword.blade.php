
<li class="{{ Request::routeIs('keyword.index') ? 'is-active' : '' }}">
    <span>
        <i class="fa-solid fa-arrow-right"></i>
    </span>

    <a href="{{route('keyword.index')}}">
        <span>
            <i class="fa-solid fa-hashtag"></i>
        </span>
        <span> 關鍵字列表 </span>
    </a>
</li>
