@extends('layouts.app')

@section('title', 'Все товары')

@section('breadcrumbs')
    <div class="row">
        <div class="col-12">
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('index') }}">Главная</a></li>
                <li class="breadcrumb-item active" aria-current="page">Категории</li>
            </ul>
        </div>
    </div>
@endsection


@section('content')
    <div class="col-12">
        <div class="text-secondary"><h5>Категории</h5></div>
        @if (isset($categories) && $categories->count())
            <div class="list-group">
                <div class="row">
                    @foreach($categories as $category)
                        <div class="col-sm-6 col-12 pb-2">
                            <a href="{{ route('category_show', $category->alias) }}"
                               class="list-group-item list-group-item-action">
                                <div class="text-center">
                                    <h5 class="mb-0"><i class="bi {{ (isset($category->subs) && $category->subs->count()) ? "bi-tags" : "bi-tag"}} pr-2"></i> {{ $category->title }}
                                        <span class="ml-auto badge badge-light align-self-center">{{ $category->products->count() }}</span></h5>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        @else
            <div class="card">
                <div class="card-body text-center">Категорий пока нет...</div>
            </div>
        @endif
        @if ($categories->hasPages())
            <div class="pt-2">
                {{ $categories->links("pagination::bootstrap-4") }}
            </div>
        @endif
    </div>
    @include('layouts.copyright')
@endsection
