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
                                <h3 class="page-title">Edit Product</h3>
                            </div>
                        </div>
                    </div>
                    <!-- /Page Header -->

                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('products.update', $product->id) }}" method="POST" accept-charset="utf-8" enctype="multipart/form-data">
                                @csrf
                                @method('PATCH')
                                <div class="row">

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Category <span class="star-red">*</span></label>
                                            <select class="form-control" id="categorySelect" name="category">
                                                @foreach ($categories as $category)
                                                    @foreach ($category->subcategories as $subcategory)
                                                        <option value="{{ $category->id }}" @if ($category->id == $product->category) ? selected : @endif>{{ $category->category }}</option>
                                                    @break
                                                @endforeach
                                            @endforeach
                                        </select>
                                    </div>
                                    @error('category')
                                        <p class='text-danger'>{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Subcategory<span class="star-red">*</span></label>
                                        <select class="form-control" id="subcategorySelect" name="subcategory">
                                            @foreach ($categories as $category)
                                                @if($category->id == $product->main_category_id)
                                                    @foreach ($category->subcategories as $subcategory)
                                                        @if($subcategory->subcategory_status == 'enable')
                                                            <option value="{{ $subcategory->id }}" @if ($subcategory->id == $product->sub_category_id) ? selected : @endif>{{ $subcategory->subcategory }}</option>
                                                        @endif
                                                    @endforeach
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                    @error('subcategory')
                                        <p class='text-danger'>{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Product Name <span class="star-red">*</span></label>
                                        <input class="form-control" name="product" type="text" value="{{ $product->product }}" placeholder="Enter Product Name">
                                        @error('product')
                                            <p class='text-danger'>{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Cost<span class="star-red">*</span></label>
                                        <input class="form-control" id="cost" name="cost" type="text" value="{{ $product->cost }}" onfocusout="myFunction()">
                                        @error('cost')
                                            <p class='text-danger'>{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Product Status <span class="star-red">*</span></label><br><br>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" id="product_status" name="product_status" type="radio" value="enable"
                                                @if ($product->status == 'enable') ?  checked : @endif>
                                            <label class="form-check-label" for="enable">Enable</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" id="product_status" name="product_status" type="radio" value="disable"
                                                @if ($product->status == 'disable') ?  checked : @endif>
                                            <label class="form-check-label" for="disable">Disable</label>
                                        </div>
                                        @error('product_status')
                                            <p class='text-danger'>{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label" for="image">Images<span class="star-red">*</span></label>
                                        <input class="form-control" id="images" name="images[]" type="file" multiple>
                                    </div>
                                    @error('images.*')
                                        <p class='text-danger'>{{ $message }}</p>
                                    @enderror
                                    @error('images')
                                        <p class='text-danger'>{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label class="form-label" for="preview">Preview</label>
                                    </div>
                                    <div class="mt-1 text-center">
                                        <div id="image_preview" style="width:100%;">
                                            <?php $c=0; ?>
                                            @foreach ($product->images as $img)
                                                <div class="img-div" id="img-div{{$c}}">
                                                    <img class="img-responsive image img-thumbnail" src="{{asset('/storage/'.$img->path.'')}}" title="{{$img->name}}">
                                                    <div class="middle">
                                                        <button class="btn btn-danger" id="action-icon" value="img-div{{$c++}}" role="{{$img->name}}">
                                                            <i class='fa fa-trash'></i>
                                                        </button>
                                                        <input name="oldimg[]" type="text" value="{{ $img->id }}" hidden>
                                                    </div>
                                                </div>
                        
                                            @endforeach
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Description <span class="star-red">*</span></label>
                                        <textarea class="form-control" id="description" name="description" value="{{ $product->description }}">{{ $product->description }}</textarea>
                                        @error('description')
                                            <p class='text-danger'>{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <table class="table table-borderless" id="dynamicAddRemove">
                                            <tr>
                                                <label class="form-label" for="Specifications">Specifications<span class="star-red">*</span></label>
                                            </tr>
                                            <?php $i = 0; ?>
                                            @foreach ($product->specifications as $spec)
                                                @if ($i == 0)
                                                    <tr>
                                                        <td><input class="form-control" name="addMoreInputFields[{{ $i }}][specification]" type="text"
                                                                value="{{ $spec->specification }}" />
                                                        </td>
                                                        <td><button class="btn btn-outline-primary" id="dynamic-ar" name="add" type="button">+ Add
                                                            </button></td>
                                                    </tr>
                                                @endif
                                                @if ($i != 0)
                                                    <tr>
                                                        <td><input class="form-control" name="addMoreInputFields[{{ $i }}][specification]" type="text"
                                                                value="{{ $spec->specification }}" />
                                                        </td>
                                                        <td><button class="btn btn-outline-danger remove-input-field" type="button">Delete</button>
                                                        </td>
                                                    </tr>
                                                @endif
                                                <?php $i++; ?>
                                            @endforeach
                                        </table>
                                        @error('addMoreInputFields.*.specification')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
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
    @include('layouts.admin.adminafterimports')
</body>

</html>
