@extends('frontend.layouts.app')

@section('title', 'All Product - Ouron')

@section('content')

    <section class="product_detail">
        <div class="container py-5">
            <div class="row justify-content-center py-5">
                <h1 class="fs-4 text-center">Our Blogs</h1>
                <p class="text-muted text-center text-normal">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Dicta
                    vel
                    aspernatur accusamus ipsam exercitationem consequuntur quo amet veritatis temporibus recusandae!</p>
            </div>

            <div class="row py-5">
                <div class="row">
                    <div class="col-12 py-4">
                        <div class="row align-items-end">
                            <div class="col-4">
                                <div class="product_card">
                                    <div class="product_img">
                                        <img src="https://bluorng.com/cdn/shop/files/WHITE_WILD_BUNCH_FRONT_FLYING.jpg?v=1738932437&width=360"
                                            alt="" class="img-fluid">
                                    </div>
                                    <div class="product_info p-2 pb-0">
                                        <h3 class="product_title">
                                            The Clash T-shirt
                                        </h3>
                                        <p class="product_price text-muted">
                                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Veritatis, at?
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="product_card">
                                    <div class="product_img">
                                        <img src="https://cdn.shopify.com/s/files/1/0514/9494/4962/files/blogn2.jpg?v=1740130957"
                                            alt="" class="img-fluid">
                                    </div>

                                </div>
                            </div>
                            <div class="col-4">
                                <div class="product_card">

                                    <div class="product_img">
                                        <img src="https://cdn.shopify.com/s/files/1/0514/9494/4962/files/blogn3.jpg?v=1740130957"
                                            alt="" class="img-fluid">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="product_card">

                            <div class="product_img">
                                <img src="https://bluorng.com/cdn/shop/files/DSC099288.jpg?v=1738849896&width=360"
                                    alt="" class="img-fluid">
                            </div>
                            <div class="product_info p-2 pb-0">
                                <h3 class="product_title">
                                    The Clash T-shirt
                                </h3>
                                <p class="product_price text-muted">
                                    Lorem ipsum dolor, sit amet consectetur adipisicing elit. Non, aspernatur!
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="product_card">
                            <div class="product_img">
                                <img src="https://bluorng.com/cdn/shop/files/WHITE_WILD_BUNCH_FRONT_FLYING.jpg?v=1738932437&width=360"
                                    alt="" class="img-fluid">
                            </div>
                            <div class="product_info p-2 pb-0">
                                <h3 class="product_title">
                                    The Clash T-shirt
                                </h3>
                                <p class="product_price text-muted">
                                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Veritatis, at?
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="product_card">

                            <div class="product_img">
                                <img src="https://bluorng.com/cdn/shop/files/BLACKWILDBUNCHFRONTFLYING.jpg?v=1738932421&width=360"
                                    alt="" class="img-fluid">
                            </div>
                            <div class="product_info p-2 pb-0">
                                <h3 class="product_title">
                                    The Clash T-shirt
                                </h3>
                                <p class="product_price text-muted">
                                    Lorem ipsum dolor, sit amet consectetur adipisicing elit. Non, aspernatur!
                                </p>
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
