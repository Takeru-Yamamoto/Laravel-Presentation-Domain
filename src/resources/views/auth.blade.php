@extends('mycustom::base', ['bodyClass' => 'login-page'])

@section('body')
    <div class="login-box">
        <div class="login-logo">
            @if (config('mycustoms.presentation-domain.view_icon'))
                <img src="{{ config('mycustoms.presentation-domain.icon_path') }}"
                    alt="{{ config('mycustoms.presentation-domain.site_name') }}" height="50">
            @endif
            <span>{{ config('mycustoms.presentation-domain.site_name') }}</span>
        </div>

        @include('mycustom::components.alert')

        <div class="card card-outline card-primary">
            @yield('auth-card')
        </div>
    </div>
@stop
