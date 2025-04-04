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
                                        <span>Discount Coupon : <small class="text-secondory">
                                                <s>{{ $discount['coupon_code'] }}</s></small></span>
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
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <input type="text" class="form-control py-2 custom-card-bg" name="first_name"
                                                placeholder="First name"
                                                value="{{ old('first_name', Auth::user()->name ?? '') }}" required>
                                            @error('first_name')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <input type="text" class="form-control py-2 custom-card-bg"
                                                placeholder="Last name" name="last_name" value="{{ old('last_name') }}">
                                            @error('last_name')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group mb-3">
                                    <input type="email" class="form-control py-2 custom-card-bg" name="email"
                                        id="emailAddress" placeholder="Enter email"
                                        value="{{ old('email', Auth::user()->email ?? '') }}" required>
                                    @error('email')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group mb-3">
                                    <input type="text" class="form-control py-2 custom-card-bg"
                                        placeholder="Flat / House No. / Floor / Building" name="address"
                                        value="{{ old('address', $defaultAddress->address) }}" required>
                                    @error('address')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group mb-3">
                                    <input type="text" class="form-control py-2 custom-card-bg"
                                        placeholder="Address 2 (Optional)" name="address2"
                                        value="{{ old('address2', $defaultAddress->address_2) }}">
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <input type="text" class="form-control py-2 custom-card-bg" id="city"
                                                placeholder="City" name="city"
                                                value="{{ old('city', $defaultAddress->city) }}" required>
                                            @error('city')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <select id="state" class="form-control py-2 custom-card-bg"
                                                name="state" required>
                                                <option value="">Select State</option>
                                                <option value="Andhra Pradesh"
                                                    {{ old('state', $defaultAddress->state) == 'Andhra Pradesh' ? 'selected' : '' }}>
                                                    Andhra Pradesh
                                                </option>
                                                <option value="Arunachal Pradesh"
                                                    {{ old('state', $defaultAddress->state) == 'Arunachal Pradesh' ? 'selected' : '' }}>
                                                    Arunachal
                                                    Pradesh</option>
                                                <option value="Assam"
                                                    {{ old('state', $defaultAddress->state) == 'Assam' ? 'selected' : '' }}>
                                                    Assam</option>
                                                <option value="Bihar"
                                                    {{ old('state', $defaultAddress->state) == 'Bihar' ? 'selected' : '' }}>
                                                    Bihar</option>
                                                <option value="Delhi"
                                                    {{ old('state', $defaultAddress->state) == 'Delhi' ? 'selected' : '' }}>
                                                    Delhi</option>
                                                <option value="Chhattisgarh"
                                                    {{ old('state', $defaultAddress->state) == 'Chhattisgarh' ? 'selected' : '' }}>
                                                    Chhattisgarh
                                                </option>
                                                <option value="Goa"
                                                    {{ old('state', $defaultAddress->state) == 'Goa' ? 'selected' : '' }}>
                                                    Goa
                                                </option>
                                                <option value="Gujarat"
                                                    {{ old('state', $defaultAddress->state) == 'Gujarat' ? 'selected' : '' }}>
                                                    Gujarat</option>
                                                <option value="Haryana"
                                                    {{ old('state', $defaultAddress->state) == 'Haryana' ? 'selected' : '' }}>
                                                    Haryana</option>
                                                <option value="Himachal Pradesh"
                                                    {{ old('state', $defaultAddress->state) == 'Himachal Pradesh' ? 'selected' : '' }}>
                                                    Himachal
                                                    Pradesh</option>
                                                <option value="Jharkhand"
                                                    {{ old('state', $defaultAddress->state) == 'Jharkhand' ? 'selected' : '' }}>
                                                    Jharkhand</option>
                                                <option value="Karnataka"
                                                    {{ old('state', $defaultAddress->state) == 'Karnataka' ? 'selected' : '' }}>
                                                    Karnataka</option>
                                                <option value="Kerala"
                                                    {{ old('state', $defaultAddress->state) == 'Kerala' ? 'selected' : '' }}>
                                                    Kerala</option>
                                                <option value="Madhya Pradesh"
                                                    {{ old('state', $defaultAddress->state) == 'Madhya Pradesh' ? 'selected' : '' }}>
                                                    Madhya Pradesh
                                                </option>
                                                <option value="Maharashtra"
                                                    {{ old('state', $defaultAddress->state) == 'Maharashtra' ? 'selected' : '' }}>
                                                    Maharashtra
                                                </option>
                                                <option value="Manipur"
                                                    {{ old('state', $defaultAddress->state) == 'Manipur' ? 'selected' : '' }}>
                                                    Manipur</option>
                                                <option value="Meghalaya"
                                                    {{ old('state', $defaultAddress->state) == 'Meghalaya' ? 'selected' : '' }}>
                                                    Meghalaya</option>
                                                <option value="Mizoram"
                                                    {{ old('state', $defaultAddress->state) == 'Mizoram' ? 'selected' : '' }}>
                                                    Mizoram</option>
                                                <option value="Nagaland"
                                                    {{ old('state', $defaultAddress->state) == 'Nagaland' ? 'selected' : '' }}>
                                                    Nagaland</option>
                                                <option value="Odisha"
                                                    {{ old('state', $defaultAddress->state) == 'Odisha' ? 'selected' : '' }}>
                                                    Odisha</option>
                                                <option value="Punjab"
                                                    {{ old('state', $defaultAddress->state) == 'Punjab' ? 'selected' : '' }}>
                                                    Punjab</option>
                                                <option value="Rajasthan"
                                                    {{ old('state', $defaultAddress->state) == 'Rajasthan' ? 'selected' : '' }}>
                                                    Rajasthan</option>
                                                <option value="Sikkim"
                                                    {{ old('state', $defaultAddress->state) == 'Sikkim' ? 'selected' : '' }}>
                                                    Sikkim</option>
                                                <option value="Tamil Nadu"
                                                    {{ old('state', $defaultAddress->state) == 'Tamil Nadu' ? 'selected' : '' }}>
                                                    Tamil Nadu
                                                </option>
                                                <option value="Telangana"
                                                    {{ old('state', $defaultAddress->state) == 'Telangana' ? 'selected' : '' }}>
                                                    Telangana</option>
                                                <option value="Tripura"
                                                    {{ old('state', $defaultAddress->state) == 'Tripura' ? 'selected' : '' }}>
                                                    Tripura</option>
                                                <option value="Uttar Pradesh"
                                                    {{ old('state', $defaultAddress->state) == 'Uttar Pradesh' ? 'selected' : '' }}>
                                                    Uttar Pradesh
                                                </option>
                                                <option value="Uttarakhand"
                                                    {{ old('state', $defaultAddress->state) == 'Uttarakhand' ? 'selected' : '' }}>
                                                    Uttarakhand
                                                </option>
                                                <option value="West Bengal"
                                                    {{ old('state', $defaultAddress->state) == 'West Bengal' ? 'selected' : '' }}>
                                                    West Bengal
                                                </option>
                                            </select>
                                            @error('state')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <input type="text" class="form-control py-2 custom-card-bg"
                                                placeholder="PIN Code" name="pin_code"
                                                value="{{ old('pin_code', $defaultAddress->pin_code) }}" required>
                                            @error('pin_code')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <input type="text" class="form-control py-2 custom-card-bg"
                                                placeholder="Phone" name="phone"
                                                value="{{ old('phone', Auth::user()->phone ?? '') }}" required>
                                            @error('phone')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group mb-3">
                                            <select class="form-control py-2 custom-card-bg" name="payment_method"
                                                required>
                                                <option value="" selected disabled>Payment Method</option>
                                                <option value="COD"
                                                    {{ old('payment_method') == 'COD' ? 'selected' : '' }}>COD
                                                </option>

                                                <option value="UPI"
                                                    {{ old('payment_method') == 'UPI' ? 'selected' : '' }}>UPI
                                                </option>
                                            </select>
                                            @error('payment_method')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-12 text-end py-3">
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
