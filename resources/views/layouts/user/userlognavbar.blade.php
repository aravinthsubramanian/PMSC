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
                <a class="navbar-brand logo" href="#">
                    <span>
                        PMS
                    </span>
                </a>
                <a class="navbar-brand logo-small" href="#">
                    <span>
                        PMS
                    </span>
                </a>
            </div>
            <div class="main-menu-wrapper">
                <div class="menu-header">
                    <a class="menu-logo" href="#">
                        <span>
                            PMS
                        </span>
                    </a>
                    <a class="menu-close" id="menu_close" href="javascript:void(0);">
                        <i class="fas fa-times"></i>
                    </a>
                </div>

                <ul class="main-nav">
                    {{-- <li>
                        <a href="{{route('user.dashboard')}}">Home</a>
                    </li>
                    <li>
                        <a href="{{route('user.products')}}">Products</a>
                    </li> --}}
                </ul>
            </div>
            <ul class="nav header-navbar-rht">
                {{-- <li class="nav-item dropdown">
                    <div class="flag-dropdown">
                        <a class="dropdown-toggle nav-link" data-bs-toggle="dropdown" href="#" role="button">
                            <img class="flag-img" src="assets/img/flags/us.png" alt="" height="20"> <span>English</span>
                        </a>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="javascript:void(0);">
                                <img src="assets/img/flags/us.png" alt="" height="16"> English
                            </a>
                            <a class="dropdown-item" href="javascript:void(0);">
                                <img src="assets/img/flags/fr.png" alt="" height="16"> French
                            </a>
                            <a class="dropdown-item" href="javascript:void(0);">
                                <img src="assets/img/flags/es.png" alt="" height="16"> Spanish
                            </a>
                            <a class="dropdown-item" href="javascript:void(0);">
                                <img src="assets/img/flags/de.png" alt="" height="16"> German
                            </a>
                        </div>
                    </div>
                </li>
                <li class="nav-item">
                    <a href="#"><i class="feather-settings"></i></a>
                </li>
                <li class="nav-item">
                    <a href="#"><i class="feather-bell"></i></a>
                </li> --}}
                <li class="nav-item">
                    <a class="nav-link header-login" href="{{route('users.loginoption')}}">
                        <i class="feather-users me-2"></i> Login
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</header>
<!-- /Header -->