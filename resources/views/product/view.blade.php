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
                                <h3 class="page-title">PMS Products</h3>
                            </div>
                            <div class="col-md-6">
                                <div class="page-header-btn">
                                    @haspermission('PRODUCT_CREATE', 'admin')
                                        <a class="btn btn-primary" href="{{ route('products.create') }}">
                                            <i class="feather-plus-circle"></i> Add Product
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
                                            <th>Images</th>
                                            <th>Product Name</th>
                                            <th>Description</th>
                                            <th>Specifications</th>
                                            <th>Cost</th>
                                            <th>Category</th>
                                            <th>Subcategory</th>
                                            <th>Status</th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $sn = 1; ?>
                                        @foreach ($categories as $category)
                                            @foreach ($category->subcategories as $subcategory)
                                                @foreach ($subcategory->products as $product)
                                                    <tr>
                                                        <td>{{ $sn++ }}</td>
                                                        <td style="width: 20%;height:auto">
                                                            @foreach ($product->images as $image)
                                                                <img src="{{ asset('/storage/' . $image->path) }}" alt="..." width="30%" height="30%">
                                                            @endforeach
                                                        </td>
                                                        <td>{{ $product->product }}</td>
                                                        <td>{!! $product->description !!}</td>
                                                        <td>
                                                            @foreach ($product->specifications as $specification)
                                                                {{ $specification->specification }}<br>
                                                            @endforeach
                                                        </td>
                                                        <td>{{ $product->cost }}</td>
                                                        <td>{{ $category->category }}</td>
                                                        <td>{{ $subcategory->subcategory }}</td>
                                                        <td>{{ $product->status }}</td>
                                                        <td>
                                                            <div class="table-btns">
                                                                @haspermission('PRODUCT_UPDATE', 'admin')
                                                                    <a class="btn edit-btn" href="{{ route('products.edit', $product->id) }}">
                                                                        <i class="feather-edit"></i>
                                                                    </a>
                                                                @endhaspermission
                                                                @haspermission('PRODUCT_DELETE', 'admin')
                                                                    <a class="btn delete-btn" data-id="{{ $product->id }}" data-bs-toggle="modal" data-bs-target="#exampleModal" href="#">
                                                                        <i class="feather-trash-2"></i>
                                                                    </a>
                                                                @endhaspermission
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            @endforeach
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
                    var productId = $(this).data('id');
                    var del = "{{ route('products.destroy', 'productId') }}";
                    del = del.replace('productId', productId);
                    $('#del').attr('action', del);
                });
            });
        </script>

    </body>

</html>
