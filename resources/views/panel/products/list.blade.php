@extends('layouts.panel')

@section('breadcrumbs')
    <li class="breadcrumb-item"><a href="{{ route('main') }}">Кабинет</a></li>
    <li class="breadcrumb-item"><a href="{{ route('panel') }}">Панель управления</a></li>
    <li class="breadcrumb-item active" aria-current="page">Товары</li>
@endsection

@include('panel.aside')

@section('content')
    <div class="card border-0">
        <div class="card-header d-flex justify-content-between align-items-center border border-bottom-0">
            <div>Товары</div>
            <div>
                <a href="{{ route('add_product') }}" class="btn btn-outline-secondary">Добавить</a>
            </div>
        </div>

        @if (count($products))
            <table class="table table-bordered mb-0">
                <thead class="text-center table-info">
                <th>#</th>
                <th>Название</th>
                <th>Категория</th>
                <th></th>
                </thead>
                <tbody>
                @foreach ($products as $product)
                    <tr>
                        <td class="text-center align-middle small">{{ $product->id }}</td>
                        <td class="align-middle">
                            <b>{{ $product->title }}</b>
                        </td>
                        <td class="align-middle text-center">{{ $product->category->title }}</td>
                        <td class="text-center"><a class="btn btn-primary"
                                                   href="{{ route('show_product', $product->id) }}">Посмотреть</a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>

        @else
            <div class="card-body border rounded-bottom">
                Товаров нет, но Вы можете добавить <a href="{{ route('add_product') }}" class="link">новый</a>.
            </div>
        @endif

        @if ($products->hasPages())
            <div class="card-body pt-3 py-1 border border-top-0 rounded-bottom">
                {{ $products->links("pagination::bootstrap-4") }}
            </div>
        @endif
    </div>

    </div>
@endsection
