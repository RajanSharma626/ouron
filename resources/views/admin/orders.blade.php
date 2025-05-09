@extends('admin.layouts.master')

@section('title', 'Orders')

@section('page_title', 'Orders')

@section('content')
    <div class="page-content">

        <!-- Start Container Fluid -->
        <div class="container-xxl">

            <div class="row">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="d-flex card-header justify-content-between align-items-center">
                            <div>
                                <h4 class="card-title">All Order List</h4>
                            </div>
                            <div class="dropdown">
                                <a href="{{route('orders.csv.download')}}" class="btn btn-sm btn-primary">
                                    Download CSV
                                </a>
                            </div>
                        </div>

                        <div>
                            <div class="table-responsive">
                                <table class="table align-middle mb-0 table-hover table-centered">
                                    <thead class="bg-light-subtle">
                                        <tr>
                                            <th>Order ID</th>
                                            <th>Created at</th>
                                            <th>Product</th>
                                            <th>Customer</th>
                                            <th>Email</th>
                                            <th>Phone</th>
                                            <th>Address</th>
                                            <th>Total</th>
                                            <th>Payment Status</th>
                                            <th>Items</th>
                                            <th>Order Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
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
                                                        <div>
                                                            <p class="mb-0 " style="font-size: 12px;">
                                                                {{ $order->items->pluck('product.name')->join(', ') }}
                                                            </p>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <a href="#!"
                                                        class="link-primary fw-medium">{{ $order->first_name . ' ' . $order->last_name }}</a>
                                                </td>
                                                <td>
                                                    <a href="mailto:{{ $order->email }}"
                                                        class="link-primary fw-medium">{{ $order->email }}</a>
                                                </td>
                                                <td>
                                                    <a href="tel:{{ $order->phone }}"
                                                        class="link-primary fw-medium">{{ $order->phone }}</a>
                                                </td>
                                                <td>
                                                    {{ $order->address . ', ' . $order->city . ', ' . $order->state . ', ' . $order->pin_code }}
                                                </td>
                                                <td> ₹{{ number_format($order->total, 2) }}</td>
                                                <td> <span
                                                        class="badge bg-light text-dark  px-2 py-1 fs-13">{{ $order->payment_method }}</span>
                                                </td>
                                                <td> {{ $order->items->sum('quantity') }} </td>

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
                                                            class="btn btn-light btn-sm"><iconify-icon
                                                                icon="solar:eye-broken"
                                                                class="align-middle fs-18"></iconify-icon></a>
                                                        {{-- <a href="#!" class="btn btn-soft-primary btn-sm"><iconify-icon
                                                                icon="solar:pen-2-broken"
                                                                class="align-middle fs-18"></iconify-icon></a>
                                                        <a href="#!" class="btn btn-soft-danger btn-sm"><iconify-icon
                                                                icon="solar:trash-bin-minimalistic-2-broken"
                                                                class="align-middle fs-18"></iconify-icon></a> --}}
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
                                    @if ($orders->onFirstPage())
                                        <li class="page-item disabled"><a class="page-link"
                                                href="javascript:void(0);">Previous</a></li>
                                    @else
                                        <li class="page-item"><a class="page-link"
                                                href="{{ $orders->previousPageUrl() }}">Previous</a></li>
                                    @endif

                                    @foreach ($orders->links()->elements[0] as $page => $url)
                                        @if ($page == $orders->currentPage())
                                            <li class="page-item active"><a class="page-link"
                                                    href="javascript:void(0);">{{ $page }}</a></li>
                                        @else
                                            <li class="page-item"><a class="page-link"
                                                    href="{{ $url }}">{{ $page }}</a></li>
                                        @endif
                                    @endforeach

                                    @if ($orders->hasMorePages())
                                        <li class="page-item"><a class="page-link"
                                                href="{{ $orders->nextPageUrl() }}">Next</a></li>
                                    @else
                                        <li class="page-item disabled"><a class="page-link"
                                                href="javascript:void(0);">Next</a></li>
                                    @endif
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>

            </div>


        </div>
        <!-- End Container Fluid -->

        <!-- ========== Footer Start ========== -->
        @include('admin.layouts.footer')
        <!-- ========== Footer End ========== -->

    </div>
@endsection
