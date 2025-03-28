<!DOCTYPE html>
<html>

<head>
    <title>Order Confirmation</title>
</head>

<body>
    <h2>Thank you for your order, {{ $order->first_name }}!</h2>
    <p>We have received your order #{{ $order->id }}.</p>

    <h3>Order Details:</h3>

    @foreach ($order->items as $item)
        <div class="d-flex align-items-center mb-3 border-bottom pb-3">
            <div class="position-relative">
                <img src="{{ asset($item->product->firstImage->img) }}" alt="Product" class="img-thumbnail mr-3"
                    style="width: 70px; height: 70px;">
                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill primary-bg">
                    {{ $item->quantity }}
                </span>
            </div>
            <div class="d-flex justify-content-between w-100 ms-2">
                <div>
                    <h6 class="mb-1 fw-bold check_title">{{ $item->product->name }}</h6>
                    <p class="mb-0 check_desc">
                        Size: {{ $item->size ?? 'XS' }} | Color: &nbsp;
                        <span class="color-circle checkout-color"
                            style="background-color: {{ $item->color ?? '#ffffff' }};"></span>
                    </p>
                </div>
                <div class="ml-auto">
                    <h6>₹{{ number_format($item->product->price - ($item->product->price * $item->product->discount_price) / 100, 2) }}
                    </h6>
                </div>
            </div>
        </div>
    @endforeach

    <p><strong>Subtotal:</strong> ₹{{ $order->subtotal }}</p>
    <p><strong>Tax:</strong> ₹{{ $order->tax }}</p>
    <p><strong>Total:</strong> ₹{{ $order->total }}</p>

    <p>We will notify you once your order is shipped.</p>

    <p>Thank you for shopping with us!</p>
</body>

</html>
