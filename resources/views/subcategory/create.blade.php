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
                                <h3 class="page-title">Add Subcategory</h3>
                            </div>
                        </div>
                    </div>
                    <!-- /Page Header -->

                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('subcategories.store') }}" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Category <span class="star-red">*</span></label>
                                            <select class="form-control" name="category">
                                                <option value="" selected></option>
                                                @foreach ($categories as $category)
                                                    <option value="{{ $category->id }}">{{ $category->category }}</option>
                                                @endforeach>
                                            </select>
                                        </div>
                                        @error('category')
                                            <p class='text-danger'>{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Subcategory Name <span class="star-red">*</span></label>
                                            <input class="form-control" name="subcategory" type="text" value="{{ old('subcategory') }}" placeholder="Enter Category Name">
                                        </div>
                                        @error('subcategory')
                                            <p class='text-danger'>{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Status <span class="star-red">*</span></label>
                                            <select class="form-control" name="status">
                                                <option value="enable" selected>Enable</option>
                                                <option value="disable">Disable</option>
                                            </select>
                                        </div>
                                        @error('status')
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
