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

                            @if (session()->has('buy_now'))
                                @php
                                    $buyNow = session()->get('buy_now');
                                @endphp
                                <div class="d-flex align-items-center mb-3 border-bottom pb-3">
                                    <div class="position-relative">
                                        <img src="{{ $buyNow['img'] }}" alt="Product" class="img-thumbnail mr-3"
                                            style="width: 70px; height: 70px;">
                                        <span
                                            class="position-absolute top-0 start-100 translate-middle badge rounded-pill primary-bg">
                                            1
                                        </span>
                                    </div>
                                    <div class="d-flex justify-content-between w-100 ms-2">
                                        <div>
                                            <h6 class="mb-1 fw-bold check_title">{{ $buyNow['name'] }}</h6>
                                            <p class="mb-0 check_desc">
                                                Size: {{ $buyNow['size'] }} | Color: &nbsp;

                                                <span class="color-circle checkout-color"
                                                    style="background-color: {{ $buyNow['color'] ?? '#ffffff' }};"></span>

                                            </p>
                                        </div>
                                        <div class="ml-auto">
                                            <h6>₹{{ number_format($buyNow['price'], 2) }}
                                            </h6>
                                        </div>
                                    </div>
                                </div>
                            @else
                                <p class="text-center text-muted">No items found in your cart.</p>
                            @endif
                            <!-- Repeat product items as needed -->
                        </div>
                    </div>
                    <!-- Discount Code -->
                    <div class="card custom-card-bg mb-4">
                        <div class="card-body">
                            <form>
                                <div class="form-group">
                                    <label for="discountCode" class="form-label">Discount Code</label>
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control text-normal py-2 custom-card-bg"
                                            placeholder="Discount Code" aria-label="Discount Code"
                                            aria-describedby="button-addon2">
                                        <button class="btn btn-outline-secondary py-2" type="button"
                                            id="button-addon2">Apply
                                            Code</button>
                                    </div>
                                </div>


                            </form>
                        </div>
                    </div>

                    <!-- Order Summary -->
                    <div class="card custom-card-bg">
                        <div class="card-body">
                            @php
                                $subtotal = $buyNow['price'];
                                $tax = $subtotal * 0.18; // GST 18%
                                $total = $subtotal + $tax;
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

                            <form method="post" action="{{ route('buy.now.store') }}">
                                @csrf
                                <input type="number" name="product_id" hidden value="{{ $buyNow['product_id'] }}">
                                <input type="number" name="product_quantity" hidden value="{{ $buyNow['quantity'] }}">
                                <input type="number" name="product_size" hidden value="{{ $buyNow['size'] }}">
                                <input type="text" name="product_color" hidden value="{{ $buyNow['color'] }}">

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
                                        value="{{ old('address', $buyNow['address']) }}" required>
                                    @error('address')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group mb-3">
                                    <input type="text" class="form-control py-2 custom-card-bg"
                                        placeholder="Address 2 (Optional)" name="address2" value="{{ old('address2', $buyNow['address2']) }}">
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <input type="text" class="form-control py-2 custom-card-bg" id="city"
                                                placeholder="City" name="city" value="{{ old('city', $buyNow['city']) }}" required>
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
                                                    {{ old('state', $buyNow['state']) == 'Andhra Pradesh' ? 'selected' : '' }}>Andhra Pradesh
                                                </option>
                                                <option value="Arunachal Pradesh"
                                                    {{ old('state', $buyNow['state']) == 'Arunachal Pradesh' ? 'selected' : '' }}>Arunachal
                                                    Pradesh</option>
                                                <option value="Assam" {{ old('state', $buyNow['state']) == 'Assam' ? 'selected' : '' }}>
                                                    Assam</option>
                                                <option value="Bihar" {{ old('state', $buyNow['state']) == 'Bihar' ? 'selected' : '' }}>
                                                    Bihar</option>
                                                <option value="Delhi" {{ old('state', $buyNow['state']) == 'Delhi' ? 'selected' : '' }}>
                                                    Delhi</option>
                                                <option value="Chhattisgarh"
                                                    {{ old('state', $buyNow['state']) == 'Chhattisgarh' ? 'selected' : '' }}>Chhattisgarh
                                                </option>
                                                <option value="Goa" {{ old('state', $buyNow['state']) == 'Goa' ? 'selected' : '' }}>Goa
                                                </option>
                                                <option value="Gujarat" {{ old('state', $buyNow['state']) == 'Gujarat' ? 'selected' : '' }}>
                                                    Gujarat</option>
                                                <option value="Haryana" {{ old('state', $buyNow['state']) == 'Haryana' ? 'selected' : '' }}>
                                                    Haryana</option>
                                                <option value="Himachal Pradesh"
                                                    {{ old('state', $buyNow['state']) == 'Himachal Pradesh' ? 'selected' : '' }}>Himachal
                                                    Pradesh</option>
                                                <option value="Jharkhand"
                                                    {{ old('state', $buyNow['state']) == 'Jharkhand' ? 'selected' : '' }}>Jharkhand</option>
                                                <option value="Karnataka"
                                                    {{ old('state', $buyNow['state']) == 'Karnataka' ? 'selected' : '' }}>Karnataka</option>
                                                <option value="Kerala" {{ old('state', $buyNow['state']) == 'Kerala' ? 'selected' : '' }}>
                                                    Kerala</option>
                                                <option value="Madhya Pradesh"
                                                    {{ old('state', $buyNow['state']) == 'Madhya Pradesh' ? 'selected' : '' }}>Madhya Pradesh
                                                </option>
                                                <option value="Maharashtra"
                                                    {{ old('state', $buyNow['state']) == 'Maharashtra' ? 'selected' : '' }}>Maharashtra
                                                </option>
                                                <option value="Manipur" {{ old('state', $buyNow['state']) == 'Manipur' ? 'selected' : '' }}>
                                                    Manipur</option>
                                                <option value="Meghalaya"
                                                    {{ old('state', $buyNow['state']) == 'Meghalaya' ? 'selected' : '' }}>Meghalaya</option>
                                                <option value="Mizoram" {{ old('state', $buyNow['state']) == 'Mizoram' ? 'selected' : '' }}>
                                                    Mizoram</option>
                                                <option value="Nagaland"
                                                    {{ old('state', $buyNow['state']) == 'Nagaland' ? 'selected' : '' }}>Nagaland</option>
                                                <option value="Odisha" {{ old('state', $buyNow['state']) == 'Odisha' ? 'selected' : '' }}>
                                                    Odisha</option>
                                                <option value="Punjab" {{ old('state', $buyNow['state']) == 'Punjab' ? 'selected' : '' }}>
                                                    Punjab</option>
                                                <option value="Rajasthan"
                                                    {{ old('state', $buyNow['state']) == 'Rajasthan' ? 'selected' : '' }}>Rajasthan</option>
                                                <option value="Sikkim" {{ old('state', $buyNow['state']) == 'Sikkim' ? 'selected' : '' }}>
                                                    Sikkim</option>
                                                <option value="Tamil Nadu"
                                                    {{ old('state', $buyNow['state']) == 'Tamil Nadu' ? 'selected' : '' }}>Tamil Nadu
                                                </option>
                                                <option value="Telangana"
                                                    {{ old('state', $buyNow['state']) == 'Telangana' ? 'selected' : '' }}>Telangana</option>
                                                <option value="Tripura" {{ old('state', $buyNow['state']) == 'Tripura' ? 'selected' : '' }}>
                                                    Tripura</option>
                                                <option value="Uttar Pradesh"
                                                    {{ old('state', $buyNow['state']) == 'Uttar Pradesh' ? 'selected' : '' }}>Uttar Pradesh
                                                </option>
                                                <option value="Uttarakhand"
                                                    {{ old('state', $buyNow['state']) == 'Uttarakhand' ? 'selected' : '' }}>Uttarakhand
                                                </option>
                                                <option value="West Bengal"
                                                    {{ old('state', $buyNow['state']) == 'West Bengal' ? 'selected' : '' }}>West Bengal
                                                </option>
                                            </select>
                                            @error('state', $buyNow['state'])
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <input type="text" class="form-control py-2 custom-card-bg"
                                                placeholder="PIN Code" name="pin_code" value="{{ old('pin_code', $buyNow['pin_code']) }}"
                                                required>
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

                                        @if (session()->has('buy_now'))
                                            <button type="submit" class="checkout_btn w-100">Buy Now</button>
                                        @else
                                            <a href="{{ route('home') }}" class="checkout_btn w-100 link-normal">Continue
                                                Shopping</a>
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
