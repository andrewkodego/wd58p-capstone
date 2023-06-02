@foreach($consoleMenus as $menu)
<x-nav-link :href="route($menu->route)" :active="request()->routeIs($menu->route)">
    {{ __($menu->name) }}
</x-nav-link>
@endforeach