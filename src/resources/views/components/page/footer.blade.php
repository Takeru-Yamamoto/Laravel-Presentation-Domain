@if (config('mycustoms.presentation-domain.page_footer'))
    <footer class="main-footer">
        @if (View::hasSection('footer'))
            @yield('footer')
        @else
            <p class="m-0 text-right">{{ ViewFunctions::pageFooter() }}</p>
        @endif
    </footer>
@endif
