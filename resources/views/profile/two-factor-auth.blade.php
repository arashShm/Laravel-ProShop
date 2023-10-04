@extends('profile.layouts')



@section('main')
    
    <h3>Two Factor Authenticate :</h3>
    <hr>

    @if($errors->any())
        @foreach ($errors->all() as $error)
            <div class="alert alert-danger">
                {{$error}}
            </div>
        @endforeach
    @endif 

    <form action="" method="POST" class="">
        @csrf
            <div class="form-group my-3">
                <label for="type">Type :</label>
                <select name="type" id="type" class="form-control">
                    @foreach (config('twofactor.types') as $key => $value)
                        <option value="{{$key}}" {{old('type') == $key || auth()->user()->hasTwoFactor($key) ? 'selected' : ''}}>{{$value}}</option>
                    @endforeach
                </select>
            </div>
    
            <div class="form-group my-3">
                <label for="phone">Phone Number :</label>
                <input type="text" name="phone" id="phone" class="form-control" placeholder="Enter your Number" value="{{old('phone_number') ?? auth()->user()->phone_number}}">
            </div>
    
            <div class="form-group my-3">
                <button class="btn btn-primary">update</button>
            </div>

    </form>
@endsection
