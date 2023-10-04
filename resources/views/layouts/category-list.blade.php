<ul>
    @foreach ($categories as $category)
    <li>
        {{$category->name}}
        @if ($category->child)
            @include('layouts.category-list' , ['categories' => $category->child])
        @endif
    </li>
    @endforeach
</ul>

