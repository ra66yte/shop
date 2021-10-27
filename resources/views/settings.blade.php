@extends('layouts.app')

@section('title', 'Настройки')

@section('breadcrumbs')
    <div class="row">
        <div class="col-12">
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('index') }}">Главная</a></li>
                <li class="breadcrumb-item"><a href="{{ route('main') }}">Кабинет</a></li>
                <li class="breadcrumb-item active" aria-current="page">Настройки</li>
            </ul>
        </div>
    </div>
@endsection

@section('content')
    @include('layouts.main_aside')
    <div class="col-lg-9 col-md-8 /*pl-md-0*/">
        <div class="card">
            <div class="card-header border-bottom-0">Настройки</div>
        </div>

        <div class="card mt-3">

            <form action="{{ route('save_settings') }}" method="POST" autocomplete="off">
                <div class="card-body">
                    @csrf
                    <div class="form-row">
                        <div class="form-group col-4">
                            <label for="last_name">Фамилия:</label>
                            <input id="last_name" type="text"
                                   name="last_name"
                                   class="form-control @error('last_name') is-invalid @enderror"
                                   title="Фамилия"
                                   value="{{ old('last_name') ? old('last_name') : Auth::user()->last_name }}">
                            @error('last_name')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror

                        </div>
                        <div class="form-group col-4">

                            <label for="first_name">Имя:</label>
                            <input id="first_name" type="text"
                                   name="first_name"
                                   class="form-control @error('first_name') is-invalid @enderror" title="Имя"
                                   value="{{ old('first_name') ? old('first_name') : Auth::user()->first_name }}"
                                   required>
                            @error('first_name')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror

                        </div>
                        <div class="form-group col-4">

                            <label for="middle_name">Отчество:</label>
                            <input id="middle_name" type="text"
                                   name="middle_name"
                                   class="form-control @error('middle_name') is-invalid @enderror" title="Отчество"
                                   value="{{ old('middle_name') ? old('middle_name') : Auth::user()->middle_name }}">
                            @error('middle_name')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror

                        </div>
                    </div>

                    <div class="form-group">

                        <label for="email">Email:</label>
                        <input id="email" type="text"
                               name="email"
                               class="form-control @error('email') is-invalid @enderror" title="Email" disabled
                               value="{{ Auth::user()->email }}">
                        @error('email')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror

                    </div>


                    <div class="form-group">
                        <input type="password" name="mask" style="display: none">
                        <label for="password">Новый пароль:</label>
                        <input id="password" type="password"
                               name="password"
                               class="form-control @error('password') is-invalid @enderror" title="Пароль">
                        @error('password')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror

                    </div>
                    <div class="form-group">

                        <label for="password_confirmation">Повтор пароля:</label>
                        <input id="password_confirmation" type="password"
                               name="password_confirmation"
                               class="form-control @error('password_confirmation') is-invalid @enderror"
                               title="Повтор пароля">
                        @error('password_confirmation')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror

                    </div>
                    <div class="text-right">
                        <input type="submit" class="btn btn-primary" value="Сохранить">
                    </div>
                </div>


            </form>

        </div>
    </div>
@endsection
