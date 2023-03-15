<aside class="main-sidebar elevation-4"
    style="background-color:{{ ViewFunctions::convertToColorCode(config('mycustoms.presentation-domain.color_sidebar')) }}!important;">
    <a href="{{ route('home') }}" class="brand-link border-bottom border-gray"
        style="color:{{ ViewFunctions::convertToColorCode(config('mycustoms.presentation-domain.color_sidebar_title')) }}!important;">
        @if (config('mycustoms.presentation-domain.view_icon'))
            <img src="{{ config('mycustoms.presentation-domain.icon_path') }}" alt="{{ config('mycustoms.presentation-domain.site_name') }}"
                class="brand-image img-circle elevation-3">
        @endif
        <span class="brand-text font-weight-light">{{ config('mycustoms.presentation-domain.site_name') }}</span>
    </a>

    <div class="sidebar">
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                
                @each('mycustom::components.page.sidebar.item', config('mycustoms.presentation-domain.pages'), 'page')

            </ul>
        </nav>
    </div>
</aside>
