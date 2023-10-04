@component('admin.layouts.content' , ['title' => 'Orders List'])
    @slot('breadcrumb')
        <li class="breadcrumb-item"><a href="/admin">Admin Panel</a></li>
        <li class="breadcrumb-item active">Orders List</li>
    @endslot


    <div class="row">
        <div class="col-lg-12">
            @include('admin.layouts.errors')
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Orders Edit</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form class="form-horizontal" action="{{ route('admin.orders.update', $order->id) }}" method="POST">
                    @csrf
                    @method('PATCH')

                    <div class="card-body">
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">Order Id</label>
                            <input type="text" class="form-control" id="inputEmail3" value="{{ $order->id }}" disabled>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">Order Price</label>
                            <input type="number" class="form-control" id="inputEmail3" disabled>
                        </div>
                        <div class="form-group">
                            <label for="inputPassword3" class="col-sm-2 control-label">Status</label>
                            <select name="status" class="form-control">
                                <option value="unpaid" {{ old('status' , $order->status) == 'unpaid' ? 'selected' : '' }}>Unpaid</option>
                                <option value="paid" {{ old('status' , $order->status) == 'paid' ? 'selected' : '' }}>Paid</option>
                                <option value="preparation" {{ old('status' , $order->status) == 'preparation' ? 'selected' : '' }}>Preparation</option>
                                <option value="posted" {{ old('status' , $order->status) == 'posted' ? 'selected' : '' }}>Posted</option>
                                <option value="received" {{ old('status' , $order->status) == 'received' ? 'selected' : '' }}>Recieved</option>
                                <option value="canceled" {{ old('status' , $order->status) == 'canceled' ? 'selected' : '' }}>Canceled</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="inputPassword3" class="col-sm-2 control-label">Post Code</label>
                            <input type="text" name="tracking_serial" class="form-control" id="inputPassword3" placeholder="Enter Post Code" value="{{ old('tracking_serial', $order->tracking_serial )}}">
                        </div>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                        <button type="submit" class="btn btn-info">Edit</button>
                        <a href="{{ route('admin.orders.index') }}" class="btn btn-default float-left">Cancel</a>
                    </div>
                    <!-- /.card-footer -->
                </form>
            </div>
        </div>
    </div>
@endcomponent