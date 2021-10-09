@extends('layouts.app')

@section('breadcrumbs')
    <li class="breadcrumb-item"><a href="{{ route('main') }}">Кабинет</a></li>
    <li class="breadcrumb-item"><a href="{{ route('panel') }}">Панель управления</a></li>
    <li class="breadcrumb-item active" aria-current="page">Категории</li>
@endsection

@include('panel.aside')

@section('content')

    <div class="card-header d-flex justify-content-between align-items-center">
        <div>Категории</div>
        <div>
            <a href="{{ route('add_category') }}" class="btn btn-dark">Добавить</a>
        </div>
    </div>
    <div class="card-body">
        @if (is_array($categories) && $categories)
            <table class="table">
                <thead>
                <th>#</th>
                <th>Name</th>
                <th>Description</th>
                <th></th>
                </thead>
                <tbody>
                @foreach ($categories as $category)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $category->title }}</td>
                        <td>{{ $category->description }}</td>
                        <td><a class="btn btn-primary"
                               href="{{ route('show_category', $category->id) }}">Посмотреть</a></td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @else
            Категорий нет, но Вы можете добавить <a href="{{ route('add_category') }}" class="link">новую</a>
            .
        @endif
    </div>

@endsection
