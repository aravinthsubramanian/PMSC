<!DOCTYPE html>
<html lang="en">
    @include('layouts.admin.adminheader')

    <body>
        @include('layouts.alerts.alerts')

        @include('layouts.admin.adminimports')
        <!-- Main Wrapper -->
        <div class="main-wrapper">

            @include('layouts.admin.admindashnav')

            @include('layouts.admin.adminsidebar')

            <!-- Page Wrapper -->
            <div class="page-wrapper">
                <div class="content container-fluid">

                    <!-- Page Header -->
                    <div class="page-header">
                        <div class="row">
                            <div class="col-md-12">
                                <h3 class="page-title">Update Password</h3>
                            </div>
                        </div>
                    </div>
                    <!-- /Page Header -->

                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('admins.updatepass', $admin->id) }}" method="POST">
                                @csrf
                                <div class="row">
                                
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Email <span class="star-red">*</span></label>
                                            <input class="form-control" name="email" type="text" value="{{ $admin->email }}" placeholder="Email" disabled>
                                        </div>
                                        @error('email')
                                            <p class='text-danger'>{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Current Password <span class="star-red">*</span></label>
                                            <input class="form-control" name="password" type="password" placeholder="Current Password">
                                        </div>
                                        @error('password')
                                            <p class='text-danger'>{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>New Password <span class="star-red">*</span></label>
                                            <input class="form-control" name="npassword" type="password" placeholder="New Password">
                                        </div>
                                        @error('npassword')
                                            <p class='text-danger'>{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Confirm Password <span class="star-red">*</span></label>
                                            <input class="form-control" name="cpassword" type="password" placeholder="Confirm Password">
                                        </div>
                                        @error('cpassword')
                                            <p class='text-danger'>{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group admin-list-btns">
                                            <button class="btn btn-primary me-2" type="submit">Submit</button>
                                            <button class="btn btn-secondary" type="reset">Cancel</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>

    </body>

</html>
