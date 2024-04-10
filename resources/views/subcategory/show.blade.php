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
                                <h3 class="page-title">PMS Subcategories</h3>
                            </div>
                            <div class="col-md-6">
                                <div class="page-header-btn">
                                    @haspermission('SUBCATEGORY_CREATE', 'admin')
                                        <a class="btn btn-primary" href="{{ route('subcategories.create') }}">
                                            <i class="feather-plus-circle"></i> Add subcategory
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
                                <table class="table" id="datatable">
                                    <thead>
                                        <tr>
                                            <th>S.NO</th>
                                            <th>Category Name</th>
                                            <th>Subcategory Name</th>
                                            <th>status</th>
                                            <th>Created at</th>
                                            <th>Updated at</th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                    </thead>
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

            function delfun(id){
                var subcatId = id;
                var del = "{{ route('subcategories.destroy', ':subcatId') }}";
                del = del.replace(':subcatId', subcatId);
                // console.log(del);
                $('#del').attr('action', del);
            }

            $(document).ready(function() {
                $('#datatable').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: {
                        url: "{{ route('subcategories.fetch') }}",
                        type: "POST",
                        data: function(data) {
                            data.search = $('input[type="search"]').val();
                            data._token = '{{ csrf_token() }}';
                        }
                    },
                    // order: ['1', 'DESC'],
                    pageLength: 5,
                    searching: true,
                    aoColumns: [
                        {
                            data: null,
                            orderable: false,
                            searchable: false,
                            render: function(data, type, row, meta) {
                                return meta.row + meta.settings._iDisplayStart + 1;
                            }
                        },
                        {
                            data: 'category',
                        },
                        {
                            data: 'subcategory',
                        },
                        {
                            data: 'subcategory_status',
                        },
                        {
                            data: 'created_at',
                        },
                        {
                            data: 'updated_at',
                        },
                        {
                            data: 'id',
                            orderable: false,
                            searchable: false,
                            render: function(data, type, row) {

                                var html =  '<div class="table-btns">'+
                                                '@haspermission('SUBCATEGORY_UPDATE', 'admin')'+
                                                    '<a class="btn edit-btn" href="{{ route('subcategories.edit','+row.id+') }}"><i class="feather-edit"></i></a>'+
                                                '@endhaspermission'+
                                                '@haspermission('SUBCATEGORY_DELETE', 'admin')'+
                                                    '<a class="btn delete-btn" onclick="delfun('+row.id+')" data-bs-toggle="modal" data-bs-target="#exampleModal" href="#">'+
                                                        '<i class="feather-trash-2"></i></a>'+
                                                '@endhaspermission'+
                                            '</div>';

                                html = html.replace('+row.id+', row.id);
                                return html;
                            }
                        },
                    ]
                });
            });

        </script>

    </body>
</html>