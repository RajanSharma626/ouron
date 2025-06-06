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

                            <a href="{{ route('product.csv.download') }}" class="btn btn-sm btn-outline-primary">
                                Download CSV
                            </a>

                            <a href="{{ route('admin.products.add') }}" class="btn btn-sm btn-primary">
                                Add Product
                            </a>

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
                                                                </span>{{ implode(', ', $product->variants->pluck('size')->toArray()) }}
                                                            </p>
                                                        </div>
                                                    </div>

                                                </td>
                                                <td><s> ₹{{ $product->price }}</s></td>
                                                <td>₹{{ $product->discount_price }}
                                                </td>
                                                <td>
                                                    @php
                                                        $totalStock = $product->variants->sum('stock');
                                                    @endphp
                                                    @if ($totalStock == 0)
                                                        <p class="mb-1 text-danger"><span
                                                                class="text-danger fw-medium">{{ $totalStock }}
                                                                Item</span> Left</p>
                                                    @elseif ($totalStock <= 5)
                                                        <p class="mb-1 text-warning"><span
                                                                class="text-warning fw-medium">{{ $totalStock }}
                                                                Item</span> Left</p>
                                                    @else
                                                        <p class="mb-1 text-muted"><span
                                                                class="text-dark fw-medium">{{ $totalStock }}
                                                                Item</span> Left</p>
                                                    @endif
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
                                                        <a href="{{ route('product.detail', $product->slug) }}"
                                                            target="_blank" class="btn btn-light btn-sm"><iconify-icon
                                                                icon="solar:eye-broken"
                                                                class="align-middle fs-18"></iconify-icon></a>
                                                        <a href="{{ route('admin.products.edit', $product->id) }}"
                                                            class="btn btn-soft-primary btn-sm"><iconify-icon
                                                                icon="solar:pen-2-broken"
                                                                class="align-middle fs-18"></iconify-icon></a>
                                                        <a href="{{ route('product.delete', $product->id) }}"
                                                            onclick="event.preventDefault(); confirmAction('Delete this product?', 'This cannot be undone.', '{{ route('product.delete', $product->id) }}')"
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
