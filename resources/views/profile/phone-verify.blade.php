@extends('layouts.app')



@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    Active Phone Number :
                </div>

                <div class="card-body">
                    <form action="{{route('profile.factor.insertCode')}}" method="POST">
                        @csrf
                        <div class="form-group my-3">
                            <label for="token" class="col-form-label">Code :</label>
                            <input type="text" class="form-control @error('token') is-invalid @enderror" name="token" placeholder="Enter Your Code">
                            @error('token')
                                <span class="invalid-feedback">
                                    <strong>{{$message}}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group my-3">
                            <button class="btn btn-primary">Verify Phone</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection