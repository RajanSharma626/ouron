@extends('admin.layouts.master')

@section('title', 'Dashboard')

@section('page_title', 'Welcome, ' . Auth::guard('admin')->user()->name . '!')

@section('content')
    <div class="page-content">

        <!-- Start Container Fluid -->
        <div class="container-fluid">

            <!-- Start here.... -->
            <div class="row">
                <div class="col-xxl-5">
                    <div class="row">
                        {{-- <div class="col-12">
                            <div class="alert alert-primary text-truncate mb-3" role="alert">
                                We regret to inform you that our server is currently experiencing technical
                                difficulties.
                            </div>
                        </div> --}}

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
                                        <a href="{{route('admin.products')}}" class="text-reset fw-semibold fs-12">View More</a>
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
                </div> <!-- end col -->
            </div> <!-- end row -->

            {{-- <div class="row">
                <div class="col">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex align-items-center justify-content-between">
                                <h4 class="card-title">
                                    Recent Orders
                                </h4>

                                <a href="#!" class="btn btn-sm btn-soft-primary">
                                    <i class="bx bx-plus me-1"></i>Create Order
                                </a>
                            </div>
                        </div>
                        <!-- end card body -->
                        <div class="table-responsive table-centered">
                            <table class="table mb-0">
                                <thead class="bg-light bg-opacity-50">
                                    <tr>
                                        <th class="ps-3">
                                            Order ID.
                                        </th>
                                        <th>
                                            Date
                                        </th>
                                        <th>
                                            Product
                                        </th>
                                        <th>
                                            Customer Name
                                        </th>
                                        <th>
                                            Email ID
                                        </th>
                                        <th>
                                            Phone No.
                                        </th>
                                        <th>
                                            Address
                                        </th>
                                        <th>
                                            Payment Type
                                        </th>
                                        <th>
                                            Status
                                        </th>
                                    </tr>
                                </thead>
                                <!-- end thead-->
                                <tbody>
                                    <tr>
                                        <td class="ps-3">
                                            <a href="order-detail.html">#RB5625</a>
                                        </td>
                                        <td>29 April 2024</td>
                                        <td>
                                            <img src="assets/images/products/product-1(1).png" alt="product-1(1)"
                                                class="img-fluid avatar-sm">
                                        </td>
                                        <td>
                                            <a href="#!">Anna M. Hines</a>
                                        </td>
                                        <td>anna.hines@mail.com</td>
                                        <td>(+1)-555-1564-261</td>
                                        <td>Burr Ridge/Illinois</td>
                                        <td>Credit Card</td>
                                        <td>
                                            <i class="bx bxs-circle text-success me-1"></i>Completed
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="ps-3">
                                            <a href="order-detail.html">#RB9652</a>
                                        </td>
                                        <td>25 April 2024</td>
                                        <td>
                                            <img src="assets/images/products/product-4.png" alt="product-4"
                                                class="img-fluid avatar-sm">
                                        </td>
                                        <td>
                                            <a href="#!">Judith H. Fritsche</a>
                                        </td>
                                        <td>judith.fritsche.com</td>
                                        <td>(+57)-305-5579-759</td>
                                        <td>SULLIVAN/Kentucky</td>
                                        <td>Credit Card</td>
                                        <td>
                                            <i class="bx bxs-circle text-success me-1"></i>Completed
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="ps-3">
                                            <a href="order-detail.html">#RB5984</a>
                                        </td>
                                        <td>25 April 2024</td>
                                        <td>
                                            <img src="assets/images/products/product-5.png" alt="product-5"
                                                class="img-fluid avatar-sm">
                                        </td>
                                        <td>
                                            <a href="#!">Peter T. Smith</a>
                                        </td>
                                        <td>peter.smith@mail.com</td>
                                        <td>(+33)-655-5187-93</td>
                                        <td>Yreka/California</td>
                                        <td>Pay Pal</td>
                                        <td>
                                            <i class="bx bxs-circle text-success me-1"></i>Completed
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="ps-3">
                                            <a href="order-detail.html">#RB3625</a>
                                        </td>
                                        <td>21 April 2024</td>
                                        <td>
                                            <img src="assets/images/products/product-6.png" alt="product-6"
                                                class="img-fluid avatar-sm">
                                        </td>
                                        <td>
                                            <a href="#!">Emmanuel J. Delcid</a>
                                        </td>
                                        <td>
                                            emmanuel.delicid@mail.com
                                        </td>
                                        <td>(+30)-693-5553-637</td>
                                        <td>Atlanta/Georgia</td>
                                        <td>Pay Pal</td>
                                        <td>
                                            <i class="bx bxs-circle text-primary me-1"></i>Processing
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="ps-3">
                                            <a href="order-detail.html">#RB8652</a>
                                        </td>
                                        <td>18 April 2024</td>
                                        <td>
                                            <img src="assets/images/products/product-1(2).png" alt="product-1(2)"
                                                class="img-fluid avatar-sm">
                                        </td>
                                        <td>
                                            <a href="#!">William J. Cook</a>
                                        </td>
                                        <td>william.cook@mail.com</td>
                                        <td>(+91)-855-5446-150</td>
                                        <td>Rosenberg/Texas</td>
                                        <td>Credit Card</td>
                                        <td>
                                            <i class="bx bxs-circle text-primary me-1"></i>Processing
                                        </td>
                                    </tr>
                                </tbody>
                                <!-- end tbody -->
                            </table>
                            <!-- end table -->
                        </div>
                        <!-- table responsive -->

                        <div class="card-footer border-top">
                            <div class="row g-3">
                                <div class="col-sm">
                                    <div class="text-muted">
                                        Showing
                                        <span class="fw-semibold">5</span>
                                        of
                                        <span class="fw-semibold">90,521</span>
                                        orders
                                    </div>
                                </div>

                                <div class="col-sm-auto">
                                    <ul class="pagination m-0">
                                        <li class="page-item">
                                            <a href="#" class="page-link"><i class="bx bx-left-arrow-alt"></i></a>
                                        </li>
                                        <li class="page-item active">
                                            <a href="#" class="page-link">1</a>
                                        </li>
                                        <li class="page-item">
                                            <a href="#" class="page-link">2</a>
                                        </li>
                                        <li class="page-item">
                                            <a href="#" class="page-link">3</a>
                                        </li>
                                        <li class="page-item">
                                            <a href="#" class="page-link"><i class="bx bx-right-arrow-alt"></i></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> --}}

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
