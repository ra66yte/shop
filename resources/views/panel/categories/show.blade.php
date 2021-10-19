@extends('layouts.panel')

@section('breadcrumbs')
    <li class="breadcrumb-item"><a href="{{ route('main') }}">Кабинет</a></li>
    <li class="breadcrumb-item"><a href="{{ route('panel') }}">Панель управления</a></li>
    <li class="breadcrumb-item"><a href="{{ route('panel_cat_list') }}">Категории</a></li>
    <li class="breadcrumb-item active" aria-current="page">{{ $category->title }}</li>
@endsection

@include('panel.aside')

@section('content')
    <div class="card">

        <div class="card-header">{{ $category->title }}</div>
        <div class="card-body">
            <div class="form-group">
                <input id="category-id" type="hidden" name="id" value="{{ $category->id }}">
                <div class="col px-0">
                    <p class="text" data-parent_id>
                        Подчиняется: @if (isset($category->parent)) {{ $category->parent->title }} @else
                            - @endif </p>
                    <label class="d-none"
                           for="parent_id">Подчиняется: </label> <select name="parent_id" id="parent_id"
                                                                         class="inp form-control d-none">
                        <option value="">- Не указано -</option>
                        @foreach($categories as $cat)
                            <option value="{{ $cat->id }}"
                                    {{$category->validParent($cat->id)}}
                                    @if (isset($category->parent) && $cat->id == $category->parent->id) selected @endif
                                    @if (!$category->validParent($cat->id)) disabled @endif
                            >{{ $cat->title }}</option>
                            @if (count($cat->sub))
                                @include('panel.categories.subcategories_list', ['subcategories' => $cat->sub,
                                                                      'prefix' => $cat->title,
                                                                      'disabled' => 1])
                            @endif
                        @endforeach
                    </select>
                    <span class="invalid-feedback" role="alert"><strong></strong></span>
                </div>
                <div class="col px-0 pt-2">
                    <p class="text" data-title>Название: {{ $category->title }}</p>
                    <label class="d-none" for="title">Название: </label> <input id="title"
                                                                                class="inp form-control d-none"
                                                                                type="text" name="title"
                                                                                value="{{ $category->title }}"
                                                                                data-name="Название">

                    <span class="invalid-feedback" role="alert"><strong></strong></span>
                </div>
                <div class="col px-0 pt-2">
                    <p class="text" data-desc>Описание: {{ $category->description }}</p>
                    <label class="d-none" for="desc">Описание: </label> <textarea id="desc"
                                                                                  class="inp form-control d-none"
                                                                                  name="desc"
                                                                                  data-name="Описание">{{ $category->description }}</textarea>
                    <span class="invalid-feedback" role="alert"><strong></strong></span>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 d-flex justify-content-between">
                    <a id="save" class="btn btn-success d-none"
                       data-action="{{ route('category_update') }}">Сохранить</a>
                    <a id="edit" class="btn btn-primary">Редактировать</a>
                    <a id="delete" class="btn btn-danger d-none"
                       data-action="{{ route('category_delete') }}">Удалить</a>
                </div>
            </div>

        </div>
    </div>

@endsection
@section('scripts')
    <script src="{{ asset('js/panel.categories.js') }}"></script>
@endsection
