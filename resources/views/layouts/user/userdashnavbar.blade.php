<!-- Header -->
<header class="header">
    <div class="container">
        <nav class="navbar navbar-expand-lg header-nav">
            <div class="navbar-header">
                <a id="mobile_btn" href="javascript:void(0);">
                    <span class="bar-icon">
                        <span></span>
                        <span></span>
                        <span></span>
                    </span>
                </a>
                <a class="navbar-brand logo" href="{{ route('users.dashboard') }}">
                    <span>
                        PMS
                    </span>
                </a>
                <a class="navbar-brand logo-small" href="index.html">

                </a>
            </div>
            <div class="main-menu-wrapper">
                <div class="menu-header">
                    <a class="menu-logo" href="{{ route('users.dashboard') }}">
                        <span>
                            PMS
                        </span>
                    </a>
                    <a class="menu-close" id="menu_close" href="javascript:void(0);">
                        <i class="fas fa-times"></i>
                    </a>
                </div>

                <ul class="main-nav">
                    <li>
                        <a href="{{ route('users.dashboard') }}">Home</a>
                    </li>
                    <li>
                        <a href="{{ route('users.product') }}">Product</a>
                    </li>
                </ul>
            </div>
            <ul class="nav header-navbar-rht">

                <!-- User Menu -->
                <li class="nav-item dropdown has-arrow">
                    <a class="dropdown-toggle nav-link" data-bs-toggle="dropdown" href="#">
                        <span class="user-img"><img class="rounded-circle" src="{{asset('user/assets/img/profiles/avatar-12.jpg')}}" alt="Ryan Taylor" width="31"></span>
                    </a>
                    <div class="dropdown-menu">
                        <div class="user-header">
                            <div class="avatar avatar-sm">
                                <img class="avatar-img rounded-circle" src="{{asset('user/assets/img/profiles/avatar-12.jpg')}}" alt="User Image">
                            </div>
                            <div class="user-text">
                                <h6>{{Auth::User()->name}}</h6>
                            </div>
                        </div>
                        <a class="dropdown-item" href="#">My Profile</a>
                        <a class="dropdown-item" href="{{route('users.logout')}}">Logout</a>
                    </div>
                </li>
                <!-- /User Menu -->

            </ul>
        </nav>
    </div>
</header>
<!-- /Header -->
