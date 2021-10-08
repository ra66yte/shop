@extends('layouts.app')

@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Категории
                    <a href="{{ route('add_category') }}" class="btn btn-primary">Добавить</a>
                </div>

                <div class="card-body">
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
                                    <td><a class="btn btn-primary" href="{{ route('show_category', $category->id) }}">Посмотреть</a></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection
