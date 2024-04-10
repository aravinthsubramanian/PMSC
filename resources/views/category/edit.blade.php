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
                                <h3 class="page-title">Edit Category</h3>
                            </div>
                        </div>
                    </div>
                    <!-- /Page Header -->

                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('categories.update',$category->id) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <div class="row">

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Category Name <span class="star-red">*</span></label>
                                            <input class="form-control" name="category" type="text" value="{{ $category->category }}" placeholder="Enter Category Name">
                                        </div>
                                        @error('category')
                                            <p class='text-danger'>{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Status <span class="star-red">*</span></label>
                                            <select class="form-control" name="status">
                                                <option value="enable" @if($category->category_status == 'enable')? selected :  @endif>Enable</option>
                                                <option value="disable" @if($category->category_status == 'disable')? selected :  @endif>Disable</option>
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
