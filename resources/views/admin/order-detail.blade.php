@extends('admin.layouts.master')

@section('title', 'Order Detail')

@section('page_title', 'Order Detail')

@section('content')
    <div class="page-content">

        <!-- Start Container -->
        <div class="container-xxl">
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
            <div class="row">
                <div class="col-xl-9 col-lg-8">
                    <div class="row">
                        <div class="col-lg-12">

                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex flex-wrap align-items-center justify-content-between gap-2">
                                        <div>
                                            <h4 class="fw-medium text-dark d-flex align-items-center gap-2">
                                                Order#{{ $order->id }}

                                                @if ($order->status == 'Pending')
                                                    <span
                                                        class="border border-warning text-warning fs-13 px-2 py-1 rounded">Order
                                                        Placed</span>
                                                @elseif ($order->status == 'Cancelled')
                                                    <span
                                                        class="border border-danger text-danger fs-13 px-2 py-1 rounded">Order
                                                        Cancelled</span>
                                                @elseif ($order->status == 'Confirmed')
                                                    <span
                                                        class="border border-success text-success fs-13 px-2 py-1 rounded">Order
                                                        Confirmed</span>
                                                @elseif ($order->status == 'Shipped')
                                                    <span
                                                        class="border border-success text-success fs-13 px-2 py-1 rounded">Order
                                                        Shipped</span>
                                                @elseif ($order->status == 'Out for Delivery')
                                                    <span
                                                        class="border border-success text-success fs-13 px-2 py-1 rounded">Out
                                                        of Delivery</span>
                                                @elseif ($order->status == 'Delivered')
                                                    <span
                                                        class="border border-success text-success fs-13 px-2 py-1 rounded"><i
                                                            class="bx bx-check-double"></i> Order Delivered </span>
                                                @elseif ($order->status == 'Returned')
                                                    <span
                                                        class="border border-danger text-danger fs-13 px-2 py-1 rounded">Order
                                                        Returned</span>
                                                @elseif ($order->status == 'Refunded')
                                                    <span
                                                        class="border border-danger text-danger fs-13 px-2 py-1 rounded">Order
                                                        Refunded</span>
                                                @elseif ($order->status == 'Return Requested')
                                                    <span
                                                        class="border border-warning text-warning fs-13 px-2 py-1 rounded">Return
                                                        Requested</span>
                                                @elseif ($order->status == 'Return Approved')
                                                    <span
                                                        class="border border-success text-success fs-13 px-2 py-1 rounded">Return
                                                        Approved</span>
                                                @endif

                                            </h4>
                                            <p class="mb-0">
                                                {{ $order->created_at->format('M d, Y') }} at
                                                {{ $order->created_at->format('g:i a') }}</p>
                                        </div>
                                        <div>
                                            <a href="{{ route('admin.orders') }}" class="btn btn-outline-secondary">Back</a>
                                            @if ($order->status == 'Pending')
                                                <a href="{{ route('admin.order.cancel', $order->id) }}"
                                                    class="btn btn-danger">Cancel
                                                    Order</a>
                                            @endif
                                        </div>

                                    </div>

                                    <div class="mt-4">
                                        <h4 class="fw-medium text-dark">Progress</h4>
                                    </div>
                                    <div class="row row-cols-md-4">
                                        <div class="col">
                                            <div class="progress mt-3" style="height: 10px;">
                                                <div class="progress-bar progress-bar-striped progress-bar-animated bg-success"
                                                    role="progressbar" style="width: 100%" aria-valuenow="100"
                                                    aria-valuemin="0" aria-valuemax="100">
                                                </div>
                                            </div>
                                            <p class="mb-0 mt-2">Order Placed</p>
                                        </div>
                                        <div class="col">
                                            <div class="progress mt-3" style="height: 10px;">
                                                <div class="progress-bar progress-bar-striped progress-bar-animated {{ $order->status == 'Pending' ? 'bg-warning' : ($order->status == 'Confirmed' || $order->status == 'Shipped' || $order->status == 'Out for Delivery' || $order->status == 'Delivered' || $order->status == 'Returned' || $order->status == 'Refunded' || $order->status == 'Return Requested' || $order->status == 'Return Approved' || $order->status == 'Returned Cancelled' ? 'bg-success' : 'bg-primary') }}"
                                                    role="progressbar"
                                                    style="width: {{ $order->status == 'Pending' ? '60%' : ($order->status == 'Confirmed' || $order->status == 'Shipped' || $order->status == 'Out for Delivery' || $order->status == 'Delivered' || $order->status == 'Returned' || $order->status == 'Refunded' || $order->status == 'Return Requested' || $order->status == 'Return Approved' || $order->status == 'Returned Cancelled' ? '100%' : '0%') }}"
                                                    aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">
                                                </div>
                                            </div>
                                            <p class="mb-0 mt-2">Confirmed</p>
                                        </div>
                                        <div class="col">
                                            <div class="progress mt-3" style="height: 10px;">
                                                <div class="progress-bar progress-bar-striped progress-bar-animated {{ $order->status == 'Confirmed' ? 'bg-warning' : ($order->status == 'Shipped' || $order->status == 'Out for Delivery' || $order->status == 'Delivered' || $order->status == 'Returned' || $order->status == 'Refunded' || $order->status == 'Return Requested' || $order->status == 'Return Approved' || $order->status == 'Returned Cancelled' ? 'bg-success' : 'bg-primary') }}"
                                                    role="progressbar"
                                                    style="width: {{ $order->status == 'Confirmed' ? '60%' : ($order->status == 'Shipped' || $order->status == 'Out for Delivery' || $order->status == 'Delivered' || $order->status == 'Returned' || $order->status == 'Refunded' || $order->status == 'Return Requested' || $order->status == 'Return Approved' || $order->status == 'Returned Cancelled' ? '100%' : '0%') }}"
                                                    aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">
                                                </div>
                                            </div>
                                            <p class="mb-0 mt-2">Shipped</p>
                                        </div>
                                        <div class="col">
                                            <div class="progress mt-3" style="height: 10px;">
                                                <div class="progress-bar progress-bar-striped progress-bar-animated {{ $order->status == 'Shipped' ? 'bg-warning' : ($order->status == 'Out for Delivery' || $order->status == 'Delivered' || $order->status == 'Returned' || $order->status == 'Refunded' || $order->status == 'Return Requested' || $order->status == 'Return Approved' || $order->status == 'Returned Cancelled' ? 'bg-success' : 'bg-primary') }}"
                                                    role="progressbar"
                                                    style="width: {{ $order->status == 'Shipped' ? '60%' : ($order->status == 'Out for Delivery' || $order->status == 'Delivered' || $order->status == 'Returned' || $order->status == 'Refunded' || $order->status == 'Return Requested' || $order->status == 'Return Approved' || $order->status == 'Returned Cancelled' ? '100%' : '0%') }}"
                                                    aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">
                                                </div>
                                            </div>
                                            <p class="mb-0 mt-2">Out for Delivery</p>
                                        </div>
                                        <div class="col">
                                            <div class="progress mt-3" style="height: 10px;">
                                                <div class="progress-bar progress-bar-striped progress-bar-animated {{ $order->status == 'Out for Delivery' ? 'bg-warning' : ($order->status == 'Delivered' || $order->status == 'Returned' || $order->status == 'Refunded' || $order->status == 'Return Requested' || $order->status == 'Return Approved' || $order->status == 'Returned Cancelled' ? 'bg-success' : 'bg-primary') }}"
                                                    role="progressbar"
                                                    style="width: {{ $order->status == 'Out for Delivery' ? '60%' : ($order->status == 'Delivered' || $order->status == 'Returned' || $order->status == 'Refunded' || $order->status == 'Return Requested' || $order->status == 'Return Approved' || $order->status == 'Returned Cancelled' ? '100%' : '0%') }}"
                                                    aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">
                                                </div>
                                            </div>
                                            <p class="mb-0 mt-2">Delivered</p>
                                        </div>
                                        <div class="col">
                                            <div class="progress mt-3" style="height: 10px;">
                                                <div class="progress-bar progress-bar-striped progress-bar-animated {{ $order->status == 'Return Requested' ? 'bg-warning' : ($order->status == 'Return Approved' || $order->status == 'Returned' || $order->status == 'Return Approved' || $order->status == 'Refunded' ? 'bg-success' : 'bg-primary') }}"
                                                    role="progressbar"
                                                    style="width: {{ $order->status == 'Return Requested' ? '60%' : ($order->status == 'Return Approved' || $order->status == 'Returned' || $order->status == 'Return Approved' || $order->status == 'Refunded' ? '100%' : '0%') }}"
                                                    aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">
                                                </div>
                                            </div>
                                            <p class="mb-0 mt-2">Return Requested</p>
                                        </div>
                                        <div class="col">
                                            <div class="progress mt-3" style="height: 10px;">
                                                @if (isset($order->status))
                                                    <div class="progress-bar progress-bar-striped progress-bar-animated {{ $order->status == 'Return Approved' ? 'bg-warning' : ($order->status == 'Returned' || $order->status == 'Refunded' ? 'bg-success' : 'bg-primary') }}"
                                                        role="progressbar"
                                                        style="width: {{ $order->status == 'Return Approved' ? '60%' : ($order->status == 'Returned' || $order->status == 'Refunded' ? '100%' : '0%') }}"
                                                        aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">
                                                    </div>
                                                @else
                                                    <div class="progress-bar progress-bar-striped progress-bar-animated bg-primary"
                                                        role="progressbar" style="width: 0%" aria-valuenow="0"
                                                        aria-valuemin="0" aria-valuemax="100">
                                                    </div>
                                                @endif
                                            </div>
                                            <p class="mb-0 mt-2">Returned</p>
                                        </div>
                                        <div class="col">
                                            <div class="progress mt-3" style="height: 10px;">
                                                <div class="progress-bar progress-bar-striped progress-bar-animated {{ $order->status == 'Returned' ? 'bg-warning' : ($order->status == 'Refunded' ? 'bg-success' : 'bg-primary') }}"
                                                    role="progressbar"
                                                    style="width: {{ $order->status == 'Returned' ? '60%' : ($order->status == 'Refunded' ? '100%' : '0%') }}"
                                                    aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">
                                                </div>
                                            </div>
                                            <p class="mb-0 mt-2">Refunded</p>
                                        </div>
                                    </div>
                                </div>
                                <div
                                    class="card-footer d-flex flex-wrap align-items-center justify-content-between bg-light-subtle gap-2">
                                    <p class=""></p>
                                    <div>
                                        @if ($order->status != 'Cancelled')
                                            @if ($order->status == 'Pending')
                                                <a href="#"
                                                    onclick="confirmOrder('{{ route('admin.order.confirm', $order->id) }}')"
                                                    class="btn btn-primary">Make as Confirm Order</a>
                                            @elseif ($order->status == 'Confirmed')
                                                <a href="#"
                                                    onclick="confirmAction2('{{ route('admin.order.shipped', $order->id) }}', 'Ready to Shipped')"
                                                    class="btn btn-primary">Make as Ready To Shipped</a>
                                            @elseif ($order->status == 'Shipped')
                                                <a href="#"
                                                    onclick="confirmAction2('{{ route('admin.order.out.of.delivered', $order->id) }}', 'Out for Delivery')"
                                                    class="btn btn-primary">Make as Out for Delivery</a>
                                            @elseif ($order->status == 'Out for Delivery')
                                                <a href="#"
                                                    onclick="confirmAction2('{{ route('admin.order.delivered', $order->id) }}', 'Delivered')"
                                                    class="btn btn-primary">Make as Delivered</a>
                                            @elseif ($order->status == 'Delivered')
                                                <a class="btn border-success text-success">Delivered <i
                                                        class="bx bx-check-double"></i></a>
                                            @elseif ($order->status == 'Return Requested')
                                                <a href="#"
                                                    onclick="confirmAction2('{{ route('admin.order.returnedApprove', $order->id) }}', 'Return Accepted')"
                                                    class="btn btn-primary">Return Accept</a>
                                                <a href="#"
                                                    onclick="confirmAction2('{{ route('admin.order.returnedCancel', $order->id) }}', 'Return Cancel')"
                                                    class="btn btn-danger">Return Cancel</a>
                                            @elseif ($order->status == 'Return Approved')
                                                <a href="#"
                                                    onclick="confirmAction2('{{ route('admin.order.returned', $order->id) }}', 'Returned')"
                                                    class="btn btn-primary">Make as Returned</a>
                                            @elseif ($order->status == 'Returned')
                                                <a href="#"
                                                    onclick="confirmAction2('{{ route('admin.order.refunded', $order->id) }}', 'Returned')"
                                                    class="btn btn-primary">Make as Refunded</a>
                                            @else
                                                <a class="btn border-success text-success">Completed <i
                                                        class="bx bx-check-double"></i></a>
                                            @endif
                                        @endif

                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Product</h4>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table align-middle mb-0 table-hover table-centered">
                                            <thead class="bg-light-subtle border-bottom">
                                                <tr>
                                                    <th>Product Name & Size</th>
                                                    <th>Quantity</th>
                                                    <th>Price</th>
                                                    <th>Amount</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($order->items as $item)
                                                    <tr>
                                                        <td>
                                                            <div class="d-flex align-items-center gap-2">
                                                                <div
                                                                    class="rounded bg-light avatar-md d-flex align-items-center justify-content-center">
                                                                    <img src="{{ asset($item->product->firstimage->img ?? 'default.jpg') }}"
                                                                        alt="Product Image" class="avatar-md">
                                                                </div>
                                                                <div>
                                                                    <a href="#!"
                                                                        class="text-dark fw-medium fs-15">{{ $item->product->name }}</a>
                                                                    <p
                                                                        class="text-muted mb-0 mt-1 fs-13 d-flex align-items-center">
                                                                        <span>Size :
                                                                            &nbsp;</span><b>{{ $item->size ?? 'N/A' }}</b>
                                                                        &nbsp;&nbsp;
                                                                        <span>Color : &nbsp;</span><span
                                                                            class="color-circle"
                                                                            style="background-color: {{ $item->color ?? '#ffffff' }};"></span>
                                                                    </p>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>{{ $item->quantity }} item</td>
                                                        <td>₹{{ number_format($item->price, 2) }}</td>
                                                        <td>₹{{ number_format($item->price * $item->quantity, 2) }}</td>
                                                    </tr>
                                                @endforeach

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Order Timeline</h4>
                                </div>
                                <div class="card-body">
                                    <div class="position-relative ms-2">
                                        <span class="position-absolute start-0 top-0 border border-dashed h-100"></span>

                                        @if (isset($statusHistory) && $statusHistory->isNotEmpty())
                                            @foreach ($statusHistory as $index => $history)
                                                @if ($history->status == 'invoice_generated')
                                                    <div class="position-relative ps-4">
                                                        <div class="mb-4">
                                                            <span
                                                                class="position-absolute start-0 avatar-sm translate-middle-x bg-light d-inline-flex align-items-center justify-content-center rounded-circle text-success fs-20">
                                                                <i class="bx bx-check-circle"></i>
                                                            </span>
                                                            <div
                                                                class="ms-2 d-flex flex-wrap gap-2 align-items-center justify-content-between">
                                                                <div>
                                                                    <h5 class="mb-1 text-dark fw-medium fs-15">The Invoice
                                                                        has been created</h5>
                                                                    @if ($history->changedBy)
                                                                        <p class="mb-2">Invoice created by
                                                                            {{ $history->changedBy->name }}</p>
                                                                    @endif
                                                                    <a href="{{asset($order->invoice->invoice_path)}}" class="btn btn-primary" download>Download
                                                                        Invoice</a>
                                                                </div>
                                                                <p class="mb-0">
                                                                    {{ \Carbon\Carbon::parse($history->changed_at)->format('F d, Y, h:i A') }}
                                                                </p>

                                                            </div>
                                                        </div>
                                                    </div>
                                                @else
                                                    <div class="position-relative ps-4 mb-4">
                                                        <span
                                                            class="position-absolute start-0 avatar-sm translate-middle-x bg-light d-inline-flex align-items-center justify-content-center rounded-circle text-success fs-20">
                                                            <i class='bx bx-check-circle'></i>
                                                        </span>

                                                        <div
                                                            class="ms-2 d-flex flex-wrap gap-2 align-items-center justify-content-between">
                                                            <div>
                                                                <h5 class="mb-1 text-dark fw-medium fs-15">
                                                                    {{ ucfirst($history->status) }}
                                                                </h5>
                                                                @if ($history->comment)
                                                                    <p class="mb-2">{{ $history->comment }}</p>
                                                                @endif

                                                                @if ($history->status == 'Return Requested' && !empty($order->return_image))
                                                                    <div class="mb-2">
                                                                        @foreach (json_decode($order->return_image, true) as $img)
                                                                            <a href="{{ asset(Storage::url($img)) }}" data-lightbox="return-{{ $order->id }}" data-title="Return Image">
                                                                                <img src="{{ asset(Storage::url($img)) }}" alt="Return Image" style="height: 60px; margin-right: 8px; border-radius: 4px; border: 1px solid #eee;">
                                                                            </a>
                                                                        @endforeach
                                                                    </div>
                                                                @endif

                                                                @if ($history->changedBy)
                                                                    <p class="mb-0">Marked by
                                                                        {{ $history->changedBy->name }}
                                                                    </p>
                                                                @endif
                                                            </div>
                                                            <p class="mb-0">
                                                                {{ \Carbon\Carbon::parse($history->changed_at)->format('F d, Y, h:i A') }}
                                                            </p>
                                                        </div>
                                                    </div>
                                                @endif
                                            @endforeach
                                        @endif

                                        <div class="position-relative ps-4">
                                            <div class="mb-2">
                                                <span
                                                    class="position-absolute start-0 avatar-sm translate-middle-x bg-light d-inline-flex align-items-center justify-content-center rounded-circle text-success fs-20">
                                                    <i class='bx bx-check-circle'></i>
                                                </span>
                                                <div
                                                    class="ms-2 d-flex flex-wrap gap-2 align-items-center justify-content-between">
                                                    <div>
                                                        <h5 class="mb-2 text-dark fw-medium fs-15">
                                                            Order Placed by
                                                            <span
                                                                class="link-primary">{{ $order->first_name . ' ' . $order->last_name }}</span>
                                                        </h5>

                                                        @foreach ($order->items as $index => $item)
                                                            <a href="#!"
                                                                class="badge bg-light text-dark fw-normal px-2 py-1 fs-13">Item
                                                                {{ $index + 1 }}</a>
                                                        @endforeach
                                                    </div>
                                                    <p class="mb-0">{{ $order->created_at->format('M d, Y') }} at
                                                        {{ $order->created_at->format('g:i a') }}</p>
                                                </div>
                                            </div>
                                        </div>

                                        @if ($statusHistory->first() && $statusHistory->first()->status === 'delivered')
                                            <div class="text-center mt-4">
                                                <span class="badge bg-success fs-15">This order has been successfully
                                                    Delivered</span>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>


                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-4">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Order Summary</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table mb-0">
                                    <tbody>
                                        <tr>
                                            <td class="px-0">
                                                <p class="d-flex mb-0 align-items-center gap-1">
                                                    <iconify-icon icon="solar:clipboard-text-broken"></iconify-icon>
                                                    Sub Total :
                                                </p>
                                            </td>
                                            <td class="text-end text-dark fw-medium px-0">₹{{ $order->subtotal }}</td>
                                        </tr>
                                        {{-- <tr>
                                            <td class="px-0">
                                                <p class="d-flex mb-0 align-items-center gap-1">
                                                    <iconify-icon icon="solar:ticket-broken"
                                                        class="align-middle"></iconify-icon> Discount
                                                    :
                                                </p>
                                            </td>
                                            <td class="text-end text-dark fw-medium px-0">-$60.00</td>
                                        </tr> --}}
                                        <tr>
                                            <td class="px-0">
                                                <p class="d-flex mb-0 align-items-center gap-1">
                                                    <iconify-icon icon="solar:kick-scooter-broken"
                                                        class="align-middle"></iconify-icon> Delivery
                                                    Charge :
                                                </p>
                                            </td>
                                            <td class="text-end text-dark fw-medium px-0">₹00.00</td>
                                        </tr>
                                        <tr>
                                            <td class="px-0">
                                                <p class="d-flex mb-0 align-items-center gap-1">
                                                    <iconify-icon icon="solar:calculator-minimalistic-broken"
                                                        class="align-middle"></iconify-icon>
                                                    Estimated Tax (12%) :
                                                </p>
                                            </td>
                                            <td class="text-end text-dark fw-medium px-0">₹{{ $order->tax }}</td>
                                        </tr>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="card-footer d-flex align-items-center justify-content-between bg-light-subtle">
                            <div>
                                <p class="fw-medium text-dark mb-0">Total Amount</p>
                            </div>
                            <div>
                                <p class="fw-medium text-dark mb-0">₹{{ $order->total }}</p>
                            </div>

                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Payment Information</h4>
                        </div>
                        <div class="card-body">
                            <div
                                class="d-flex align-items-center gap-3 {{ $order->payment_method == 'UPI' ? 'mb-3' : '' }}">
                                <div>
                                    <p class="mb-1 text-dark fw-medium">{{ $order->payment_method }}</p>
                                </div>
                                <div class="ms-auto">
                                    <iconify-icon icon="solar:check-circle-broken"
                                        class="fs-22 text-success"></iconify-icon>
                                </div>
                            </div>
                            @if ($order->payment_method == 'UPI')
                                <p class="text-dark mb-1 fw-medium">Transaction ID : <span
                                        class="text-muted fw-normal fs-13">
                                        #{{ $order->payment->transaction_id ?? 'NA' }}</span></p>
                            @endif

                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Customer Details</h4>
                        </div>
                        <div class="card-body">
                            <div class="d-flex align-items-center gap-2">
                                {{-- <img src="assets/images/users/avatar-1.jpg" alt=""
                                    class="avatar rounded-3 border border-light border-3"> --}}
                                <div>
                                    <p class="mb-1">{{ $order->first_name . ' ' . $order->last_name }}</p>
                                    <a href="mailto:{{ $order->email }}"
                                        class="link-primary fw-medium">{{ $order->email }}</a>
                                </div>
                            </div>
                            <div class="d-flex justify-content-between mt-3">
                                <h5 class="">Contact Number</h5>
                                {{-- <div>
                                    <a href="#!"><i class='bx bx-edit-alt fs-18'></i></a>
                                </div> --}}
                            </div>
                            <p class="mb-1"><a href="tel:+91{{ $order->phone }}" class="link-primary fw-medium">+91
                                    {{ $order->phone }}</a></p>

                            <div class="d-flex justify-content-between mt-3">
                                <h5 class="">Shipping Address</h5>
                                {{-- <div>
                                    <a href="#!"><i class='bx bx-edit-alt fs-18'></i></a>
                                </div> --}}
                            </div>

                            <div>
                                <p class="mb-1">{{ $order->address }}</p>
                                <p class="mb-1">{{ $order->address2 }}</p>
                                <p class="mb-1">{{ $order->city }} ,</p>
                                <p class="mb-1">{{ $order->state }} - {{ $order->pin_code }} ,</p>
                                <p class="">+91 {{ $order->phone }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
