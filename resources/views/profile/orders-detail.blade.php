@extends('profile.layouts')

@section('main')
    <h2>Orders List</h2>

    <div class="card-body table-responsive p-0">
        <table class="table table-hover">
            <tbody>
                <tr>
                    <th>Product id</th>
                    <th>Product Name</th>
                    <th>Count</th>
                    <th>Price</th>
                </tr>

                {{-- @if ($order->user_id == auth()->user()->id) --}}
                    @foreach ($order->products as $key => $product)
                        <tr>
                            <td>{{ $product->id }}</td>
                            <td>{{ $product->title }}</td>
                            <td>{{ $product->pivot->quantity }}</td>
                            <td>{{ $product->pivot->quantity * $product->price }}</td>
                        </tr>
                    @endforeach
                {{-- @endif --}}

            </tbody>
        </table>
        {{-- <div class="card-footer">
            {{ $order->products->render() }}
            {{-- {!! $products->links() !!} --}}
        {{-- </div>  --}}
    </div>
@endsection
