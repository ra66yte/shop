<div id="header-messages">
    @if (session('success'))
        <div class="alert alert-success text-center alert-dismissible fade show px-3 mt-1" role="alert">
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>

        </div>
    @endif
    @if (session('warning'))
        <div class="alert alert-danger text-center alert-dismissible fade show px-3 mt-1 mb-1" role="alert">
            {{ session('warning') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>

        </div>
    @endif

</div>
