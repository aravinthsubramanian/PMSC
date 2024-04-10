<!DOCTYPE html>
<html lang="en">
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
                                <h1>Admin Login</h1>
                                <p class="account-subtitle">Welcome our world</p>

                                <!-- Form -->
                                <form action="{{ route('admins.login') }}" method="POST">
                                    @csrf
                                    <div class="form-group">
                                        <input class="form-control" name="email" type="text" value="{{ old('email') }}" placeholder="Email">
                                        @error('email')
                                            <p class='text-danger'>{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <input class="form-control" name="password" type="password" placeholder="Password">
                                        @error('password')
                                            <p class='text-danger'>{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <button class="btn btn-primary btn-block w-100" type="submit">Login</button>
                                    </div>
                                </form>
                                <!-- /Form -->

                                <div class="text-center forgotpass"><a href="{{route('admins.forgotpassword')}}">Forgot Password?</a></div>
                                {{-- <div class="login-or">
									<span class="or-line"></span>
									<span class="span-or">or</span>
								</div> --}}

                                <!-- Social Login -->
                                {{-- <div class="social-login">
									<span>Login with</span>
									<a href="#" class="facebook"><i class="fab fa-facebook-f"></i></a>
									<a href="#" class="google"><i class="fab fa-google"></i></a>
								</div> --}}
                                <!-- /Social Login -->

                                {{-- <div class="text-center dont-have">Don’t have an account? <a href="{{ route('admin.register') }}">Register</a></div> --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Main Wrapper -->

    </body>

</html>
