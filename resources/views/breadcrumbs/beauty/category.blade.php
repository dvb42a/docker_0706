
<li class="{{ Request::routeIs('category.index') ? 'is-active' : '' }}">
    <span>
        <i class="fa-solid fa-arrow-right"></i>
    </span>

    <a href="{{route('category.index')}}">
        <span>
            <i class="fa-regular fa-object-group"></i>
        </span>
        <span> 關鍵字群組 </span>
    </a>
</li>
