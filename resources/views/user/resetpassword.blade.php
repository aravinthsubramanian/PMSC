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
                                            <h3>Reset Password</h3>
                                        </div>
                                        <form action="{{ route('users.updatepassword') }}" method="POST">
                                            @csrf
                                            <div class="row">
                                                <input id="token" name="token" type="text" value="{{ $token }}" hidden>
                                                <input name="email" type="text" value="{{ $email }}" hidden>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Email</label>
                                                        <input class="form-control" name="" type="text" value="{{ $email }}" disabled>
                                                        @error('email')
                                                            <p class='text-danger'>{{ $message }}</p>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Password</label>
                                                        <input class="form-control" name="npassword" type="password" placeholder="Enter password">
                                                        @error('npassword')
                                                            <p class='text-danger'>{{ $message }}</p>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label>Confirm Password</label>
                                                        <input class="form-control" name="cpassword" type="password" placeholder="Enter confirm password">
                                                        @error('cpassword')
                                                            <p class='text-danger'>{{ $message }}</p>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <button class="btn btn-primary w-100" type="submit">
                                                    Update password
                                                </button>
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

            @include('layouts.user.userfooter')

        </div>
        <!-- /Main Wrapper -->

    </body>

</html>
