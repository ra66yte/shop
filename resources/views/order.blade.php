@extends('layouts.app')

@section('title', 'Заказ #' . $order->id)

@section('breadcrumbs')
    <div class="row">
        <div class="col-12">
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('index') }}">Главная</a></li>
                <li class="breadcrumb-item"><a href="{{ route('main') }}">Кабинет</a></li>
                <li class="breadcrumb-item active" aria-current="page">Заказ #{{ $order->id }}</li>
            </ul>
        </div>
    </div>
@endsection

@section('content')
    @include('layouts.main_aside')
    <div class="col-lg-9 col-md-8 /*pl-md-0*/">
        @if ($order->status === 0)
            <div class="alert alert-warning text-center alert-dismissible fade show px-3 border" role="alert">
                <h3>Этот заказ еще не подтвержден!</h3>
                <p>При оформлении заказа на Ваш адрес электронной почты <b>{{ Auth::user()->email }}</b> было отправлено
                    письмо подтверждения. Следуйте инструкциям, указанным в письме и подтвердите заказ.</p>
                <form action="{{ route('confirm_repeat', $order->id) }}" method="POST">
                    @csrf
                    <p>Если Вы не получили письмо подтверждения, Вы можете <button type="submit" class="btn btn-link p-0">отправить его еще раз</button>.</p>
                </form>

            </div>
        @endif
        <div class="card">
            <div class="card-header border-bottom-0">Заказ <b>#{{ $order->id }}</b>
                <span class="text-secondary small">[{{ $order->created_at->format('d.m.Y в H:i:s') }}]</span>
                <i class="ml-2 badge badge-{{ $order->status == 1 ? 'success' : 'secondary' }}">
                    {{ $order->status == 1 ? 'Подтвержден' : 'Не подтвержден' }}
                </i>
            </div>
        </div>

        <div class="card border-0 mt-3">
            <div class="card-body p-0">
                @if ($order->products->count())
                    @include('layouts.order_products')
                @endif
            </div>
        </div>
<!--    <div class="py-2 text-right">
        <button type="button" class="btn btn-primary" disabled><i class="bi bi-wallet"></i> Перейти к оплате</button>
    </div>-->

@endsection
