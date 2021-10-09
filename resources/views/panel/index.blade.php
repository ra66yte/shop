@extends('layouts.app')

@section('breadcrumbs')
    <li class="breadcrumb-item"><a href="{{ route('main') }}">Кабинет</a></li>
    <li class="breadcrumb-item active" aria-current="page">Панель управления</li>
@endsection

@include('panel.aside')

@section('content')
    <div class="card-body">Здравствуйте, {{ Auth::user()->first_name }} [
        @foreach ($roles as $role)
            <small>
                {{ $role->name }}
                @if (!$loop->last)
                    {{ ", " }}
                @endif
            </small>
        @endforeach
        ].
    </div>



@endsection
