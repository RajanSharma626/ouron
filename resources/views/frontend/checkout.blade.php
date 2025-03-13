@extends('frontend.layouts.app')

@section('title', 'Checkout - Ouron')

@section('content')

    <section class="product_detail py-5">
        <div class="container py-5">
            <div class="row">
                <div class="col-md-6">
                    <!-- Product List -->
                    <div class="card mb-4 check_product">
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
                    <div class="card mb-4">
                        <div class="card-body">
                            <form>
                                <div class="form-group">
                                    <label for="discountCode" class="form-label">Discount Code</label>
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control text-normal py-2"
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
                    <div class="card">
                        <div class="card-body">
                            <ul class="list-group mb-3">
                                <li class="list-group-item d-flex justify-content-between">
                                    <span>Subtotal</span>
                                    <strong>₹100.00</strong>
                                </li>
                                <li class="list-group-item d-flex justify-content-between">
                                    <span>Tax</span>
                                    <strong>₹10.00</strong>
                                </li>
                                <li class="list-group-item d-flex justify-content-between">
                                    <span>Total</span>
                                    <strong>₹110.00</strong>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <!-- Checkout Form -->
                    <div class="card">
                        <div class="card-body">
                            <h4 class="mb-4">Address Detail</h4>
                            <form>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            {{-- <label for="fullName" class="form-label">First Name</label> --}}
                                            <input type="text" class="form-control py-2" id="fullName"
                                                placeholder="First name">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            {{-- <label for="fullName" class="form-label">LAst Name</label> --}}
                                            <input type="text" class="form-control py-2" placeholder="Last name">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group mb-3">
                                    {{-- <label for="emailAddress">Email Address</label> --}}
                                    <input type="email" class="form-control py-2" id="emailAddress"
                                        placeholder="Enter email">
                                </div>
                                <div class="form-group mb-3">
                                    {{-- <label for="address">Address</label> --}}
                                    <input type="text" class="form-control" id="address"
                                        placeholder="Flat / House No. / Floor / Building">
                                </div>
                                <div class="form-group mb-3">
                                    {{-- <label for="address">Address</label> --}}
                                    <input type="text" class="form-control" id="address"
                                        placeholder="Address 2 (Optional)">
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            {{-- <label for="city">City</label> --}}
                                            <input type="text" class="form-control py-2" id="city"
                                                placeholder="City">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            {{-- <label for="state">State</label> --}}
                                            <select id="state" class="form-control py-2">
                                                <option value="">Select State</option>
                                                <option value="Andhra Pradesh">Andhra Pradesh</option>
                                                <option value="Arunachal Pradesh">Arunachal Pradesh</option>
                                                <option value="Assam">Assam</option>
                                                <option value="Bihar">Bihar</option>
                                                <option value="Chhattisgarh">Chhattisgarh</option>
                                                <option value="Goa">Goa</option>
                                                <option value="Gujarat">Gujarat</option>
                                                <option value="Haryana">Haryana</option>
                                                <option value="Himachal Pradesh">Himachal Pradesh</option>
                                                <option value="Jharkhand">Jharkhand</option>
                                                <option value="Karnataka">Karnataka</option>
                                                <option value="Kerala">Kerala</option>
                                                <option value="Madhya Pradesh">Madhya Pradesh</option>
                                                <option value="Maharashtra">Maharashtra</option>
                                                <option value="Manipur">Manipur</option>
                                                <option value="Meghalaya">Meghalaya</option>
                                                <option value="Mizoram">Mizoram</option>
                                                <option value="Nagaland">Nagaland</option>
                                                <option value="Odisha">Odisha</option>
                                                <option value="Punjab">Punjab</option>
                                                <option value="Rajasthan">Rajasthan</option>
                                                <option value="Sikkim">Sikkim</option>
                                                <option value="Tamil Nadu">Tamil Nadu</option>
                                                <option value="Telangana">Telangana</option>
                                                <option value="Tripura">Tripura</option>
                                                <option value="Uttar Pradesh">Uttar Pradesh</option>
                                                <option value="Uttarakhand">Uttarakhand</option>
                                                <option value="West Bengal">West Bengal</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            {{-- <label for="postalCode">Pin Code</label> --}}
                                            <input type="text" class="form-control" id="postalCode"
                                                placeholder="PIN Code">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            {{-- <label for="postalCode">Pin Code</label> --}}
                                            <input type="text" class="form-control" id="postalCode"
                                                placeholder="Phone">
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
