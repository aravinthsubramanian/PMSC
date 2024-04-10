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
                                <h3 class="page-title">PMS Roles</h3>
                            </div>
                            <div class="col-md-6">
                                <div class="page-header-btn">
                                    @haspermission('ROLE_CREATE', 'admin')
                                        <a class="btn btn-primary" href="{{ route('roles.create') }}">
                                            <i class="feather-plus-circle"></i> Add Role
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
                                            <th>Role Name</th>
                                            <th>Guard</th>
                                            <th>Created at</th>
                                            <th>Updated at</th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $sn = 1; ?>
                                        @foreach ($roles as $role)
                                            <tr>
                                                <td>{{ $sn++ }}</td>
                                                <td>{{ $role->role }}</td>
                                                <td>{{ $role->guard_name }}</td>
                                                <td>{{ $role->created_at }}</td>
                                                <td>{{ $role->updated_at }}</td>
                                                <td>
                                                    <div class="table-btns">
                                                        @haspermission('ROLE_UPDATE', 'admin')
                                                            <a class="btn edit-btn" href="{{ route('roles.edit', $role->id) }}">
                                                                <i class="feather-edit"></i>
                                                            </a>
                                                        @endhaspermission
                                                        @haspermission('ROLE_DELETE', 'admin')
                                                            <a class="btn delete-btn" data-id="{{ $role->id }}" data-bs-toggle="modal" data-bs-target="#exampleModal" href="#">
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
                    var roleId = $(this).data('id');
                    var del = "{{ route('roles.destroy', 'roleId') }}";
                    del = del.replace('roleId', roleId);
                    $('#del').attr('action', del);
                });
            });
        </script>

    </body>

</html>
