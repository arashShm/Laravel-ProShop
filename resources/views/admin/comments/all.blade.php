@component('admin.layouts.content', ['title' => 'Comments List'])
    @slot('breadcrumb')
        <li class="breadcrumb-item "><a href="/admin">Admin Panel</a></li>
        <li class="breadcrumb-item "><a href="{{route('admin.comments.unapproved')}}">Unapproved Comments List</a></li>
        <li class="breadcrumb-item active">Comments List</li>
    @endslot

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Comments </h3>

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

                        </div>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover">
                        <tbody>
                            <tr>
                                <th>id</th>
                                <th>User Name</th>
                                <th>Comment</th>
                                <th>Status</th>
                                <th>Proceedings</th>
                            </tr>


                            @foreach ($comments as $key => $comment)
                                <tr>
                                    <td>{{ $comment->id }}</td>
                                    <td>{{ $comment->user->name }}</td>
                                    <td>{{ $comment->comment }}</td>
                                    @if ($comment->approved === 1)
                                        <td><span class="badge badge-success">Approved</span></td>
                                    @elseif($comment->approved === 0)
                                        <td><span class="badge badge-danger">Unapproved</span></td>
                                    @endif

                                    <td class="d-flex ">
                                        @can('edit-comment')
                                            <form action="{{ route('admin.comments.destroy', ['comment' => $comment->id]) }}"
                                                method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-primary btn-sm ml-2">Remove Comment</button>
                                            </form>
                                            @if ($comment->approved == 0)
                                                <form action="{{ route('admin.comments.update', ['comment' => $comment->id]) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('PATCH')
                                                    <button type="submit" class="btn btn-success btn-sm ml-2">Edit
                                                        Comment</button>
                                                </form>
                                            @endif
                                            {{-- <a href="{{ route('admin.comments.update', ['comment' =>$comment->id]) }}"
                                                class="btn btn-danger btn-sm ml-2">Edit Comment</a> --}}
                                        @endcan
                                    </td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                    {{-- {{$comments->appends('search' => request(['search']))->render() }} --}}
                    {!! $comments->links() !!}
                </div>
            </div>
            <!-- /.card -->
        </div>
    </div>
@endcomponent
