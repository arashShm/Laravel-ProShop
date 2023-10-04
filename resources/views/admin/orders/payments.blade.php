@component('admin.layouts.content' , ['title' => 'Payments List'])
    @slot('breadcrumb')
        <li class="breadcrumb-item"><a href="/admin">Admin Panel</a></li>
        <li class="breadcrumb-item active">Order Id{{ $order->id }} </li>
        <li class="breadcrumb-item active">Payments List</li>
    @endslot

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Payments List</h3>

                    <div class="card-tools d-flex">
                        <form action="">
                            <div class="input-group input-group-sm" style="width: 150px;">
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
                                <th>Payment ResNmber</th>
                                <th>Status</th>
                                <th>Time</th>
                            </tr>

                            @foreach($payments as $payment)
                                <tr>
                                    <td>{{ $payment->id }}</td>
                                    <td>{{ $payment->resnumber }}</td>
                                    <td>{{ $payment->status ? 'Paid' :'Unpaid'}}</td>
                                    <td>{{ jdate($payment->created_at)->format('%Y-%m-%d') }}</td>
                                </tr>
                            @endforeach


                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    {{ $payments->appends([ 'search' => request('search') ])->render() }}
                </div>
            </div>
            <!-- /.card -->
        </div>
    </div>

@endcomponent
