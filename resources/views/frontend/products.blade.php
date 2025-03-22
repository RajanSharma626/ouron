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
                <div class="col-6 col-md-3" data-aos="fade-up">
                    <a href="/product/detail" class="text-decoration-none">
                        <div class="product_card">
                            <div class="product_img position-relative">
                                <img src="https://bluorng.com/cdn/shop/files/wedacwsdz.jpg?v=1742189620&width=533"
                                    alt="" class="img-fluid default_img">
                                <img src="https://bluorng.com/cdn/shop/files/encwesdnc_bfd44569-186c-48b9-a88d-b75c2ecbdc4d.jpg?v=1742189608&width=533"
                                    alt="" class="img-fluid hover_img">

                                <!-- Icons (Positioned correctly) -->
                                <div class="product_icons position-absolute top-0 end-0 p-2">
                                    <a href="javascript:void(0)" class="cart_icon add-to-cart" title="Add to Cart"
                                        data-id="1" data-name="The Clash T-shirt" data-price="3999"
                                        data-image="https://bluorng.com/cdn/shop/files/wedacwsdz.jpg?v=1742189620&width=533">
                                        <i class="bi bi-handbag"></i>
                                    </a>
                                    <a href="#" class="like_icon" title="Add to Wishlist">
                                        <i class="bi bi-heart"></i>
                                    </a>
                                    <a href="#" class="share_icon" title="Share">
                                        <i class="bi bi-share-fill"></i>
                                    </a>
                                </div>
                            </div>

                            <div class="product_info p-3">
                                <h3 class="product_title">The Clash T-shirt</h3>
                                <p class="product_price mb-0 text-muted">
                                    <del>RS. 4,995</del> &nbsp; RS. 3,999
                                </p>
                            </div>
                        </div>
                    </a>
                </div>

                <div class="col-6 col-md-3" data-aos="fade-up">
                    <a href="/product/detail" class="text-decoration-none">
                        <div class="product_card">
                            <div class="product_img position-relative">
                                <img src="https://bluorng.com/cdn/shop/files/encwesdnc_bfd44569-186c-48b9-a88d-b75c2ecbdc4d.jpg?v=1742189608&width=533"
                                    alt="" class="img-fluid default_img">
                                <img src="https://bluorng.com/cdn/shop/files/wedacwsdz.jpg?v=1742189620&width=533"
                                    alt="" class="img-fluid hover_img">

                                <!-- Icons (Positioned correctly) -->
                                <div class="product_icons position-absolute top-0 end-0 p-2">
                                    <a href="javascript:void(0)" class="cart_icon add-to-cart" title="Add to Cart"
                                        data-id="2" data-name="The Clash T-shirt 2" data-price="3999"
                                        data-image="https://bluorng.com/cdn/shop/files/encwesdnc_bfd44569-186c-48b9-a88d-b75c2ecbdc4d.jpg?v=1742189608&width=533">
                                        <i class="bi bi-handbag"></i>
                                    </a>
                                    <a href="#" class="like_icon" title="Add to Wishlist">
                                        <i class="bi bi-heart"></i>
                                    </a>
                                    <a href="#" class="share_icon" title="Share">
                                        <i class="bi bi-share-fill"></i>
                                    </a>
                                </div>
                            </div>

                            <div class="product_info p-3">
                                <h3 class="product_title">The Clash T-shirt</h3>
                                <p class="product_price mb-0 text-muted"><del>RS. 4,995 </del> &nbsp; RS. 3,999</p>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-6 col-md-3" data-aos="fade-up">
                    <a href="/product/detail" class="text-decoration-none">
                        <div class="product_card">
                            <div class="product_img position-relative">
                                <img src="https://bluorng.com/cdn/shop/files/fv3weca.jpg?v=1741010363&width=533"
                                    alt="" class="img-fluid default_img">
                                <img src="https://bluorng.com/cdn/shop/files/erwfsdcwqas.jpg?v=1741417955&width=533"
                                    alt="" class="img-fluid hover_img">

                                <!-- Icons (Positioned correctly) -->
                                <div class="product_icons position-absolute top-0 end-0 p-2">
                                    <a href="#" class="cart_icon" title="Add to Cart">
                                        <i class="bi bi-handbag"></i>
                                    </a>
                                    <a href="#" class="like_icon" title="Add to Wishlist">
                                        <i class="bi bi-heart"></i>
                                    </a>
                                    <a href="#" class="share_icon" title="Share">
                                        <i class="bi bi-share-fill"></i>
                                    </a>
                                </div>
                            </div>

                            <div class="product_info p-3">
                                <h3 class="product_title">The Clash T-shirt</h3>
                                <p class="product_price mb-0 text-muted"><del>RS. 4,995 </del> &nbsp; RS. 3,999</p>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-6 col-md-3" data-aos="fade-up">
                    <a href="/product/detail" class="text-decoration-none">
                        <div class="product_card">
                            <div class="product_img position-relative">
                                <img src="https://bluorng.com/cdn/shop/files/erwfsdcwqas.jpg?v=1741417955&width=533"
                                    alt="" class="img-fluid default_img">
                                <img src="https://bluorng.com/cdn/shop/files/fv3weca.jpg?v=1741010363&width=533"
                                    alt="" class="img-fluid hover_img">

                                <!-- Icons (Positioned correctly) -->
                                <div class="product_icons position-absolute top-0 end-0 p-2">
                                    <a href="#" class="cart_icon" title="Add to Cart">
                                        <i class="bi bi-handbag"></i>
                                    </a>
                                    <a href="#" class="like_icon" title="Add to Wishlist">
                                        <i class="bi bi-heart"></i>
                                    </a>
                                    <a href="#" class="share_icon" title="Share">
                                        <i class="bi bi-share-fill"></i>
                                    </a>
                                </div>
                            </div>

                            <div class="product_info p-3">
                                <h3 class="product_title">The Clash T-shirt</h3>
                                <p class="product_price mb-0 text-muted"><del>RS. 4,995 </del> &nbsp; RS. 3,999</p>
                            </div>
                        </div>
                    </a>
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
