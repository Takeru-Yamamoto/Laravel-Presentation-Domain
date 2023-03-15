<div class="content-wrapper"
    style="background-color:{{ ViewFunctions::convertToColorCode(config('mycustoms.presentation-domain.color_content')) }};color:{{ ViewFunctions::convertToColorCode(config('mycustoms.presentation-domain.color_content_text')) }};">
    <div class="content-header">
        <div class="container-fluid">
            <h1>@yield('page-header')</h1>
        </div>
    </div>

    <div class="content">
        <div class="container-fluid">
            @include('mycustom::components.alert')

            @yield('modal')
            @yield('contents')
        </div>
    </div>
</div>
