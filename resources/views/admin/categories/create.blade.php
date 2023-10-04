@component('admin.layouts.content', ['title' => 'Create Category'])
    @slot('breadcrumb')
        <li class="breadcrumb-item"><a href="{{ route('admin.main') }}">Admin Panel</a></li>
        <li class="breadcrumb-item active">Create Category</li>
        <li class="breadcrumb-item "><a href="{{ route('admin.categories.index') }}">Category List</a></li>
    @endslot

    <div class="row">
        <div class="col-lg-12">
            @include('admin.layouts.errors')
            <div class="card card-info">
                <div class="card-header">
                    <h3 class="card-title">User Category Form</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form class="form-horizontal" method="POST" action="{{route('admin.categories.store')}}">
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">Name</label>
                            <input type="text" name="name" class="form-control" id="inputEmail3" placeholder="Enter Your Email">
                        </div>


                        @if(request('parent'))

                        @php
                            $parent = \App\Models\Category::find(request('parent'))
                        @endphp
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">sub Category</label>
                            <input type="text" class="form-control" id="inputEmail3" disabled value="{{$parent->name}}">
                            <input type="hidden" name="parent" value="{{$parent->id}}">
                        </div>
                        @endif

                        <!-- /.card-body -->
                        <div class="card-footer">
                            <button type="submit" class="btn btn-info">Register</button>
                            <a href="{{route('admin.categories.index')}}" class="btn btn-danger float-left">Cancel</a>
                        </div>
                        <!-- /.card-footer -->
                </form>
            </div>
        </div>
    </div>
@endcomponent
