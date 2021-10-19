@extends('layouts.panel')

@section('title', '| Редактирование товара ' . $product->title)

@section('breadcrumbs')
    <li class="breadcrumb-item"><a href="{{ route('main') }}">Кабинет</a></li>
    <li class="breadcrumb-item"><a href="{{ route('panel') }}">Панель управления</a></li>
    <li class="breadcrumb-item"><a href="{{ route('panel_products_list') }}">Товары</a></li>
    <li class="breadcrumb-item active" aria-current="page">{{ $product->title }}</li>
@endsection

@include('panel.aside')

@section('content')
    <div class="card">
        <div class="card-header">Редактирование товара <b>"{{ $product->title }}"</b></div>
        <div class="card-body">
            <form id="update-product-form" action="{{ route('product_update') }}" method="post" enctype="multipart/form-data">
                @csrf
                <input id="product-id" type="hidden" name="id" value="{{ $product->id }}">
                <div class="form-group">
                    <label for="category_id">Категория: </label>
                    <select name="category_id" id="category_id"
                            class="form-control" required>
                        <option value="">- Не указано -</option>
                        @foreach($categories as $category)
                            <option
                                value="{{ $category->id }}" {{ ($category->id == $product->category_id ? "selected" : "") }}>{{ $category->title }}</option>
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
                           value="{{ $product->title }}">
                    <span class="invalid-feedback" role="alert"><strong></strong></span>
                </div>
                <div class="form-group">
                    <label for="alias">Алиас: </label>
                    <input id="alias"
                           class="form-control"
                           type="text"
                           name="alias"
                           required
                           value="{{ $product->alias }}"
                           data-action="{{ route('panel_get_alias') }}">
                    <span class="invalid-feedback" role="alert"><strong></strong></span>
                </div>
                <div class="form-group">
                    <label for="desc">Описание:</label>
                    <textarea id="desc"
                              class="form-control"
                              name="desc">{{ $product->description }}</textarea>
                    <span class="invalid-feedback" role="alert"><strong></strong></span>
                </div>

                <div class="form-row">
                    <div class="form-group col-3">
                        <label for="amount">Цена</label>
                        <input id="amount" type="text" name="amount"
                               class="form-control col-6 text-center"
                               placeholder="0.00"
                               value="{{ $product->amount }}">
                        <span class="invalid-feedback" role="alert"><strong></strong></span>
                    </div>
                </div>
                <div id="upload-block" class="form-group">
                    <label for="images">Изображение:</label>
                    <input type="file" class="form-control-file"
                           id="images"
                           name="images[]" multiple>
                    <span class="invalid-feedback" role="alert"><strong></strong></span>
                </div>

                <div class="form-group">
                    <div id="show" class="card-group products__images">
                        @if ($product->photos->count())
                            @foreach ($product->photos as $photo)
                                <div class="products__images-item" data-id="{{ $photo->id }}">
                                    <div id="old-image-{{ $loop->index }}"
                                         class="products__image"
                                         style="background-image: url('{{ asset('storage/' . $photo->image) }}');">
                                        <span class="products__image-clear" title="Удалить">×</span>
                                    </div>
                                </div>
                            @endforeach
                        @endif

                    </div>
                </div>

                <div class="row">
                    <div class="col d-flex justify-content-between">
                        <input class="btn btn-success" type="submit" value="Сохранить">
                        <a id="delete-product" class="btn btn-outline-danger"
                           data-action="{{ route('product_delete') }}">Удалить</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('js/panel.products.js') }}"></script>
@endsection
