@foreach($subcategories as $subcategory)
    <a href="{{ route('category_show', $subcategory->alias) }}" class="list-group-item list-group-item-action d-flex justify-content-between">
        <i class="bi {{ (isset($subcategory->subs) && $subcategory->subs->count()) ? "bi-tags" : "bi-tag"}} pr-2" title="{{ $prefix }}"></i>{{ $subcategory->title }}
        <span class="ml-auto badge badge-light align-self-center">{{ $subcategory->products->count() }}</span>
    </a>
    @if ($subcategory->sub->count())
        @include('categories.subcategories_list', ['subcategories' => $subcategory->sub,
                                              'prefix' => $prefix . " / " . $subcategory->title])
    @endif
@endforeach
<?php
