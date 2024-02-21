@if (session()->has('status'))
    <div>
        <div class="alert alert-{{ $status == "error" ? "danger" : "success" }} alert-dismissible fade show" role="alert">
            {!! $message !!}
            <button type="button" class="close btn-close" data-bs-dismiss="alert" aria-label="Close">
                @role('Administrator')
                <span aria-hidden="true">&times;</span>
                @endrole
            </button>
        </div>
    </div>
@endif  