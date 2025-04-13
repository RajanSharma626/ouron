@extends('frontend.layouts.app')

@section('title', 'Wishlist - Ouron')

@section('content')

    <section class="product_detail">
        <div class="container py-5">
            <h4 class="fw-bold mb-3">Order Details</h4>

            <div class="card">
                <div class="card-body">
                    <h6 class="fw-bold">Order #{{ $order->id }}</h6>
                    <p class="mb-2"><strong>Order Date:</strong> {{ $order->created_at->format('d M Y, h:i A') }}</p>
                    <p class="mb-2"><strong>Total Amount:</strong> ₹{{ number_format($order->total, 2) }}</p>
                    <p class="mb-2"><strong>Status:</strong>
                        <span class="badge bg-success">
                            {{ ucfirst($order->status == "Pending" ? "Confimed" : $order->status) }}
                        </span>
                    </p>

                    <p class="mb-2"><strong>Payment Method:</strong>
                        {{ $order->payment_method == 'UPI' ? 'Prepaid' : 'Cash on Delivery (COD)' }}
                    </p class="mb-2">

                    @if ($order->payment_method == 'UPI')
                        <p><strong>Transaction ID:</strong> </p>
                        <p><strong>Payment Status:</strong> </p>
                    @endif

                    <h6 class="fw-bold mt-4 border-bottom pb-2">Order Items</h6>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Product</th>
                                <th>Quantity</th>
                                <th>Price</th>
                                <th>Subtotal</th>
                            </tr>
                        </thead>
                        <tbody> 
                            @foreach ($order->items as $item)
                                <tr>
                                    <td>
                                        <a href="{{route('product.detail', $item->product->slug)}}" class="link-normal">
                                            <div class="d-flex align-items-center">
                                                <img src="{{ $item->product->firstimage->img }}"
                                                    alt="{{ $item->product->name }}"
                                                    style="width: 60px; object-fit: cover; margin-right: 10px;">
                                                <div>
                                                    <span class="fw-bold">{{ $item->product->name }}</span><br>
                                                    <small>Size: {{ $item->size }}</small><br>
                                                    <small>Color: <span
                                                            style="display: inline-block; width: 15px; height: 15px; background-color: {{ $item->color }}; border: 1px solid #000; border-radius: 50%;"></span></small>
                                                </div>
                                            </div>
                                        </a>
                                    </td>
                                    <td>{{ $item->quantity }}</td>
                                    <td>₹{{ number_format($item->price, 2) }}</td>
                                    <td>₹{{ number_format($item->price * $item->quantity, 2) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <h6 class="fw-bold mt-4">Shipping Address</h6>
                    <p>{{ $order->address }}, {{ $order->city }}, {{ $order->state }} -
                        {{ $order->pin_code }}</p>

                    <a href="{{ route('profile') }}" class="btn primary-bg mt-3">
                        Back to Orders
                    </a>
                </div>
            </div>
    </section>

@endsection
