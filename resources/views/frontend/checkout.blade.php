@extends('frontend.layouts.app')

@section('title', 'Checkout - Ouron')

@section('content')

    <section class="product_detail py-5">
        <div class="container py-5">
            <div class="row">
                <div class="col-md-6">
                    <!-- Product List -->
                    <div class="card custom-card-bg mb-4 check_product">
                        <div class="card-body">
                            @if ($cart->isEmpty())
                                <p class="text-center text-muted">No items found in your cart.</p>
                            @else
                                @foreach ($cart as $item)
                                    <div class="d-flex align-items-center mb-3 border-bottom pb-3">
                                        <div class="position-relative">
                                            <img src="{{ $item->product->firstImage->img }}" alt="Product"
                                                class="img-thumbnail mr-3" style="width: 70px; height: 70px;">
                                            <span
                                                class="position-absolute top-0 start-100 translate-middle badge rounded-pill primary-bg">
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
                            @endif
                        </div>
                    </div>

                    <!-- Discount Code -->
                    <div class="card custom-card-bg mb-4">
                        <div class="card-body">
                            <form method="POST" action="{{ route('checkout.applyCoupon') }}">
                                @csrf
                                <div class="form-group">
                                    <label for="discountCode" class="form-label">Discount Code</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control text-normal py-2 custom-card-bg"
                                            placeholder="Discount Code" name="coupon_code" aria-label="Discount Code">
                                        <button class="btn btn-outline-secondary py-2" type="submit"
                                            id="button-addon2">Apply Code</button>
                                    </div>
                                    @if (session('coupon_error'))
                                        <div class="text-danger ps-2">{{ session('coupon_error') }}</div>
                                    @endif
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- Order Summary -->
                    <div class="card custom-card-bg">
                        <div class="card-body">
                            @php
                                $subtotal = 0;
                                foreach ($cart as $item) {
                                    $price =
                                        $item->product->price -
                                        ($item->product->price * $item->product->discount_price) / 100;
                                    $subtotal += $price * $item->quantity;
                                }

                                $tax = $subtotal * 0.18; // GST 18%
                                $total = $subtotal + $tax;

                                // Check if a coupon has been applied
                                if (session('discount')) {
                                    $discount = session('discount');
                                    if ($discount['type'] == 'percentage') {
                                        $discountAmount = ($subtotal * $discount['value']) / 100;
                                        $total -= $discountAmount;
                                    } elseif ($discount['type'] == 'fixed_amount') {
                                        $discountAmount = $discount['value'];
                                        $total -= $discountAmount;
                                    } elseif ($discount['type'] == 'free_shipping') {
                                        $discountAmount = $tax; // Free shipping removes the tax
                                        $total -= $tax;
                                    }
                                } else {
                                    $discountAmount = 0;
                                }
                            @endphp

                            <ul class="list-group mb-3">
                                <li class="list-group-item d-flex justify-content-between custom-card-bg">
                                    <span>Subtotal</span>
                                    <strong>₹{{ number_format($subtotal, 2) }}</strong>
                                </li>
                                <li class="list-group-item d-flex justify-content-between custom-card-bg">
                                    <span>GST (18%)</span>
                                    <strong>₹{{ number_format($tax, 2) }}</strong>
                                </li>
                                @if ($discountAmount > 0)
                                    <li class="list-group-item d-flex justify-content-between custom-card-bg">
                                        <span>Discount</span>
                                        <strong>-₹{{ number_format($discountAmount, 2) }}</strong>
                                    </li>
                                @endif
                                <li class="list-group-item d-flex justify-content-between custom-card-bg">
                                    <span>Total</span>
                                    <strong>₹{{ number_format($total, 2) }}</strong>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 mt-3 mt-md-0">
                    <!-- Checkout Form -->
                    <div class="card custom-card-bg">
                        <div class="card-body">
                            <h4 class="mb-4">Address Detail</h4>
                            <form method="post" action="{{ route('checkout.store') }}">
                                @csrf
                                <!-- Address Fields here -->
                                <div class="row">
                                    <div class="col-md-12 text-end py-3">
                                        @if ($cart->isEmpty())
                                            <a href="{{ route('home') }}" class="checkout_btn w-100 link-normal">Continue
                                                Shopping</a>
                                        @else
                                            <button type="submit" class="checkout_btn w-100">Buy Now</button>
                                        @endif
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection

@section('scripts')
    <script>
        document.getElementById('button-addon2').addEventListener('click', function() {
            let couponCode = document.querySelector('input[placeholder="Discount Code"]').value;

            if (!couponCode) {
                alert('Please enter a coupon code.');
                return;
            }

            fetch("{{ route('checkout.applyCoupon') }}", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": "{{ csrf_token() }}",
                    },
                    body: JSON.stringify({
                        coupon_code: couponCode,
                        subtotal: {{ $subtotal }}
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.error) {
                        alert(data.error);
                    } else {
                        alert(data.message);
                        document.getElementById('discountValue').innerText = "₹" + data.discount;
                    }
                })
                .catch(error => console.log(error));
        });
    </script>


@endsection
