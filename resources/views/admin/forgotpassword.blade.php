@include('layouts.admin.adminheader')

<body>	
    
    @include('layouts.alerts.alerts')

    @include('layouts.admin.adminimports')
    
    <!-- Main Wrapper -->
    <div class="main-wrapper login-body">
        <div class="login-wrapper">
            <div class="container">
                <div class="loginbox">
                    <div class="login-left">
                        <span>PMS</span>
                    </div>
                    <div class="login-right">
                        <div class="login-right-wrap">
                            <h1>Forgot Password?</h1>
                            <p class="account-subtitle">Enter your email to get a password reset link</p>
                            
                            <!-- Form -->
                            <form action="{{route('admins.sendmail')}}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <input class="form-control" type="text" name="email" placeholder="Email">
                                    @error('email')
                                            <p class='text-danger'>{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="form-group mb-0">
                                    <button class="btn btn-primary btn-block w-100" type="submit">Submit</button>
                                </div>
                            </form>
                            <!-- /Form -->
                            
                            <div class="text-center dont-have">I have password? <a href="{{route('admins.loginoption')}}">Login</a></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /Main Wrapper -->  
</body>