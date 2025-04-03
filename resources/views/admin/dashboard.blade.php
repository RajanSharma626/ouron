@extends('admin.layouts.master')

@section('title', 'Dashboard')

@section('page_title', 'Welcome, ' . Auth::guard('admin')->user()->name . '!')

@section('content')
    <div class="page-content">

        <!-- Start Container Fluid -->
        <div class="container-fluid">

            <!-- Start here.... -->
            <div class="row">

                <div class="col-md-6">
                    <div class="card overflow-hidden">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-6">
                                    <div class="avatar-md bg-soft-primary rounded">
                                        <iconify-icon icon="solar:cart-5-bold-duotone"
                                            class="avatar-title fs-32 text-primary"></iconify-icon>
                                    </div>
                                </div> <!-- end col -->
                                <div class="col-6 text-end">
                                    <p class="text-muted mb-0 text-truncate">Total Orders</p>
                                    <h3 class="text-dark mt-1 mb-0">{{ $TotalOrders }}</h3>
                                </div> <!-- end col -->
                            </div> <!-- end row-->
                        </div> <!-- end card body -->
                        <div class="card-footer py-2 bg-light bg-opacity-50">
                            <div class="d-flex align-items-center justify-content-between">
                                <div>

                                </div>
                                <a href="{{ route('admin.orders') }}" class="text-reset fw-semibold fs-12">View
                                    More</a>
                            </div>
                        </div> <!-- end card body -->
                    </div> <!-- end card -->
                </div> <!-- end col -->
                <div class="col-md-6">
                    <div class="card overflow-hidden">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-6">
                                    <div class="avatar-md bg-soft-primary rounded">
                                        <i class="bx bx-award avatar-title fs-24 text-primary"></i>
                                    </div>
                                </div> <!-- end col -->
                                <div class="col-6 text-end">
                                    <p class="text-muted mb-0 text-truncate">Total Leads</p>
                                    <h3 class="text-dark mt-1 mb-0">{{ $TotalUsers }}</h3>
                                </div> <!-- end col -->
                            </div> <!-- end row-->
                        </div> <!-- end card body -->
                        <div class="card-footer py-2 bg-light bg-opacity-50">
                            <div class="d-flex align-items-center justify-content-between">
                                <div>

                                </div>
                                <a href="#!" class="text-reset fw-semibold fs-12">View More</a>
                            </div>
                        </div> <!-- end card body -->
                    </div> <!-- end card -->
                </div> <!-- end col -->
                <div class="col-md-6">
                    <div class="card overflow-hidden">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-6">
                                    <div class="avatar-md bg-soft-primary rounded">
                                        <i class="bx bxs-backpack avatar-title fs-24 text-primary"></i>
                                    </div>
                                </div> <!-- end col -->
                                <div class="col-6 text-end">
                                    <p class="text-muted mb-0 text-truncate">Total Products</p>
                                    <h3 class="text-dark mt-1 mb-0">{{ $TotalProducts }}</h3>
                                </div> <!-- end col -->
                            </div> <!-- end row-->
                        </div> <!-- end card body -->
                        <div class="card-footer py-2 bg-light bg-opacity-50">
                            <div class="d-flex align-items-center justify-content-between">
                                <div>
                                    {{-- <span class="text-danger"> <i class="bx bxs-down-arrow fs-12"></i>
                                                0.3%</span>
                                            <span class="text-muted ms-1 fs-12">Last Month</span> --}}
                                </div>
                                <a href="{{ route('admin.products') }}" class="text-reset fw-semibold fs-12">View More</a>
                            </div>
                        </div> <!-- end card body -->
                    </div> <!-- end card -->
                </div> <!-- end col -->
                <div class="col-md-6">
                    <div class="card overflow-hidden">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-6">
                                    <div class="avatar-md bg-soft-primary rounded">
                                        <i class="bx bx-dollar-circle avatar-title text-primary fs-24"></i>
                                    </div>
                                </div> <!-- end col -->
                                <div class="col-6 text-end">
                                    <p class="text-muted mb-0 text-truncate">Total Revenue</p>
                                    <h3 class="text-dark mt-1 mb-0">₹{{ $TotalOrdersAmount }}</h3>
                                </div> <!-- end col -->
                            </div> <!-- end row-->
                        </div> <!-- end card body -->
                        <div class="card-footer py-2 bg-light bg-opacity-50">
                            <div class="d-flex align-items-center justify-content-between">
                                <div>
                                    {{-- <span class="text-danger"> <i class="bx bxs-down-arrow fs-12"></i>
                                                10.6%</span>
                                            <span class="text-muted ms-1 fs-12">Last Month</span> --}}
                                </div>
                                <a href="{{ route('admin.orders') }}" class="text-reset fw-semibold fs-12">View
                                    More</a>
                            </div>
                        </div> <!-- end card body -->
                    </div> <!-- end card -->
                </div> <!-- end col -->

            </div> <!-- end row -->

        </div>
        <!-- End Container Fluid -->

        <!-- ========== Footer Start ========== -->
        @include('admin.layouts.footer')
        <!-- ========== Footer End ========== -->

    </div>
@endsection
