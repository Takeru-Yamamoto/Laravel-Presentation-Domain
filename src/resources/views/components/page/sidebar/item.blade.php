@if (!isset($page['can']) || (isLoggedIn() && userCan($page['can'])))
    @if (isset($page['children']))
        @include('mycustom::components.page.sidebar.treeview', ['page' => $page])
    @else
        @include('mycustom::components.page.sidebar.link', ['page' => $page])
    @endif
@endif
