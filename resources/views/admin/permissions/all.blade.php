@component('admin.layouts.content', ['title' => 'Access'])
    @slot('breadcrumb')
        <li class="breadcrumb-item "><a href="/admin">Admin Panel</a></li>
        <li class="breadcrumb-item active">Access</li>
    @endslot

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Accesses List</h3>

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
                            <a href="{{ route('admin.permissions.create') }}" class="btn btn-info">New Access</a>
                        </div>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover">
                        <tbody>
                            <tr>
                                <th>id</th>
                                <th>Name of Access</th>
                                <th>Description</th>
                                <th>Proceedings</th>
                            </tr>


                            @foreach ($permissions as $key => $permission)
                                <tr>
                                    <td>{{ $permission->id }}</td>
                                    <td>{{ $permission->name }}</td>
                                    <td>{{ $permission->label }}</td>
                                    <td class="d-flex ">
                                        <form action="{{ route('admin.permissions.destroy', $permission->id) }}"
                                            method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-primary btn-sm ml-2">Remove Access</button>
                                        </form>
                                            <a href="{{ route('admin.permissions.edit',$permission->id) }}"
                                                class="btn btn-danger btn-sm">Edit Permission</a>
                                    </td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                    {{-- {{ $permissions->appends('search' => request(['search'])) }} --}}
                    {!! $permissions->links() !!}
                </div>
            </div>
            <!-- /.card -->
        </div>
    </div>
@endcomponent
