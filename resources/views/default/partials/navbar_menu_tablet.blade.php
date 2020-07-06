<ul class="navbar-nav mr-auto navbar-header-menu flex-row">
    @foreach(navbarMenuItemsDefinition() as $key => $menu)
        @if($key < 4)
        <li class="nav-item mr-4 position-relative">
            <a class="nav-link @if(count($menu['items'])) menu-parent @endif" 
                data-key="{{ $key + 1 }}" 
                href="{{ $menu['url'] ?: '' }}">
                {{ $menu['label'] }}
            </a>

            @if(count($menu['items']))
                <ul class="navbar-header-menu-items sub-menu-items position-absolute p-0 top-100">
                    @foreach($menu['items'] as $item)
                        <li class="d-flex align-items-center justify-content-between position-relative">
                            <a href="{{ $item['url'] ?: '' }}">
                                {{ $item['label'] }}
                            </a>
                            @if(count($item['items']))
                                <i class="text-default font-weight-bold ti-angle-right"></i>
                                <ul class="navbar-header-menu-items sub-menu-child-items position-absolute p-0 left-100 top-0">
                                    @foreach($item['items'] as $childItem)
                                        <li class="d-flex align-items-center justify-content-between position-relative">
                                            <a href="{{ $childItem['url'] ?: '' }}">
                                                {{ $childItem['label'] }}
                                            </a>
                                            @if(count($childItem['items']))
                                                <i class="text-default font-weight-bold ti-angle-right"></i>
                                                <ul class="navbar-header-menu-items sub-menu-child-child-items position-absolute p-0 left-100 top-0">
                                                    @foreach($childItem['items'] as $childChildItem)
                                                        <li>
                                                            <a href="{{ $childChildItem['url'] ?: '' }}">
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
        @endif
    @endforeach
</ul>
<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
</button>
<div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto navbar-header-menu">
        @foreach(navbarMenuItemsDefinition() as $key => $menu)
            @if($key > 3)
            <li class="nav-item mr-1 position-relative">
                <a class="nav-link @if(count($menu['items'])) menu-parent @endif" 
                    data-key="{{ $key + 1 }}" 
                    href="{{ $menu['url'] ?: '' }}">
                    {{ $menu['label'] }}
                </a>

                @if(count($menu['items']))
                    <ul class="navbar-header-menu-items sub-menu-items position-absolute p-0 top-100">
                        @foreach($menu['items'] as $item)
                            <li class="d-flex align-items-center justify-content-between position-relative">
                                <a href="{{ $item['url'] ?: '' }}">
                                    {{ $item['label'] }}
                                </a>
                                @if(count($item['items']))
                                    <i class="text-default font-weight-bold ti-angle-right"></i>
                                    <ul class="navbar-header-menu-items sub-menu-child-items position-absolute p-0 left-100 top-0">
                                        @foreach($item['items'] as $childItem)
                                            <li class="d-flex align-items-center justify-content-between position-relative">
                                                <a href="{{ $childItem['url'] ?: '' }}">
                                                    {{ $childItem['label'] }}
                                                </a>
                                                @if(count($childItem['items']))
                                                    <i class="text-default font-weight-bold ti-angle-right"></i>
                                                    <ul class="navbar-header-menu-items sub-menu-child-child-items position-absolute p-0 left-100 top-0">
                                                        @foreach($childItem['items'] as $childChildItem)
                                                            <li>
                                                                <a href="{{ $childChildItem['url'] ?: '' }}">
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
            @endif
        @endforeach
    </ul>
</div>