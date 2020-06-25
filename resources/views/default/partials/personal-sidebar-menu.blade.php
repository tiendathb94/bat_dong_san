<div class="personal-menu-wrapper mt-3">
    @foreach(personalMenuItemsDefinition() as $menu)
        <div>
            @php($items = getAllItemsHasPermission($menu['items']))
            @if ($items &&count($items)>0)
                <h4 class="personal-menu-heading">{{$menu['heading']}}</h4>
                <ul>
                    @foreach($items as $item)
                        <li>
                            <span class="ti-link"></span>
                            <a href="{{$item['link']}}">
                                {{$item['label']}}
                            </a>
                        </li>
                    @endforeach
                </ul>
            @endif
        </div>
    @endforeach
</div>
