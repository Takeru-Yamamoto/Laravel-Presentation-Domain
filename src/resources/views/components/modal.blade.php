<div class="modal fade" id="{{ $id }}" tabindex="-1" role="dialog" aria-hidden="true"
    @if (isset($autoHide) && !$autoHide) data-backdrop="static" @endif
    @if (isset($data) && is_array($data)) @foreach ($data as $key => $value) 
            data-{{ $key }}="{{ $value }}" 
        @endforeach @endif>
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    @yield('modal_title')
                </h5>
                @if (!isset($autoHide) || $autoHide)
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                @endif
            </div>
            <div class="modal-body">
                @yield('modal_body')
            </div>
            <div class="modal-footer">
                @yield('modal_footer')
            </div>
        </div>
    </div>
</div>
