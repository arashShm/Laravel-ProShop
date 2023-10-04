@component('admin.layouts.content' , ['title' => 'Images List'])
    @slot('breadcrumb')
        <li class="breadcrumb-item"><a href="/admin">Admin Panel</a></li>
        <li class="breadcrumb-item">{{ $product->title }}</li>
        <li class="breadcrumb-item active">Gallery</li>
    @endslot

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Images</h3>

                    <div class="card-tools d-flex">
                        <div class="btn-group-sm mr-1">
                            <a href="{{ route('admin.product.gallery.create' , ['product' => $product->id]) }}" class="btn btn-info">+ Add New Image  </a>
                        </div>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <div class="row">
                        @foreach($images as $image)
                            <div class="col-sm-2">
                                <a href="{{ url($image->image) }}">
                                    <img src="{{ url($image->image) }}" class="img-fluid mb-2" alt="{{$image->alt }}">
                                </a>
                                <form action="{{ route('admin.product.gallery.destroy' , ['product' => $product->id , 'gallery' => $image->id]) }}" id="image-{{ $image->id }}" method="post">
                                    @method('delete')
                                    @csrf
                                </form>
                                <a href="{{ route('admin.product.gallery.edit' , ['product' => $product->id , 'gallery' => $image->id]) }}" class="btn btn-sm btn-primary">ویرایش</a>
                                <a href="#" class="btn btn-sm btn-danger" onclick="document.getElementById('image-{{ $image->id }}').submit()">حذف</a>
                            </div>
                        @endforeach
                    </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    {{ $images->render() }}
                </div>
            </div>
            <!-- /.card -->
        </div>
    </div>

@endcomponent
