@extends('frontend.layouts.app')

@section('title', 'Checkout - Ouron')

@section('content')

    <section class="product_detail">
        <div class="container py-md-5">
            <div class="row">

                <div class="col-12">
                    <h1 class="fs-3 text-center mb-md-5 mb-3 fw-bold mt-3 mt-md-0">Checkout</h1>
                </div>
                <div class="col-md-6">
                    <!-- Product List -->
                    <div class="card custom-card-bg mb-4 check_product">
                        <div class="card-body pb-0">
                            @if ($cart->isEmpty())
                                <p class="text-center text-muted">No items found in your cart.</p>
                            @else
                                @foreach ($cart as $item)
                                    <a href="{{ route('product.detail', $item->product->slug) }}" class="link-normal">
                                        <div class="d-flex align-items-center pb-3">
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
                                                    <p class="mb-0 check_desc d-flex align-items-center">
                                                        <span>
                                                            Size: <b>{{ $item->size ?? 'XS' }}</b>
                                                        </span>
                                                        &nbsp; | &nbsp; Color: &nbsp;
                                                        <span class="rounded-circle checkout-color border-dark border"
                                                            style="background-color: {{ $item->color ?? '#ffffff' }};"></span>
                                                    </p>
                                                </div>
                                                <div class="ml-auto">
                                                    <h6>₹{{ number_format($item->product->discount_price, 2) }}
                                                    </h6>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
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
                                // Calculate subtotal from cart items
                                $subtotal = 0;
                                foreach ($cart as $item) {
                                    $price = $item->product->discount_price;
                                    $subtotal += $price * $item->quantity;
                                }

                                $discountAmount = 0;
                                // If a coupon is applied, deduct discount from the subtotal.
                                if (session('discount')) {
                                    $discount = session('discount');
                                    if ($discount['type'] == 'percentage') {
                                        $discountAmount = ($subtotal * $discount['value']) / 100;
                                    } elseif ($discount['type'] == 'fixed_amount') {
                                        $discountAmount = $discount['value'];
                                    }
                                }
                                $total = $subtotal - $discountAmount;
                                $tax = $total < 1000 ? $total * 0.05 : $total * 0.12; // 5% tax for total under 1000, 12% for 1000 and above
                            @endphp

                            <ul class="list-group mb-3">
                                <li class="list-group-item d-flex justify-content-between custom-card-bg">
                                    <span>Subtotal</span>
                                    <strong>₹{{ number_format($subtotal, 2) }}</strong>
                                </li>
                                @if ($discountAmount > 0)
                                    <li class="list-group-item d-flex justify-content-between custom-card-bg">
                                        <span>Discount Coupon : <small class="text-secondary">
                                                <s>{{ $discount['coupon_code'] }}</s></small>
                                            <form method="POST" action="{{ route('checkout.removeCoupon') }}">
                                                @csrf
                                                <button type="submit"
                                                    class="btn btn-link btn-sm text-danger p-0">Remove</button>
                                            </form>
                                        </span>
                                        <strong>-₹{{ number_format($discountAmount, 2) }} @if ($discount['type'] == 'percentage')
                                                ({{ number_format($discount['value'], 0) }}%)
                                            @endif
                                        </strong>
                                    </li>
                                @endif
                                <li class="list-group-item d-flex justify-content-between custom-card-bg">
                                    <span>Shipping</span>
                                    <span id="shippingCost">
                                        <small class="text-muted"><s>₹100</s> <span class="text-success">Free</span></small>
                                    </span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between custom-card-bg">
                                    <span>GST ({{ $total < 1000 ? '5%' : '12%' }})</span>
                                    <span id="shippingCost">
                                        <small class="text-muted"> ₹{{$tax ?? "0"}}</small>
                                    </span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between custom-card-bg">
                                    <span>Total</span>
                                    <strong>₹{{ number_format($total, 2) }}</strong>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 mt-4 mt-md-0">
                    <!-- Checkout Form -->
                    <div class="card custom-card-bg">
                        <div class="card-body">
                            <h4 class="mb-4 fw-bold">Address Detail</h4>
                            <form method="post" action="{{ route('checkout.store') }}">
                                @csrf
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group mb-3">
                                            <input type="text" class="form-control py-2 custom-card-bg @error('first_name') is-invalid @enderror" name="first_name"
                                                placeholder="Full name *"
                                                value="{{ old('first_name', Auth::user()->name ?? '') }}">
                                            @error('first_name')
                                            <div class="text-danger transform-none"><span>{{ $message }}</span></div>
                                            @enderror
                                        </div>
                                    </div>
                                   
                                </div>

                                <div class="form-group mb-3">
                                    <input type="email" class="form-control py-2 custom-card-bg @error('email') is-invalid @enderror" name="email"
                                        id="emailAddress" placeholder="Enter email *"
                                        value="{{ old('email', Auth::user()->email ?? '') }}">
                                    @error('email')
                                        <div class="text-danger transform-none"><span>{{ $message }}</span></div>
                                    @enderror
                                </div>
                                <div class="form-group mb-3">
                                    <input type="text" class="form-control py-2 custom-card-bg @error('address') is-invalid @enderror"
                                        placeholder="Flat / House No. / Floor / Building *" name="address"
                                        value="{{ old('address', $defaultAddress->address ?? '') }}">
                                    @error('address')
                                    <div class="text-danger transform-none"><span>{{ $message }}</span></div>
                                    @enderror
                                </div>
                                <div class="form-group mb-3">
                                    <input type="text" class="form-control py-2 custom-card-bg"
                                        placeholder="Address 2 (Optional)" name="address2"
                                        value="{{ old('address2', $defaultAddress->address_2 ?? '') }}">
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <input type="text" class="form-control py-2 custom-card-bg @error('city') is-invalid @enderror" id="city"
                                                placeholder="City *" name="city"
                                                value="{{ old('city', $defaultAddress->city ?? '') }}">
                                            @error('city')
                                            <div class="text-danger transform-none"><span>{{ $message }}</span></div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <select id="state" class="form-control py-2 custom-card-bg @error('state') is-invalid @enderror"
                                                name="state">
                                                <option value="">Select State *</option>
                                                <option value="Andaman and Nicobar Islands"
                                                    {{ old('state', $defaultAddress->state ?? '') == 'Andaman and Nicobar Islands' ? 'selected' : '' }}>
                                                    Andaman and Nicobar Islands
                                                </option>
                                                <option value="Andhra Pradesh"
                                                    {{ old('state', $defaultAddress->state ?? '') == 'Andhra Pradesh' ? 'selected' : '' }}>
                                                    Andhra Pradesh
                                                </option>
                                                <option value="Arunachal Pradesh"
                                                    {{ old('state', $defaultAddress->state ?? '') == 'Arunachal Pradesh' ? 'selected' : '' }}>
                                                    Arunachal Pradesh
                                                </option>
                                                <option value="Assam"
                                                    {{ old('state', $defaultAddress->state ?? '') == 'Assam' ? 'selected' : '' }}>
                                                    Assam
                                                </option>
                                                <option value="Bihar"
                                                    {{ old('state', $defaultAddress->state ?? '') == 'Bihar' ? 'selected' : '' }}>
                                                    Bihar
                                                </option>
                                                <option value="Chandigarh"
                                                    {{ old('state', $defaultAddress->state ?? '') == 'Chandigarh' ? 'selected' : '' }}>
                                                    Chandigarh
                                                </option>
                                                <option value="Chhattisgarh"
                                                    {{ old('state', $defaultAddress->state ?? '') == 'Chhattisgarh' ? 'selected' : '' }}>
                                                    Chhattisgarh
                                                </option>
                                                <option value="Dadra and Nagar Haveli and Daman and Diu"
                                                    {{ old('state', $defaultAddress->state ?? '') == 'Dadra and Nagar Haveli and Daman and Diu' ? 'selected' : '' }}>
                                                    Dadra and Nagar Haveli and Daman and Diu
                                                </option>
                                                <option value="Delhi"
                                                    {{ old('state', $defaultAddress->state ?? '') == 'Delhi' ? 'selected' : '' }}>
                                                    Delhi
                                                </option>
                                                <option value="Goa"
                                                    {{ old('state', $defaultAddress->state ?? '') == 'Goa' ? 'selected' : '' }}>
                                                    Goa
                                                </option>
                                                <option value="Gujarat"
                                                    {{ old('state', $defaultAddress->state ?? '') == 'Gujarat' ? 'selected' : '' }}>
                                                    Gujarat
                                                </option>
                                                <option value="Haryana"
                                                    {{ old('state', $defaultAddress->state ?? '') == 'Haryana' ? 'selected' : '' }}>
                                                    Haryana
                                                </option>
                                                <option value="Himachal Pradesh"
                                                    {{ old('state', $defaultAddress->state ?? '') == 'Himachal Pradesh' ? 'selected' : '' }}>
                                                    Himachal Pradesh
                                                </option>
                                                <option value="Jammu and Kashmir"
                                                    {{ old('state', $defaultAddress->state ?? '') == 'Jammu and Kashmir' ? 'selected' : '' }}>
                                                    Jammu and Kashmir
                                                </option>
                                                <option value="Jharkhand"
                                                    {{ old('state', $defaultAddress->state ?? '') == 'Jharkhand' ? 'selected' : '' }}>
                                                    Jharkhand
                                                </option>
                                                <option value="Karnataka"
                                                    {{ old('state', $defaultAddress->state ?? '') == 'Karnataka' ? 'selected' : '' }}>
                                                    Karnataka
                                                </option>
                                                <option value="Kerala"
                                                    {{ old('state', $defaultAddress->state ?? '') == 'Kerala' ? 'selected' : '' }}>
                                                    Kerala
                                                </option>
                                                <option value="Ladakh"
                                                    {{ old('state', $defaultAddress->state ?? '') == 'Ladakh' ? 'selected' : '' }}>
                                                    Ladakh
                                                </option>
                                                <option value="Lakshadweep"
                                                    {{ old('state', $defaultAddress->state ?? '') == 'Lakshadweep' ? 'selected' : '' }}>
                                                    Lakshadweep
                                                </option>
                                                <option value="Madhya Pradesh"
                                                    {{ old('state', $defaultAddress->state ?? '') == 'Madhya Pradesh' ? 'selected' : '' }}>
                                                    Madhya Pradesh
                                                </option>
                                                <option value="Maharashtra"
                                                    {{ old('state', $defaultAddress->state ?? '') == 'Maharashtra' ? 'selected' : '' }}>
                                                    Maharashtra
                                                </option>
                                                <option value="Manipur"
                                                    {{ old('state', $defaultAddress->state ?? '') == 'Manipur' ? 'selected' : '' }}>
                                                    Manipur
                                                </option>
                                                <option value="Meghalaya"
                                                    {{ old('state', $defaultAddress->state ?? '') == 'Meghalaya' ? 'selected' : '' }}>
                                                    Meghalaya
                                                </option>
                                                <option value="Mizoram"
                                                    {{ old('state', $defaultAddress->state ?? '') == 'Mizoram' ? 'selected' : '' }}>
                                                    Mizoram
                                                </option>
                                                <option value="Nagaland"
                                                    {{ old('state', $defaultAddress->state ?? '') == 'Nagaland' ? 'selected' : '' }}>
                                                    Nagaland
                                                </option>
                                                <option value="Odisha"
                                                    {{ old('state', $defaultAddress->state ?? '') == 'Odisha' ? 'selected' : '' }}>
                                                    Odisha
                                                </option>
                                                <option value="Puducherry"
                                                    {{ old('state', $defaultAddress->state ?? '') == 'Puducherry' ? 'selected' : '' }}>
                                                    Puducherry
                                                </option>
                                                <option value="Punjab"
                                                    {{ old('state', $defaultAddress->state ?? '') == 'Punjab' ? 'selected' : '' }}>
                                                    Punjab
                                                </option>
                                                <option value="Rajasthan"
                                                    {{ old('state', $defaultAddress->state ?? '') == 'Rajasthan' ? 'selected' : '' }}>
                                                    Rajasthan
                                                </option>
                                                <option value="Sikkim"
                                                    {{ old('state', $defaultAddress->state ?? '') == 'Sikkim' ? 'selected' : '' }}>
                                                    Sikkim
                                                </option>
                                                <option value="Tamil Nadu"
                                                    {{ old('state', $defaultAddress->state ?? '') == 'Tamil Nadu' ? 'selected' : '' }}>
                                                    Tamil Nadu
                                                </option>
                                                <option value="Telangana"
                                                    {{ old('state', $defaultAddress->state ?? '') == 'Telangana' ? 'selected' : '' }}>
                                                    Telangana
                                                </option>
                                                <option value="Tripura"
                                                    {{ old('state', $defaultAddress->state ?? '') == 'Tripura' ? 'selected' : '' }}>
                                                    Tripura
                                                </option>
                                                <option value="Uttar Pradesh"
                                                    {{ old('state', $defaultAddress->state ?? '') == 'Uttar Pradesh' ? 'selected' : '' }}>
                                                    Uttar Pradesh
                                                </option>
                                                <option value="Uttarakhand"
                                                    {{ old('state', $defaultAddress->state ?? '') == 'Uttarakhand' ? 'selected' : '' }}>
                                                    Uttarakhand
                                                </option>
                                                <option value="West Bengal"
                                                    {{ old('state', $defaultAddress->state ?? '') == 'West Bengal' ? 'selected' : '' }}>
                                                    West Bengal
                                                </option>
                                            </select>
                                            @error('state')
                                            <div class="text-danger transform-none"><span>{{ $message }}</span></div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">

                                            <input type="text" class="form-control py-2 custom-card-bg @error('pin_code') is-invalid @enderror"
                                                placeholder="PIN Code *" name="pin_code" id="pincode"
                                                value="{{ old('pin_code', $defaultAddress->pin_code ?? '') }}"
                                                maxlength="6" pattern="\d{6}"
                                                title="Please enter a valid 6-digit PIN code">
                                            <small id="pincode-message" class="text-danger d-block mt-1"
                                                style="display:none;"></small>

                                            @error('pin_code')
                                               <div class="text-danger transform-none"><span>{{ $message }}</span></div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <input type="number" class="form-control py-2 custom-card-bg @error('phone') is-invalid @enderror"
                                                placeholder="Phone *" name="phone"
                                                value="{{ old('phone', Auth::user()->phone ?? '') }}">
                                            @error('phone')
                                               <div class="text-danger transform-none"><span>{{ $message }}</span></div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group mb-3">
                                            <select class="form-control py-2 custom-card-bg @error('payment_method') is-invalid @enderror" name="payment_method"
                                                >
                                                <option value="" selected disabled>Payment Method &#11206;</option>
                                                <option value="COD"
                                                    {{ old('payment_method') == 'COD' ? 'selected' : '' }}>COD
                                                </option>

                                                <option value="UPI"
                                                    {{ old('payment_method') == 'UPI' ? 'selected' : '' }}>UPI
                                                </option>
                                            </select>
                                            @error('payment_method')
                                               <div class="text-danger transform-none"><span>{{ $message }}</span></div>
                                            @enderror
                                            @if (session('error'))
                                                <p class="text-danger">
                                                    {{ session('error') }}
                                                </p>
                                            @endif
                                        </div>


                                    </div>

                                    <div class="col-12 text-end py-3">
                                        @if ($cart->isEmpty())
                                            <a href="{{ route('home') }}" class="checkout_btn w-100 link-normal">Continue
                                                Shopping</a>
                                        @else
                                            <button type="submit" class="checkout_btn w-100" id="checkpout" disabled>Buy
                                                Now</button>
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
