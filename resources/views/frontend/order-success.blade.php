@extends('frontend.layouts.app')

@section('title', 'Order Success - Ouron')

@section('content')

    <section class="product_detail py-5">
        <div class="container py-5">
            <div class="row">
                <div class="col-md-5 mx-auto">
                    <div class="card">
                        <div class="container text-center py-5">
                            <h2>Thank You for Your Order!</h2>
                            <p>Your order has been placed successfully. You will receive an email confirmation soon.</p>
                            <a href="{{ route('home') }}" class="custom-btn">Continue Shopping</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
