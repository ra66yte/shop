@extends('layouts.panel')

@section('title', '| Добавление нового товара')

@section('breadcrumbs')
    <li class="breadcrumb-item"><a href="{{ route('main') }}">Кабинет</a></li>
    <li class="breadcrumb-item"><a href="{{ route('panel') }}">Панель управления</a></li>
    <li class="breadcrumb-item"><a href="{{ route('panel_products_list') }}">Товары</a></li>
    <li class="breadcrumb-item active" aria-current="page">Добавление товара</li>
@endsection

@include('panel.aside')

@section('content')
    <div class="card">
        <div class="card-header">Добавление нового товара</div>
        <div class="card-body">
            <form id="add-product-form" action="{{ route('add_product_save') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="category_id">Категория: </label>
                    <select name="category_id" id="category_id"
                            class="form-control" required>
                        <option value="">- Не указано -</option>
                        @foreach($categories as $category)
                            <option
                                value="{{ $category->id }}" {{ (old('category_id') == $category->id ? "selected" : "") }}>{{ $category->title }}</option>
                            @if ($category->sub->count())
                                @include('panel.products.subcategories_list', ['subcategories' => $category->sub, 'prefix' => $category->title])
                            @endif
                        @endforeach
                    </select>
                    <span class="invalid-feedback" role="alert"><strong></strong></span>
                </div>
                <div class="form-group">
                    <label for="title">Название: </label>
                    <input id="title"
                           class="form-control"
                           type="text"
                           name="title"
                           required
                           value="{{ old('title') }}">
                    <span class="invalid-feedback" role="alert"><strong></strong></span>
                </div>
                <div class="form-group">
                    <label for="alias">Алиас: </label>
                    <input id="alias"
                           class="form-control"
                           type="text"
                           name="alias"
                           required
                           value="{{ old('alias') }}"
                           data-action="{{ route('panel_get_alias') }}">
                    <span class="invalid-feedback" role="alert"><strong></strong></span>
                </div>
                <div class="form-group">
                    <label for="desc">Описание:</label>
                    <textarea id="desc"
                              class="form-control"
                              name="desc">{{ old('desc') }}</textarea>
                    <span class="invalid-feedback" role="alert"><strong></strong></span>
                </div>

                <div class="form-row">
                    <div class="form-group col-3">
                        <label for="amount">Цена</label>
                        <input id="amount" type="text" name="amount"
                               class="form-control col-6 text-center"
                               placeholder="0.00"
                               value="{{ old('amount') }}">
                        <span class="invalid-feedback" role="alert"><strong></strong></span>
                    </div>
                </div>

                <div class="form-group">
                    <label for="images">Изображение:</label>
                    <input type="file" class="form-control-file"
                           id="images"
                           name="images[]" multiple>
                    <span class="invalid-feedback" role="alert"><strong></strong></span>
                </div>

                <div class="form-group">
                    <div id="show" class="card-group products__images"></div>
                </div>

                <div class="row">
                    <div class="col-md-12"><input class="btn btn-primary" type="submit" value="Добавить"></div>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('js/panel.products.js') }}"></script>
@endsection
