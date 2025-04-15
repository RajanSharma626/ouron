@extends('frontend.layouts.app')

@section('title', 'Order Success - Ouron')

@section('content')

    <section class="product_detail py-5">
        <div class="container py-5">
            <div class="row">
                <div class="col-md-5 mx-auto">
                    <div class="card">
                        <div class="container text-center py-5">
                            <div class="success-video" >
                                <video autoplay loop muted playsinline width="50%">
                                    <source src="{{ asset('images/video/confirmed.mp4') }}" type="video/mp4">
                                    Your browser does not support the video tag.
                                </video>
                            </div>
                            <h2 class="fs-4 fw-bold">Thank You for Your Order!</h2>
                            <p>Your order has been placed successfully. You will receive an email confirmation soon.</p>
                            @php
                                $id = request()->route('id');
                            @endphp
                            <a href="{{ route('orders.show', $id) }}" class="btn primary-bg">View Order</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
