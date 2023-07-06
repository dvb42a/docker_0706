
<li class="{{ Request::routeIs('mediaCategory.index') ? 'is-active' : '' }}">

    <span>
        <i class="fa-solid fa-arrow-right"></i>
    </span>

    <a href="{{route('mediaCategory.index')}}">
        <span>
            <i class="fa-solid fa-photo-film"></i>
        </span>
        <span> 媒體庫 </span>
    </a>
</li>
