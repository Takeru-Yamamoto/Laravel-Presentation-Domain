<li class="nav-item">
    <a class="nav-link {{ isset($page['class']) ? $page['class'] : '' }}"
        @if (isset($page['route'])) href="{{ url()->route($page['route']) }}"
        @elseif(isset($page['url'])) href="{{ url($page['url']) }}"
        @elseif(isset($page['link'])) href="{{ $page['link'] }}" @endif
        style="color:{{ ViewFunctions::convertToColorCode(config('mycustoms.presentation-domain.color_sidebar_item_text')) }}!important;
                            {{ isset($page['route']) && url()->route($page['route']) === url()->current()
                                ? 'background-color:' .
                                    ViewFunctions::convertToColorCode(config('mycustoms.presentation-domain.color_sidebar_item')) .
                                    '!important;'
                                : '' }}">
        @if (isset($page['icon']))
            <i class="{{ $page['icon'] }} {{ isset($page['icon_class']) ? $page['icon_class'] : '' }}"></i>
        @endif
        <p class="{{ isset($page['title_class']) ? $page['title_class'] : '' }}">{{ ___($page['title']) }}</p>
    </a>
</li>
