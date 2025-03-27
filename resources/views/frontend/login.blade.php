@extends('frontend.layouts.app')

@section('title', 'Login - Ouron')

@section('content')

    <section class="product_detail py-5">
        <div class="container py-5">
            <div class="row">
                <div class="col-md-5 mx-auto">
                    <div class="border  p-4 rounded-3">
                        <div class="card-header ">
                            <h5 class="fw-bold text-center pb-3">Log in </h5>
                        </div>
                        <div class="card-body">
                            <form method="POST" action="{{ route('login.auth') }}">
                                @csrf
                                <div class="form-group">
                                    <input type="number" class="form-control p-2 text-normal bg-none"
                                        placeholder="Enter Mobile no." min="0" name="phone" required>
                                </div>
                                @if (session('error'))
                                    <div class="text-danger text-normal">
                                        {{ session('error') }}
                                    </div>
                                @endif
                                <div class="form-group text-center mt-4">
                                    <button type="submit" class="login_btn w-100 mb-3">Send OTP</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
