<!-- Header -->
<div class="header">

    <!-- Logo -->
    <div class="header-left">
        <a class="logo" href="#">
            <span> PMS</span>
        </a>
    </div>
    <!-- /Logo -->

    <!-- Mobile Menu Toggle -->
    <a class="mobile_btn" id="mobile_btn">
        <i class="fa fa-bars"></i>
    </a>
    <!-- /Mobile Menu Toggle -->

    <!-- Header Right Menu -->
    <ul class="nav user-menu">

        <!-- User Menu -->
        <li class="nav-item dropdown has-arrow">
            <a class="dropdown-toggle nav-link" data-bs-toggle="dropdown" href="#">
                <span class="user-img"><img class="rounded-circle" src="{{ asset('admin/assets/img/profiles/avatar-12.jpg') }}" alt="Ryan Taylor" width="31"></span>
            </a>
            <div class="dropdown-menu">
                <div class="user-header">
                    <div class="avatar avatar-sm">
                        <img class="avatar-img rounded-circle" src="{{ asset('admin/assets/img/profiles/avatar-12.jpg') }}" alt="User Image">
                    </div>
                    <div class="user-text">
                        <h6>{{ Auth::guard('admin')->user()->ad_name }}</h6>
                    </div>
                </div>
                <a class="dropdown-item" href="{{ route('admins.myprofile', Auth::guard('admin')->user()->id) }}">My Profile</a>
                <a class="dropdown-item" href="{{ route('admins.mypassword', Auth::guard('admin')->user()->id) }}">Change Password</a>
                <a class="dropdown-item" href="{{ route('admins.logout') }}">Logout</a>
            </div>
        </li>
        <!-- /User Menu -->

    </ul>
    <!-- /Header Right Menu -->

</div>
<!-- /Header -->
