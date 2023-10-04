@component('admin.layouts.content', ['title' => 'ConfirmAccess'])
    @slot('breadcrumb')
        <li class="breadcrumb-item"><a href="{{ route('admin.main') }}">Admin Panel</a></li>
        <li class="breadcrumb-item active">Create Access</li>
        <li class="breadcrumb-item "><a href="{{ route('admin.users.index') }}">Users List</a></li>
    @endslot

    @slot('script')
        <script>
            $('#roles').select2({
                'placeholder' : 'please select a role  '
            })
            $('#permissions').select2({
                'placeholder' : 'please select a permission '
            })
        </script>
    @endslot

    <div class="row">
        <div class="col-lg-12">
            @include('admin.layouts.errors')
            <div class="card card-info">
                <div class="card-header">
                    <h3 class="card-title">Access For Staffs</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form class="form-horizontal" method="POST" action="{{ route('admin.users.permission.store' , ['user' => $user->id]) }}">
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label for="label" class="col-sm-2 control-label">Roles</label>
                            <select class="form-control" name="roles[]" id="roles" multiple>
                                @foreach (\App\Models\Role::all() as $role)
                                    <option value="{{ $role->id }}" {{in_array($role->id , $user->roles->pluck('id')->toArray()) ? 'selected' : ''}}>{{ $role->name }} - {{ $role->label }}
                                    </option>
                                @endforeach
                            </select>
                        </div>


                        <div class="form-group">
                            <label for="label" class="col-sm-2 control-label">Permissions</label>
                            <select class="form-control" name="permissions[]" id="permissions" multiple>
                                @foreach (\App\Models\Permission::all() as $permission)
                                    <option value="{{ $permission->id }}" {{in_array($permission->id , $user->permissions->pluck('id')->toArray()) ? 'selected' : ''}}>{{ $permission->name }} - {{ $permission->label }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- /.card-body -->
                        <div class="card-footer">
                            <button type="submit" class="btn btn-info">Confirm</button>
                            <a href="{{ route('admin.roles.index') }}" class="btn btn-danger float-left">Cancel</a>
                        </div>
                    </div>
                        <!-- /.card-footer -->
                </form>
            </div>
        </div>
    </div>
@endcomponent
