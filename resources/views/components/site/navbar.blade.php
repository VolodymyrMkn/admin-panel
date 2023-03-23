<ul class="navbar-nav items">
    @foreach($menus as $menu)

        <x-dynamic-component
            :component="'front.menus.'.$menu->template->slug"
            :option="$menu->option"
            :menus="$menu->menus"
            :$langSlug
        />

    @endforeach
</ul>
