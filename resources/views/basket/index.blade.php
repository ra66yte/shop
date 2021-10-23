@extends('layouts.app')

@section('title', 'Корзина')

@section('breadcrumbs')
    <div class="row">
        <div class="col-12">
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('index') }}">Главная</a></li>
                <li class="breadcrumb-item active" aria-current="page">Корзина</li>
            </ul>
        </div>
    </div>
@endsection


@section('content')
    <div class="col">
        <div class="card border-0 overflow-auto products__table">
            <table id="basket-table" class="table table-bordered mb-0" data-action="{{ route('get_basket_products') }}">
                <thead class="table-info text-center">
                    <th class="col-2">Image</th>
                    <th class="col-5">Название</th>
                    <th class="col-3">Количество / Цена</th>
                    <th class="col-3">Сумма</th>
                </thead>
                <tbody class="text-center basket" data-action="{{ route('products_list') }}">
                    <tr>
                        <td colspan="4" class="py-5 text-center">В корзине нет товаров. Давайте это <a href="{{ route('products_list') }}">исправим</a>!</td>
                    </tr>
                </tbody>
                <tfoot></tfoot>
            </table>
        </div>
        <div class="text-right pt-3 d-none">
                <button id="add-order" type="button" class="btn btn-primary" data-action="{{ route('basket_store') }}"><i class="bi bi-cart4"></i> Оформить заказ</button>
        </div>
    </div>
    @include('layouts.copyright')
@endsection
@section('scripts')
    <script src="{{ asset('js/confirm_basket.js') }}"></script>
@endsection
