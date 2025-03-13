@extends('frontend.layouts.app')

@section('title', 'Login - Ouron')

@section('content')

    <section class="product_detail py-5">
        <div class="container py-5">
            <div class="row">
                <div class="col-md-5 mx-auto">
                    <div class="card">
                        <div class="card-header ">
                            <h5>Log in </h5>
                        </div>
                        <div class="card-body">
                            <form method="POST" action="{{ route('login.auth') }}">
                                @csrf
                                <div class="form-group">
                                    <label for="" class="text-normal form-label">Enter mobile number</label>
                                    <input type="number" class="form-control p-2 text-normal" name="phone" required>
                                </div>
                                @if (session('error'))
                                    <div class="text-danger text-normal">
                                        {{ session('error') }}
                                    </div>
                                @endif
                                <div class="form-group text-center mt-4">
                                    <button type="submit" class="login_btn w-100 mb-3">Login</button>
                                    <a class="link-normal border-bottom" href="{{ route('register') }}"
                                        class="btn btn-link">Create an account</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
