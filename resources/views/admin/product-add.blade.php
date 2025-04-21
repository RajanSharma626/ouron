@extends('admin.layouts.master')

@section('title', 'Add Products')

@section('page_title', 'Add Product')

@section('content')
    <div class="page-content">

        <!-- Start Container Fluid -->
        <div class="container-xxl">

            <div class="row">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div class="col-xl-12 col-lg-12 ">
                    <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Add Product Photo</h4>
                            </div>
                            <div class="card-body dropzone" id="product-dropzone">
                                <!-- File Upload -->
                                <div class="fallback">
                                    <input name="images[]" type="file" multiple hidden id="product-images" required />
                                </div>
                                <div class="dz-message needsclick" id="dropzone-message">
                                    <i class="bx bx-cloud-upload fs-48 text-primary"></i>
                                    <h3 class="mt-4">Drop your images here, or <span class="text-primary"
                                            id="browse-files">click to browse</span></h3>
                                    <span class="text-muted fs-13">
                                        1600 x 1200 (4:3) recommended. PNG, JPG and GIF files are allowed
                                    </span>
                                </div>
                                <div id="preview-container" class="row mt-3"></div>
                            </div>


                        </div>
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Product Information</h4>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="mb-3">
                                            <label for="product-name" class="form-label">Product Name</label>
                                            <input type="text" id="product-name" name="product_name" class="form-control"
                                                placeholder="Items Name" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <label for="product-categories" class="form-label">Product Categories</label>
                                        <select class="form-control" id="product-categories" name="product_category"
                                            data-choices data-choices-groups data-placeholder="Select Categories"
                                            name="choices-single-groups" required>
                                            <option value="">Choose a categories</option>
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                            @endforeach
                                        </select>

                                    </div>

                                    <div class="col-lg-4">
                                        <label for="product-Collection" class="form-label">Product Collection</label>
                                        <select class="form-control" id="product-Collection" name="product_collection"
                                            data-choices data-choices-groups data-placeholder="Select Collection"
                                            name="choices-single-groups">
                                            <option value="">Choose a Collection</option>
                                            @foreach ($collections as $collection)
                                                <option value="{{ $collection->id }}">{{ $collection->name }}</option>
                                            @endforeach

                                        </select>

                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="mb-3">
                                            <label for="product-stock" class="form-label">Best Seller</label>
                                            <select class="form-control" id="bestSeller" name="bestSeller" data-choices
                                                data-choices-groups data-placeholder="Best Seller" required>
                                                <option value="" selected disabled>- Select -</option>
                                                <option value="1">Yes</option>
                                                <option value="0">No</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="mb-3">
                                            <label for="product-weight" class="form-label">Weight</label>
                                            <input type="text" id="product-weight" name="product_weight"
                                                class="form-control" placeholder="In gm & kg">
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <label for="gender" class="form-label">Gender</label>
                                        <select class="form-control" id="gender" name="gender" data-choices
                                            data-choices-groups data-placeholder="Select Gender">
                                            <option value="">Select Gender</option>
                                            <option value="Men">Men</option>
                                            <option value="Women">Women</option>
                                            <option value="Unisex">Unisex</option>
                                            <option value="Other">Other</option>
                                        </select>
                                    </div>


                                </div>
                                <div class="row mb-4">
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
                                                <input type="checkbox" class="btn-check" name="color[]" id="color-white"
                                                    value="#FFFFFF" checked>
                                                <label
                                                    class="btn btn-light avatar-sm rounded d-flex justify-content-center align-items-center"
                                                    for="color-white">
                                                    <i class="bx bxs-circle fs-18" style="color: #FFFFFF"></i>
                                                </label>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="mb-3">
                                            <label for="description" class="form-label">Description</label>
                                            <textarea class="form-control bg-light-subtle" id="editor" name="description" rows="7"
                                                placeholder="Short description about the product"></textarea>
                                        </div>

                                    </div>
                                    <div class="col-lg-12">
                                        <div class="mb-3">
                                            <label for="description" class="form-label">Detail</label>
                                            <textarea class="form-control bg-light-subtle" id="DetailEditor" name="detail" rows="7"
                                                placeholder="Short description about the product"> {{ $product->detail ?? '' }}</textarea>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="mb-3">
                                            <label for="description" class="form-label">Shipping & Return</label>
                                            <textarea class="form-control bg-light-subtle" id="ShipingReturnEditor" name="shipping_Return" rows="7"
                                                placeholder="Short description about the product"> {{ $product->shipping_Return ?? '' }}</textarea>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Size Stock</h4>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    @php
                                        $sizeOptions = ['S', 'M', 'L', 'XL'];
                                    @endphp

                                    @foreach ($sizeOptions as $size)
                                        <div class="col-lg-4">
                                            <div class="input-group mb-3">
                                                <span class="input-group-text ">{{ $size }}</span>
                                                <input type="number" name="size_stock[{{ $size }}]"
                                                    class="form-control" placeholder="0" min="0">
                                            </div>
                                        </div>
                                    @endforeach
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
                                            <span class="input-group-text fs-20"><i class='bx bx-rupee'></i></span>
                                            <input type="number" id="product-price" name="product_price"
                                                class="form-control" placeholder="000" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <label for="product-discount" class="form-label">Discount Price</label>
                                        <div class="input-group mb-3">
                                            <span class="input-group-text fs-20"><i class='bx bxs-discount'></i></span>
                                            <input type="number" id="product-discount" name="discount_price"
                                                class="form-control" placeholder="000" required>
                                        </div>
                                    </div>

                                    <div class="col-lg-4">
                                        <label for="discount-percentage" class="form-label">Discount Percentage</label>
                                        <div class="input-group mb-3">
                                            <span class="input-group-text">%</span>
                                            <input type="text" id="discount-percentage" class="form-control" placeholder="0%" readonly>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="p-3 bg-light mb-3 rounded">
                            <div class="row justify-content-end g-2">
                                <div class="col-lg-2">
                                    <a href="{{ route('admin.products') }}" class="btn btn-primary w-100">Cancel</a>
                                </div>
                                <div class="col-lg-2">
                                    <button type="submit" class="btn btn-outline-secondary w-100">Create Product</button>
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
