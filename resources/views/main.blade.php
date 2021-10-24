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
    <aside class="col-lg-3 col-md-4 pr-md-0 pt-md-0 pt-2 pb-3 order-md-first order-last">
        <div class="card text-center">
            <img class="card-img-top" src="{{ asset('images/no_photo.png') }}" width="50px" alt="photo">
            <div class="card-body pt-1">
                <div class="card-title">
                    {{ Auth::user()->last_name . ' ' . Auth::user()->first_name . ' ' . Auth::user()->middle_name }}
                </div>
                <div class="card-subtitle">
                    <b class="text-secondary">{{ Auth::user()->email }}</b>
                </div>
            </div>

        </div>
        <div class="list-group pt-2">
            <a href="#" class="list-group-item list-group-item-action">
                <i class="bi bi-gear pr-2"></i> Настройки
            </a>
        </div>
        @include('layouts.copyright')
    </aside>
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
                            @if ($order->status == 1)
                                <a href="{{ route('order_show', $order->id) }}" class="btn btn-link ml-auto">Подробнее</a>
                            @else
                                <a href="{{ route('order_show', $order->id) }}" class="btn btn-primary ml-auto">Подтвердить</a>
                            @endif
                        </div>

                        @if ($order->products->count())
                            <table class="table table-bordered text-center">
                                <tbody>
                                @foreach($order->products as $product)
                                    <tr>
                                        <td class="col-7"><a
                                                href="{{ route('product_show', [$product->category->alias, $product->alias]) }}">{{ $product->title }}</a>
                                        </td>
                                        <td class="col-2 text-secondary">{{ $product->pivot->count . ' * ' . number_format($product->pivot->price, '2', '.', ' ') }}</td>
                                        <td class="col-3 text-secondary">
                                            <b>{{ number_format($product->pivot->count * $product->pivot->price, '2', '.', ' ') }}</b>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                                <tfoot>
                                <tr>
                                    <td colspan="2" class="text-right">К оплате:</td>
                                    <td><b>{{ $order->getFullAmount() }}</b></td>
                                </tr>
                                </tfoot>
                            </table>
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
