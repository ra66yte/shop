@foreach($subcategories as $subcategory)
    <option value="{{ $subcategory->id }}"
            @if (isset($product) && $subcategory->id == $product->category_id) selected @endif
    >{{ $prefix . " / " . $subcategory->title }}</option>
    @if ($subcategory->sub->count())
        @include('panel.products.subcategories_list', ['subcategories' => $subcategory->sub,
                                              'prefix' => $prefix . " / " . $subcategory->title])
    @endif
@endforeach
