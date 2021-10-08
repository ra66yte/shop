@extends('layouts.app')

@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Новая категория</div>

                <div class="card-body">
                    <form action="{{ route('add_category_save') }}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-md-12"><label for="title">Название: </label> <input id="title" type="text" name="title"></div>
                        </div>
                        <div class="row">
                            <div class="col-md-12"><label for="desc">Описание:</label> <textarea id="desc" name="desc"
                                                                                                 rows="10"></textarea></div>
                        </div>
                        <div class="row">
                            <div class="col-md-12"><input class="btn btn-success" type="submit" value="Добавить"></div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
