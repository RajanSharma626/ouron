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
                                <a href="{{ route('admin.customers') }}" class="text-reset fw-semibold fs-12">View More</a>
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

            <div class="row">
                <div class="col">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex align-items-center justify-content-between">
                                <h4 class="card-title">
                                    Recent Orders
                                </h4>
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
                                        <th>
                                            Action
                                        </th>
                                    </tr>
                                </thead>
                                <!-- end thead-->
                                <tbody>
                                    @foreach ($orders as $order)
                                        <tr>
                                            <td>
                                                #{{ $order->id }}
                                            </td>
                                            <td>{{ $order->created_at->format('d M, Y') }}</td>

                                            <td>
                                                <div class="d-flex align-items-center">

                                                    <div class="avatar-sm flex-shrink-0 me-2">
                                                        <img src="{{ asset($order->items->first()->product->firstimage->img) }}"
                                                            alt="" class="img-fluid rouded">
                                                    </div>

                                                    <p class="mb-0 " style="font-size: 12px;">
                                                        {{ $order->items->pluck('product.name')->join(', ') }}
                                                    </p>
                                                </div>

                                            </td>
                                            <td>
                                                <a href="#!"
                                                    class="link-primary fw-medium">{{ $order->first_name . ' ' . $order->last_name }}</a>
                                            </td>
                                            <td>
                                                <a href="mailto:{{ $order->email }}">{{ $order->email }}</a>
                                            </td>
                                            <td>
                                                <a href="tel:{{ $order->phone }}">{{ $order->phone }}</a>
                                            </td>
                                            <td>
                                                {{ $order->address . ', ' . $order->city . ', ' . $order->state . ', ' . $order->pin_code }}
                                            </td>

                                            <td> <span
                                                    class="badge bg-light text-dark  px-2 py-1 fs-13">{{ $order->payment_method }}</span>
                                            </td>
                                            <td>
                                                @php
                                                    $statusClass = match ($order->status) {
                                                        'Pending' => 'bg-warning-subtle text-warning',
                                                        'Confirmed' => 'bg-success-subtle text-success',
                                                        'Packed' => 'bg-success-subtle text-success',
                                                        'Shipped' => 'bg-success-subtle text-success',
                                                        'Delivered' => 'bg-success-subtle text-success',
                                                        'Cancelled' => 'bg-danger-subtle text-danger',
                                                        default => 'bg-warning-subtle text-warning',
                                                    };
                                                @endphp
                                                <span
                                                    class="badge {{ $statusClass }}  px-2 py-1">{{ $order->status }}</span>

                                            </td>
                                            <td>
                                                <div class="d-flex gap-2">
                                                    <a href="{{ route('admin.order.view', $order->id) }}"
                                                        class="btn btn-light btn-sm"><iconify-icon icon="solar:eye-broken"
                                                            class="align-middle fs-18"></iconify-icon></a>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
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
                    <!-- end card -->
                </div>
                <!-- end col -->
            </div>

        </div>
        <!-- End Container Fluid -->

        <!-- ========== Footer Start ========== -->
        @include('admin.layouts.footer')
        <!-- ========== Footer End ========== -->

    </div>
@endsection
