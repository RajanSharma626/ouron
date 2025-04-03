@extends('frontend.layouts.app')

@section('title', 'Wishlist - Ouron')

@section('content')

    <section class="product_detail">
        <div class="container py-5">
            <h4 class="fw-bold mb-3">Order Details</h4>

            <div class="card">
                <div class="card-body">
                    <h6 class="fw-bold">Order #{{ $order->id }}</h6>
                    <p><strong>Order Date:</strong> {{ $order->created_at->format('d M Y, h:i A') }}</p>
                    <p><strong>Total Amount:</strong> ₹{{ number_format($order->total, 2) }}</p>
                    <p><strong>Status:</strong>
                        <span class="badge bg-{{ $order->status == 'Completed' ? 'success' : 'warning' }}">
                            {{ ucfirst($order->status) }}
                        </span>
                    </p>

                    <h6 class="fw-bold mt-4">Order Items</h6>
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
                                        <div class="d-flex align-items-center">
                                            <img src="{{ $item->product->firstimage->img }}" alt="{{ $item->product->name }}"
                                                style="width: 60px; object-fit: cover; margin-right: 10px;">
                                            <div>
                                                <span class="fw-bold">{{ $item->product->name }}</span><br>
                                                <small>Size: {{ $item->size }}</small><br>
                                                <small>Color: <span style="display: inline-block; width: 15px; height: 15px; background-color: {{ $item->color }}; border: 1px solid #000; border-radius: 50%;"></span></small>
                                            </div>
                                        </div>
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
