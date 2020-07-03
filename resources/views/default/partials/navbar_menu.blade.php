<ul class="navbar-nav mr-auto navbar-header-menu flex-wrap">
    @foreach(navbarMenuItemsDefinition() as $key => $menu)
        <li class="nav-item mr-1 position-relative">
            <a class="nav-link @if(count($menu['items'])) menu-parent @endif" 
                data-key="{{ $key + 1 }}" 
                href="{{ $menu['route_name'] ? route($menu['route_name']) : '' }}">
                {{ $menu['label'] }}
            </a>

            @if(count($menu['items']))
                <ul class="navbar-header-menu-items sub-menu-items position-absolute p-0 top-100">
                    @foreach($menu['items'] as $item)
                        <li class="d-flex align-items-center justify-content-between position-relative">
                            <a href="{{ $item['route_name'] ? route($item['route_name']) : '' }}">
                                {{ $item['label'] }}
                            </a>
                            @if(count($item['items']))
                                <i class="text-default font-weight-bold ti-angle-right"></i>
                                <ul class="navbar-header-menu-items sub-menu-child-items position-absolute p-0 left-100 top-0">
                                    @foreach($item['items'] as $childItem)
                                        <li class="d-flex align-items-center justify-content-between position-relative">
                                            <a href="{{ $childItem['route_name'] ? route($childItem['route_name']) : '' }}">
                                                {{ $childItem['label'] }}
                                            </a>
                                            @if(count($childItem['items']))
                                                <i class="text-default font-weight-bold ti-angle-right"></i>
                                                <ul class="navbar-header-menu-items sub-menu-child-child-items position-absolute p-0 left-100 top-0">
                                                    @foreach($childItem['items'] as $childChildItem)
                                                        <li>
                                                            <a href="{{ $childChildItem['route_name'] ? route($childChildItem['route_name']) : '' }}">
                                                                {{ $childChildItem['label'] }}
                                                            </a>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            @endif
                                        </li>
                                    @endforeach
                                </ul>
                            @endif
                        </li>
                    @endforeach
                </ul>
            @endif
        </li>
    @endforeach
</ul>
