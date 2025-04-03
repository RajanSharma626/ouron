@extends('frontend.layouts.app')

@section('title', 'Profile - Ouron')

@section('content')

    <section class="py-5">
        <div class="container">
            <div class="profile-container row py-5">
                <!-- Sidebar -->
                <div class="col-md-4">
                    <div class="list-group">
                        <a class="list-group-item list-group-item-action {{ session('activeTab', 'profileTab') == 'profileTab' ? 'active' : '' }}"
                            data-bs-toggle="tab" href="#profileTab">Profile</a>
                        <a class="list-group-item list-group-item-action {{ session('activeTab') == 'ordersTab' ? 'active' : '' }}"
                            data-bs-toggle="tab" href="#ordersTab">Order
                            History</a>
                        <a class="list-group-item list-group-item-action {{ session('activeTab') == 'addressesTab' ? 'active' : '' }}"
                            data-bs-toggle="tab" href="#addressesTab">Addresses</a>
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
                        <div class="tab-pane fade {{ session('activeTab', 'profileTab') == 'profileTab' ? 'show active' : '' }}"
                            id="profileTab">
                            <h5 class="mb-4 fw-bold">Contact Detail</h5>
                            @if (session('success'))
                                <div class="alert alert-success">
                                    {{ session('success') }}
                                </div>
                            @endif
                            <form action="{{ route('profile.update') }}" method="POST">
                                @csrf
                                <input type="hidden" name="activeTab" value="profileTab">
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
                        <div class="tab-pane fade {{ session('activeTab') == 'ordersTab' ? 'show active' : '' }}"
                            id="ordersTab">
                            <div class="container">
                                <h5 class="mb-4 fw-bold">Order History</h5>

                                @if ($orders->isEmpty())
                                    <div class="alert alert-warning">No orders found.</div>
                                @else
                                    <div class="row">
                                        @foreach ($orders as $order)
                                            <div class="col-12">
                                                <div class="card mb-3">
                                                    <div class="row g-0">
                                                        <div class="col-md-3">
                                                            <img src="{{ $order->items->first()->product->firstimage->img }}"
                                                                class="img-fluid rounded-start" alt="Product Image">
                                                        </div>
                                                        <div class="col-md-9">
                                                            <div class="card-body">
                                                                <h5 class="card-title">Order #{{ $order->id }}
                                                                </h5>
                                                                <p class="card-text mb-0"><strong>Date:</strong>
                                                                    {{ $order->created_at->format('d M Y, h:i A') }}</p>
                                                                <p class="card-text mb-0"><strong>Total Amount:</strong>
                                                                    ₹{{ number_format($order->total, 2) }}</p>
                                                                <p class="card-text"><strong>Status:</strong>
                                                                    <span
                                                                        class="text-{{ $order->status == 'Completed' ? 'success' : 'warning' }}">
                                                                        {{ ucfirst($order->status) }}
                                                                    </span>
                                                                </p>
                                                                <p class="card-text">
                                                                    <a href="{{ route('orders.show', $order->id) }}"
                                                                        class="btn primary-bg btn-sm">
                                                                        View Details
                                                                    </a>
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>


                                            </div>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                        </div>

                        <!-- Addresses Tab -->


                        <div class="tab-pane fade {{ session('activeTab') == 'addressesTab' ? 'show active' : '' }}"
                            id="addressesTab">
                            <h5 class="mb-4 fw-bold">Your Addresses</h5>

                            @if (session('address-success'))
                                <div class="alert alert-success">{{ session('address-success') }}</div>
                            @endif

                            <!-- Add Address Form -->
                            <button class="btn btn-dark mb-3" data-bs-toggle="collapse" data-bs-target="#addAddressForm">
                                Add New Address
                            </button>

                            <div class="collapse mb-4" id="addAddressForm">
                                <div class="card card-body">
                                    <form method="POST" action="{{ route('addresses.store') }}">
                                        @csrf
                                        <div class="mb-3">
                                            <label for="address" class="form-label">Address</label>
                                            <textarea name="address" id="address" class="form-control" rows="3" required></textarea>
                                            @error('address')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <label for="address_2" class="form-label">Address 2 (Optional)</label>
                                            <input type="text" name="address_2" id="address_2" class="form-control">
                                        </div>

                                        <div class="mb-3">
                                            <label for="city" class="form-label">City</label>
                                            <input type="text" name="city" id="city" class="form-control"
                                                required>
                                            @error('city')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <label for="state" class="form-label">State</label>
                                            <select id="state" class="form-control py-2" name="state" required>
                                                <option value="">Select State</option>
                                                <option value="Delhi">Delhi</option>
                                                <option value="Maharashtra">Maharashtra</option>
                                                <option value="Karnataka">Karnataka</option>
                                                <option value="Tamil Nadu">Tamil Nadu</option>
                                                <option value="Uttar Pradesh">Uttar Pradesh</option>
                                                <option value="West Bengal">West Bengal</option>
                                                <!-- Add remaining states -->
                                            </select>
                                            @error('state')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <label for="pin_code" class="form-label">Pin Code</label>
                                            <input type="text" name="pin_code" id="pin_code" class="form-control"
                                                required>
                                            @error('pin_code')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
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

                            <!-- Display Default Address -->
                            <h6 class="mt-4">Default Address:</h6>
                            @if ($defaultAddress)
                                <div class="alert alert-primary">
                                    <strong>{{ $defaultAddress->address }}</strong><br>
                                    {{ $defaultAddress->address_2 ? $defaultAddress->address_2 . ', ' : '' }}
                                    {{ $defaultAddress->city }}, {{ $defaultAddress->state }},
                                    {{ $defaultAddress->pin_code }}
                                </div>
                            @else
                                <div class="alert alert-warning">No default address set.</div>
                            @endif

                            <!-- Display Other Addresses -->
                            <h6 class="mt-4">Other Addresses:</h6>
                            <ul class="list-group">
                                @foreach ($addresses as $address)
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <div>
                                            {{ $address->address }},
                                            {{ $address->address_2 ? $address->address_2 . ', ' : '' }}
                                            {{ $address->city }}, {{ $address->state }}, {{ $address->pin_code }}
                                        </div>
                                        <div>
                                            @if (!$address->default_address)
                                                <form action="{{ route('addresses.setDefault', $address->id) }}"
                                                    method="POST" class="d-inline">
                                                    @csrf
                                                    @method('PATCH')
                                                    <button class="btn btn-sm btn-primary">Set as Default</button>
                                                </form>
                                            @endif
                                            <form action="{{ route('addresses.destroy', $address->id) }}" method="POST"
                                                class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-sm btn-danger">Delete</button>
                                            </form>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        </div>
    </section>

@endsection
