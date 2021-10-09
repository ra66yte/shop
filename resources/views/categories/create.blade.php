@extends('layouts.app')

@section('breadcrumbs')
    <li class="breadcrumb-item"><a href="{{ route('main') }}">Кабинет</a></li>
    <li class="breadcrumb-item"><a href="{{ route('panel') }}">Панель управления</a></li>
    <li class="breadcrumb-item"><a href="{{ route('panel_cat_list') }}">Категории</a></li>
    <li class="breadcrumb-item active" aria-current="page">Добавление категории</li>
@endsection

@include('panel.aside')

@section('content')
    <div class="card-header">Новая категория</div>
    <div class="card-body">
        <form action="{{ route('add_category_save') }}" method="post">
            <div class="form-group">
                @csrf
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
                <label for="desc">Описание:</label> <textarea id="desc"
                                                              class="form-control @error('desc') is-invalid @enderror"
                                                              name="desc">{{ old('desc') }}</textarea>
                @error('desc')
                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                @enderror
            </div>
            <div class="row">
                <div class="col-md-12"><input class="btn btn-primary" type="submit" value="Добавить"></div>
            </div>
        </form>
    </div>
@endsection
