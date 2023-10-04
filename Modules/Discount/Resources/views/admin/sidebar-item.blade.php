<li class="nav-item has-treeview {{ isActive(['admin.discount.index'], 'menu-open') }}">
    <a href="#" class="nav-link {{ isActive(['admin.discount.index'], 'active') }}">
        <i class="nav-icon fa fa-dashboard"></i>
        <p>
            Discount
            <i class="right fa fa-angle-left"></i>
        </p>
    </a>
    <ul class="nav nav-treeview">
        <li class="nav-item">
            <a href="{{ route('admin.discount.index') }}"
                class="nav-link {{ isActive('admin.discount.index', 'active') }} ">
                <i class="fa fa-circle-o nav-icon"></i>
                <p>Discount Codes List</p>
            </a>
        </li>
    </ul>
</li>
