@foreach($subcategories as $subcategory)
    <option value="{{ $subcategory->id }}"
            @if ((isset($category->parent) && $subcategory->id == $category->parent->id) || old('category_id') == $subcategory->id) selected @endif
            @if (isset($disabled) && $disabled == 1 && isset($subcategory->parent) && !$category->validParent($subcategory->id)) disabled @endif
    >{{ $prefix . " / " . $subcategory->title }}</option>
    @if (count($subcategory->sub))
        @include('panel.categories.subcategories_list', ['subcategories' => $subcategory->sub,
                                              'prefix' => $prefix . " / " . $subcategory->title,
                                              'disabled' => (isset($disabled) && $disabled == 1 ? 1 : 0)])
    @endif
@endforeach
