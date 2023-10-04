@component('admin.layouts.content' , ['title' => 'Order Details'])
    @slot('breadcrumb')
        <li class="breadcrumb-item"><a href="/admin">Admin Panel</a></li>
        <li class="breadcrumb-item active">{{ $order->id }} </li>
        <li class="breadcrumb-item active">Order List</li>
    @endslot

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Order List</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover">
                        <tbody>
                            <tr>
                                <th>id</th>
                                <th>Product Name</th>
                                <th>Product Count</th>
                                <th>Product Price</th>
                                <th>Total Price</th>
                            </tr>

                            @foreach($products as $product)
                                <tr>
                                    <td>{{ $product->id }}</td>
                                    <td>{{ $product->title }}</td>
                                    <td>{{ $product->pivot->quantity }}</td>
                                    <td>{{ number_format($product->price) }} $ </td>
                                    <td>{{ number_format($product->pivot->quantity * $product->price)}} $ </td>
                                </tr>
                            @endforeach


                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    {{ $products->render() }}
                </div>
            </div>
            <!-- /.card -->
        </div>
    </div>

@endcomponent
