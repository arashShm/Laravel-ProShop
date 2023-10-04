@component('admin.layouts.content', ['title' => 'Create Access'])
    @slot('breadcrumb')
        <li class="breadcrumb-item"><a href="{{ route('admin.main') }}">Admin Panel</a></li>
        <li class="breadcrumb-item active">Create Access</li>
        <li class="breadcrumb-item "><a href="{{ route('admin.permissions.index') }}">Access</a></li>
    @endslot

    <div class="row">
        <div class="col-lg-12">
            @include('admin.layouts.errors')
            <div class="card card-info">
                <div class="card-header">
                    <h3 class="card-title">Accessibilty Form</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form class="form-horizontal" method="POST" action="{{route('admin.permissions.store')}}">
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label for="inputName" class="col-sm-2 control-label">Name</label>
                            <input type="text" name="name" class="form-control" id="inputName" placeholder="Enter Your permission" value="{{old('name')}}">
                        </div>
                        <div class="form-group">
                            <label for="label" class="col-sm-2 control-label">Description</label>
                            <input type="text" name="label" class="form-control" id="label" placeholder="Enter Your permisson" value="{{old('label')}}">
                        </div>

                        <!-- /.card-body -->
                        <div class="card-footer">
                            <button type="submit" class="btn btn-info">Confirm</button>
                            <a href="{{route('admin.permissions.index')}}" class="btn btn-danger float-left">Cancel</a>
                        </div>
                        <!-- /.card-footer -->
                </form>
            </div>
        </div>
    </div>
@endcomponent
