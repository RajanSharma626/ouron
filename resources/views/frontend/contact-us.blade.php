@extends('frontend.layouts.app')

@section('title', 'Contact Us - Ouron')

@section('content')

    <section class="product_detail">
        <div class="container py-5">
            <div class="row justify-content-center py-5">

                <div class="col-12 mb-5">
                    <h1 class="fs-4 text-center">CONNECT WITH THE BRAND</h1>
                    <p class="text-center text-normal">We would love to hear about your feedback, interests and future
                        collaborations. Reach out to us on
                        email at contact@ouron.in. Our dedicated customer support number can be reached on +91 8799232708,
                        Monday to Saturday, 11.30 AM to 8:00 PM.</p>
                </div>

                <div class="col-12">
                    <div class="row py-4">
                        <div class="col-md-3 mb-3">
                            <div class="card text-center h-100 p-4">

                                <h5 class="fw-bold mb-0">Trade name:</h5>
                                Ouron Lifestyle & co
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <div class="card text-center h-100 p-4">
                                <h5 class="fw-bold mb-0">
                                    Phone number:
                                </h5>
                                +91 8799232708
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <div class="card text-center h-100 p-4">

                                <h5 class="fw-bold mb-0">
                                    Email:
                                </h5>
                                contact@ouron.in

                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <div class="card text-center h-100 p-4">
                                <h5  class="fw-bold mb-0">
                                    Physical address:
                                </h5>
                                 D/2 Khodiyar Nagar Colony, Surat, 395006 Gujarat, India
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-md-6">
                    <form action="">
                        <div class="row">
                            <div class="col-12 col-md-6 mb-3">
                                <input type="text" class="form-control fs-07rem p-3" placeholder="Name">
                            </div>
                            <div class="col-12 col-md-6 mb-3">
                                <input type="email" class="form-control fs-07rem p-3" placeholder="Email*">
                            </div>
                            <div class="col-12 mb-3">
                                <input type="number" class="form-control fs-07rem p-3" placeholder="Phone Number*">
                            </div>
                            <div class="col-12 mb-3">
                                <textarea name="" class="form-control fs-07rem p-3" id="" placeholder="Comment"></textarea>
                            </div>

                            <div class="col-12 text-center">
                                <button class="btn primary-bg px-5">Submit</button>
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
                    Shipping worldwide &nbsp;&nbsp;&nbsp; | &nbsp;&nbsp;&nbsp; Free returns &nbsp;&nbsp;&nbsp; |
                    &nbsp;&nbsp;&nbsp; 24/7 Customer Support
                    | &nbsp;&nbsp;&nbsp; Shipping worldwide &nbsp;&nbsp;&nbsp; | &nbsp;&nbsp;&nbsp; Free returns
                    &nbsp;&nbsp;&nbsp; | &nbsp;&nbsp;&nbsp; 24/7 Customer Support
                    | &nbsp;&nbsp;&nbsp; Shipping worldwide &nbsp;&nbsp;&nbsp; | &nbsp;&nbsp;&nbsp; Free returns
                    &nbsp;&nbsp;&nbsp; | &nbsp;&nbsp;&nbsp; 24/7 Customer Support
                </marquee>
            </div>
        </section>
        {{-- ============================================= Marquee Section End ==================================== --}}
    </section>

@endsection
