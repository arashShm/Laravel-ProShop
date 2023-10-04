@extends('profile.layouts')

@section('main')
    <h2>Orders List</h2>

    <div class="card-body table-responsive p-0">
        <table class="table table-hover">
            <tbody>
                <tr>
                    <th>Order id</th>
                    <th>Date of Order</th>
                    <th>Status</th>
                    {{-- <th>Comments</th> --}}
                    <th>Post Code</th>
                    <th>Proceedings</th>
                </tr>


                @foreach ($orders as $key => $order)
                    <tr>
                       <td>{{$order->id}}</td>
                       <td>{{jdate($order->created_at)->format('%d %B %Y')}}</td>
                       <td>{{$order->status}}</td>
                       <td class="text-danger">{{$order->tracking_serial ?? 'Not Confirmed'}}</td>
                       <td>
                            <a href="{{route('profile.orders.detail' , $order->id)}}" class="btn btn-sm btn-info">Details</a>

                            @if ($order->status == 'unpaid')
                                <a href="{{ route('profile.orders.payment' , $order->id)}}" class="btn btn-sm btn-warning">Pay</a>
                            @endif
                       </td>
                    </tr>
                @endforeach

            </tbody>
        </table>
        <div class="card-footer">
            {{ $orders->render() }}
            {{-- {!! $products->links() !!} --}}
        </div>
    </div>
@endsection