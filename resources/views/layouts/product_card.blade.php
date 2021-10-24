<div class="card">
    <a href="{{ route('product_show', [$product->category->alias, $product->alias]) }}">
        <div class="products__photo">
            @if ($product->photos->count())
                <img class=""
                     src="{{ asset('storage/' . $product->photos->first()->image ) }}"
                     alt="no image">
            @else
                <img class="" src="{{ asset('images/no-image.png') }}"
                     alt="no image">
            @endif
        </div>
    </a>
    <div class="card-body border-top">
        <div class="card-title">
            <a href="{{ route('product_show', [$product->category->alias, $product->alias]) }}"
               class="card-link">{{ $product->title }}</a>
        </div>
        <div class="card-subtitle text-secondary">
            @if ($product->category->getParentsNames() !== $product->category->title)
                @foreach ($product->category->getParentsNames()->reverse() as $item)
                    {{ $item->title . " / " }}
                @endforeach
            @endif
            {{ $product->category->title }}
        </div>
        <div class="card-text d-flex justify-content-between align-items-center">
            <span><b>{{ $product->amount }} ₴</b></span>
            @if ($product->count < 1)
                <a href="{{ route('product_show', [$product->category->alias, $product->alias]) }}" class="btn btn-secondary"><i class="bi bi-eye"></i> Посмотреть</a>
            @else
                <button type="button" class="btn btn-primary" data-id="{{ $product->id }}"><i class="bi bi-cart-plus"></i> В корзину</button>
            @endif
        </div>
    </div>
</div>
