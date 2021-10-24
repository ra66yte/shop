@extends('layouts.app')

@section('title', 'Главная страница')

@section('content')
    <aside class="col-lg-3 col-md-4 pr-md-0 pt-md-2 pt-0 pb-3 order-md-first order-last">
        <div class="py-2 text-secondary"><h5>Категории</h5></div>
        @if (isset($categories) && $categories->count())
            <div class="list-group">
                @foreach($categories as $category)
                    <a href="{{ route('category_show', $category->alias) }}"
                       class="list-group-item list-group-item-action d-flex justify-content-between">
                        <i class="bi bi-tags pr-2"></i> {{ $category->title }}
                        <span
                            class="ml-auto badge badge-light align-self-center">{{ $category->products->count() }}</span>
                    </a>
                    @if ($category->sub->count())
                        @include('categories.subcategories_list', ['subcategories' => $category->sub,
                                                              'prefix' => $category->title])
                    @endif
                @endforeach
            </div>
        @else
            <div class="card">
                <div class="card-body">
                    Категорий нет...
                </div>
            </div>
        @endif
        @include('layouts.copyright')
    </aside>

    <div class="col-lg-9 col-md-8 pt-2 /*pl-md-0*/">
        <div class="py-2 text-secondary"><h5>Товары</h5></div>
        @if (isset($products) && $products->count())
            <div class="card-group" style="margin-left: -15px; margin-right: -15px">
                <div id="products" class="row w-100 mx-0 card__product" data-action="{{ route('basket') }}">
                    @foreach ($products as $product)
                        <div class="col-lg-4 col-md-6 col-sm-6 pb-3">
                            @include('layouts.product_card')
                        </div>
                    @endforeach
                </div>
            </div>
        @else
            <div class="card">
                <div class="card-body">
                    Товаров нет...
                </div>
            </div>
        @endif
        @if ($products->hasPages())
            <div class="pt-2">
                {{ $products->links("pagination::bootstrap-4") }}
            </div>
        @endif
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('js/basket.js') }}"></script>
@endsection
