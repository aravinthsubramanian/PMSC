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
                                        <form action="{{route('users.sendmail')}}" method="POST">
                                            @csrf
                                            <div class="form-group">
                                                <label>Email</label>
                                                <input class="form-control" name="email" type="text" value="{{ old('email') }}" placeholder="Enter email">
                                                @error('email')
                                                    <p class='text-danger'>{{ $message }}</p>
                                                @enderror
                                            </div>
                                            <button class="btn btn-primary w-100" type="submit">
                                                Submit
                                            </button>

                                            <div class="row align-items-center">
                                                <div class="col-6 text-end dont-have">
                                                    You have password? <a href="{{ route('users.loginoption') }}">Click here</a>
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
        </div>
        <!-- /Main Wrapper -->
    </body>

</html>
