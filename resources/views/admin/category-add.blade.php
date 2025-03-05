@extends('admin.layouts.master')

@section('title', 'Categories')

@section('page_title', 'Categories')

@section('content')
    <div class="page-content">

        <!-- Start Container Fluid -->
        <div class="container-xxl">
            <div class="row">
                <div class="12">
                    <form action="{{ route('category.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Add Thumbnail Photo</h4>
                            </div>
                            <div class="card-body">
                                <!-- File Upload -->

                                <div class="fallback">
                                    <input name="file" class="form-control" type="file" required />
                                </div>
                                @error('file')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror

                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">General Information</h4>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label for="category-title" class="form-label">Category Title</label>
                                            <input type="text" name="category-title" class="form-control"
                                                placeholder="Enter Title" required>
                                        </div>
                                        @error('category-title')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="mb-0">
                                            <label for="description" class="form-label">Description</label>
                                            <textarea class="form-control bg-light-subtle" name="description" rows="7" placeholder="Type description"></textarea>
                                        </div>
                                        @error('description')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Meta Options</h4>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label for="meta-title" class="form-label">Meta Title</label>
                                            <input type="text" class="form-control" name="meta-title"
                                                placeholder="Enter Title">
                                        </div>
                                        @error('meta-title')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label for="meta-tag" class="form-label">Meta Tag Keyword</label>
                                            <input type="text" name="meta-tag" class="form-control"
                                                placeholder="Enter word">
                                        </div>
                                        @error('meta-tag')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="mb-0">
                                            <label for="description" class="form-label">Description</label>
                                            <textarea class="form-control bg-light-subtle" name="meta-description" rows="4" placeholder="Type description"></textarea>
                                        </div>

                                        @error('meta-description')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="p-3 bg-light mb-3 rounded">
                            <div class="row justify-content-end g-2">
                                <div class="col-lg-2">
                                    <button type="submit" href="#!" class="btn btn-outline-secondary w-100">Save
                                        Change</button>
                                </div>
                                <div class="col-lg-2">
                                    <a href="#!" class="btn btn-primary w-100">Cancel</a>
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
                        <iconify-icon icon="iconamoon:heart-duotone" class="fs-18 align-middle text-danger"></iconify-icon>
                        <a href="https://1.envato.market/techzaa" class="fw-bold footer-text" target="_blank">Rajan</a>
                    </div>
                </div>
            </div>
        </footer>
        <!-- ========== Footer End ========== -->

    </div>
@endsection
