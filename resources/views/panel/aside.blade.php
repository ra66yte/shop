@section('aside')
        <div class="list-group">
            <a href="{{ route('panel') }}" class="list-group-item list-group-item-action @if (Route::is('panel')) active disabled @endif">
                Главная
            </a>
            <a href="{{ route('panel_cat_list') }}" class="list-group-item list-group-item-action {{ Route::is('panel_cat_list') ? 'active' : null }} @if (!Auth::user()->hasPermission('manage-categories')) disabled @endif">Категории</a>
            <a href="{{ route('panel_products_list') }}" class="list-group-item list-group-item-action {{ Route::is('panel_products_list') ? 'active' : null }} @if (!Auth::user()->hasPermission('manage-products')) disabled @endif">Товары</a>
            <a href="#" class="list-group-item list-group-item-action @if (!Auth::user()->hasPermission('manage-orders')) disabled @endif">Заказы</a>
            <a href="#" class="list-group-item list-group-item-action @if (!Auth::user()->hasPermission('manage-users')) disabled @endif">Клиенты</a>
        </div>
        @include('layouts.copyright')
@endsection
