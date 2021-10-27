<aside class="col-lg-3 col-md-4 pr-md-0 pt-md-0 pt-2 pb-3 order-md-first order-last">
    <div class="card text-center">
        <img class="card-img-top" src="{{ asset('images/no_photo.png') }}" width="50px" alt="photo">
        <div class="card-body pt-1">
            <div class="card-title">
                {{ Auth::user()->last_name . ' ' . Auth::user()->first_name . ' ' . Auth::user()->middle_name }}
            </div>
            <div class="card-subtitle">
                <b class="text-secondary">{{ Auth::user()->email }}</b>
            </div>
        </div>

    </div>
    <div class="list-group pt-2">
        <a href="#" class="list-group-item list-group-item-action">
            <i class="bi bi-gear pr-2"></i> Настройки
        </a>
    </div>
    @include('layouts.copyright')
</aside>
