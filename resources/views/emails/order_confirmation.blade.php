<!DOCTYPE html>
<html>

<head>
    <title>Order Confirmation</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }

        h2 {
            color: #333;
        }

        h3 {
            margin-top: 20px;
            color: #555;
        }

        .d-flex {
            display: flex;
        }

        .align-items-center {
            align-items: center;
        }

        .mb-3 {
            margin-bottom: 1rem;
        }

        .border-bottom {
            border-bottom: 1px solid #ddd;
        }

        .pb-3 {
            padding-bottom: 1rem;
        }

        .position-relative {
            position: relative;
        }

        .img-thumbnail {
            border: 1px solid #ddd;
            border-radius: 0.25rem;
            padding: 0.25rem;
        }

        .mr-3 {
            margin-right: 1rem;
        }

        .position-absolute {
            position: absolute;
        }

        .top-0 {
            top: 0;
        }

        .start-100 {
            left: 100%;
        }

        .translate-middle {
            transform: translate(-50%, -50%);
        }

        .badge {
            display: inline-block;
            padding: 0.25em 0.4em;
            font-size: 75%;
            font-weight: 700;
            line-height: 1;
            text-align: center;
            white-space: nowrap;
            vertical-align: baseline;
            border-radius: 0.375rem;
        }

        .rounded-pill {
            border-radius: 50rem;
        }

        .primary-bg {
            background-color: #007bff;
            color: #fff;
        }

        .ms-2 {
            margin-left: 0.5rem;
        }

        .justify-content-between {
            justify-content: space-between;
        }

        .w-100 {
            width: 100%;
        }

        .fw-bold {
            font-weight: bold;
        }

        .check_title {
            font-size: 1rem;
        }

        .check_desc {
            font-size: 0.875rem;
            color: #666;
        }

        .ml-auto {
            margin-left: auto;
        }

        .color-circle {
            display: inline-block;
            width: 15px;
            height: 15px;
            border-radius: 50%;
            border: 1px solid #ddd;
        }
    </style>
</head>

<body>
    <h2>Thank you for your order, {{ $order->first_name }}!</h2>
    <p>We have received your order #{{ $order->id }}.</p>

    <h3>Order Details:</h3>

    @foreach ($order->items as $item)
        <div class="d-flex align-items-center mb-3 border-bottom pb-3">
            <div class="position-relative">
                <img src="{{ asset($item->product->firstImage->img) }}" alt="Product" class="img-thumbnail mr-3"
                    style="width: 70px;">
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
                    <h6>₹{{ number_format($item->product->discount_price, 2) }}
                    </h6>
                </div>
            </div>
        </div>
    @endforeach

    <p><strong>Subtotal:</strong> ₹{{ $order->subtotal }}</p>
    <p><strong>Total:</strong> ₹{{ $order->total }}</p>

    <p>We will notify you once your order is shipped.</p>

    <p>Thank you for shopping with us!</p>

</body>

</html>
