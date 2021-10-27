@extends('layouts.app')

@section('title', 'Кабинет')

@section('breadcrumbs')
    <div class="row">
        <div class="col-12">
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('index') }}">Главная</a></li>
                <li class="breadcrumb-item active" aria-current="page">Кабинет</li>
            </ul>
        </div>
    </div>
@endsection

@section('content')
    @include('layouts.main_aside')
    <div class="col-lg-9 col-md-8 /*pl-md-0*/">
        <div class="card">
            <div class="card-header border-bottom-0">
                Ваши заказы
            </div>

        </div>

        @if (isset($orders) && $orders->count())
            @foreach($orders as $order)
                <div class="card mt-2">
                    <div class="card-body py-2">
                        <div class="card-title d-flex align-items-center">
                            Заказ #{{ $order->id }}
                            <i class="ml-2 badge badge-{{ $order->status == 1 ? 'success' : 'secondary' }}">
                                {{ $order->status == 1 ? 'Подтвержден' : 'Не подтвержден' }}
                            </i>
                            <a href="{{ route('order_show', $order->id) }}" class="btn btn-link ml-auto">Подробнее</a>

                        </div>

                        @if ($order->products->count())
                            @include('layouts.order_products')
                        @endif
                    </div>
                </div>
            @endforeach
            @if ($orders->hasPages())
                <div class="pt-3">
                    {{ $orders->links("pagination::bootstrap-4") }}
                </div>
            @endif
        @else
            <div class="card mt-2">
                <div class="card-body">
                    <div class="card-title text-center">У Вас пока нет заказов.</div>
                </div>
            </div>
        @endif
    </div>
@endsection
