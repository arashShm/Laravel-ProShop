@component('admin.layouts.content', ['title' => 'Users List'])
    @slot('breadcrumb')
        <li class="breadcrumb-item "><a href="/admin">Admin Panel</a></li>
        <li class="breadcrumb-item active">Users List</li>
    @endslot

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Users</h3>

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
                            @can('create-user')
                                <a href="{{ route('admin.users.create') }}" class="btn btn-info">New User</a>
                            @endcan
                            
                            @can('show-staff-user')
                                <a href="{{ request()->fullUrlWithQuery(['admin' => 1]) }}" class="btn btn-warning">Staff
                                    Users</a>
                            @endcan
                        </div>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover">
                        <tbody>
                            <tr>
                                <th>id</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Email verification</th>
                                <th>Role</th>
                                <th>Proceedings</th>
                            </tr>


                            @foreach ($users as $key => $user)
                                <tr>
                                    <td>{{ $user->id }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    @if ($user->email_verified_at)
                                        <td><span class="badge badge-success">Verified</span></td>
                                    @else
                                        <td><span class="badge badge-danger">Not Verified</span></td>
                                    @endif


                                    @if ($user->is_superuser === 1)
                                        <td><span class="badge badge-success">Admin</span></td>
                                    @elseif($user->is_staff === 1)
                                        <td><span class="badge badge-warning">Staff</span></td>
                                    @else
                                        <td><span class="badge badge-primary">User</span></td>
                                    @endif

                                    <td class="d-flex ">
                                        @can('delete-user')
                                            <form action="{{ route('admin.users.destroy', ['user' => $user->id]) }}"
                                                method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-primary btn-sm ml-2">Remove User</button>
                                            </form>
                                        @endcan

                                        @can('edit-user')
                                            <a href="{{ route('admin.users.edit', ['user' => $user->id]) }}"
                                                class="btn btn-danger btn-sm ml-2">Edit User</a>
                                        @endcan

                                        @if ($user->is_staff)
                                            @can('staff-user-pemissions')
                                                <a href="{{ route('admin.users.permission.create', ['user' => $user->id]) }}"
                                                    class="btn btn-warning btn-sm">Access</a>
                                            @endcan
                                        @endif
                                    </td>


                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                    {{-- {{ $users->appends('search' => request(['search']))->render() }} --}}
                    {!! $users->links() !!}
                </div>
            </div>
            <!-- /.card -->
        </div>
    </div>
@endcomponent
