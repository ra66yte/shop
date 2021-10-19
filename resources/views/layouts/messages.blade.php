<div id="header-messages" class="row px-3">
    @if (session('success'))
        <div class="alert alert-success w-100 text-center alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>

        </div>
    @endif

</div>
