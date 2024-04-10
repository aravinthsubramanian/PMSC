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
                        <div class="row align-items-center">
                            <div class="col-md-6">
                                <h3 class="page-title">PMS Admins</h3>
                            </div>
                            <div class="col-md-6">
                                <div class="page-header-btn">
                                    @haspermission('ADMIN_CREATE', 'admin')
                                        <a class="btn btn-primary" href="{{ route('admins.create') }}">
                                            <i class="feather-plus-circle"></i> Add Admin
                                        </a>
                                    @endhaspermission
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /Page Header -->

                    <div class="card">
                        <div class="card-body table-card-body">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>S.NO</th>
                                            <th>Role</th>
                                            <th>Admin Name</th>
                                            <th>Mobile</th>
                                            <th>Email</th>
                                            <th>Status</th>
                                            <th class="text-end">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $sn = 1; ?>
                                        @foreach ($admins as $admin)
                                            <tr>
                                                <td>{{ $sn++ }}</td>
                                                <td>
                                                    @foreach ($admin->getRoleNames() as $role)
                                                        {{ $role }}
                                                    @endforeach
                                                </td>
                                                <td>{{ $admin->name }}</td>
                                                <td>{{ $admin->mobile }}</td>
                                                <td>{{ $admin->email }}</td>
                                                <td>{{ $admin->status }}</td>
                                                <td>
                                                    <div class="table-btns">
                                                        @haspermission('ADMIN_UPDATE', 'admin')
                                                            <a class="btn edit-btn" href="{{ route('admins.edit', $admin->id) }}">
                                                                <i class="feather-edit"></i>
                                                            </a>
                                                        @endhaspermission
                                                        @haspermission('ADMIN_DELETE', 'admin')
                                                            <a class="btn delete-btn" data-id="{{ $admin->id }}" data-bs-toggle="modal" data-bs-target="#exampleModal" href="#">
                                                                <i class="feather-trash-2"></i>
                                                            </a>
                                                        @endhaspermission
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <!-- Delete Modal -->
        <!-- Modal -->
        <div class="modal fade" id="exampleModal" data-backdrop="static" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" tabindex="-1">
            <div class="modal-dialog">
                <form id="del" method="POST">
                    @csrf
                    @method('DELETE')
                    <div class="modal-content">
                        <div class="modal-body">Are you want to delete?</div>
                        <div class="modal-footer">
                            <button class="btn btn-secondary" data-bs-dismiss="modal" type="button">Close</button>
                            <button class="btn btn-danger" type="submit">delete</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!-- /Delete Modal -->

        <script>
            $(document).ready(function() {
                $('.delete-btn').click(function() {
                    // console.log("triggered..........................");
                    var adminId = $(this).data('id');
                    var del = "{{ route('admins.destroy', 'adminId') }}";
                    del = del.replace('adminId', adminId);
                    $('#del').attr('action', del);
                });
            });
        </script>

    </body>

</html>
