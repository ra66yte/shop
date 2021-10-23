@extends('layouts.app')

@section('title', $product->title)

@section('breadcrumbs')
    <div class="row">
        <div class="col-12">
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('index') }}">Главная</a></li>
                <li class="breadcrumb-item"><a href="{{ route('products_list') }}">Товары</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ $product->title }}</li>
            </ul>
        </div>
    </div>
@endsection

@section('content')

    <div class="col-lg-5 col-md-4 col-sm-4">
        <div class="card">
            @if (isset($product->photos) && $product->photos->count())
                @if ($product->photos->count() > 1)
                    <div id="carouselProduct" class="carousel slide" data-ride="carousel">
                        <ol class="carousel-indicators">
                            @foreach ($product->photos as $photo)
                                <li data-target="#carouselProduct" data-slide-to="{{ $loop->index }}" {{ $loop->iteration == 1 ? 'class="active"' : ''  }}></li>
                            @endforeach
                        </ol>
                        <div class="carousel-inner">
                            @foreach ($product->photos as $photo)
                                <div class="carousel-item {{ $loop->iteration == 1 ? "active" : "" }} products__photo">
                                    <img src="{{ asset('storage/' . $photo->image) }}" alt="img">
                                </div>
                            @endforeach
                            <a class="carousel-control-prev" href="#carouselProduct" role="button" data-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="sr-only">Предыдущий</span>
                            </a>
                            <a class="carousel-control-next" href="#carouselProduct" role="button" data-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="sr-only">Следующий</span>
                            </a>
                        </div>
                    </div>
                @else
                    <div class="products__photo">
                        <img src="{{ asset('storage/' . $product->photos->first()->image) }}" alt="img">
                    </div>
                @endif
            @else
<!--                <div class="card-body">-->
                    <div class="products__photo">
                        <img src="{{ asset('images/no-image.png') }}" alt="no image">
                    </div>
<!--                </div>-->
            @endif
        </div>

    </div>
    <div class="col-lg-7 col-md-8 col-sm-8 pl-sm-0 pt-sm-0 pt-3">
        <div class="card h-100">
            <div class="card-body">
                <div class="card-title"><h3>{{ $product->title }}</h3></div>
                <div class="card-subtitle text-secondary">Артикул: {{ $product->alias }}</div>
                <div class="card-text">
                    Описание:
                    {{ $product->description }}

                </div>
            </div>
            <div class="text-center py-2">
                <h3><b>{{ $product->amount }} ₴</b></h3> <button id="add-product-to-basket" type="button" class="btn btn-primary" data-id="{{ $product->id }}" data-action="{{ route('basket') }}"><i class="bi bi-cart-plus"></i> В корзину</button>
            </div>
        </div>

    </div>

    @include('layouts.copyright')
@endsection
@section('scripts')
    <script src="{{ asset('js/basket.js') }}"></script>
@endsection
