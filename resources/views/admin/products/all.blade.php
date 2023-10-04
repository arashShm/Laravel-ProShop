@component('admin.layouts.content', ['title' => 'Products'])
    @slot('breadcrumb')
        <li class="breadcrumb-item "><a href="/admin">Admin Panel</a></li>
        <li class="breadcrumb-item active">Products List</li>
    @endslot

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Products List</h3>

                    <div class="card-tools d-flex">

                        <form action="">
                            <div class="input-group input-group-sm" style="width: 150px;">
                                <input type="text" name="search" class="form-control float-right" placeholder="جستجو"
                                    value="{{ request('search') }}">

                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                                </div>
                            </div>
                        </form>

                        @can('create-product')
                            <div class="btn-group-sm mr-2">
                                <a href="{{ route('admin.products.create') }}" class="btn btn-info">New Product</a>
                            </div>
                        @endcan
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover">
                        <tbody>
                            <tr>
                                <th>id</th>
                                <th>Name of Products</th>
                                <th>Description</th>
                                <th>Count</th>
                                {{-- <th>Comments</th> --}}
                                <th>View</th>
                                <th>Proceedings</th>
                            </tr>


                            @foreach ($products as $key => $product)
                                <tr>
                                    <td>{{ $product->id }}</td>
                                    <td>{{ $product->title }}</td>
                                    <td>{{ $product->description }}</td>
                                    <td>{{ $product->inventory }}</td>
                                    <td>{{ $product->view_count }}</td>
                                    <td class="d-flex ">
                                        @can('delete-product')        
                                            <form action="{{ route('admin.products.destroy', $product->id) }}"
                                                method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-primary btn-sm ml-2">Remove Product</button>
                                            </form>
                                        @endcan
                                        @can('edit-product')             
                                            <a href="{{ route('admin.products.edit', $product->id) }}"
                                                class="btn btn-danger btn-sm">Edit Product</a>
                                        @endcan
                                        <a href="{{route('admin.product.gallery.index' , ['product' => $product->id])}}" class="btn btn-warning btn-sm mr-1">Gallery</a>
                                    </td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                    {{ $products->render() }}
                    {{-- {!! $products->links() !!} --}}
                </div>
            </div>
            <!-- /.card -->
        </div>
    </div>
@endcomponent
