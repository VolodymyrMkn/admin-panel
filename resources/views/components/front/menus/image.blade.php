<li class="nav-item">
    <a href="{{ '/'.$langSlug.$option?->link ?? '' }}" class="nav-link menu-link">{{ $option?->title ?? '' }}</a>
    <img src="{{ $option->img }}" alt="" class="menu-image">
</li>



<style>
    .menu-image {
        display: none;
    }
    .menu-link:hover ~ .menu-image{
        display: block;
    }
</style>
