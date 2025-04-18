@extends('frontend.layouts.app')

@section('title', 'Profile - Ouron')

@section('content')

    <section class="py-5">
        <div class="container">
            <div class="profile-container row py-5">
                <!-- Sidebar -->
                <div class="col-md-4 col-12 mb-3">
                    <div class="list-group">
                        <a class="list-group-item list-group-item-action {{ session('activeTab', 'profileTab') == 'profileTab' ? 'active' : '' }}"
                            data-bs-toggle="tab" href="#profileTab">Profile</a>
                        <a class="list-group-item list-group-item-action {{ session('activeTab') == 'ordersTab' ? 'active' : '' }}"
                            data-bs-toggle="tab" href="#ordersTab">Order
                            History</a>
                        <a class="list-group-item list-group-item-action {{ session('activeTab') == 'addressesTab' ? 'active' : '' }}"
                            data-bs-toggle="tab" href="#addressesTab">Addresses</a>
                        <form action="{{ route('logout') }}" method="POST" class="mt-3 d-none d-md-block">
                            @csrf
                            <button type="submit" class="btn btn-danger" id="logoutBtn2" style="background: #FAA0A0;color:black; border: #FAA0A0;">Logout</button>
                        </form>
                    </div>
                </div>

                <!-- Right Content -->
                <div class="col-md-8 col-12">
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
                                    <label for="name" class="form-label fw-bold">Name</label>
                                    <input type="text" name="name" class="form-control"
                                        value="{{ old('name', auth()->user()->name) }}"
                                        @if (!$errors->any()) disabled @endif>
                                    @error('name')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="email" class="form-label fw-bold">Email</label>
                                    <input type="email" name="email" class="form-control"
                                        value="{{ old('email', auth()->user()->email) }}"
                                        @if (!$errors->any()) disabled @endif>
                                    @error('email')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="phone" class="form-label fw-bold">Phone No</label>
                                    <input type="number" name="phone" class="form-control"
                                        value="{{ old('phone', auth()->user()->phone) }}"
                                        @if (!$errors->any()) disabled @endif>
                                    @error('phone')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3 text-end">
                                    <button id="editBtn" type="button" class="btn primary-bg {{ $errors->any() ? 'd-none' : '' }}">
                                        Edit Detail
                                    </button>
                                    <button id="saveBtn" type="submit" class="btn primary-bg {{ $errors->any() ? '' : 'd-none' }}">
                                        Save Detail
                                    </button>
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
                                            <div class="col-12 ">
                                                <div class="card mb-3">
                                                    <div class="d-flex justify-content-start">
                                                        <div>
                                                            <img src="{{ $order->items->first()->product->firstimage->img }}"
                                                                class="img-fluid rounded-start history_product_img" alt="Product Image" width="115px">
                                                        </div>
                                                        <div class="w-100">
                                                            <div class="card-body">
                                                                <h6 class="card-title d-flex justify-content-between">
                                                                    <span>Order #{{ $order->id }}</span>
                                                                    <span>₹{{ number_format($order->total, 2) }}</small></span>
                                                                </h6>

                                                        
                                                                <small class="card-text">Status:
                                                                    <span class="text-success">
                                                                        {{ ucfirst($order->status == 'Pending' ? 'Confirmed' : $order->status) }}
                                                                    </span>
                                                                </small>
                                                                <p class="card-text mt-2 d-flex justify-content-between align-items-center">
                                                                    <a href="{{ route('orders.show', $order->id) }}"
                                                                        class="btn primary-bg btn-sm">
                                                                        View Details
                                                                    </a>

                                                                    <small class="d-none d-md-block">{{ $order->created_at->format('d M Y, h:i A') }}</small>
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
                            <button class="btn primary-bg mb-3" data-bs-toggle="collapse" data-bs-target="#addAddressForm">
                                Add New Address
                            </button>

                            <div class="collapse mb-4" id="addAddressForm">
                                <div class="card card-body">
                                    <form method="POST" action="{{ route('addresses.store') }}">
                                        @csrf
                                        <div class="mb-3">
                                            <label for="address" class="form-label fw-bold">Address</label>
                                            <input type="text" name="address" id="address" class="form-control" placeholder="Flat / House No. / Floor / Building"  required>
                                            @error('address')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <label for="address_2" class="form-label">Address 2 (Optional)</label>
                                            <input type="text" name="address_2" id="address_2" class="form-control" placeholder="Address 2 (Optional)">
                                        </div>

                                        <div class="mb-3">
                                            <label for="city" class="form-label fw-bold">City</label>
                                            <input type="text" name="city" id="city" class="form-control" placeholder="City"
                                                required>
                                            @error('city')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <label for="state" class="form-label">State</label>
                                            <select id="state" class="form-control py-2" name="state" required>
                                                <option value="">Select State</option>
                                                @foreach ([
                                                    'Andhra Pradesh', 'Arunachal Pradesh', 'Assam', 'Bihar', 'Chhattisgarh', 
                                                    'Goa', 'Gujarat', 'Haryana', 'Himachal Pradesh', 'Jharkhand', 
                                                    'Karnataka', 'Kerala', 'Madhya Pradesh', 'Maharashtra', 'Manipur', 
                                                    'Meghalaya', 'Mizoram', 'Nagaland', 'Odisha', 'Punjab', 
                                                    'Rajasthan', 'Sikkim', 'Tamil Nadu', 'Telangana', 'Tripura', 
                                                    'Uttar Pradesh', 'Uttarakhand', 'West Bengal', 'Andaman and Nicobar Islands', 
                                                    'Chandigarh', 'Dadra and Nagar Haveli and Daman and Diu', 'Delhi', 
                                                    'Jammu and Kashmir', 'Ladakh', 'Lakshadweep', 'Puducherry'] as $state)
                                                    <option value="{{ $state }}">{{ $state }}</option>
                                                @endforeach
                                            </select>
                                            @error('state')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <label for="pin_code" class="form-label">Pin Code</label>
                                            <input type="text" name="pin_code" id="pin_code" class="form-control" placeholder="Pin Code"
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

                                        <button type="submit" class="btn primary-bg">Save Address</button>
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
                                    <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                        <div class="mb-2 mb-md-0">
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
                                                    <button class="btn btn-sm btn-primary text-black" style="background: #BBD8A3;border: #BBD8A3">Set as Default</button>
                                                </form> 
                                            @endif
                                            <button class="btn btn-sm btn-warning" data-bs-toggle="collapse"
                                                data-bs-target="#editAddressForm{{ $address->id }}" style="background: #FFE6A9;border: #FFE6A9">Edit</button>
                                            <form action="{{ route('addresses.destroy', $address->id) }}" method="POST"
                                                class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-sm btn-danger" style="background: #FAA0A0;color:black; border: #FAA0A0;">Delete</button>
                                            </form>
                                        </div>
                                    </li>
                                    <div class="collapse mb-4" id="editAddressForm{{ $address->id }}">
                                        <div class="card card-body">
                                            <form method="POST" action="{{ route('addresses.update', $address->id) }}">
                                                @csrf
                                                @method('PUT')
                                                <div class="mb-3">
                                                    <label for="address" class="form-label">Address</label>
                                                    <input name="address" id="address" class="form-control" value="{{ $address->address }}" placeholder="Flat / House No. / Floor / Building" required>
                                                    @error('address')
                                                        <small class="text-danger">{{ $message }}</small>
                                                    @enderror
                                                </div>

                                                <div class="mb-3">
                                                    <label for="address_2" class="form-label">Address 2 (Optional)</label>
                                                    <input type="text" name="address_2" id="address_2" placeholder="Address 2 (Optional)"
                                                        class="form-control" value="{{ $address->address_2 }}">
                                                </div>

                                                <div class="mb-3">
                                                    <label for="city" class="form-label">City</label>
                                                    <input type="text" name="city" id="city" class="form-control" placeholder="City"
                                                        value="{{ $address->city }}" required>
                                                    @error('city')
                                                        <small class="text-danger">{{ $message }}</small>
                                                    @enderror
                                                </div>

                                                <div class="mb-3">
                                                    <label for="state" class="form-label">State</label>
                                                    <select id="state" class="form-control py-2" name="state" required>
                                                        <option value="">Select State</option>
                                                        @foreach ([
                                                            'Andhra Pradesh', 'Arunachal Pradesh', 'Assam', 'Bihar', 'Chhattisgarh', 
                                                            'Goa', 'Gujarat', 'Haryana', 'Himachal Pradesh', 'Jharkhand', 
                                                            'Karnataka', 'Kerala', 'Madhya Pradesh', 'Maharashtra', 'Manipur', 
                                                            'Meghalaya', 'Mizoram', 'Nagaland', 'Odisha', 'Punjab', 
                                                            'Rajasthan', 'Sikkim', 'Tamil Nadu', 'Telangana', 'Tripura', 
                                                            'Uttar Pradesh', 'Uttarakhand', 'West Bengal', 'Andaman and Nicobar Islands', 
                                                            'Chandigarh', 'Dadra and Nagar Haveli and Daman and Diu', 'Delhi', 
                                                            'Jammu and Kashmir', 'Ladakh', 'Lakshadweep', 'Puducherry'] as $state)
                                                            <option value="{{ $state }}" {{ $address->state == $state ? 'selected' : '' }}>
                                                                {{ $state }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    @error('state')
                                                        <small class="text-danger">{{ $message }}</small>
                                                    @enderror
                                                </div>

                                                <div class="mb-3">
                                                    <label for="pin_code" class="form-label">Pin Code</label>
                                                    <input type="text" name="pin_code" id="pin_code"
                                                        class="form-control" value="{{ $address->pin_code }}" placeholder="Pin Code" required>
                                                    @error('pin_code')
                                                        <small class="text-danger">{{ $message }}</small>
                                                    @enderror
                                                </div>

                                                <div class="form-check mb-3">
                                                    <input type="checkbox" class="form-check-input" id="primary"
                                                        name="primary" {{ $address->default_address ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="primary">Set as primary
                                                        address</label>
                                                </div>

                                                <button type="submit" class="btn btn-success">Update Address</button>
                                            </form>
                                        </div>
                                    </div>
                                @endforeach
                            </ul>
                        </div>

                    </div>
                </div>

                <form action="{{ route('logout') }}" method="POST" class="mt-3 w-100 d-md-none">
                    @csrf
                    <button type="button" class="btn btn-danger w-100" id="logoutBtn">Logout</button>
                </form>
            </div>
        </div>
        </div>
    </section>

@endsection
