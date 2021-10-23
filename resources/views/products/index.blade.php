@extends('layouts.app')

@section('title', 'Все товары')

@section('breadcrumbs')
    <div class="row">
        <div class="col-12">
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('index') }}">Главная</a></li>
                <li class="breadcrumb-item active" aria-current="page">Все товары</li>
            </ul>
        </div>
    </div>
@endsection


@section('content')
    <div class="col-12">
        <div class="text-secondary"><h5>Товары</h5></div>
        @if (isset($products) && $products->count())
            <div class="card-group" style="margin-left: -15px; margin-right: -15px">
                <div id="products" class="row w-100 mx-0 card__product" data-action="{{ route('basket') }}">
                    @foreach ($products as $product)
                        <div class="col-lg-3 col-md-4 col-sm-6 pb-3">
                            <div class="card">
                                <a href="{{ route('product_show', $product->alias) }}">
                                    <div class="products__photo">
                                        @if ($product->photos->count())
                                            <img class=""
                                                 src="{{ asset('storage/' . $product->photos->first()->image ) }}"
                                                 alt="no image">
                                        @else
                                            <img class="" src="{{ asset('images/no-image.png') }}"
                                                 alt="no image">
                                        @endif
                                    </div>
                                </a>
                                <div class="card-body border-top">
                                    <div class="card-title">
                                        <a href="{{ route('product_show', $product->alias) }}"
                                           class="card-link">{{ $product->title }}</a>
                                    </div>
                                    <div class="card-subtitle text-secondary">
                                        @if ($product->category->getParentsNames() !== $product->category->title)
                                            @foreach ($product->category->getParentsNames()->reverse() as $item)
                                                {{ $item->title . " / " }}
                                            @endforeach
                                        @endif
                                        {{ $product->category->title }}
                                    </div>
                                    <div class="card-text d-flex justify-content-between align-items-center">
                                        <span><b>{{ $product->amount }} ₴</b></span>
                                        <button type="button" class="btn btn-primary" data-id="{{ $product->id }}"><i
                                                class="bi bi-cart-plus"></i> В корзину
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @else
            <div class="card">
                <div class="card-body text-center">Товаров пока нет...</div>
            </div>
        @endif
        @if ($products->hasPages())
            <div class="pt-2">
                {{ $products->links("pagination::bootstrap-4") }}
            </div>
        @endif
    </div>
    @include('layouts.copyright')
@endsection
@section('scripts')
    <script src="{{ asset('js/basket.js') }}"></script>
@endsection
