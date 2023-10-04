@component('admin.layouts.content', ['title' => 'Categories List'])
    @slot('breadcrumb')
        <li class="breadcrumb-item "><a href="/admin">Admin Panel</a></li>
        <li class="breadcrumb-item active">Categories List</li>
    @endslot

    @slot('head')
        <style>
            li.list-group-item > ul.list-group {
                margine-top : 15px
            }
        </style>
    @endslot

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Categories</h3>

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


                        <div class="btn-group-sm mr-2">
                            @can('edit-category')
                                <a href="{{ route('admin.categories.create') }}" class="btn btn-info">New Category</a>
                            @endcan
                        </div>
                    </div>
                </div>


                <div class="row">
                    <div class="card-body table-responsive p-0">
                        @include('admin.layouts.categories-items', ['categories' => $categories])
                    </div>
                </div>

                <div class="card-footer">
                    {{-- {{ $users->appends('search' => request(['search']))->render() }} --}}
                    {!! $categories->links() !!}
                </div>
            </div>
            <!-- /.card -->
        </div>
    </div>
@endcomponent
