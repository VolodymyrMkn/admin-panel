<li class="nav-item dropdown">
    <a class="nav-link" href="{{ '/'.$langSlug.$option?->link ?? '' }}">{{ $option?->title ?? '' }}<i class="fas fa-angle-down ml-1"></i></a>
    <ul class="dropdown-menu">
        @foreach($menus as $menu)
            <li class="nav-item"><a href="{{ '/'.$langSlug.$menu->option?->link ?? '' }}" class="nav-link">{{ $menu->option?->title ?? '' }}</a></li>
        @endforeach
    </ul>
</li>
