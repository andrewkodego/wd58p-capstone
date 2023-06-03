@foreach($consoleMenus as $menu)
@if($menu->userCanView)
<x-nav-link :href="route($menu->route)" :active="request()->routeIs($menu->route)">
    {{ __($menu->name) }}
</x-nav-link>
@endif
@endforeach