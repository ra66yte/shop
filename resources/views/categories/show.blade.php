@extends('layouts.app')

@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ $category->title }}</div>

                <div class="card-body">
                    <input id="category-id" class="inp" type="hidden" name="id" value="{{ $category->id }}">
                    <div class="col"><p class="text" data-title>{{ $category->title }}</p>
                        <input class="inp d-none" type="text" name="title" value="{{ $category->title }}">
                    </div>
                    <div class="col"><p class="text" data-desc>{{ $category->description }}</p>
                        <textarea class="inp d-none" name="desc">{{ $category->description }}</textarea>
                    </div>

                    <a id="save" class="btn btn-primary d-none" data-action="{{ route('category_update') }}">Save</a>
                    <a id="edit" class="btn btn-success">Edit</a>
                    <a id="delete" class="btn btn-error" data-action="{{ route('category_delete') }}">Delete</a>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('scripts')
    <script src="{{ asset('js/categories.js') }}"></script>
@endsection
