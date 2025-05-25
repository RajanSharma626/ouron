@extends('frontend.layouts.app')

@section('title', 'Order Details - Ouron')

@section('content')
    <section class="order-details py-5">
        <div class="container">
            <!-- Alert Messages -->
            @if (session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <!-- Order Header -->
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h4 class="fw-bold mb-0">Order Details</h4>
                <a href="{{ route('profile') }}" class="btn btn-outline-secondary btn-sm">
                    <i class="bi bi-arrow-left me-1"></i> Back to Orders
                </a>
            </div>

            <div class="card shadow-sm mb-4">
                <div class="card-header bg-white py-3">
                    <div class="row align-items-center">
                        <div class="col-md-6">
                            <h5 class="mb-0 fw-bold">Order #{{ $order->id }}</h5>
                        </div>
                        <div class="col-md-6 text-md-end">
                            @if ($order->status == 'Pending')
                                <span class="badge bg-success rounded-pill px-3 py-2">
                                    <i class="bi bi-clock me-1"></i> Order Place
                                </span>
                            @elseif ($order->status == 'Confirmed')
                                <span class="badge bg-success rounded-pill px-3 py-2">
                                    <i class="bi bi-box-seam me-1"></i> Prepairing for Shipment
                                </span>
                            @elseif ($order->status == 'Shipped')
                                <span class="badge bg-success rounded-pill px-3 py-2">
                                    <i class="bi bi-truck me-1"></i> Order Shipped
                                </span>
                            @elseif ($order->status == 'Out for Delivery')
                                <span class="badge bg-success rounded-pill px-3 py-2">
                                    <i class="bi bi-truck me-1"></i> Out for Delivery
                                </span>
                            @elseif ($order->status == 'Delivered')
                                <span class="badge bg-success rounded-pill px-3 py-2">
                                    <i class="bi bi-check-circle me-1"></i> Delivered
                                </span>
                            @elseif ($order->status == 'Cancelled')
                                <span class="badge bg-danger rounded-pill px-3 py-2">
                                    <i class="bi bi-x-circle me-1"></i> Cancelled
                                </span>
                            @elseif ($order->status == 'Return Requested')
                                <span class="badge bg-secondary rounded-pill px-3 py-2">
                                    <i class="bi bi-clock me-1"></i> Return Requested
                                </span>
                            @elseif ($order->status == 'Return Approved')
                                <span class="badge bg-success rounded-pill px-3 py-2">
                                    <i class="bi bi-check-circle me-1"></i> Return Accepted
                                </span>
                            @elseif ($order->status == 'Returned')
                                <span class="badge bg-success rounded-pill px-3 py-2">
                                    <i class="bi bi-arrow-left-circle me-1"></i> Returned
                                </span>
                            @elseif ($order->status == 'Failed')
                                <span class="badge bg-danger rounded-pill px-3 py-2">
                                    <i class="bi bi-exclamation-circle me-1"></i> Failed
                                </span>
                            @elseif ($order->status == 'Refunded')
                                <span class="badge bg-success rounded-pill px-3 py-2">
                                    <i class="bi bi-arrow-left-circle me-1"></i> Refunded
                                </span>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <!-- Order Summary -->
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <h6 class="text-muted fw-bold small text-uppercase">Order Information</h6>
                                <div class="mt-3 transform-none">
                                    <p class="mb-2"><span class="text-muted"><i class="bi bi-calendar3 me-1 "></i> Placed
                                            on:</span> <small>{{ $order->created_at->format('d M Y, h:i A') }}</small></p>

                                    <p class="mb-2"><span class="text-muted"><i class="bi bi-credit-card me-1 "></i>
                                            Payment
                                            Method:</span>
                                        <small>{{ $order->payment_method == 'UPI' ? 'Prepaid' : 'Cash on Delivery (COD)' }}</small>
                                    </p>


                                    <p class="mb-2"><span class="text-muted"><i class="bi bi-currency-rupee me-1 "></i>
                                            Total
                                            Amount:</span>
                                        <small> ₹{{ $order->total ?? '0' }}</small>
                                    </p>



                                    @if ($order->payment_method == 'UPI')
                                        <p class="mb-2"><span class="text-muted"><i class="bi bi-upc me-1 "></i>
                                                Transaction
                                                ID:</span> <small>#{{ $order->payment->transaction_id ?? 'N/A' }}</small>
                                        </p>

                                        <p class="mb-2"><span class="text-muted"><i class="bi bi-check-circle me-1 "></i>
                                                Payment Status:</span>
                                            <small>{{ $order->payment_status ?? 'Success' }}</small>
                                        </p>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="mb-3">
                                <h6 class="text-muted fw-bold small text-uppercase "><i class="bi bi-geo-alt text-primary"></i> Shipping Address</h6>
                                <div class="bg-light rounded">
                                    <address class="mb-0">
                                        <b>{{ $order->first_name }},</b> <br> {{ $order->address }}, {{ $order->city }}, <br>
                                        {{ $order->state }} - {{ $order->pin_code }}
                                    </address>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Order Items -->
                    <h6 class="fw-bold border-bottom pb-2 mb-3 text-uppercase small">Order Items</h6>
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead class="table-light">
                                <tr>
                                    <th scope="col">Product</th>
                                    <th scope="col" class="text-center">Quantity</th>
                                    <th scope="col" class="text-end">Price</th>
                                    <th scope="col" class="text-end">Subtotal</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($order->items as $item)
                                    <tr>
                                        <td>
                                            <a href="{{ route('product.detail', $item->product->slug) }}"
                                                class="link-dark text-decoration-none">
                                                <div class="d-flex align-items-center">
                                                    <img src="{{ $item->product->firstimage->img }}"
                                                        alt="{{ $item->product->name }}" class="rounded me-3"
                                                        style="width: 70px; height: 70px; object-fit: cover;">
                                                    <div>
                                                        <h6 class="mb-1">{{ $item->product->name }}</h6>
                                                        <div class="d-flex flex-wrap gap-3 small">
                                                            <span class="text-muted">Size: <span
                                                                    class="fw-medium">{{ $item->size }}</span></span>
                                                            <span class="text-muted d-flex align-items-center">
                                                                Color:
                                                                <span class="ms-1"
                                                                    style="display: inline-block; width: 16px; height: 16px; background-color: {{ $item->color }}; border: 1px solid #dee2e6; border-radius: 50%;"></span>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </a>
                                        </td>
                                        <td class="text-center align-middle">{{ $item->quantity }}</td>
                                        <td class="text-end align-middle">₹{{ number_format($item->price, 2) }}</td>
                                        <td class="text-end align-middle fw-bold">
                                            ₹{{ number_format($item->price * $item->quantity, 2) }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot class="table-light">
                                <tr>
                                    <td colspan="3" class="text-end fw-bold">Total:</td>
                                    <td class="text-end fw-bold">₹{{ number_format($order->total, 2) }}</td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>

                    <!-- Action Buttons -->
                    <div class="mt-4 d-flex flex-wrap gap-2 justify-content-between">
                        <div>


                            @if ($order->status == 'Pending')
                                <a href="javascript:void(0);" class="btn btn-danger"
                                    onclick="CancelOrder('Cancel Order', 'Are you sure you want to cancel this order?', '{{ route('order.cancel', $order->id) }}')">
                                    <i class="bi bi-x-circle me-1"></i>Cancel Order
                                </a>
                            @elseif ($order->status == 'Shipped' || $order->status == 'Out for Delivery')
                                <a href="{{ route('track.order', $order->id) }}" class="btn btn-primary">
                                    <i class="bi bi-truck me-1"></i> Track Order
                                </a>
                            @elseif ($order->status == 'Delivered' && $order->created_at->diffInDays(now()) <= 7)
                                <a href="javascript:void(0);" class="btn btn-danger" data-bs-toggle="modal"
                                    data-bs-target="#returnModal">
                                    <i class="bi bi-arrow-left-circle me-1"></i> Return Order
                                </a>

                                <!-- Modal -->
                                <div class="modal fade" id="returnModal" tabindex="-1"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="exampleModalLabel">Reason ?</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <form action="{{ route('return.request', $order->id) }}')" method="POST"
                                                enctype="multipart/form-data">
                                                @csrf
                                                <div class="modal-body">
                                                    <div class="row">
                                                        <div class="col-12 mb-3">
                                                            <label for="" class="form-label">Return Reason</label>
                                                            <textarea class="form-control" name="reason" id="" required></textarea>
                                                        </div>
                                                        <div class="col-12 mb-3">
                                                            <label for="" class="form-label">Product
                                                                Images</label>
                                                            <input class="form-control" name="images[]" type="file"
                                                                multiple required>
                                                            <small class="text-muted transform-none">Upload images of the
                                                                product you want to return.</small>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-primary">Return</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                        <div>
                            @if (
                                $order->status != 'Pending' ||
                                    $order->status != 'Cancelled' ||
                                    $order->status != 'Failed' ||
                                    $order->status != 'Refunded' ||
                                    $order->status != 'Returned')
                                @if ($order->invoice && $order->invoice->invoice_path != '')
                                    <a href="{{ asset($order->invoice->invoice_path) }}"
                                        class="btn btn-outline-secondary" download>
                                        <i class="bi bi-printer me-1"></i>Invoice
                                    </a>
                                @endif
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection


@push('styles')
    <style>
        @media print {
            .order-details {
                padding: 0 !important;
            }

            .btn,
            nav,
            footer,
            .alert {
                display: none !important;
            }

            .card {
                border: none !important;
                box-shadow: none !important;
            }
        }
    </style>
@endpush
