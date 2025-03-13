@extends('frontend.layouts.app')

@section('title', 'Profile - Ouron')

@section('content')

    <section class="product_detail py-5">
        <div class="container py-5">
            <div class="row">
            <div class="col-md-4">
                <div class="list-group">
                    <a href="#profile" class="list-group-item list-group-item-action active" data-toggle="tab">Profile</a>
                    <a href="#orders" class="list-group-item list-group-item-action" data-toggle="tab">Order History</a>
                    <a href="#addresses" class="list-group-item list-group-item-action" data-toggle="tab">Addresses</a>
                    <form action="{{ route('logout') }}" method="POST" class="mt-2">
                        @csrf
                        <button type="submit" class="list-group-item list-group-item-action text-left border-0 bg-transparent">Logout</button>
                    </form>
                </div>
            </div>
            <div class="col-md-8">
                <div class="tab-content">
                    <div class="tab-pane fade show active" id="profile">
                        <h3 class="mb-4">Profile Information</h3>
                        <p><strong>Name:</strong> {{ auth()->user()->name }}</p>
                        <p><strong>Email:</strong> {{ auth()->user()->email }}</p>
                        <p><strong>Phone No:</strong> {{ auth()->user()->phone }}</p>
                        <!-- Additional profile details can be added here -->
                    </div>
                    <div class="tab-pane fade" id="orders">
                        <h3 class="mb-4">Order History</h3>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Order #</th>
                                        <th>Date</th>
                                        <th>Status</th>
                                        <th>Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    {{-- @foreach($orders as $order)
                                        <tr>
                                            <td>{{ $order->id }}</td>
                                            <td>{{ $order->created_at->format('d M Y') }}</td>
                                            <td>{{ $order->status }}</td>
                                            <td>${{ number_format($order->total, 2) }}</td>
                                        </tr>
                                    @endforeach --}}
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="addresses">
                        <h3 class="mb-4">Your Addresses</h3>
                        <button class="btn btn-primary mb-3" data-toggle="collapse" data-target="#addAddressForm">
                            Add New Address
                        </button>
                        <div class="collapse mb-4" id="addAddressForm">
                            <div class="card card-body">
                                <form method="POST" action="">
                                    @csrf
                                    <div class="form-group">
                                        <label for="address">Address</label>
                                        <textarea name="address" id="address" class="form-control" rows="3"></textarea>
                                    </div>
                                    <div class="form-group form-check">
                                        <input type="checkbox" class="form-check-input" id="primary" name="primary">
                                        <label class="form-check-label" for="primary">Set as primary address</label>
                                    </div>
                                    <button type="submit" class="btn btn-success">Save Address</button>
                                </form>
                            </div>
                        </div>
                        <ul class="list-group">
                            {{-- @foreach($addresses as $address)
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    {{ $address->address }}
                                    @if($address->primary)
                                        <span class="badge badge-primary">Primary</span>
                                    @endif
                                </li>
                            @endforeach --}}
                        </ul>
                    </div>
                </div>
            </div>
            </div>
        </div>
    </section>

@endsection
