@component('admin.layouts.content', ['title' => 'Admin Panel'])
    @slot('breadcrumb')
        <li class="breadcrumb-item active">Admin Panel</li>
        <li class="breadcrumb-item"><a href="{{route('admin.users.create')}}">Create User</a></li>
        <li class="breadcrumb-item "><a href="/admin/users">Users List</a></li>
    @endslot
@endcomponent
