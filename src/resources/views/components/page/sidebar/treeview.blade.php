<li class="nav-item has-treeview">
    <a class="nav-link {{ isset($page['class']) ? $page['class'] : '' }}"
        style="color:{{ ViewFunctions::convertToColorCode(config('mycustoms.presentation-domain.color_sidebar_item_text')) }}!important;">
        @if (isset($page['icon']))
            <i class="{{ $page['icon'] }} {{ isset($page['icon_class']) ? $page['icon_class'] : '' }}"></i>
        @endif
        <p class="{{ isset($page['title_class']) ? $page['title_class'] : '' }}">
            {{ ___($page['title']) }}
            <i class="fas fa-angle-left right"></i>
        </p>
    </a>

    <ul class="nav nav-treeview">
        @each('mycustom::components.page.sidebar.item', $item['children'], 'page')
    </ul>
</li>
