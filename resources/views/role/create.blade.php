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
                                <h3 class="page-title">Add Role</h3>
                            </div>
                        </div>
                    </div>
                    <!-- /Page Header -->

                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('roles.store') }}" method="POST">
                                @csrf
                                <div class="row">

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Role Name <span class="star-red">*</span></label>
                                            <input class="form-control" name="role" type="text" value="{{ old('role') }}" placeholder="Enter Role Name">
                                        </div>
                                        @error('role')
                                            <p class='text-danger'>{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="col-md-12">
                                        <label>Permissions<span class="star-red">*</span></label>
                                        <div class="row">

                                            <div class="col-md-3">
                                                <div class="card">
                                                    <div class="card-header" style="display:flexbox">
                                                        Permissions
                                                        <input class="form-check-input text-end" id="permissions" type="checkbox" style="margin-left: 45%">&nbsp;&nbsp;all
                                                    </div>
                                                    <div class="card-body">
                                                        @foreach ($permissions as $permission)
                                                            @if (str_contains($permission->name, 'PERMISSION'))
                                                                <div class="col">
                                                                    <div class="form-check">
                                                                        <input class="form-check-input permissions" name="permission[]" type="checkbox" value="{{ $permission->id }}">
                                                                        <label class="form-check-label" for="flexCheckDefault">{{ $permission->name }}</label>
                                                                    </div>
                                                                </div>
                                                            @endif
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-3">
                                                <div class="card">
                                                    <div class="card-header">
                                                        Roles
                                                        <input class="form-check-input" id="roles" type="checkbox" style="margin-left:47%">&nbsp;&nbsp;all
                                                    </div>
                                                    <div class="card-body">
                                                        @foreach ($permissions as $permission)
                                                            @if (str_contains($permission->name, 'ROLE'))
                                                                <div class="col">
                                                                    <div class="form-check">
                                                                        <input class="form-check-input roles" name="permission[]" type="checkbox" value="{{ $permission->id }}">
                                                                        <label class="form-check-label" for="flexCheckDefault">{{ $permission->name }}</label>
                                                                    </div>
                                                                </div>
                                                            @endif
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-3">
                                                <div class="card">
                                                    <div class="card-header">
                                                        Users
                                                        <input class="form-check-input" id="users" type="checkbox" style="margin-left:47%">&nbsp;&nbsp;all
                                                    </div>
                                                    <div class="card-body">
                                                        @foreach ($permissions as $permission)
                                                            @if (str_contains($permission->name, 'USER'))
                                                                <div class="col">
                                                                    <div class="form-check">
                                                                        <input class="form-check-input users" name="permission[]" type="checkbox" value="{{ $permission->id }}">
                                                                        <label class="form-check-label" for="flexCheckDefault">{{ $permission->name }}</label>
                                                                    </div>
                                                                </div>
                                                            @endif
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-3">
                                                <div class="card">
                                                    <div class="card-header">
                                                        Admins
                                                        <input class="form-check-input" id="admins" type="checkbox" style="margin-left:47%">&nbsp;&nbsp;all
                                                    </div>
                                                    <div class="card-body">
                                                        @foreach ($permissions as $permission)
                                                            @if (str_contains($permission->name, 'ADMIN'))
                                                                <div class="col">
                                                                    <div class="form-check">
                                                                        <input class="form-check-input admins" name="permission[]" type="checkbox" value="{{ $permission->id }}">
                                                                        <label class="form-check-label" for="flexCheckDefault">{{ $permission->name }}</label>
                                                                    </div>
                                                                </div>
                                                            @endif
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-3">
                                                <div class="card">
                                                    <div class="card-header">
                                                        Categories
                                                        <input class="form-check-input" id="categories" type="checkbox" style="margin-left:47%">&nbsp;&nbsp;all
                                                    </div>
                                                    <div class="card-body">
                                                        @foreach ($permissions as $permission)
                                                            @if (str_contains($permission->name, 'MAINCATEGORY'))
                                                                <div class="col">
                                                                    <div class="form-check">
                                                                        <input class="form-check-input categories" name="permission[]" type="checkbox" value="{{ $permission->id }}">
                                                                        <label class="form-check-label" for="flexCheckDefault">{{ $permission->name }}</label>
                                                                    </div>
                                                                </div>
                                                            @endif
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-3">
                                                <div class="card">
                                                    <div class="card-header">
                                                        Subcategories
                                                        <input class="form-check-input" id="subcategories" type="checkbox" style="margin-left:40%">&nbsp;&nbsp;all
                                                    </div>
                                                    <div class="card-body">
                                                        @foreach ($permissions as $permission)
                                                            @if (str_contains($permission->name, 'SUBCATEGORY'))
                                                                <div class="col">
                                                                    <div class="form-check">
                                                                        <input class="form-check-input subcategories" name="permission[]" type="checkbox" value="{{ $permission->id }}">
                                                                        <label class="form-check-label" for="flexCheckDefault">{{ $permission->name }}</label>
                                                                    </div>
                                                                </div>
                                                            @endif
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-3">
                                                <div class="card">
                                                    <div class="card-header">
                                                        Products
                                                        <input class="form-check-input" id="products" type="checkbox" style="margin-left:47%">&nbsp;&nbsp;all
                                                    </div>
                                                    <div class="card-body">
                                                        @foreach ($permissions as $permission)
                                                            @if (str_contains($permission->name, 'PRODUCT'))
                                                                <div class="col">
                                                                    <div class="form-check">
                                                                        <input class="form-check-input products" name="permission[]" type="checkbox" value="{{ $permission->id }}">
                                                                        <label class="form-check-label" for="flexCheckDefault">{{ $permission->name }}</label>
                                                                    </div>
                                                                </div>
                                                            @endif
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @error('permission')
                                        <p class='text-danger'>{{ $message }}</p>
                                    @enderror
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

    @include('layouts.admin.rolecheckall')

</html>
