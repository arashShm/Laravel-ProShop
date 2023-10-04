@component('admin.layouts.content' , ['title' => 'Orders List'])
    @slot('breadcrumb')
        <li class="breadcrumb-item"><a href="/admin">Admin Panel</a></li>
        <li class="breadcrumb-item active">Orders List</li>
    @endslot

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Orders</h3>

                    <div class="card-tools d-flex">
                        <form action="">
                            <div class="input-group input-group-sm" style="width: 150px;">
                                <input type="hidden" name="type" value="{{ request('type') }}">
                                <input type="text" name="search" class="form-control float-right" placeholder="جستجو" value="{{ request('search') }}">

                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover">
                        <tbody>
                            <tr>
                                <th>id</th>
                                <th>User</th>
                                <th>Order Price</th>
                                <th>Status</th>
                                <th>Post Code</th>
                                <th>Time</th>
                                <th>Proceedings</th>
                            </tr>

                            @foreach($orders as $order)
                                <tr>
                                    <td>{{ $order->id }}</td>
                                    <td>{{ $order->user->name }}</td>
                                    <td>{{ $order->price }}</td>
                                    <td>{{ $order->status }}</td>
                                    <td>{{ $order->tracking_serial ?? '!No Record Yet' }}</td>
                                    <td>{{ jdate($order->created_at)->ago() }}</td>
                                    <td class="d-flex">
                                        <a href="{{ route('admin.orders.show' , $order->id) }}" class="btn btn-sm btn-warning  ml-1">Order Detail</a>
                                        <a href="{{ route('admin.orders.payments' , $order->id) }}" class="btn btn-sm btn-info  ml-1">Payments Details</a>
                                        <a href="{{ route('admin.orders.edit' , $order->id) }}" class="btn btn-sm btn-primary  ml-1">Edit Order</a>
                                        <form action="{{ route('admin.orders.destroy' , $order->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach


                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    {{ $orders->render() }}
                </div>
            </div>
            <!-- /.card -->
        </div>
    </div>

@endcomponent
