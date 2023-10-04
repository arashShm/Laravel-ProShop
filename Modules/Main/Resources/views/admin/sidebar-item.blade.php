<li class="nav-item has-treeview {{ isActive(['admin.main.index'], 'menu-open') }}">
    <a href="#" class="nav-link {{ isActive(['admin.main.index'], 'active') }}">
        <i class="nav-icon fa fa-dashboard"></i>
        <p>
            Modules
            <i class="right fa fa-angle-left"></i>
        </p>
    </a>
    <ul class="nav nav-treeview">
        <li class="nav-item">
            <a href="{{ route('admin.main.index') }}"
                class="nav-link {{ isActive('admin.main.index', 'active') }} ">
                <i class="fa fa-circle-o nav-icon"></i>
                <p>Modules List</p>
            </a>
        </li>
    </ul>
</li>