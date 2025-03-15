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
                            <div class="d-flex align-items-center mb-3 border-bottom pb-3">
                                <div class="position-relative">
                                    <img src="https://cdn.shopify.com/s/files/1/0514/9494/4962/files/View_recent_photos_128x128.jpg?v=1741692749"
                                        alt="Product" class="img-thumbnail mr-3" style="width: 70px; height: 70px;">
                                    <span
                                        class="position-absolute top-0 start-100 translate-middle badge rounded-pill primary-bg">
                                        2
                                    </span>
                                </div>
                                <div class="d-flex justify-content-between w-100 ms-2">

                                    <div>
                                        <h6 class="mb-1 fw-bold check_title">Product Title </h6>
                                        <p class="mb-0 check_desc">Size: M | Color: Blue</p>
                                    </div>
                                    <div class="ml-auto">
                                        <h6>₹50.00</h6>
                                    </div>
                                </div>
                            </div>
                            <!-- Repeat product items as needed -->
                            <div class="d-flex align-items-center mb-3 border-bottom pb-3">
                                <div class="position-relative">
                                    <img src="https://cdn.shopify.com/s/files/1/0514/9494/4962/files/View_recent_photos_128x128.jpg?v=1741692749"
                                        alt="Product" class="img-thumbnail mr-3" style="width: 70px; height: 70px;">
                                    <span
                                        class="position-absolute top-0 start-100 translate-middle badge rounded-pill primary-bg">
                                        2
                                    </span>
                                </div>
                                <div class="d-flex justify-content-between w-100 ms-2">

                                    <div>
                                        <h6 class="mb-1 fw-bold check_title">Product Title</h6>
                                        <p class="mb-0 check_desc">Size: M | Color: Blue</p>
                                    </div>
                                    <div class="ml-auto">
                                        <h6>₹50.00</h6>
                                    </div>
                                </div>
                            </div>
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
                            <ul class="list-group mb-3 ">
                                <li class="list-group-item d-flex justify-content-between custom-card-bg">
                                    <span>Subtotal</span>
                                    <strong>₹100.00</strong>
                                </li>
                                <li class="list-group-item d-flex justify-content-between custom-card-bg">
                                    <span>Tax</span>
                                    <strong>₹10.00</strong>
                                </li>
                                <li class="list-group-item d-flex justify-content-between custom-card-bg">
                                    <span>Total</span>
                                    <strong>₹110.00</strong>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <!-- Checkout Form -->
                    <div class="card custom-card-bg">
                        <div class="card-body">
                            <h4 class="mb-4">Address Detail</h4>

                            <form method="post" action="{{route('checkout.store')}}">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <input type="text" class="form-control py-2 custom-card-bg" name="first_name"
                                                placeholder="First name" value="{{ old('first_name') }}" required>
                                            @error('first_name')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <input type="text" class="form-control py-2 custom-card-bg"
                                                placeholder="Last name" name="last_name" value="{{ old('last_name') }}"
                                                required>
                                            @error('last_name')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group mb-3">
                                    <input type="email" class="form-control py-2 custom-card-bg" name="email"
                                        id="emailAddress" placeholder="Enter email" value="{{ old('email') }}">
                                    @error('email')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group mb-3">
                                    <input type="text" class="form-control py-2 custom-card-bg"
                                        placeholder="Flat / House No. / Floor / Building" name="address"
                                        value="{{ old('address') }}" required>
                                    @error('address')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group mb-3">
                                    <input type="text" class="form-control py-2 custom-card-bg"
                                        placeholder="Address 2 (Optional)" name="address2" value="{{ old('address2') }}">
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <input type="text" class="form-control py-2 custom-card-bg" id="city"
                                                placeholder="City" name="city" value="{{ old('city') }}" required>
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
                                                    {{ old('state') == 'Andhra Pradesh' ? 'selected' : '' }}>Andhra Pradesh
                                                </option>
                                                <option value="Arunachal Pradesh"
                                                    {{ old('state') == 'Arunachal Pradesh' ? 'selected' : '' }}>Arunachal
                                                    Pradesh</option>
                                                <option value="Assam" {{ old('state') == 'Assam' ? 'selected' : '' }}>
                                                    Assam</option>
                                                <option value="Bihar" {{ old('state') == 'Bihar' ? 'selected' : '' }}>
                                                    Bihar</option>
                                                <option value="Delhi" {{ old('state') == 'Delhi' ? 'selected' : '' }}>
                                                    Delhi</option>
                                                <option value="Chhattisgarh"
                                                    {{ old('state') == 'Chhattisgarh' ? 'selected' : '' }}>Chhattisgarh
                                                </option>
                                                <option value="Goa" {{ old('state') == 'Goa' ? 'selected' : '' }}>Goa
                                                </option>
                                                <option value="Gujarat" {{ old('state') == 'Gujarat' ? 'selected' : '' }}>
                                                    Gujarat</option>
                                                <option value="Haryana" {{ old('state') == 'Haryana' ? 'selected' : '' }}>
                                                    Haryana</option>
                                                <option value="Himachal Pradesh"
                                                    {{ old('state') == 'Himachal Pradesh' ? 'selected' : '' }}>Himachal
                                                    Pradesh</option>
                                                <option value="Jharkhand"
                                                    {{ old('state') == 'Jharkhand' ? 'selected' : '' }}>Jharkhand</option>
                                                <option value="Karnataka"
                                                    {{ old('state') == 'Karnataka' ? 'selected' : '' }}>Karnataka</option>
                                                <option value="Kerala" {{ old('state') == 'Kerala' ? 'selected' : '' }}>
                                                    Kerala</option>
                                                <option value="Madhya Pradesh"
                                                    {{ old('state') == 'Madhya Pradesh' ? 'selected' : '' }}>Madhya Pradesh
                                                </option>
                                                <option value="Maharashtra"
                                                    {{ old('state') == 'Maharashtra' ? 'selected' : '' }}>Maharashtra
                                                </option>
                                                <option value="Manipur" {{ old('state') == 'Manipur' ? 'selected' : '' }}>
                                                    Manipur</option>
                                                <option value="Meghalaya"
                                                    {{ old('state') == 'Meghalaya' ? 'selected' : '' }}>Meghalaya</option>
                                                <option value="Mizoram" {{ old('state') == 'Mizoram' ? 'selected' : '' }}>
                                                    Mizoram</option>
                                                <option value="Nagaland"
                                                    {{ old('state') == 'Nagaland' ? 'selected' : '' }}>Nagaland</option>
                                                <option value="Odisha" {{ old('state') == 'Odisha' ? 'selected' : '' }}>
                                                    Odisha</option>
                                                <option value="Punjab" {{ old('state') == 'Punjab' ? 'selected' : '' }}>
                                                    Punjab</option>
                                                <option value="Rajasthan"
                                                    {{ old('state') == 'Rajasthan' ? 'selected' : '' }}>Rajasthan</option>
                                                <option value="Sikkim" {{ old('state') == 'Sikkim' ? 'selected' : '' }}>
                                                    Sikkim</option>
                                                <option value="Tamil Nadu"
                                                    {{ old('state') == 'Tamil Nadu' ? 'selected' : '' }}>Tamil Nadu
                                                </option>
                                                <option value="Telangana"
                                                    {{ old('state') == 'Telangana' ? 'selected' : '' }}>Telangana</option>
                                                <option value="Tripura" {{ old('state') == 'Tripura' ? 'selected' : '' }}>
                                                    Tripura</option>
                                                <option value="Uttar Pradesh"
                                                    {{ old('state') == 'Uttar Pradesh' ? 'selected' : '' }}>Uttar Pradesh
                                                </option>
                                                <option value="Uttarakhand"
                                                    {{ old('state') == 'Uttarakhand' ? 'selected' : '' }}>Uttarakhand
                                                </option>
                                                <option value="West Bengal"
                                                    {{ old('state') == 'West Bengal' ? 'selected' : '' }}>West Bengal
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
                                                placeholder="PIN Code" name="pin_code" value="{{ old('pin_code') }}"
                                                required>
                                            @error('pin_code')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <input type="text" class="form-control py-2 custom-card-bg"
                                                placeholder="Phone" name="phone" value="{{ old('phone') }}" required>
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
                                </div>


                                <button type="submit" class="checkout_btn w-100">Buy Now</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
