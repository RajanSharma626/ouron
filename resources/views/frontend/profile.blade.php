@extends('frontend.layouts.app')

@section('title', 'Profile - Ouron')

@section('content')

    <section class="py-5">
        <div class="container">
            <div class="profile-container row py-5">
                <!-- Sidebar -->
                <div class="col-md-4">
                    <div class="list-group">
                        <a class="list-group-item list-group-item-action active" data-bs-toggle="tab"
                            href="#profileTab">Profile</a>
                        <a class="list-group-item list-group-item-action" data-bs-toggle="tab" href="#ordersTab">Order
                            History</a>
                        <a class="list-group-item list-group-item-action" data-bs-toggle="tab"
                            href="#addressesTab">Addresses</a>
                        <form action="{{ route('logout') }}" method="POST" class="mt-3">
                            @csrf
                            <button type="submit" class="btn btn-danger">Logout</button>
                        </form>
                    </div>
                </div>

                <!-- Right Content -->
                <div class="col-md-8">
                    <div class="tab-content">
                        <!-- Profile Tab -->
                        <div class="tab-pane fade show active" id="profileTab">
                            <h5 class="mb-4 fw-bold">Contact Detail</h5>
                            @if (session('success'))
                                <div class="alert alert-success">
                                    {{ session('success') }}
                                </div>
                            @endif
                            <form action="{{ route('profile.update') }}" method="POST">
                                @csrf
                                <div class="mb-3">
                                    <label for="name" class="form-label">Name</label>
                                    <input type="text" name="name" class="form-control"
                                        value="{{ old('name', auth()->user()->name) }}" disabled>
                                    @error('name')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" name="email" class="form-control"
                                        value="{{ old('email', auth()->user()->email) }}" disabled>
                                    @error('email')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="phone" class="form-label">Phone No</label>
                                    <input type="text" name="phone" class="form-control"
                                        value="{{ old('phone', auth()->user()->phone) }}" disabled>
                                    @error('phone')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3 text-end">
                                    <button id="editBtn" type="button" class="btn primary-bg">Edit Detail</button>
                                    <button id="saveBtn" type="submit" class="btn primary-bg d-none">Save Detail</button>
                                </div>
                            </form>
                        </div>

                        <!-- Orders Tab -->
                        <div class="tab-pane fade" id="ordersTab">
                            <div class="container">
                                <h5 class="mb-4 fw-bold">Order History</h5>
                                <div class="row">
                                    <div class="col-12 mx-auto">
                                        <div class="card custom-card-bg mb-4 check_product">
                                            <div class="card-body">
                                                <div class="d-flex align-items-center mb-3 border-bottom pb-3">
                                                    <div class="position-relative">
                                                        <img src="https://cdn.shopify.com/s/files/1/0514/9494/4962/files/View_recent_photos_128x128.jpg?v=1741692749"
                                                            alt="Product" class="img-thumbnail"
                                                            style="width: 80px; height: 80px;">
                                                    </div>
                                                    <div class="d-flex justify-content-between w-100 ms-3">
                                                        <div>
                                                            <h5 class="mb-0 fw-bold check_title">Product Title</h5>
                                                            <p class="mb-1 check_title">Order #12345</p>
                                                            <p class="mb-0 check_desc">Purchase Date: 12 Mar 2025</p>
                                                        </div>
                                                        <div class="text-end">
                                                            <h6 class="mb-1">Total: ₹9,990</h6>
                                                            <span class="badge bg-success">Completed</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="d-flex align-items-center mb-3 border-bottom pb-3">
                                                    <div class="position-relative">
                                                        <img src="https://cdn.shopify.com/s/files/1/0514/9494/4962/files/View_recent_photos_128x128.jpg?v=1741692749"
                                                            alt="Product" class="img-thumbnail"
                                                            style="width: 80px; height: 80px;">
                                                    </div>
                                                    <div class="d-flex justify-content-between w-100 ms-3">
                                                        <div>
                                                            <h5 class="mb-0 fw-bold check_title">Product Title</h5>
                                                            <p class="mb-1 check_title">Order #12345</p>
                                                            <p class="mb-0 check_desc">Purchase Date: 12 Mar 2025</p>
                                                        </div>
                                                        <div class="text-end">
                                                            <h6 class="mb-1">Total: ₹9,990</h6>
                                                            <span class="badge bg-success">Completed</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="d-flex align-items-center mb-3 border-bottom pb-3">
                                                    <div class="position-relative">
                                                        <img src="https://cdn.shopify.com/s/files/1/0514/9494/4962/files/View_recent_photos_128x128.jpg?v=1741692749"
                                                            alt="Product" class="img-thumbnail"
                                                            style="width: 80px; height: 80px;">
                                                    </div>
                                                    <div class="d-flex justify-content-between w-100 ms-3">
                                                        <div>
                                                            <h5 class="mb-0 fw-bold check_title">Product Title</h5>
                                                            <p class="mb-1 check_title">Order #12345</p>
                                                            <p class="mb-0 check_desc">Purchase Date: 12 Mar 2025</p>
                                                        </div>
                                                        <div class="text-end">
                                                            <h6 class="mb-1">Total: ₹9,990</h6>
                                                            <span class="badge bg-success">Completed</span>
                                                        </div>
                                                    </div>
                                                </div>



                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>

                        </div>


                        <!-- Addresses Tab -->
                        <div class="tab-pane fade" id="addressesTab">
                            <h5 class="mb-4 fw-bold">Your Addresses</h5>
                            <button class="btn btn-dark mb-3" data-bs-toggle="collapse" data-bs-target="#addAddressForm">
                                Add New Address
                            </button>
                            <div class="collapse mb-4" id="addAddressForm">
                                <div class="card card-body">
                                    <form method="POST" action="">
                                        @csrf
                                        <div class="mb-3">
                                            <label for="address" class="form-label">Address</label>
                                            <textarea name="address" id="address" class="form-control" rows="3"></textarea>
                                        </div>
                                        <div class="form-check mb-3">
                                            <input type="checkbox" class="form-check-input" id="primary"
                                                name="primary">
                                            <label class="form-check-label" for="primary">Set as primary address</label>
                                        </div>
                                        <button type="submit" class="btn btn-success">Save Address</button>
                                    </form>
                                </div>
                            </div>
                            <ul class="list-group">
                                {{-- @foreach ($addresses as $address) --}}
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    123 Street, City, Country
                                    <span class="badge bg-primary">Primary</span>
                                </li>
                                {{-- @endforeach --}}
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
