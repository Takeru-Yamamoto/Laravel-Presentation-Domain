<nav class="main-header navbar navbar-expand"
    style="background-color:{{ ViewFunctions::convertToColorCode(config('mycustoms.presentation-domain.color_navbar')) }}!important;">
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link"
                style="color:{{ ViewFunctions::convertToColorCode(config('mycustoms.presentation-domain.color_navbar_text')) }}!important;"
                data-widget="pushmenu">
                <i class="fa-solid fa-bars"></i>
                <span class="sr-only"></span>
            </a>
        </li>
    </ul>

    <ul class="navbar-nav ml-auto">
        <li class="nav-item dropdown user-menu">
            <a class="nav-link dropdown-toggle pointer"
                style="color:{{ ViewFunctions::convertToColorCode(config('mycustoms.presentation-domain.color_navbar_text')) }}!important;"
                data-toggle="dropdown" data-bs-toggle="dropdown" aria-expanded="false">
                <span>{{ isLoggedIn() ? authUserName() : ___('mycustom.word.guest') }}</span>
            </a>
            <ul class="dropdown-menu dropdown-menu-lg-end" aria-labelledby="dropdownMenuLink">
                @if (View::hasSection('usermenu_header') && config('mycustoms.presentation-domain.usermenu_header'))
                    <li class="user-header">
                        @yield('usermenu_header')
                    </li>
                @endif
                @if (View::hasSection('usermenu_body') && config('mycustoms.presentation-domain.usermenu_body'))
                    <li class="user-body">
                        @yield('usermenu_body')
                    </li>
                @endif
                <li class="user-footer">
                    @if (View::hasSection('usermenu_footer') && config('mycustoms.presentation-domain.usermenu_footer'))
                        @yield('usermenu_footer')
                    @endif
                    @if (isLoggedIn() && config('mycustoms.presentation-domain.btn_logout'))
                        <a class="btn btn-default btn-flat float-right btn-block logout-btn">
                            <i class="fa-solid fa-power-off"></i>
                            {{ ___('mycustom.word.logout') }}
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                        </form>
                    @endif
                    @if (!isLoggedIn() && config('mycustoms.presentation-domain.btn_logout'))
                        <a class="btn btn-default btn-flat float-right btn-block" href="{{ route('showLoginForm') }}">
                            <i class="fa-solid fa-right-to-bracket"></i>
                            {{ ___('mycustom.word.login') }}
                        </a>
                    @endif
                </li>
            </ul>
        </li>
    </ul>
</nav>
