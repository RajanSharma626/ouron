@extends('admin.layouts.auth')

@section('title', 'Reset Password')

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

                                <h2 class="fw-bold fs-24">Reset Password</h2>

                                <p class="text-muted mt-1 mb-4">Enter your email address and we'll send you an
                                    email with instructions to reset your password.</p>

                                <div>
                                    <form action="" class="authentication-form">
                                        <div class="mb-3">
                                            <label class="form-label" for="example-email">Email</label>
                                            <input type="email" id="example-email" name="example-email"
                                                class="form-control" placeholder="Enter your email">
                                        </div>
                                        <div class="mb-1 text-center d-grid">
                                            <button class="btn btn-primary" type="submit">Reset
                                                Password</button>
                                        </div>
                                    </form>
                                </div>

                                <p class="mt-5 text-danger text-center">Back to<a href="{{ route('admin.login') }}"
                                        class="text-dark fw-bold ms-1">Log In</a></p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xxl-5 d-none d-xxl-flex">
                    <div class="card h-100 mb-0 overflow-hidden">
                        <div class="d-flex flex-column h-100">
                            <img src="{{ asset('admin/images/small/img-10.jpg') }}" alt="" class="w-100 h-100">
                        </div>
                    </div> <!-- end card -->
                </div>
            </div>
        </div>
    </div>
@endsection
