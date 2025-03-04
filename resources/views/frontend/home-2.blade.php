@extends('frontend.layouts.app')

@section('title', 'Welcome to Quron eCommerce')

@section('content')

    {{-- ============================================= Banner Section Start ==================================== --}}
    <section class="banner-section">
        <div class="container-fluid p-0">
            <div class="swiper swiper-container">
                <div class="swiper-wrapper">
                    <div class="swiper-slide">
                        <a href=""><img
                                src="https://crazymonk.in/cdn/shop/files/Banner_for_Website_front_page_1.jpg?v=1740377697&width=2000"
                                class="img-fluid" alt="Slide 1"></a>
                    </div>
                    <div class="swiper-slide">
                        <a href=""><img
                                src="https://crazymonk.in/cdn/shop/files/2_b664a848-4712-42a2-bfe4-9377e1c2aa27.jpg?v=1733744646&width=2000"
                                class="img-fluid" alt="Slide 2"></a>
                    </div>
                </div>
                <!-- Add Pagination -->
                <div class="swiper-pagination"></div>
                <!-- Add Navigation -->
                <div class="custom-swiper-button swiper-button-next"></div>
                <div class="custom-swiper-button swiper-button-prev"></div>
            </div>
        </div>
    </section>
    {{-- ============================================= Banner Section End ==================================== --}}


    {{-- ============================================= New Arrival Section Start ==================================== --}}
    <section class="new_arrival_section mt-4">
        <div class="container">
            <div class="row justify-content-between mb-3 align-items-center">
                <div class="col">
                    <p class="text-uppercase secondary-font-size mb-0 ">New Arrivals</p>
                </div>
                <div class="col text-end">
                    <a href="" class="link-normal p-2 discover_more_btn rounded rounded">Discover More</a>
                </div>
            </div>

            <div class="row g-4">
                <div class="col-3">
                    <div class="product_img2">
                        <img src="https://crazymonk.in/cdn/shop/files/Kaiju_2.jpg?v=1735804167&width=360" alt=""
                            class="img-fluid">
                    </div>
                    <div class="product_info mt-2">
                        <h3 class="product_title2">
                            The Clash T-shirt
                        </h3>
                        <p class="product_price2 text-muted">
                            RS. 4,995 <s>RS. 5,995</s>
                        </p>
                    </div>
                </div>
                <div class="col-3">
                    <div class="product_img2">
                        <img src="https://crazymonk.in/cdn/shop/files/UltraEgo_1.jpg?v=1735804165&width=360" alt=""
                            class="img-fluid">
                    </div>
                    <div class="product_info mt-2">
                        <h3 class="product_title2">
                            The Clash T-shirt
                        </h3>
                        <p class="product_price2 text-muted">
                            RS. 4,995 <s>RS. 5,995</s>
                        </p>
                    </div>
                </div>
                <div class="col-3">
                    <div class="product_img2">
                        <img src="https://crazymonk.in/cdn/shop/files/NagiBlueLock_1.jpg?v=1735804175&width=360"
                            alt="" class="img-fluid">
                    </div>
                    <div class="product_info mt-2">
                        <h3 class="product_title2">
                            The Clash T-shirt
                        </h3>
                        <p class="product_price2 text-muted">
                            RS. 4,995 <s>RS. 5,995</s>
                        </p>
                    </div>
                </div>
                <div class="col-3">
                    <div class="product_img2">
                        <img src="https://crazymonk.in/cdn/shop/files/2_13a45b93-3208-47ee-ae4b-b50fbc00bd6f.jpg?v=1736671203&width=360"
                            alt="" class="img-fluid">
                    </div>
                    <div class="product_info mt-2">
                        <h3 class="product_title2">
                            The Clash T-shirt
                        </h3>
                        <p class="product_price2 text-muted">
                            RS. 4,995 <s>RS. 5,995</s>
                        </p>
                    </div>
                </div>
            </div>

            <div class="row py-4">
                <div class="col-12 text-center">
                    <a href="" class="discover_more_btn rounded">Discover More</a>
                </div>
            </div>
        </div>
    </section>
    {{-- ============================================= New Arrival Section End ==================================== --}}


    {{-- ============================================= Design Collection Section Start ==================================== --}}
    <section class="design_collection_section mt-4">
        <div class="container">
            <div class="row justify-content-between mb-3 align-items-center">
                <div class="col">
                    <p class="text-uppercase secondary-font-size mb-0">Design Collection</p>
                </div>
                <div class="col text-end">
                    <a href="" class="link-normal p-2  discover_more_btn rounded">Discover More</a>
                </div>
            </div>

            <div class="row g-4">
                <div class="col-3">
                    <div class="product_img2">
                        <img src="https://crazymonk.in/cdn/shop/files/Kaiju_2.jpg?v=1735804167&width=360" alt=""
                            class="img-fluid">
                    </div>
                    <div class="product_info mt-2">
                        <h3 class="product_title2">
                            The Clash T-shirt
                        </h3>
                        <p class="product_price2 text-muted">
                            RS. 4,995 <s>RS. 5,995</s>
                        </p>
                    </div>
                </div>
                <div class="col-3">
                    <div class="product_img2">
                        <img src="https://crazymonk.in/cdn/shop/files/UltraEgo_1.jpg?v=1735804165&width=360" alt=""
                            class="img-fluid">
                    </div>
                    <div class="product_info mt-2">
                        <h3 class="product_title2">
                            The Clash T-shirt
                        </h3>
                        <p class="product_price2 text-muted">
                            RS. 4,995 <s>RS. 5,995</s>
                        </p>
                    </div>
                </div>
                <div class="col-3">
                    <div class="product_img2">
                        <img src="https://crazymonk.in/cdn/shop/files/NagiBlueLock_1.jpg?v=1735804175&width=360"
                            alt="" class="img-fluid">
                    </div>
                    <div class="product_info mt-2">
                        <h3 class="product_title2">
                            The Clash T-shirt
                        </h3>
                        <p class="product_price2 text-muted">
                            RS. 4,995 <s>RS. 5,995</s>
                        </p>
                    </div>
                </div>
                <div class="col-3">
                    <div class="product_img2">
                        <img src="https://crazymonk.in/cdn/shop/files/2_13a45b93-3208-47ee-ae4b-b50fbc00bd6f.jpg?v=1736671203&width=360"
                            alt="" class="img-fluid">
                    </div>
                    <div class="product_info mt-2">
                        <h3 class="product_title2">
                            The Clash T-shirt
                        </h3>
                        <p class="product_price2 text-muted">
                            RS. 4,995 <s>RS. 5,995</s>
                        </p>
                    </div>
                </div>
            </div>

            <div class="row py-4">
                <div class="col-12 text-center">
                    <a href="" class="discover_more_btn rounded">Discover More</a>
                </div>
            </div>
        </div>
    </section>
    {{-- ============================================= Design Collection Section End ==================================== --}}




    {{-- ============================================= All Product Section Start ==================================== --}}
    <section class="design_collection_section mt-4">
        <div class="container">
            <div class="row justify-content-between mb-3 align-items-center">
                <div class="col">
                    <p class="text-uppercase secondary-font-size mb-0">All Products</p>
                </div>
                <div class="col text-end">
                    <a href="" class="link-normal p-2  discover_more_btn rounded">Discover More</a>
                </div>
            </div>

            <div class="row g-4">
                <div class="col-3">
                    <div class="product_img2">
                        <img src="https://crazymonk.in/cdn/shop/files/Kaiju_2.jpg?v=1735804167&width=360" alt=""
                            class="img-fluid">
                    </div>
                    <div class="product_info mt-2">
                        <h3 class="product_title2">
                            The Clash T-shirt
                        </h3>
                        <p class="product_price2 text-muted">
                            RS. 4,995 <s>RS. 5,995</s>
                        </p>
                    </div>
                </div>
                <div class="col-3">
                    <div class="product_img2">
                        <img src="https://crazymonk.in/cdn/shop/files/UltraEgo_1.jpg?v=1735804165&width=360"
                            alt="" class="img-fluid">
                    </div>
                    <div class="product_info mt-2">
                        <h3 class="product_title2">
                            The Clash T-shirt
                        </h3>
                        <p class="product_price2 text-muted">
                            RS. 4,995 <s>RS. 5,995</s>
                        </p>
                    </div>
                </div>
                <div class="col-3">
                    <div class="product_img2">
                        <img src="https://crazymonk.in/cdn/shop/files/NagiBlueLock_1.jpg?v=1735804175&width=360"
                            alt="" class="img-fluid">
                    </div>
                    <div class="product_info mt-2">
                        <h3 class="product_title2">
                            The Clash T-shirt
                        </h3>
                        <p class="product_price2 text-muted">
                            RS. 4,995 <s>RS. 5,995</s>
                        </p>
                    </div>
                </div>
                <div class="col-3">
                    <div class="product_img2">
                        <img src="https://crazymonk.in/cdn/shop/files/2_13a45b93-3208-47ee-ae4b-b50fbc00bd6f.jpg?v=1736671203&width=360"
                            alt="" class="img-fluid">
                    </div>
                    <div class="product_info mt-2">
                        <h3 class="product_title2">
                            The Clash T-shirt
                        </h3>
                        <p class="product_price2 text-muted">
                            RS. 4,995 <s>RS. 5,995</s>
                        </p>
                    </div>
                </div>
            </div>

            <div class="row py-4">
                <div class="col-12 text-center">
                    <a href="" class="discover_more_btn rounded">Discover More</a>
                </div>
            </div>
        </div>
    </section>
    {{-- ============================================= All Product Section End ==================================== --}}


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



@endsection


@section('swiper-script')
    <!-- Initialize Swiper -->
    <script>
        var swiper = new Swiper('.swiper-container', {
            loop: true,
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
            },
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
        });
    </script>

@endsection
