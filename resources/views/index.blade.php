@extends('layouts.app')

@section('title', 'Главная страница')

@section('content')

    <div class="col-12">
        <div class="card">
            <div class="card-header">{{ __('Index') }}</div>

            <div class="card-body">
                {{ __('You are on index page!') }}
            </div>
        </div>
    </div>



@endsection
