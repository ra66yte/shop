<table class="table table-bordered text-center mb-0">
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
    <tfoot class="basket">
    <tr>
        <td colspan="2" class="text-right">К оплате:</td>
        <td><h5 class="mb-0"><b>{{ $order->getFullAmount() }}</b></h5></td>
    </tr>
    </tfoot>
</table>
