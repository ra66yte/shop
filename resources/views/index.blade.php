@extends('layouts.app')

@section('aside')
    <aside class="col-lg-3 col-md-4 pr-md-0">
        <div class="card">
            <div class="card-body">
            @if (Route::is('main'))
                Привет, юзер
            @else
                Категория 1
                <br>
                Категория 2
            @endif
            </div>
        </div>
        @include('layouts.copyright')
    </aside>
@endsection

@section('content')
    <main class="col-lg-9 col-md-8 /*pl-md-0*/">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">{{ __('Index') }}</div>

                    <div class="card-body">
                        {{ __('You are on index page!') }}
                    </div>
                </div>
            </div>
        </div>
    </main>

@endsection
