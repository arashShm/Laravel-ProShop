<aside class="main-sidebar sidebar-dark-primary elevation-4">

    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
        <img src="dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
            style="opacity: .8">
        <span class="brand-text font-weight-light">پنل مدیریت</span>
    </a>
    <div class="sidebar" style="direction: ltr">
        <div style="direction: rtl">
            <!-- Sidebar user panel (optional) -->
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="image">
                    <img src="https://www.gravatar.com/avatar/52f0fbcbedee04a121cba8dad1174462?s=200&d=mm&r=g"
                        class="img-circle elevation-2" alt="User Image">
                </div>
                <div class="info">
                    <a href="#" class="d-block">حسام موسوی</a>
                </div>
            </div>

            <!-- Sidebar Menu -->
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                    data-accordion="false">

                    <li class="nav-item">
                        <a href="{{ route('admin.main') }}" class="nav-link {{ isActive('admin.main', 'active') }}">
                            <i class="nav-icon fa fa-dashboard"></i>
                            <p>Admin Panel</p>
                        </a>
                    </li>
                    @can('show-user')
                        <li
                            class="nav-item has-treeview {{ isActive(['admin.users.index', 'admin.users.create', 'admin.users.edit'], 'menu-open') }}">
                            <a href="#"
                                class="nav-link {{ isActive(['admin.users.index', 'admin.users.create', 'admin.users.edit'], 'active') }}">
                                <i class="nav-icon fa fa-dashboard"></i>
                                <p>
                                    Users
                                    <i class="right fa fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('admin.users.index') }}"
                                        class="nav-link {{ isActive('admin.users.index', 'active') }} ">
                                        <i class="fa fa-circle-o nav-icon"></i>
                                        <p>Users List</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    @endcan


                    @can('isAdmin')
                        <li
                            class="nav-item has-treeview {{ isActive(['admin.permissions.index', 'admin.roles.index'], 'menu-open') }}">
                            <a href="#"
                                class="nav-link {{ isActive(['admin.permissions.index', 'admin.roles.index'], 'active') }}">
                                <i class="nav-icon fa fa-dashboard"></i>
                                <p>
                                    Access
                                    <i class="right fa fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('admin.roles.index') }}"
                                        class="nav-link {{ isActive('admin.roles.index', 'active') }} ">
                                        <i class="fa fa-circle-o nav-icon"></i>
                                        <p>Roles</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('admin.permissions.index') }}"
                                        class="nav-link {{ isActive('admin.permissions.index', 'active') }} ">
                                        <i class="fa fa-circle-o nav-icon"></i>
                                        <p>Permissions</p>
                                    </a>
                                </li>

                            </ul>
                        </li>

                        <li class="nav-item has-treeview {{ isActive(['admin.permissions.index'], 'menu-open') }}">
                            <a href="#" class="nav-link {{ isActive(['admin.products.index'], 'active') }}">
                                <i class="nav-icon fa fa-dashboard"></i>
                                <p>
                                    Products
                                    <i class="right fa fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('admin.products.index') }}"
                                        class="nav-link {{ isActive('admin.products.index', 'active') }} ">
                                        <i class="fa fa-circle-o nav-icon"></i>
                                        <p>Product List</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    @endcan



                    @can('edit-comment')
                        <li
                            class="nav-item has-treeview {{ isActive(['admin.comments.index', 'admin.comments.unapproved'], 'menu-open') }}">
                            <a href="#"
                                class="nav-link {{ isActive(['admin.comments.index', 'admin.comments.unapproved'], 'active') }}">
                                <i class="nav-icon fa fa-dashboard"></i>
                                <p>
                                    Comments
                                    <i class="right fa fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('admin.comments.index') }}"
                                        class="nav-link {{ isActive('admin.comments.index', 'active') }} ">
                                        <i class="fa fa-circle-o nav-icon"></i>
                                        <p>Comments List</p>
                                    </a>
                                </li>
                            </ul>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('admin.comments.unapproved') }}"
                                        class="nav-link {{ isActive('admin.comments.unapproved', 'active') }} ">
                                        <i class="fa fa-circle-o nav-icon"></i>
                                        <p> Unapproved Comments</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    @endcan

                    <li class="nav-item has-treeview {{ isActive(['admin.categories.index'], 'menu-open') }}">
                        <a href="#" class="nav-link {{ isActive(['admin.categories.index'], 'active') }}">
                            <i class="nav-icon fa fa-dashboard"></i>
                            <p>
                                Categories
                                <i class="right fa fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('admin.categories.index') }}"
                                    class="nav-link {{ isActive('admin.categories.index', 'active') }} ">
                                    <i class="fa fa-circle-o nav-icon"></i>
                                    <p>Categories List</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item has-treeview {{ isActive(['admin.orders.index'], 'menu-open') }}">
                        <a href="#" class="nav-link {{ isActive(['admin.orders.index', 'active']) }}">
                            <i class="nav-icon fa fa-users"></i>
                            <p>
                                Orders
                                <i class="right fa fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('admin.orders.index', ['type' => 'unpaid']) }}"
                                    class="nav-link {{ isUrl(route('admin.orders.index', ['type' => 'unpaid'])) }} ">
                                    <i class="fa fa-circle-o nav-icon text-warning"></i>
                                    <p>Unpaid
                                        <span
                                            class="badge badge-warning right">{{ \App\Models\Order::whereStatus('unpaid')->count() }}</span>
                                    </p>
                                </a>
                            </li>
                        </ul>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('admin.orders.index', ['type' => 'paid']) }}"
                                    class="nav-link {{ isUrl(route('admin.orders.index', ['type' => 'paid'])) }}">
                                    <i class="fa fa-circle-o nav-icon text-info"></i>
                                    <p>Paid
                                        <span
                                            class="badge badge-info right">{{ \App\Models\Order::whereStatus('paid')->count() }}</span>
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.orders.index', ['type' => 'preparation']) }}"
                                    class="nav-link {{ isUrl(route('admin.orders.index', ['type' => 'preparation'])) }}">
                                    <i class="fa fa-circle-o nav-icon text-primary"></i>
                                    <p>Preparation
                                        <span
                                            class="badge badge-primary right">{{ \App\Models\Order::whereStatus('preparation')->count() }}</span>
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.orders.index', ['type' => 'posted']) }}"
                                    class="nav-link {{ isUrl(route('admin.orders.index', ['type' => 'posted'])) }}">
                                    <i class="fa fa-circle-o nav-icon text text-light"></i>
                                    <p>Posted
                                        <span
                                            class="badge badge-light right">{{ \App\Models\Order::whereStatus('posted')->count() }}</span>
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.orders.index', ['type' => 'received']) }}"
                                    class="nav-link {{ isUrl(route('admin.orders.index', ['type' => 'received'])) }}">
                                    <i class="fa fa-circle-o nav-icon text-success"></i>
                                    <p>Received
                                        <span
                                            class="badge badge-success right">{{ \App\Models\Order::whereStatus('received')->count() }}</span>
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.orders.index', ['type' => 'canceled']) }}"
                                    class="nav-link {{ isUrl(route('admin.orders.index', ['type' => 'canceled'])) }}">
                                    <i class="fa fa-circle-o nav-icon text-danger"></i>
                                    <p>Canceled
                                        <span
                                            class="badge badge-danger right">{{ \App\Models\Order::whereStatus('canceled')->count() }}</span>
                                    </p>
                                </a>
                            </li>
                        </ul>
                    </li>


                    @foreach (Module::collections() as $module)
                        @if (View::exists("{$module->getLowerName()}::admin.sidebar-item"))
                            @include("{$module->getLowerName()}::admin.sidebar-item")
                        @endif
                    @endforeach

                </ul>
            </nav>
            <!-- /.sidebar-menu -->
        </div>
    </div>
</aside>
