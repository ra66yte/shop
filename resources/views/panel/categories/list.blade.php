@extends('layouts.panel')

@section('breadcrumbs')
    <li class="breadcrumb-item"><a href="{{ route('main') }}">Кабинет</a></li>
    <li class="breadcrumb-item"><a href="{{ route('panel') }}">Панель управления</a></li>
    <li class="breadcrumb-item active" aria-current="page">Категории</li>
@endsection

@include('panel.aside')

@section('content')
    <div class="card border-0">
        <div class="card-header d-flex justify-content-between align-items-center border border-bottom-0">
            <div>Категории</div>
            <div>
                <a href="{{ route('panel_category_add') }}" class="btn btn-outline-secondary">Добавить</a>
            </div>
        </div>
        @if (count($categories))
            <table class="table table-bordered mb-0">
                <thead class="text-center table-info">
                <th>#</th>
                <th>Название</th>
                <th>Описание</th>
                <th></th>
                </thead>
                <tbody>
                @foreach ($categories as $category)
                    <tr>
                        <td class="text-center align-middle small">{{ $category->id }}</td>
                        <td class="align-middle">
                            @if ($category->getParentsNames() !== $category->title)
                                @foreach ($category->getParentsNames()->reverse() as $item)
                                    {{ $item->title . " / " }}
                                @endforeach
                            @endif
                            <b>{{ $category->title }}</b>
                        </td>
                        <td class="align-middle">{{ $category->description }}</td>
                        <td class="text-center"><a class="btn btn-primary"
                                                   href="{{ route('panel_category_show', $category->id) }}">Посмотреть</a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>

        @else
            <div class="card-body border rounded-bottom">
                Категорий нет, но Вы можете добавить <a href="{{ route('panel_category_add') }}" class="link">новую</a>.
            </div>
        @endif

        @if ($categories->hasPages())
            <div class="card-body pt-3 py-1 border border-top-0 rounded-bottom">
                {{ $categories->links("pagination::bootstrap-4") }}
            </div>
        @endif
    </div>

    </div>



@endsection
