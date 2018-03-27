@if($flash = session('message'))
    <div class="alert alert-success alert-dismissible fade show" id="flash-message" role="alert">
        {{ $flash }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif