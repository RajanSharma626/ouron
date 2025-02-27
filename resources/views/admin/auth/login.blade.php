@extends('admin.layouts.auth')

@section('title', 'Log In')

@section('content')
    <div class="d-flex flex-column h-100 p-3">
        <div class="d-flex flex-column flex-grow-1">
            <div class="row h-100">
                <div class="col-xxl-7">
                    <div class="row justify-content-center h-100">
                        <div class="col-lg-6 py-lg-5">
                            <div class="d-flex flex-column h-100 justify-content-center">
                                <div class="auth-logo mb-4">
                                    <a href="index.html" class="logo-dark">
                                        <img src="{{ asset('admin/images/logo/admin-login-logo.png') }}" height="24"
                                            alt="logo dark">
                                    </a>

                                    <a href="index.html" class="logo-light">
                                        <img src="{{ asset('admin/images/logo/admin-login-logo.png') }}" height="24"
                                            alt="logo light">
                                    </a>
                                </div>

                                <h2 class="fw-bold fs-24">Log In</h2>

                                <p class="text-muted mt-1 mb-4">Enter your email address and password to access
                                    admin panel.</p>

                                <div class="mb-5">
                                    <form action{{ route('admin.login') }}" method="POST" class="authentication-form">
                                        @csrf
                                        <div class="mb-3">
                                            <label class="form-label" for="email">Email</label>
                                            <input type="email" id="email" name="email" class="form-control"
                                                placeholder="Enter your email" value="{{ old('email') }}">
                                            @error('email')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <a href="reset-password" class="float-end text-muted">Reset
                                                password</a>
                                            <label class="form-label" for="password">Password</label>
                                            <input type="password" id="password" name="password" class="form-control"
                                                placeholder="Enter your password">
                                            @error('password')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <div class="form-check">
                                                <input type="checkbox" class="form-check-input" id="remember"
                                                    name="remember">
                                                <label class="form-check-label" for="remember">Remember me</label>
                                            </div>
                                        </div>
                                        <div class="mb-1 text-center d-grid">
                                            <button class="btn btn-soft-primary" type="submit">Sign In</button>
                                        </div>
                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xxl-5 d-none d-xxl-flex">
                    <div class="card h-100 mb-0 overflow-hidden">
                        <div class="d-flex flex-column h-100">
                            <img src="{{ asset('admin/images/small/img-10.jpg') }}" alt="" class="w-100 h-100">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
