<ul class="list-group list-group-flush">
    @foreach ($categories as $category)
        <li class="list-group-item">
            <div class="de-flex">
                <span style="margin-left: 25px;">{{ $category->name }}</span>
                <div class="actions mr-2">
                    <form action="{{route('admin.categories.destroy' , $category->id)}}" method="POST" id="category{{$category->id}}-delete">
                        @csrf
                        @method('DELETE')
                    </form>
                    <a href="" onclick="event.preventDefault(); document.getElementById('category{{$category->id}}-delete').submit()" class=" badge badge-danger">delete</a>
                    <a href="{{route('admin.categories.create')}}?parent={{$category->id}}" class=" badge badge-primary">Sub Category</a>
                    <a href="{{route('admin.categories.edit', $category->id)}}" class=" badge badge-warning">edit</a>
                </div>
            </div>
            @if ($category->child)
                @include('admin.layouts.categories-items', ['categories' => $category->child])
            @endif
        </li>
    @endforeach
</ul>
