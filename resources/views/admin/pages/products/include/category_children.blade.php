<option class="mb-10" value="{{ $category ?-> id ?? '' }}" {{ ($category_id == $category?->id) ? 'selected' : ''}} style="margin-left: {{ $level * 20 }}px;">
    


    {{ str_repeat('-', $level) }}  {{ $category -> name }}
    
    @if ($category->children->isNotEmpty())
        @foreach ($category->children as $child)
            @include('admin::pages.products.include.category_children', ['category' => $child, 'category_id' => $category_id,'level' => $level + 1])
        @endforeach
    @endif
</option>