@component('admin.layouts.content', ['title' => 'Edit Category'])
    @slot('breadcrumb')
        <li class="breadcrumb-item"><a href="{{ route('admin.main') }}">Admin Panel</a></li>
        <li class="breadcrumb-item active">Edit Category</li>
        <li class="breadcrumb-item "><a href="{{ route('admin.categories.index') }}">Categories List</a></li>
    @endslot

    <div class="row">
        <div class="col-lg-12">
            @include('admin.layouts.errors')
            <div class="card card-info">
                <div class="card-header">
                    <h3 class="card-title">Category Edit Form</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form class="form-horizontal" method="POST"
                    action="{{ route('admin.categories.update', ['category' => $category->id]) }}">
                    @csrf
                    @method('PUT')
                    <div class="card-body">
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">Name</label>
                            <input type="text" name="name" class="form-control" id="inputEmail3"
                                value="{{ old('name' , $category->name) }}" placeholder="Enter category name">
                        </div>
                        <div class="form-group">
                            <label for="label" class="col-sm-2 control-label">Sub Category</label>
                            <select class="form-control" name="parent" id="permissions">
                                @foreach (\App\Models\Category::all() as $category)
                                    <option value="{{ $category->id }}"
                                        {{ $category->id === $category->parent ? 'selected' : '' }}>
                                        {{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>

                    

                        <!-- /.card-body -->
                        <div class="card-footer">
                            <button type="submit" class="btn btn-info">Edit</button>
                            <a href="{{ route('admin.users.index') }}" class="btn btn-danger float-left">Cancel</a>
                        </div>
                        <!-- /.card-footer -->
                    </div>
                </form>
            </div>
        </div>
    </div>
@endcomponent
