@extends('frontend.layouts.app')

@section('title', 'Register - Ouron')

@section('content')

    <section class="product_detail py-5">
        <div class="container py-5">
            <div class="row">
                <div class="col-md-5 mx-auto">
                    <div class="card">
                        <div class="card-header ">
                            <h5>Create account</h5>
                        </div>
                        <div class="card-body">
                            <form method="POST" action="{{ route('registerUser') }}">
                                @csrf
                                <div class="form-group">
                                    <div class="mb-3">
                                        <label for="" class="text-normal form-label">Full Name</label>
                                        <input type="text" class="form-control p-2 text-normal" name="name" required>
                                        @error('name')
                                            <span class="text-danger text-normal">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="" class="text-normal form-label">Email ID</label>
                                        <input type="email" class="form-control p-2 text-normal" name="email" required>
                                        @error('email')
                                            <span class="text-danger text-normal">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="" class="text-normal form-label">Phone No.</label>
                                        <input type="number" class="form-control p-2 text-normal" min="0" name="phone" required>
                                        @error('phone')
                                            <span class="text-danger text-normal">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group text-center mt-4">
                                    <button type="submit" class="login_btn w-100 mb-3">Register</button>
                                    <a class="link-normal border-bottom" href="{{ route('login') }}"
                                        class="btn btn-link">Log in</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
