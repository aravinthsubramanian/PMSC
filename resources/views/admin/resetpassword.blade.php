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
                                <h1>Reset Password</h1>
                                <p class="account-subtitle">Update your password</p>

                                <!-- Form -->
                                <form action="{{ route('admins.updatepassword') }}" method="POST">
                                    @csrf
                                    <input name="token" type="text" value="{{ $token }}" hidden>

                                    <input name="email" type="text" value="{{ $email }}" hidden>
                                    
                                    <div class="form-group">
                                        <input class="form-control" name="" type="email" value="{{ $email }}" disabled>
                                        @error('email')
                                            <p class='text-danger'>{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <input class="form-control" name="npassword" type="password" placeholder="New Password">
                                        @error('npassword')
                                            <p class='text-danger'>{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <input class="form-control" name="cpassword" type="password" placeholder="Confirm Password">
                                        @error('cpassword')
                                            <p class='text-danger'>{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <button class="btn btn-primary btn-block w-100" type="submit">Update Password</button>
                                    </div>
                                </form>
                                <!-- /Form -->

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Main Wrapper -->
    </body>

</html>
