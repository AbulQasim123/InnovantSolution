<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
        <a href="{{ route('dashboard') }}" wire:navigate class="menu-link">
                <h4>{{ config('ui.title') }}</h4>
        </a>
        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
            <i class="bx bx-chevron-left bx-sm align-middle"></i>
        </a>
    </div>

    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1">
        @foreach (config('menu') as $menu)
            <li
                class="menu-item {{ isset($menu['sub_menu']) && collect($menu['sub_menu'])->contains(fn($sub) => request()->routeIs($sub['route'])) ? 'active open' : (isset($menu['route']) && request()->routeIs($menu['route']) ? 'active' : '') }}">
                <a @if (isset($menu['route'])) href="{{ route($menu['route']) }}"
                wire:navigate
            @else
                href="javascript:void(0)" @endif
                    class="menu-link {{ isset($menu['sub_menu']) ? 'menu-toggle' : '' }}">
                    <i class="menu-icon tf-icons {{ $menu['icon'] }}"></i>
                    <div data-i18n="{{ $menu['title'] }}">{{ $menu['title'] }}</div>
                </a>
                @if (isset($menu['sub_menu']))
                    <ul class="menu-sub">
                        @foreach ($menu['sub_menu'] as $sub)
                            <li class="menu-item {{ request()->routeIs($sub['route']) ? 'active' : '' }}">
                                <a href="{{ route($sub['route']) }}" class="menu-link" wire:navigate>
                                    <div>{{ $sub['title'] }}</div>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                @endif
            </li>
        @endforeach
    </ul>
</aside>
