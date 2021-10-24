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
                            @include('layouts.product_card')
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
