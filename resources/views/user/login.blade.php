<!DOCTYPE html>
<html lang="en">

    @include('layouts.user.userheader')

    <body>

        @include('layouts.alerts.alerts')

        @include('layouts.user.userimports')

        <!-- Main Wrapper -->
        <div class="main-wrapper">

            @include('layouts.user.userlognavbar')

            <!-- Page Content -->
            <div class="content">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-5 col-md-7">

                            <!-- Login Content -->
                            <div class="account-content">
                                <div class="align-items-center justify-content-center">
                                    <div class="login-right">
                                        <div class="login-header text-center">
                                            <h3>Welcome Back</h3>
                                        </div>
                                        <form action="{{ route('users.login') }}" method="POST">
                                            @csrf
                                            <div class="form-group">
                                                <label>Email</label>
                                                <input class="form-control" type="text" placeholder="Email" name="email" value="{{old('email')}}">
                                                @error('email')
                                                    <p class='text-danger'>{{ $message }}</p>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label>Password</label>
                                                <input class="form-control" type="password" name="password" placeholder="Enter password">
                                                @error('password')
                                                    <p class='text-danger'>{{ $message }}</p>
                                                @enderror
                                            </div>
                                            {{-- <div class="form-group">
                                                <label class="custom_check">
                                                    <input name="rem_password" type="checkbox">
                                                    <span class="checkmark"></span> Remember password
                                                </label>
                                            </div> --}}
                                            <button class="btn btn-primary w-100" type="submit">Login</button>
                                            {{-- <div class="login-or">
                                                <span class="or-line"></span>
                                                <span class="span-or">Or</span>
                                            </div> --}}

                                            <div class="row align-items-center">
                                                <div class="col-6 text-start">
                                                    <a class="forgot-link" href="{{route('users.forgotpassword')}}">Forgot Password ?</a>
                                                </div>
                                                <div class="col-6 text-end dont-have">
                                                    Don’t have an account? <a href="{{ route('users.registeroption') }}">Click here</a>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <!-- /Login Content -->

                        </div>
                    </div>
                </div>
            </div>
            <!-- /Page Content -->
            <br><br><br><br><br>

            {{-- @include('layouts.user.userfooter') --}}

        </div>
        <!-- /Main Wrapper -->

    </body>

</html>
