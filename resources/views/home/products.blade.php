@extends('layouts.app')


{{-- @section('script')
    <script src="https://www.google.com/recaptcha/api.js?hl=fa" async defer></script>
@endsection --}}


@section('content')
    <div class="container">
        <div class="row">
                @foreach ($products as $product)
                <div class="col-sm-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">{{$product->title}}</h5>
                            <br>
                            <p class="card-text">{{$product->description}}</p>

                            <div class="card-body">
                                @if ($product->categories)
                                    @foreach ($product->categories as $category)
                                        <a href="" class="mr-2">{{$category->name}}</a>
                                    @endforeach
                                @endif      
                            </div>
                            <a href="{{route('product.single' , $product->id)}}" class="btn btn-primary">more details</a>
                        </div>
                    </div>
                </div>
                @endforeach
        </div>
    </div>
@endsection
