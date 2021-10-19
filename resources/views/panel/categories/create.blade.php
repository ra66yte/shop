@extends('layouts.panel')

@section('breadcrumbs')
    <li class="breadcrumb-item"><a href="{{ route('main') }}">Кабинет</a></li>
    <li class="breadcrumb-item"><a href="{{ route('panel') }}">Панель управления</a></li>
    <li class="breadcrumb-item"><a href="{{ route('panel_cat_list') }}">Категории</a></li>
    <li class="breadcrumb-item active" aria-current="page">Добавление категории</li>
@endsection

@include('panel.aside')

@section('content')
    <div class="card">
        <div class="card-header">Новая категория</div>
        <div class="card-body">
            <form action="{{ route('add_category_save') }}" method="post">
                <div class="form-group">
                    @csrf
                    <div class="col px-0">
                        <label for="parent_id">Подчиняется: </label> <select name="parent_id" id="parent_id"
                                                                             class="form-control @error('parent_id') is-invalid @enderror">
                            <option value="">- Не указано -</option>
                            @foreach($categories as $category)
                               <option
                                   value="{{ $category->id }}">{{ $category->title }}</option>
                               @if ($category->sub->count())
                                   @include('panel.categories.subcategories_list', ['subcategories' => $category->sub, 'prefix' => $category->title])
                               @endif
                           @endforeach


                        </select>
                        @error('parent_id')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </div>
                    <div class="col px-0 pt-2">
                        <label for="title">Название: </label> <input id="title"
                                                                     class="form-control @error('title') is-invalid @enderror"
                                                                     type="text"
                                                                     name="title"
                                                                     required
                                                                     value="{{ old('title') }}">
                        @error('title')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </div>
                    <div class="col px-0 pt-2">
                        <label for="desc">Описание:</label> <textarea id="desc"
                                                                      class="form-control @error('desc') is-invalid @enderror"
                                                                      name="desc">{{ old('desc') }}</textarea>
                        @error('desc')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12"><input class="btn btn-primary" type="submit" value="Добавить"></div>
                </div>
            </form>
        </div>
    </div>
@endsection
