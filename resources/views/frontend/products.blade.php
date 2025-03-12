@extends('frontend.layouts.app')

@section('title', 'All Product - Ouron')

@section('content')

    <section class="product_detail">
        <div class="container-fluid py-5">

            <div class="row justify-content-between mb-3 align-items-center">
                <div class="col">
                    <p class="text-uppercase heading-font mb-0">All Products</p>
                </div>
            </div>

            <div class="row mb-4">
                <div class="col-md-4">
                    <div class="d-flex align-items-center">
                        <label for="sizeFilter" class="form-label me-2 mb-0 fs-07rem">Filter :</label>
                        <select id="sizeFilter" class="w-auto custom_filter px-3 py-1 fs-07rem">
                            <option value="">Size</option>
                            <option value="s">Small</option>
                            <option value="m">Medium</option>
                            <option value="l">Large</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-4 text-center">
                    <span class="me-3 text-muted fs-07rem">Showing 4 Products</span>
                </div>
                <div class="col-md-4">
                    <div class="d-flex align-items-center justify-content-end">

                        <label for="sortBy" class="form-label me-2 mb-0 fs-07rem">Sort by:</label>
                        <select id="sortBy" class="w-auto custom_filter px-3 py-1 fs-07rem">
                            <option value="Featured">Featured</option>
                            <option value="priceAsc">Price: Low to High</option>
                            <option value="priceDesc">Price: High to Low</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="row g-2">
                <div class="col-3">
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
                                RS. 4,995
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-3">
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
                                RS. 4,995
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-3">
                    <div class="product_card">

                        <div class="product_img">
                            <img src="https://bluorng.com/cdn/shop/files/hbh_kb.jpg?v=1738849531&width=360" alt=""
                                class="img-fluid">
                        </div>
                        <div class="product_info p-2 pb-0">
                            <h3 class="product_title">
                                The Clash T-shirt
                            </h3>
                            <p class="product_price text-muted">
                                RS. 4,995
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-3">
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
                                RS. 4,995
                            </p>
                        </div>
                    </div>
                </div>

                <div class="col-3">
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
                                RS. 4,995
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-3">
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
                                RS. 4,995
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-3">
                    <div class="product_card">

                        <div class="product_img">
                            <img src="https://bluorng.com/cdn/shop/files/hbh_kb.jpg?v=1738849531&width=360" alt=""
                                class="img-fluid">
                        </div>
                        <div class="product_info p-2 pb-0">
                            <h3 class="product_title">
                                The Clash T-shirt
                            </h3>
                            <p class="product_price text-muted">
                                RS. 4,995
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-3">
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
                                RS. 4,995
                            </p>
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
