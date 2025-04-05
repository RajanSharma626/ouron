@extends('admin.layouts.master')

@section('title', 'Products')

@section('page_title', 'Products')

@section('content')
    <div class="page-content">

        <!-- Start Container Fluid -->
        <div class="container-fluid">

            <!-- Start here.... -->

            <div class="row">
                <div class="col-xl-12">
                    @if (session('success'))
                        <div class="col-12">
                            <div class="alert alert-success text-truncate mb-3" role="alert">
                                {{ session('success') }}
                            </div>
                        </div>
                    @endif

                    @if (session('error'))
                        <div class="col-12">
                            <div class="alert alert-danger text-truncate mb-3" role="alert">
                                {{ session('error') }}
                            </div>
                        </div>
                    @endif
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center gap-1">
                            <h4 class="card-title flex-grow-1">All Product List</h4>

                            <a href="{{ route('admin.products.add') }}" class="btn btn-sm btn-primary">
                                Add Product
                            </a>

                            {{-- <div class="dropdown">
                                <a href="#" class="dropdown-toggle btn btn-sm btn-outline-light"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                    This Month
                                </a>
                                <div class="dropdown-menu dropdown-menu-end">
                                    <!-- item-->
                                    <a href="#!" class="dropdown-item">Download</a>
                                    <!-- item-->
                                    <a href="#!" class="dropdown-item">Export</a>
                                    <!-- item-->
                                    <a href="#!" class="dropdown-item">Import</a>
                                </div>
                            </div> --}}
                        </div>
                        <div>
                            <div class="table-responsive">
                                <table class="table align-middle mb-0 table-hover table-centered">
                                    <thead class="bg-light-subtle">
                                        <tr>

                                            <th>Product Name & Size</th>
                                            <th>Price</th>
                                            <th>Discount</th>
                                            <th>Stock</th>
                                            <th>Category</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php

                                            Log::info($products);

                                        @endphp

                                        @foreach ($products as $product)
                                            <tr>
                                               
                                                <td>
                                                    <div class="d-flex align-items-center gap-2">
                                                        <div
                                                            class="rounded bg-light avatar-md d-flex align-items-center justify-content-center">

                                                            <img src="{{ asset($product->firstimage->img) }}" alt=""
                                                                class="avatar-md">

                                                        </div>
                                                        <div>
                                                            <a href="#!"
                                                                class="text-dark fw-medium fs-15">{{ $product->name }}</a>
                                                            <p class="text-muted mb-0 mt-1 fs-13"><span>Size :
                                                                </span>{{ implode(', ', json_decode($product->sizes, true) ?? []) }}
                                                            </p>
                                                        </div>
                                                    </div>

                                                </td>
                                                <td><s> ₹{{ $product->price }}</s></td>
                                                <td>₹{{ $product->price - ($product->price * $product->discount_price) / 100 }}
                                                    ({{ $product->discount_price }}%)
                                                </td>
                                                <td>
                                                    <p class="mb-1 text-muted"><span
                                                            class="text-dark fw-medium">{{ $product->stock }}
                                                            Item</span> Left</p>
                                                    {{-- <p class="mb-0 text-muted">155 Sold</p> --}}
                                                </td>
                                                <td> {{ $product->category->name ?? 'N/A' }}</td>
                                                <td>
                                                    @if ($product->status == 'active')
                                                        <span class="badge badge-soft-success me-1">Active</span>
                                                    @elseif ($product->status == 'inactive')
                                                        <span class="badge badge-soft-danger me-1">Inactive</span>
                                                    @endif
                                                </td>

                                                <td>
                                                    <div class="d-flex gap-2">
                                                        <a href="" class="btn btn-light btn-sm"><iconify-icon
                                                                icon="solar:eye-broken"
                                                                class="align-middle fs-18"></iconify-icon></a>
                                                        <a href="{{ route('admin.products.edit', $product->id) }}"
                                                            class="btn btn-soft-primary btn-sm"><iconify-icon
                                                                icon="solar:pen-2-broken"
                                                                class="align-middle fs-18"></iconify-icon></a>
                                                        <a href="{{ route('product.delete', $product->id) }}"
                                                            class="btn btn-soft-danger btn-sm"><iconify-icon
                                                                icon="solar:trash-bin-minimalistic-2-broken"
                                                                class="align-middle fs-18"></iconify-icon></a>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <!-- end table-responsive -->
                        </div>
                        <div class="card-footer border-top">
                            <nav aria-label="Page navigation example">
                                <ul class="pagination justify-content-end mb-0">
                                    <!-- Previous Button -->
                                    @if ($products->onFirstPage())
                                        <li class="page-item disabled"><span class="page-link">Previous</span></li>
                                    @else
                                        <li class="page-item">
                                            <a class="page-link" href="{{ $products->previousPageUrl() }}">Previous</a>
                                        </li>
                                    @endif

                                    <!-- Page Numbers -->
                                    @foreach ($products->getUrlRange(1, $products->lastPage()) as $page => $url)
                                        <li class="page-item {{ $page == $products->currentPage() ? 'active' : '' }}">
                                            <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                                        </li>
                                    @endforeach

                                    <!-- Next Button -->
                                    @if ($products->hasMorePages())
                                        <li class="page-item">
                                            <a class="page-link" href="{{ $products->nextPageUrl() }}">Next</a>
                                        </li>
                                    @else
                                        <li class="page-item disabled"><span class="page-link">Next</span></li>
                                    @endif
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div><!-- end row -->

        </div>
        <!-- End Container Fluid -->

        <!-- ========== Footer Start ========== -->
        @include('admin.layouts.footer')
        <!-- ========== Footer End ========== -->

    </div>
@endsection
