@extends('admin.layouts.master')

@section('title', 'Add Products')

@section('page_title', 'Add Product')

@section('content')
    <div class="page-content">

        <!-- Start Container Fluid -->
        <div class="container-xxl">

            <div class="row">

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
                                    <input name="images" type="file" multiple hidden id="product-images" />
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
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label for="product-name" class="form-label">Product Name</label>
                                            <input type="text" id="product-name" name="product_name" class="form-control"
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
                                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                            @endforeach
                                        </select>

                                    </div>
                                </div>
                                <div class="row">
                                    {{-- <div class="col-lg-4">
                                        <div class="mb-3">
                                            <label for="product-brand" class="form-label">Brand</label>
                                            <input type="text" id="product-brand" name="product" class="form-control"
                                                placeholder="Brand Name">
                                        </div>
                                    </div> --}}
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
                                            <option value="Other">Other</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row mb-4">
                                    <div class="col-lg-4">
                                        <div class="mt-3">
                                            <h5 class="text-dark fw-medium">Size :</h5>
                                            <div class="d-flex flex-wrap gap-2" role="group"
                                                aria-label="Basic checkbox toggle button group">
                                                <input type="checkbox" class="btn-check" name="size[]" id="size-xs1" value="XS">
                                                <label
                                                    class="btn btn-light avatar-sm rounded d-flex justify-content-center align-items-center"
                                                    for="size-xs1">XS</label>

                                                <input type="checkbox" class="btn-check" name="size[]" id="size-s1" value="S">
                                                <label
                                                    class="btn btn-light avatar-sm rounded d-flex justify-content-center align-items-center"
                                                    for="size-s1">S</label>

                                                <input type="checkbox" class="btn-check" name="size[]" id="size-m1" value="M">
                                                <label
                                                    class="btn btn-light avatar-sm rounded d-flex justify-content-center align-items-center"
                                                    for="size-m1">M</label>

                                                <input type="checkbox" class="btn-check" name="size[]" id="size-xl1" value="XL">
                                                <label
                                                    class="btn btn-light avatar-sm rounded d-flex justify-content-center align-items-center"
                                                    for="size-xl1">XL</label>

                                                <input type="checkbox" class="btn-check" name="size[]" id="size-xxl1" value="XXL">
                                                <label
                                                    class="btn btn-light avatar-sm rounded d-flex justify-content-center align-items-center"
                                                    for="size-xxl1">XXL</label>
                                                <input type="checkbox" class="btn-check" name="size[]" id="size-3xl1" value="3XL">
                                                <label
                                                    class="btn btn-light avatar-sm rounded d-flex justify-content-center align-items-center"
                                                    for="size-3xl1">3XL</label>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-5">
                                        <div class="mt-3">
                                            <h5 class="text-dark fw-medium">Colors :</h5>
                                            <div class="d-flex flex-wrap gap-2" role="group"
                                                aria-label="Basic checkbox toggle button group">
                                                <input type="checkbox" class="btn-check" name="color[]" id="color-dark1">
                                                <label
                                                    class="btn btn-light avatar-sm rounded d-flex justify-content-center align-items-center"
                                                    for="color-dark1"> <i
                                                        class="bx bxs-circle fs-18 text-dark"></i></label>

                                                <input type="checkbox" class="btn-check" name="color[]" id="color-yellow1">
                                                <label
                                                    class="btn btn-light avatar-sm rounded d-flex justify-content-center align-items-center"
                                                    for="color-yellow1"> <i
                                                        class="bx bxs-circle fs-18 text-warning"></i></label>

                                                <input type="checkbox" class="btn-check" name="color[]" id="color-white1">
                                                <label
                                                    class="btn btn-light avatar-sm rounded d-flex justify-content-center align-items-center"
                                                    for="color-white1"> <i
                                                        class="bx bxs-circle fs-18 text-white"></i></label>

                                                <input type="checkbox" class="btn-check" name="color[]" id="color-red1">
                                                <label
                                                    class="btn btn-light avatar-sm rounded d-flex justify-content-center align-items-center"
                                                    for="color-red1"> <i
                                                        class="bx bxs-circle fs-18 text-primary"></i></label>

                                                <input type="checkbox" class="btn-check" name="color[]" id="color-green1">
                                                <label
                                                    class="btn btn-light avatar-sm rounded d-flex justify-content-center align-items-center"
                                                    for="color-green1"> <i
                                                        class="bx bxs-circle fs-18 text-success"></i></label>

                                                <input type="checkbox" class="btn-check" name="color[]" id="color-blue1">
                                                <label
                                                    class="btn btn-light avatar-sm rounded d-flex justify-content-center align-items-center"
                                                    for="color-blue1"> <i
                                                        class="bx bxs-circle fs-18 text-danger"></i></label>

                                                <input type="checkbox" class="btn-check" name="color[]" id="color-sky1">
                                                <label
                                                    class="btn btn-light avatar-sm rounded d-flex justify-content-center align-items-center"
                                                    for="color-sky1"> <i
                                                        class="bx bxs-circle fs-18 text-info"></i></label>

                                                <input type="checkbox" class="btn-check" name="color[]" id="color-gray1">
                                                <label
                                                    class="btn btn-light avatar-sm rounded d-flex justify-content-center align-items-center"
                                                    for="color-gray1"> <i
                                                        class="bx bxs-circle fs-18 text-secondary"></i></label>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="mb-3">
                                            <label for="description" class="form-label">Description</label>
                                            <textarea class="form-control bg-light-subtle" id="description" name="description" rows="7"
                                                placeholder="Short description about the product"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="mb-3">
                                            <label for="product-id" class="form-label">Tag Number</label>
                                            <input type="number" id="product-id" name="product_id" class="form-control"
                                                placeholder="#******">
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="mb-3">
                                            <label for="product-stock" class="form-label">Stock</label>
                                            <input type="number" id="product-stock" name="product_stock"
                                                class="form-control" placeholder="Quantity">
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <label for="product-stock" class="form-label">Tag</label>
                                        <select class="form-control" id="choices-multiple-remove-button" data-choices
                                            data-choices-removeItem name="choices-multiple-remove-button" multiple>
                                            <option value="Fashion" selected>Fashion</option>
                                            <option value="Electronics">Electronics</option>
                                            <option value="Watches">Watches</option>
                                            <option value="Headphones">Headphones</option>
                                        </select>
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
                                            <input type="number" id="product-price" name="product_price"
                                                class="form-control" placeholder="000">
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <label for="product-discount" class="form-label">Discount</label>
                                        <div class="input-group mb-3">
                                            <span class="input-group-text fs-20"><i class='bx bxs-discount'></i></span>
                                            <input type="number" id="product-discount" name="discount_price"
                                                class="form-control" placeholder="000">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="p-3 bg-light mb-3 rounded">
                            <div class="row justify-content-end g-2">
                                <div class="col-lg-2">
                                    <button type="submit" class="btn btn-outline-secondary w-100">Create Product</button>
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
        <footer class="footer">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12 text-center">
                        <script>
                            document.write(new Date().getFullYear())
                        </script> &copy; Ouron. Design & Develop by
                        <iconify-icon icon="iconamoon:heart-duotone"
                            class="fs-18 align-middle text-danger"></iconify-icon>
                        <a href="https://1.envato.market/techzaa" class="fw-bold footer-text" target="_blank">Rajan</a>
                    </div>
                </div>
            </div>
        </footer>
        <!-- ========== Footer End ========== -->

    </div>

    <script>
        document.getElementById('browse-files').addEventListener('click', function() {
            document.getElementById('product-images').click();
        });

        document.getElementById('product-images').addEventListener('change', function(event) {
            handleFiles(event.target.files);
        });

        document.getElementById('product-dropzone').addEventListener('drop', function(event) {
            event.preventDefault();
            handleFiles(event.dataTransfer.files);
        });

        document.getElementById('product-dropzone').addEventListener('dragover', function(event) {
            event.preventDefault();
        });

        function handleFiles(files) {
            const previewContainer = document.getElementById('preview-container');
            previewContainer.innerHTML = '';
            for (let i = 0; i < files.length; i++) {
                const file = files[i];
                const reader = new FileReader();
                reader.onload = function(e) {
                    const img = document.createElement('img');
                    img.src = e.target.result;
                    img.className = 'img-thumbnail col-md-3 img-fluid';
                    previewContainer.appendChild(img);
                };
                reader.readAsDataURL(file);
            }
        }
    </script>
@endsection
