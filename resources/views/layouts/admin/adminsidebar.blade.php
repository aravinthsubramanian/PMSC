<!-- Sidebar -->
<div class="sidebar" id="sidebar">
    <div class="sidebar-inner slimscroll">
        <div class="sidebar-menu" id="sidebar-menu">
            <ul>
                <li>
                    <a href="{{ route('admins.dashboard') }}">
                        <span><i class="feather-grid"></i> Dashboard</span>
                    </a>
                </li>
                @haspermission('PERMISSION_READ','admin')
                    <li>
                        {{-- <a href="{{route('role.view')}}"> --}}
                        <a href="{{ route('permissions.index') }}">
                            <span><i class="feather-lock"></i> Permissions</span>
                        </a>
                    </li>
                @endhaspermission

                @haspermission('ROLE_READ','admin')
                <li>
                    {{-- <a href="{{route('role.view')}}"> --}}
                    <a href="{{ route('roles.index') }}">
                        <span><i class="feather-shield"></i> Roles</span>
                    </a>
                </li>
                @endhaspermission

                @haspermission('ADMIN_READ','admin')
                    <li>
                        {{-- <a href="{{route('admins.view')}}"> --}}
                        <a href="{{ route('admins.index') }}">
                            <span><i class="feather-user"></i> Admins</span>
                        </a>
                    </li>
                @endhaspermission

                @haspermission('USER_READ','admin')
                    <li>
                        {{-- <a href="{{route('users.view')}}"> --}}
                        <a href="{{ route('admins.users') }}">
                            <span><i class="feather-users"></i> Users</span>
                        </a>
                    </li>
                @endhaspermission
                @haspermission('MAINCATEGORY_READ','admin')
                    <li>
                        {{-- <a href="{{route('category.view')}}"> --}}
                        <a href="{{ route('categories.index') }}">
                            <span><i class="feather-database"></i>Category</span>
                        </a>
                    </li>
                @endhaspermission
                @haspermission('SUBCATEGORY_READ','admin')
                    <li>
                        {{-- <a href="{{route('subcategory.view')}}"> --}}
                        <a href="{{ route('subcategories.index') }}">
                            <span><i class="feather-database"></i> Sub Category</span>
                        </a>
                    </li>
                @endhaspermission
                @haspermission('PRODUCT_READ','admin')
                    <li>
                        {{-- <a href="{{route('product.view')}}"> --}}
                        <a href="{{ route('products.index') }}">
                            <span><i class="feather-shopping-cart"></i>Products</span>
                        </a>
                    </li>
                @endhaspermission
            </ul>
        </div>
    </div>
</div>
<!-- /Sidebar -->
