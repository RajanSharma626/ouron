@extends('admin.layouts.master')

@section('title', 'Edit Products')

@section('page_title', 'Edit Product')

@section('content')
    <div class="page-content">

        <!-- Start Container Fluid -->
        <div class="container-xxl">

            <div class="row">

                <div class="col-xl-12 col-lg-12 ">
                    <form action="{{ route('product.update') }}" method="POST" enctype="multipart/form-data">

                        <input type="text" name="product_id" value="{{ $product->id }}" hidden>
                        @csrf
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Edit Product Photo</h4>
                            </div>
                            <div class="card-body dropzone" id="product-dropzone">
                                <!-- File Upload -->
                                <div class="fallback">
                                    <input name="images[]" type="file" multiple hidden id="product-images" />
                                </div>
                                <div class="dz-message needsclick" id="dropzone-message">
                                    <i class="bx bx-cloud-upload fs-48 text-primary"></i>
                                    <h3 class="mt-4">
                                        Drop your images here, or <span class="text-primary" id="browse-files">click to
                                            browse</span>
                                    </h3>
                                    <span class="text-muted fs-13">
                                        PNG, JPG and WEBP files are allowed
                                    </span>
                                </div>
                                <div id="preview-container" class="row mt-3">
                                    {{-- Show existing product images from the database --}}
                                    @if ($product->productImg && $product->productImg->count())
                                        @foreach ($product->productImg as $image)
                                            <div class="col-md-3 mb-2 position-relative">
                                                <img src="{{ asset($image->img) }}" class="img-thumbnail img-fluid"
                                                    alt="Product Image">
                                                <a href="{{ route('product.image.delete', $image->id) }}"
                                                    class="position-absolute top-0 end-0 mt-2 me-2 btn btn-danger btn-sm"
                                                    onclick="event.preventDefault(); if(confirm('Are you sure you want to delete this image?')) {
                                                       var form = document.createElement('form');
                                                       form.method = 'POST';
                                                       form.action = this.href;
                                                       var token = document.createElement('input');
                                                       token.type = 'hidden';
                                                       token.name = '_token';
                                                       token.value = '{{ csrf_token() }}';
                                                       form.appendChild(token);
                                                       var method = document.createElement('input');
                                                       method.type = 'hidden';
                                                       method.name = '_method';
                                                       method.value = 'DELETE';
                                                       form.appendChild(method);
                                                       document.body.appendChild(form);
                                                       form.submit(); }">
                                                    Delete
                                                </a>
                                            </div>
                                        @endforeach
                                    @endif
                                </div>
                            </div>


                        </div>
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Product Information</h4>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label for="product-name" class="form-label">Product Name</label>
                                            <input type="text" id="product-name" name="product_name"
                                                value="{{ $product->name ?? '' }}" class="form-control"
                                                placeholder="Items Name">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <label for="product-categories" class="form-label">Product Categories</label>
                                        <select class="form-control" id="product-categories" name="product_category"
                                            data-choices data-choices-groups data-placeholder="Select Categories"
                                            name="choices-single-groups">
                                            <option value="">Choose a categories</option>
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}"
                                                    {{ $category->id == $product->category_id ? 'selected' : '' }}>
                                                    {{ $category->name }}</option>
                                            @endforeach
                                        </select>

                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="mb-3">
                                            <label for="product-weight" class="form-label">Weight</label>
                                            <input type="text" id="product-weight" value="" name="product_weight"
                                                class="form-control" placeholder="In gm & kg">
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <label for="gender" class="form-label">Gender</label>
                                        <select class="form-control" id="gender" name="gender" data-choices
                                            data-choices-groups data-placeholder="Select Gender">
                                            <option value="">Select Gender</option>
                                            <option value="Men" {{ $product->gender == 'Men' ? 'selected' : '' }}>Men
                                            </option>
                                            <option value="Women" {{ $product->gender == 'Women' ? 'selected' : '' }}>
                                                Women
                                            </option>
                                            <option value="Unisex" {{ $product->gender == 'Unisex' ? 'selected' : '' }}>
                                                Unisex</option>
                                            <option value="Other" {{ $product->gender == 'Other' ? 'selected' : '' }}>
                                                Other
                                            </option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row mb-4">
                                    <div class="col-lg-4">
                                        <div class="mt-3">
                                            <h5 class="text-dark fw-medium">Size :</h5>
                                            <div class="d-flex flex-wrap gap-2" role="group"
                                                aria-label="Basic checkbox toggle button group">
                                                <input type="checkbox" class="btn-check" id="size-xs1" name="sizes[]"
                                                    value="XS"
                                                    {{ in_array('XS', json_decode($product->sizes, true) ?? []) ? 'checked' : '' }}>
                                                <label
                                                    class="btn btn-light avatar-sm rounded d-flex justify-content-center align-items-center"
                                                    for="size-xs1">XS</label>

                                                <input type="checkbox" class="btn-check" id="size-s1" name="sizes[]"
                                                    value="S"
                                                    {{ in_array('S', json_decode($product->sizes, true) ?? []) ? 'checked' : '' }}>
                                                <label
                                                    class="btn btn-light avatar-sm rounded d-flex justify-content-center align-items-center"
                                                    for="size-s1">S</label>

                                                <input type="checkbox" class="btn-check" id="size-m1" name="sizes[]"
                                                    value="M"
                                                    {{ in_array('M', json_decode($product->sizes, true) ?? []) ? 'checked' : '' }}>
                                                <label
                                                    class="btn btn-light avatar-sm rounded d-flex justify-content-center align-items-center"
                                                    for="size-m1">M</label>

                                                <input type="checkbox" class="btn-check" id="size-xl1" name="sizes[]"
                                                    value="XL"
                                                    {{ in_array('XL', json_decode($product->sizes, true) ?? []) ? 'checked' : '' }}>
                                                <label
                                                    class="btn btn-light avatar-sm rounded d-flex justify-content-center align-items-center"
                                                    for="size-xl1">XL</label>

                                                <input type="checkbox" class="btn-check" id="size-xxl1" name="sizes[]"
                                                    value="XXL"
                                                    {{ in_array('XXL', json_decode($product->sizes, true) ?? []) ? 'checked' : '' }}>
                                                <label
                                                    class="btn btn-light avatar-sm rounded d-flex justify-content-center align-items-center"
                                                    for="size-xxl1">XXL</label>

                                                <input type="checkbox" class="btn-check" id="size-3xl1" name="sizes[]"
                                                    value="3XL"
                                                    {{ in_array('3XL', json_decode($product->sizes, true) ?? []) ? 'checked' : '' }}>
                                                <label
                                                    class="btn btn-light avatar-sm rounded d-flex justify-content-center align-items-center"
                                                    for="size-3xl1">3XL</label>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-5">
                                        <div class="mt-3">
                                            <h5 class="text-dark fw-medium">Colors :</h5>
                                            <div class="d-flex flex-wrap gap-2 color-container" role="group"
                                                aria-label="Basic checkbox toggle button group">
                                                <div class="input-group mt-2">
                                                    <input type="text" id="new-color" class="form-control"
                                                        placeholder="Enter hex color code">
                                                    <button type="button" id="add-color" class="btn btn-primary">Add
                                                        Color</button>
                                                </div>
                                                @foreach (json_decode($product->colors, true) as $color)
                                                    <input type="checkbox" class="btn-check" name="color[]"
                                                        id="color-{{ Str::slug($color) }}" value="{{ $color }}"
                                                        checked>
                                                    <label
                                                        class="btn btn-light avatar-sm rounded d-flex justify-content-center align-items-center"
                                                        for="color-{{ Str::slug($color) }}">
                                                        <i class="bx bxs-circle fs-18"
                                                            style="color: {{ $color }}"></i>
                                                    </label>
                                                @endforeach

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="mb-3">
                                            <label for="description" class="form-label">Description</label>
                                            <textarea class="form-control bg-light-subtle" id="editor" name="description" rows="7"
                                                placeholder="Short description about the product"> {{ $product->description ?? '' }}</textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="mb-3">
                                            <label for="product-id" class="form-label">Tag Number</label>
                                            <input type="number" id="tag_no" name="" class="form-control"
                                                placeholder="#******">
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="mb-3">
                                            <label for="product-stock" class="form-label">Stock</label>
                                            <input type="number" id="product-stock" value="{{ $product->stock ?? '' }}"
                                                name="product_stock" class="form-control" placeholder="Quantity">
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="mb-3">
                                            <label for="product-stock" class="form-label">Best Seller</label>
                                            <select class="form-control" id="bestSeller" name="bestSeller" data-choices
                                                data-choices-groups data-placeholder="Best Seller" required>
                                                <option value="">- Select -</option>
                                                <option value="1" {{ $product->best_seller == 1 ? 'selected' : '' }}>
                                                    Yes</option>
                                                <option value="0" {{ $product->best_seller == 0 ? 'selected' : '' }}>
                                                    No</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Pricing Details</h4>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-4">
                                        <label for="product-price" class="form-label">Price</label>
                                        <div class="input-group mb-3">
                                            <span class="input-group-text fs-20"><i class='bx bx-dollar'></i></span>
                                            <input type="number" id="product-price" value="{{ $product->price ?? '' }}"
                                                name="product_price" class="form-control" placeholder="000">
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <label for="product-discount" class="form-label">Discount</label>
                                        <div class="input-group mb-3">
                                            <span class="input-group-text fs-20"><i class='bx bxs-discount'></i></span>
                                            <input type="number" id="product-discount"
                                                value="{{ $product->discount_price }}" name="discount_price"
                                                class="form-control" placeholder="000">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="p-3 bg-light mb-3 rounded">
                            <div class="row justify-content-end g-2">
                                <div class="col-lg-2">
                                    <button type="submit" class="btn btn-outline-secondary w-100">Update Product</button>
                                </div>
                                <div class="col-lg-2">
                                    <a href="{{ route('admin.products') }}" class="btn btn-primary w-100">Cancel</a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- End Container Fluid -->

        <!-- ========== Footer Start ========== -->
        @include('admin.layouts.footer')
        <!-- ========== Footer End ========== -->

    </div>

@endsection
