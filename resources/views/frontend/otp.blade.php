@extends('frontend.layouts.app')

@section('title', 'OTP Verification - Ouron')

@section('content')

    <section class="product_detail py-5">
        <div class="container py-5">
            <div class="row">
                <div class="col-md-5 mx-auto">
                    <div class="card">
                        <div class="card-header ">
                            <h5>OTP Verify</h5>
                        </div>
                        <div class="card-body">

                            <p class="text-center mb-3 text-normal">OTP has been sent to your phone number.</p>

                            <form method="POST" action="{{ route('verify-otp') }}">
                                @csrf
                                <div class="form-group">
                                    <label for="" class="text-normal form-label">Enter One Time Password
                                        (OTP)</label>
                                    <input type="number" class="form-control p-2 text-normal" min=0 name="otp"
                                        required>
                                    @if ($errors->has('otp'))
                                        <span class="text-danger">{{ $errors->first('otp') }}</span>
                                    @endif

                                    <input type="number" value="{{ session('user_id') }}" name="user_id" hidden>
                                </div>
                                <div class="form-group text-center mt-4">
                                    <button type="submit" class="login_btn w-100 mb-3">Verify OTP</button>
                                    <a class="link-normal border-bottom" href="{{ route('login') }}"
                                        class="btn btn-link">Back to Login</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
