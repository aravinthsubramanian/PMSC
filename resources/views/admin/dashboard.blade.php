<!DOCTYPE html>
<html lang="en">
    @include('layouts.admin.adminheader')

    <body>

        @include('layouts.alerts.alerts')

        @include('layouts.admin.adminimports')
        
        <!-- Main Wrapper -->
        <div class="main-wrapper">

            @include('layouts.admin.admindashnav')

            @include('layouts.admin.adminsidebar')

            <!-- Page Wrapper -->
            <div class="page-wrapper">

                <div class="content container-fluid">

                    <!-- Page Header -->
                    <div class="page-header">
                        <div class="row">
                            <div class="col-sm-12">
                                <h3 class="page-title">Dashboard</h3>
                            </div>
                        </div>
                    </div>
                    <!-- /Page Header -->

                    <div class="row">
                        
                        <div class="col-xl-3 col-sm-6 col-12">
                            <div class="card">
                                <div class="card-body">
                                    <a href="{{route('permissions.index')}}">
                                        <div class="dash-widget-header">
                                            <span class="dash-widget-icon text-primary border-primary">
                                                <i class="feather-lock"></i>
                                            </span>
                                            <div class="dash-count">
                                                <h3>{{$permissions_count}}</h3>
                                                <h6 class="text-muted">Total Permissions</h6>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-sm-6 col-12">
                            <div class="card">
                                <div class="card-body">
                                    <a href="{{route('roles.index')}}">
                                        <div class="dash-widget-header">
                                            <span class="dash-widget-icon text-primary border-primary">
                                                <i class="feather-shield"></i>
                                            </span>
                                            <div class="dash-count">
                                                <h3>{{$roles_count}}</h3>
                                                <h6 class="text-muted">Total Roles</h6>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-sm-6 col-12">
                            <div class="card">
                                <div class="card-body">
                                    <a href="{{route('admins.index')}}">
                                        <div class="dash-widget-header">
                                            <span class="dash-widget-icon text-primary border-primary">
                                                <i class="feather-user"></i>
                                            </span>
                                            <div class="dash-count">
                                                <h3>{{$admins_count}}</h3>
                                                <h6 class="text-muted">Total Admins</h6>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-sm-6 col-12">
                            <div class="card">
                                <div class="card-body">
                                    <a href="{{route('admins.users')}}">
                                        <div class="dash-widget-header">
                                            <span class="dash-widget-icon text-primary border-primary">
                                                <i class="feather-users"></i>
                                            </span>
                                            <div class="dash-count">
                                                <h3>{{$users_count}}</h3>
                                                <h6 class="text-muted">Total Users</h6>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-sm-6 col-12">
                            <div class="card">
                                <div class="card-body">
                                    <a href="{{route('categories.index')}}">
                                        <div class="dash-widget-header">
                                            <span class="dash-widget-icon text-primary border-primary">
                                                <i class="feather-database"></i>
                                            </span>
                                            <div class="dash-count">
                                                <h3>{{$categories_count}}</h3>
                                                <h6 class="text-muted">Total Category</h6>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-sm-6 col-12">
                            <div class="card">
                                <div class="card-body">
                                    <a href="{{route('subcategories.index')}}">
                                        <div class="dash-widget-header">
                                            <span class="dash-widget-icon text-primary border-primary">
                                                <i class="feather-database"></i>
                                            </span>
                                            <div class="dash-count">
                                                <h3>{{$subcategories_count}}</h3>
                                                <h6 class="text-muted">Total Subcategory</h6>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-sm-6 col-12">
                            <div class="card">
                                <div class="card-body">
                                    <a href="{{route('products.index')}}">
                                        <div class="dash-widget-header">
                                            <span class="dash-widget-icon text-primary border-primary">
                                                <i class="feather-shopping-cart"></i>
                                            </span>
                                            <div class="dash-count">
                                                <h3>{{$products_count}}</h3>
                                                <h6 class="text-muted">Total Products</h6>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <!-- /Page Wrapper -->

        </div>
        <!-- /Main Wrapper -->

    </body>

</html>
