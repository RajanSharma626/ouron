@extends('frontend.layouts.app')

@section('title', 'Contact Us - Ouron')

@section('content')

    <section class="product_detail">
        <div class="container py-5">
            <div class="row justify-content-center py-5">

                <div class="col-12 mb-5 text-center">
                    <h1 class="fs-3 text-center fw-bold">CONNECT WITH THE BRAND</h1>
                    <small class="text-center">We would love to hear about your feedback, interests and future
                        collaborations. Reach out to us on
                        email at contact@ouron.in. Our dedicated customer support number can be reached on +91 8799232708,
                        Monday to Saturday, 11.30 AM to 8:00 PM.</small>
                </div>

                <div class="col-12 col-md-6">
                    <form id="contactForm">
                        @csrf
                        <div class="row">
                            <div class="col-12 col-md-6 mb-3">
                                <input type="text" name="name" style="text-transform: none" class="form-control fs-07rem p-3" placeholder="Name"
                                    required>
                            </div>
                            <div class="col-12 col-md-6 mb-3">
                                <input type="email" name="email" style="text-transform: none" class="form-control fs-07rem p-3" placeholder="Email*"
                                    required>
                            </div>
                            <div class="col-12 mb-3">
                                <input type="number" name="phone" style="text-transform: none" class="form-control fs-07rem p-3"
                                    placeholder="Phone Number*" required>
                            </div>
                            <div class="col-12 mb-3">
                                <textarea name="comment" style="text-transform: none" class="form-control fs-07rem p-3" id="" placeholder="Comment" required></textarea>
                            </div>

                            <div class="col-12 text-center">
                                <button type="submit" class="btn primary-bg px-5" id="submitBtn">
                                    <span class="btn-text">Submit</span>
                                </button>
                            </div>

                        </div>
                    </form>
                </div>


            </div>

        </div>

        {{-- ============================================= Marquee Section Start ==================================== --}}
        <section class="marquee-section primary-bg py-2">
            <div class="container-fluid d-flex align-items-center">
                <marquee behavior="scroll" direction="left" scrollamount="5" class="text-white">
                    100% Made With Indian Pride &nbsp;&nbsp;&nbsp; |
                    &nbsp;&nbsp;&nbsp; Free Shipping
                    | &nbsp;&nbsp;&nbsp; COD Available &nbsp;&nbsp;&nbsp; | &nbsp;&nbsp;&nbsp; 7-Day Easy Returns
                </marquee>
            </div>
        </section>
        {{-- ============================================= Marquee Section End ==================================== --}}
    </section>

@endsection
