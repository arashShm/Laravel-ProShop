@component('admin.layouts.content', ['title' => 'Edit User'])
    @slot('breadcrumb')
        <li class="breadcrumb-item"><a href="{{ route('admin.main') }}">Admin Panel</a></li>
        <li class="breadcrumb-item active">Edit User</li>
        <li class="breadcrumb-item "><a href="{{ route('admin.users.index') }}">Users List</a></li>
    @endslot

    <div class="row">
        <div class="col-lg-12">
            @include('admin.layouts.errors')
            <div class="card card-info">
                <div class="card-header">
                    <h3 class="card-title">User Edit Form</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form class="form-horizontal" method="POST"
                    action="{{route('admin.users.update' , ['user' => $user->id])}}">
                    @csrf
                    @method('PUT')
                    <div class="card-body">
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">Email</label>
                            <input type="email" name="email" class="form-control" id="inputEmail3" value="{{$user->email}}"
                                placeholder="Enter Your Email">
                        </div>
                        <div class="form-group">
                            <label for="username" class="col-sm-2 control-label">Username</label>
                            <input type="text" name="name" class="form-control" id="username" value="{{$user->name}}"
                                 placeholder="Enter Your Email">
                        </div>
                        <div class="form-group">
                            <label for="inputPassword3" class="col-sm-2 control-label">Password</label>
                            <input type="password" name="password" class="form-control" id="inputPassword3"
                                placeholder="Enter Your Password">
                        </div>


                        <div class="form-group">
                            <label for="inputPassword3" class="col-sm-2 control-label">Confirm Password</label>
                            <input type="password" name="password_confirmation" class="form-control" id="inputPassword3"
                                placeholder="Enter Your Password">
                        </div>


                        @if (! $user->hasVerifiedEmail())
                            <div class="form-check">
                                <input type="checkbox" name="verify" class="form-check-input" id="verify">
                                <label for="verify" class="form-check-label">Accounts Verified</label>
                            </div>
                        @endif



                        <!-- /.card-body -->
                        <div class="card-footer">
                            <button type="submit" class="btn btn-info">Edit</button>
                            <a href="{{ route('admin.users.index') }}" class="btn btn-danger float-left">Cancel</a>
                        </div>
                        <!-- /.card-footer -->
                </form>
            </div>
        </div>
    </div>
@endcomponent
