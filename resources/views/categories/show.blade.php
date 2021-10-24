@extends('layouts.app')

@section('title', $category->title)

@section('breadcrumbs')
    <div class="row">
        <div class="col-12">
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('index') }}">Главная</a></li>
                <li class="breadcrumb-item"><a href="{{ route('categories_list') }}">Категории</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ $category->title }}</li>
            </ul>
        </div>
    </div>
@endsection

@section('content')

    <div class="col-12">
        <div class="card text-center py-4">
            <div class="card-title">
                <h1>{{ $category->title }}</h1>
            </div>

            @if ($category->getParentsNames() !== $category->title)
                <div class="card-subtitle text-secondary">
                    @foreach ($category->getParentsNames()->reverse() as $item)
                        {{ $item->title . (!$loop->last ? " / " : "") }}
                    @endforeach
                </div>
            @endif


            <div class="card-text">
                {{ $category->description }}
            </div>
        </div>
    </div>

    <div class="col-12 pt-2">
        @if (isset($subcategories) && $subcategories->count())
            <div class="pt-1 pb-3 text-secondary"><h5 class="mb-0">В этой категории</h5></div>
            <div class="list-group">
                <div class="row">
                    @foreach($subcategories as $category)
                       <div class="col-lg-4 col-md-6 pb-2">
                           <a href="{{ route('category_show', $category->alias) }}"
                              class="list-group-item list-group-item-action d-flex justify-content-between">
                               <i class="bi {{ (isset($category->subs) && $category->subs->count()) ? "bi-tags" : "bi-tag"}} pr-2"></i> {{ $category->title }}
                               <span
                                   class="ml-auto badge badge-light align-self-center">{{ $category->products->count() }}</span>
                           </a>
                       </div>
                    @endforeach
                </div>
            </div>
        @endif
        <div class="pt-1 pb-3 text-secondary"><h5 class="mb-0">Товары</h5></div>
        @if (isset($products) && $products->count())
            <div class="card-group" style="margin-left: -15px; margin-right: -15px">
                <div id="products" class="row w-100 mx-0" data-action="{{ route('basket') }}">
                    @foreach ($products as $product)
                        <div class="col-lg-3 col-6 pb-3">
                            @include('layouts.product_card')
                        </div>
                    @endforeach
                </div>
            </div>
        @else
            <div class="card">
                <div class="card-body">
                    В этой категории товары отсутствуют...
                </div>
            </div>
        @endif
        @if ($products->hasPages())
            <div class="pt-3">
                {{ $products->links("pagination::bootstrap-4") }}
            </div>
        @endif
    </div>
    @include('layouts.copyright')
@endsection
@section('scripts')
    <script src="{{ asset('js/basket.js') }}"></script>
@endsection
