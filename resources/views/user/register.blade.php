<!DOCTYPE html>
<html lang="en">
    @include('layouts.user.userheader')

    <body>

        <!-- Main Wrapper -->
        <div class="main-wrapper">

            @include('layouts.user.userlognavbar')
            @include('layouts.alerts.alerts')

            @include('layouts.user.userimports')

            <!-- Page Content -->
            <div class="content">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-6 col-md-12">

                            <!-- Login Content -->
                            <div class="account-content">
                                <div class="align-items-center justify-content-center">
                                    <div class="login-right">
                                        <div class="login-header text-center">
                                            <h3>Join PMS</h3>
                                        </div>
                                        <form action="{{ route('users.register') }}" method="POST">
                                            @csrf
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Name</label>
                                                        <input class="form-control" name="name" type="text" value="{{ old('name') }}" placeholder="Enter name">
                                                    </div>
                                                    @error('name')
                                                        <p class='text-danger'>{{ $message }}</p>
                                                    @enderror
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Email</label>
                                                        <input class="form-control" name="email" type="text" value="{{ old('email') }}" placeholder="Enter email">
                                                    </div>
                                                    @error('email')
                                                        <p class='text-danger'>{{ $message }}</p>
                                                    @enderror
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Mobile</label>
                                                        <input class="form-control" name="mobile" type="text" value="{{ old('mobile') }}" placeholder="Enter username">
                                                    </div>
                                                    @error('mobile')
                                                        <p class='text-danger'>{{ $message }}</p>
                                                    @enderror
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Password</label>
                                                        <input class="form-control" name="npassword" type="password" placeholder="Enter password">
                                                    </div>
                                                    @error('npassword')
                                                        <p class='text-danger'>{{ $message }}</p>
                                                    @enderror
                                                </div>

                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label>Confirm Password</label>
                                                        <input class="form-control" name="cpassword" type="password" placeholder="Enter confirm password">
                                                    </div>
                                                    @error('cpassword')
                                                        <p class='text-danger'>{{ $message }}</p>
                                                    @enderror
                                                </div>
                                            </div>
                                            {{-- <div class="form-group dont-have">
                                                <label class="custom_check">
                                                    <input name="rem_password" type="checkbox">
                                                    <span class="checkmark"></span> By signing up, I agree to PMS
                                                    <a href="#">Terms and Conditions</a>
                                                </label>
                                            </div> --}}
                                            <div class="form-group">
                                                <button class="btn btn-primary w-100" type="submit">
                                                    Register
                                                </button>
                                            </div>
                                            <div class="row align-items-center">
                                                <div class="col-12 text-center dont-have mt-0">
                                                    Already on PMS? <a href="{{ route('users.loginoption') }}">Click here</a>
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
            {{-- @include('layouts.user.userfooter') --}}
        </div>
        <!-- /Main Wrapper -->
    </body>
</html>
