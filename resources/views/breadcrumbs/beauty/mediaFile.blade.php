<li class="{{ Request::routeIs('mediaFile.show') ? 'is-active' : '' }}">

    <span>
        <i class="fa-solid fa-arrow-right"></i>
    </span>

    <a href="{{route('mediaFile.show',$id)}}">
        <span>
            <i class="fa-solid fa-image"></i>
        </span>
        <span> {{$setting->kmc_name}} </span>
    </a>
</li>
