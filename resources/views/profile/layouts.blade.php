@extends('layouts.app')



@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <ul class="nav nav-pills card-header-pills">
                        <li class="nav-item">
                            <a href="{{route('profile.index')}}" class="nav-link {{Request::path() === 'profile' ? 'active' : ''}}">Profile</a>
                        </li>

                        <li class="nav-item">
                            <a href="{{route('profile.factor')}}" class="nav-link {{Request::path() === 'profile/twofactor' ? 'active' : ''}}">Two Factor Authenticate</a>
                        </li> 

                        <li class="nav-item">
                            <a href="{{route('profile.orders')}}" class="nav-link {{Request::path() === 'profile/orders' ? 'active' : ''}}">Orders</a>
                        </li> 
                    </ul>    
                </div>

                <div class="card-body">
                    @yield('main')
                </div>
            </div>
        </div>
    </div>
</div>
@endsection