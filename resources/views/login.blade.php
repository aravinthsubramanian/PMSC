<!DOCTYPE html>
<html lang="en">

    @include('layouts.user.userheader')

    <body>

        @include('layouts.alerts.alerts')

        @include('layouts.user.userimports')

        <!-- Main Wrapper -->
        <div class="main-wrapper">

            {{-- @include('layout.user.userlognavbar') --}}

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
                                            <h3>Login as Admin/User</h3>
                                        </div>
                                        <form action="{{route('common.login')}}" method="POST">
                                            @csrf
                                            <div class="form-group">
                                                <label>Email</label>
                                                <input class="form-control" name="email" type="text" value="{{ old('email') }}" placeholder="Email">
                                                @error('email')
                                                    <p class='text-danger'>{{ $message }}</p>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label>Password</label>
                                                <input class="form-control" name="password" type="password" placeholder="Enter password">
                                                @error('password')
                                                    <p class='text-danger'>{{ $message }}</p>
                                                @enderror
                                            </div>
                                            <button class="btn btn-primary w-100" type="submit">
                                                Login
                                            </button>
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

        </div>
        <!-- /Main Wrapper -->

    </body>

</html>
