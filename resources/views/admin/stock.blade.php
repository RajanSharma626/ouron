@extends('admin.layouts.master')

@section('title', 'Products Stocks')

@section('page_title', 'Products Stocks')

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
                            <h4 class="card-title flex-grow-1">All Product Stock List</h4>


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

                                            <th>Product Name</th>
                                            <th>S </th>
                                            <th>M </th>
                                            <th>L </th>
                                            <th>XL </th>
                                            <th>XXL </th>
                                            <th>Category</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>

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

                                                        </div>
                                                    </div>
                                                    @php
                                                        $variants = $product->variants->keyBy('size'); // Assumes 'size' field in variants
                                                    @endphp
                                                </td>
                                                <td>
                                                    <span class="badge
                                                        {{ ($variants['S']->stock ?? 0) == 0 ? 'bg-danger' : (($variants['S']->stock ?? 0) <= 5 ? 'bg-warning' : 'bg-success') }}">
                                                        {{ $variants['S']->stock ?? '0' }}
                                                    </span>
                                                </td>
                                                <td>
                                                    <span class="badge
                                                        {{ ($variants['M']->stock ?? 0) == 0 ? 'bg-danger' : (($variants['M']->stock ?? 0) <= 5 ? 'bg-warning' : 'bg-success') }}">
                                                        {{ $variants['M']->stock ?? '0' }}
                                                    </span>
                                                </td>
                                                <td>
                                                    <span class="badge
                                                        {{ ($variants['L']->stock ?? 0) == 0 ? 'bg-danger' : (($variants['L']->stock ?? 0) <= 5 ? 'bg-warning' : 'bg-success') }}">
                                                        {{ $variants['L']->stock ?? '0' }}
                                                    </span>
                                                </td>
                                                <td>
                                                    <span class="badge
                                                        {{ ($variants['XL']->stock ?? 0) == 0 ? 'bg-danger' : (($variants['XL']->stock ?? 0) <= 5 ? 'bg-warning' : 'bg-success') }}">
                                                        {{ $variants['XL']->stock ?? '0' }}
                                                    </span>
                                                </td>
                                                <td>
                                                    <span class="badge
                                                        {{ ($variants['XXL']->stock ?? 0) == 0 ? 'bg-danger' : (($variants['XXL']->stock ?? 0) <= 5 ? 'bg-warning' : 'bg-success') }}">
                                                        {{ $variants['XXL']->stock ?? '0' }}
                                                    </span>
                                                </td>
                                                <td> {{ $product->category->name ?? 'N/A' }}</td>


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
