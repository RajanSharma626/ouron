@extends('frontend.layouts.app')

@section('title', 'Blogs - Ouron')

@section('content')

    <section class="blogs">
        <div class="container">
            <div class="row py-5">
                <div class="row">
                    <div class="col-12 py-4">
                        <div class="row align-items-center">
                            <div class="col-3">
                                <div class="blog">
                                    <div class="product_img">
                                        <img src="https://bluorng.com/cdn/shop/articles/encwesdnc_8c9feeae-442d-412d-aef9-a8a72fa7e6bd.jpg?v=1741871844"
                                            alt="" class="img-fluid">
                                    </div>
                                    <div class="product_info p-2 pb-0">
                                        <h3 class="blog_title">
                                            The Clash T-shirt
                                        </h3>
                                        <p class="blog_desc text-muted">
                                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Veritatis, at?
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="blog">
                                    <div class="product_img">
                                        <img src="https://bluorng.com/cdn/shop/articles/encwesdnc_8c9feeae-442d-412d-aef9-a8a72fa7e6bd.jpg?v=1741871844"
                                            alt="" class="img-fluid">
                                    </div>
                                    <div class="product_info p-2 pb-0">
                                        <h3 class="blog_title">
                                            The Clash T-shirt
                                        </h3>
                                        <p class="blog_desc text-muted">
                                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Veritatis, at?
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="blog">
                                    <div class="product_img">
                                        <img src="https://bluorng.com/cdn/shop/articles/encwesdnc_8c9feeae-442d-412d-aef9-a8a72fa7e6bd.jpg?v=1741871844"
                                            alt="" class="img-fluid">
                                    </div>
                                    <div class="product_info p-2 pb-0">
                                        <h3 class="blog_title">
                                            The Clash T-shirt
                                        </h3>
                                        <p class="blog_desc text-muted">
                                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Veritatis, at?
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="blog">
                                    <div class="product_img">
                                        <img src="https://bluorng.com/cdn/shop/articles/encwesdnc_8c9feeae-442d-412d-aef9-a8a72fa7e6bd.jpg?v=1741871844"
                                            alt="" class="img-fluid">
                                    </div>
                                    <div class="product_info p-2 pb-0">
                                        <h3 class="blog_title">
                                            The Clash T-shirt
                                        </h3>
                                        <p class="blog_desc text-muted">
                                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Veritatis, at?
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

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
