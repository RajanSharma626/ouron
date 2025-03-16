@extends('frontend.layouts.app')

@section('title', 'Welcome to Quron eCommerce')

@section('content')

    {{-- ============================================= Banner Section Start ==================================== --}}
    <section class="banner-section">
        <div class="container-fluid p-0">
            <div class="swiper swiper-container">
                <div class="swiper-wrapper">
                    <div class="swiper-slide">
                        <a href=""><img src="{{ asset('images/banner/banner.webp') }}" class="img-fluid"
                                alt="Slide 1"></a>
                    </div>
                    <div class="swiper-slide">
                        <a href=""><img src="{{ asset('images/banner/banner-2.webp') }}" class="img-fluid"
                                alt="Slide 2"></a>
                    </div>
                    <div class="swiper-slide">
                        <a href="">
                            <img src="{{ asset('images/banner/banner-3.webp') }}" class="img-fluid" alt="Slide 3">
                        </a>
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
    <section class="new_arrival_section mt-5">
        <div class="container-fluid">
            <div class="row justify-content-between mb-3 align-items-center">
                <div class="col">
                    <p class="text-uppercase mb-0 fw-bold">New Arrivals</p>
                </div>
                <div class="col text-end">
                    <a href="{{ route('new.in') }}" class="link-normal p-2 discover_more_btn">Discover More</a>
                </div>
            </div>

            <div class="row g-2">
                <div class="col-3">
                    <a href="/product/detail" class="text-decoration-none">
                        <div class="product_card">
                            <div class="product_img">
                                <img src="https://bluorng.com/cdn/shop/files/WHITE_WILD_BUNCH_FRONT_FLYING.jpg?v=1738932437&width=360"
                                    alt="" class="img-fluid">
                            </div>
                            <div class="product_info p-3">
                                <h3 class="product_title">
                                    The Clash T-shirt
                                </h3>
                                <p class="product_price mb-0 text-muted">
                                    RS. 4,995
                                </p>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-3">
                    <a href="/product/detail" class="text-decoration-none">
                        <div class="product_card">

                            <div class="product_img">
                                <img src="https://bluorng.com/cdn/shop/files/BLACKWILDBUNCHFRONTFLYING.jpg?v=1738932421&width=360"
                                    alt="" class="img-fluid">
                            </div>
                            <div class="product_info p-3">
                                <h3 class="product_title">
                                    The Clash T-shirt
                                </h3>
                                <p class="product_price mb-0 text-muted">
                                    RS. 4,995
                                </p>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-3">
                    <a href="/product/detail" class="text-decoration-none">
                        <div class="product_card">

                            <div class="product_img">
                                <img src="https://bluorng.com/cdn/shop/files/hbh_kb.jpg?v=1738849531&width=360"
                                    alt="" class="img-fluid">
                            </div>
                            <div class="product_info p-3">
                                <h3 class="product_title">
                                    The Clash T-shirt
                                </h3>
                                <p class="product_price mb-0 text-muted">
                                    RS. 4,995
                                </p>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-3">
                    <a href="/product/detail" class="text-decoration-none">
                        <div class="product_card">

                            <div class="product_img">
                                <img src="https://bluorng.com/cdn/shop/files/DSC099288.jpg?v=1738849896&width=360"
                                    alt="" class="img-fluid">
                            </div>
                            <div class="product_info p-3">
                                <h3 class="product_title">
                                    The Clash T-shirt
                                </h3>
                                <p class="product_price mb-0 text-muted">
                                    RS. 4,995
                                </p>
                            </div>
                        </div>
                    </a>
                </div>
            </div>

            <div class="row py-4">
                <div class="col-12 text-center">
                    <a href="{{ route('new.in') }}" class="discover_more_btn">Discover More</a>
                </div>
            </div>
        </div>
    </section>
    {{-- ============================================= New Arrival Section End ==================================== --}}

    <div class="container-fluid py-5">
        <div class="row">
            <div class="col-12">
                <a href=""><img
                        src="https://crazymonk.in/cdn/shop/files/Banner_for_Website_front_page_1.jpg?v=1740377697&width=2000"
                        class="img-fluid" alt="Slide 1"></a>
            </div>
        </div>
    </div>


    {{-- ============================================= All Product Section Start ==================================== --}}
    <section class="design_collection_section py-5">
        <div class="container-fluid">
            <div class="row justify-content-between mb-3 align-items-center">
                <div class="col">
                    <p class="text-uppercase heading-font mb-0">All Products</p>
                </div>
                <div class="col text-end">
                    <a href="{{ route('all-product') }}" class="link-normal p-2  discover_more_btn">Discover More</a>
                </div>
            </div>

            <div class="row g-2">
                <div class="col-3">
                    <a href="/product/detail" class="text-decoration-none">
                        <div class="product_card">
                            <div class="product_img">
                                <img src="https://bluorng.com/cdn/shop/files/WHITE_WILD_BUNCH_FRONT_FLYING.jpg?v=1738932437&width=360"
                                    alt="" class="img-fluid">
                            </div>
                            <div class="product_info p-3">
                                <h3 class="product_title">
                                    The Clash T-shirt
                                </h3>
                                <p class="product_price mb-0 text-muted">
                                    RS. 4,995
                                </p>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-3">
                    <a href="/product/detail" class="text-decoration-none">
                        <div class="product_card">

                            <div class="product_img">
                                <img src="https://bluorng.com/cdn/shop/files/BLACKWILDBUNCHFRONTFLYING.jpg?v=1738932421&width=360"
                                    alt="" class="img-fluid">
                            </div>
                            <div class="product_info p-3">
                                <h3 class="product_title">
                                    The Clash T-shirt
                                </h3>
                                <p class="product_price mb-0 text-muted">
                                    RS. 4,995
                                </p>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-3">
                    <a href="/product/detail" class="text-decoration-none">
                        <div class="product_card">

                            <div class="product_img">
                                <img src="https://bluorng.com/cdn/shop/files/hbh_kb.jpg?v=1738849531&width=360"
                                    alt="" class="img-fluid">
                            </div>
                            <div class="product_info p-3">
                                <h3 class="product_title">
                                    The Clash T-shirt
                                </h3>
                                <p class="product_price mb-0 text-muted">
                                    RS. 4,995
                                </p>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-3">
                    <a href="/product/detail" class="text-decoration-none">
                        <div class="product_card">

                            <div class="product_img">
                                <img src="https://bluorng.com/cdn/shop/files/DSC099288.jpg?v=1738849896&width=360"
                                    alt="" class="img-fluid">
                            </div>
                            <div class="product_info p-3">
                                <h3 class="product_title">
                                    The Clash T-shirt
                                </h3>
                                <p class="product_price mb-0 text-muted">
                                    RS. 4,995
                                </p>
                            </div>
                        </div>
                    </a>
                </div>

                <div class="col-3">
                    <a href="/product/detail" class="text-decoration-none">
                        <div class="product_card">
                            <div class="product_img">
                                <img src="https://bluorng.com/cdn/shop/files/WHITE_WILD_BUNCH_FRONT_FLYING.jpg?v=1738932437&width=360"
                                    alt="" class="img-fluid">
                            </div>
                            <div class="product_info p-3">
                                <h3 class="product_title">
                                    The Clash T-shirt
                                </h3>
                                <p class="product_price mb-0 text-muted">
                                    RS. 4,995
                                </p>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-3">
                    <a href="/product/detail" class="text-decoration-none">
                        <div class="product_card">

                            <div class="product_img">
                                <img src="https://bluorng.com/cdn/shop/files/BLACKWILDBUNCHFRONTFLYING.jpg?v=1738932421&width=360"
                                    alt="" class="img-fluid">
                            </div>
                            <div class="product_info p-3">
                                <h3 class="product_title">
                                    The Clash T-shirt
                                </h3>
                                <p class="product_price mb-0 text-muted">
                                    RS. 4,995
                                </p>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-3">
                    <a href="/product/detail" class="text-decoration-none">
                        <div class="product_card">

                            <div class="product_img">
                                <img src="https://bluorng.com/cdn/shop/files/hbh_kb.jpg?v=1738849531&width=360"
                                    alt="" class="img-fluid">
                            </div>
                            <div class="product_info p-3">
                                <h3 class="product_title">
                                    The Clash T-shirt
                                </h3>
                                <p class="product_price mb-0 text-muted">
                                    RS. 4,995
                                </p>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-3">
                    <a href="/product/detail" class="text-decoration-none">
                        <div class="product_card">

                            <div class="product_img">
                                <img src="https://bluorng.com/cdn/shop/files/DSC099288.jpg?v=1738849896&width=360"
                                    alt="" class="img-fluid">
                            </div>
                            <div class="product_info p-3">
                                <h3 class="product_title">
                                    The Clash T-shirt
                                </h3>
                                <p class="product_price mb-0 text-muted">
                                    RS. 4,995
                                </p>
                            </div>
                        </div>
                    </a>
                </div>
            </div>

            <div class="row py-4">
                <div class="col-12 text-center">
                    <a href="{{ route('all-product') }}" class="discover_more_btn">Discover More</a>
                </div>
            </div>
        </div>
    </section>
    {{-- ============================================= All Product Section End ==================================== --}}

    {{-- ============================================= Best seller Section Start ==================================== --}}
    <section class="best_seller_section py-5">
        <div class="container-fluid">
            <div class="row justify-content-between mb-3 align-items-center">
                <div class="col">
                    <p class="text-uppercase heading-font mb-0 ">Best Seller</p>
                </div>
                <div class="col text-end">
                    <a href="" class="link-normal p-2  discover_more_btn">Discover More</a>
                </div>
            </div>

            <div class="row g-2">
                <div class="col-3">
                    <a href="/product/detail" class="text-decoration-none">
                        <div class="product_card">
                            <div class="product_img">
                                <img src="https://bluorng.com/cdn/shop/files/WHITE_WILD_BUNCH_FRONT_FLYING.jpg?v=1738932437&width=360"
                                    alt="" class="img-fluid">
                            </div>
                            <div class="product_info p-3">
                                <h3 class="product_title">
                                    The Clash T-shirt
                                </h3>
                                <p class="product_price mb-0 text-muted">
                                    RS. 4,995
                                </p>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-3">
                    <a href="/product/detail" class="text-decoration-none">
                        <div class="product_card">

                            <div class="product_img">
                                <img src="https://bluorng.com/cdn/shop/files/BLACKWILDBUNCHFRONTFLYING.jpg?v=1738932421&width=360"
                                    alt="" class="img-fluid">
                            </div>
                            <div class="product_info p-3">
                                <h3 class="product_title">
                                    The Clash T-shirt
                                </h3>
                                <p class="product_price mb-0 text-muted">
                                    RS. 4,995
                                </p>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-3">
                    <a href="/product/detail" class="text-decoration-none">
                        <div class="product_card">

                            <div class="product_img">
                                <img src="https://bluorng.com/cdn/shop/files/hbh_kb.jpg?v=1738849531&width=360"
                                    alt="" class="img-fluid">
                            </div>
                            <div class="product_info p-3">
                                <h3 class="product_title">
                                    The Clash T-shirt
                                </h3>
                                <p class="product_price mb-0 text-muted">
                                    RS. 4,995
                                </p>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-3">
                    <a href="/product/detail" class="text-decoration-none">
                        <div class="product_card">

                            <div class="product_img">
                                <img src="https://bluorng.com/cdn/shop/files/DSC099288.jpg?v=1738849896&width=360"
                                    alt="" class="img-fluid">
                            </div>
                            <div class="product_info p-3">
                                <h3 class="product_title">
                                    The Clash T-shirt
                                </h3>
                                <p class="product_price mb-0 text-muted">
                                    RS. 4,995
                                </p>
                            </div>
                        </div>
                    </a>
                </div>
            </div>

            <div class="row py-4">
                <div class="col-12 text-center">
                    <a href="" class="discover_more_btn">Discover More</a>
                </div>
            </div>
        </div>
    </section>
    {{-- ============================================= Best Seller Section End ==================================== --}}




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


    {{-- ============================================= Blogs Section Start ==================================== --}}
    <section class="blogs_section py-5">
        <div class="container-fluid">
            <div class="row justify-content-between mb-3 align-items-center">
                <div class="col">
                    <p class="text-uppercase heading-font mb-0">Latest Blogs</p>
                </div>
                <div class="col text-end">
                    <a href="" class="link-normal p-2  discover_more_btn">Discover More</a>
                </div>
            </div>

            <div class="row g-2">
                <div class="col-3">
                    <div class="blog_card">
                        <div class="product_img">
                            <img src="https://bluorng.com/cdn/shop/files/WHITE_WILD_BUNCH_FRONT_FLYING.jpg?v=1738932437&width=360"
                                alt="" class="img-fluid">
                        </div>
                        <div class="blog_info p-3">
                            <h3 class="blog_title">
                                The Clash T-shirt
                            </h3>
                            <p class="blog_short_desc mb-0 text-muted">
                                Lorem ipsum dolor sit amet consectetur adipisicing elit. Veritatis, at?
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-3">
                    <div class="blog_card">

                        <div class="product_img">
                            <img src="https://bluorng.com/cdn/shop/files/BLACKWILDBUNCHFRONTFLYING.jpg?v=1738932421&width=360"
                                alt="" class="img-fluid">
                        </div>
                        <div class="blog_info p-3">
                            <h3 class="blog_title">
                                The Clash T-shirt
                            </h3>
                            <p class="blog_short_desc mb-0 text-muted">
                                Lorem ipsum dolor, sit amet consectetur adipisicing elit. Non, aspernatur!
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-3">
                    <div class="blog_card">

                        <div class="product_img">
                            <img src="https://bluorng.com/cdn/shop/files/hbh_kb.jpg?v=1738849531&width=360" alt=""
                                class="img-fluid">
                        </div>
                        <div class="blog_info p-3">
                            <h3 class="blog_title">
                                The Clash T-shirt
                            </h3>
                            <p class="blog_short_desc mb-0 text-muted">
                                Lorem ipsum dolor, sit amet consectetur adipisicing elit. Non, aspernatur!
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-3">
                    <div class="blog_card">
                        <div class="product_img">
                            <img src="https://bluorng.com/cdn/shop/files/DSC099288.jpg?v=1738849896&width=360"
                                alt="" class="img-fluid">
                        </div>
                        <div class="blog_info p-3">
                            <h3 class="blog_title">
                                The Clash T-shirt
                            </h3>
                            <p class="blog_short_desc mb-0 text-muted">
                                Lorem ipsum dolor, sit amet consectetur adipisicing elit. Non, aspernatur!
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row py-4">
                <div class="col-12 text-center">
                    <a href="" class="discover_more_btn">Discover More</a>
                </div>
            </div>
        </div>
    </section>
    {{-- ============================================= Best Seller Section End ==================================== --}}

    {{-- ============================================= Newsletter Section ==================================== --}}
    <section class="newsletter_section py-5 primary-bg">
        <div class="container-fluid py-5">
            <div class="row justify-content-center">
                <div class="col-6">
                    <div class="newsletter_content text-center">
                        <h3 class="newsletter
                            title">Subscribe to our Newsletter</h3>
                        <p class="newsletter_desc text-normal">Sign up for our weekly
                            newsletter to get the
                            latest news, updates and amazing offers delivered directly in your inbox.</p>
                        <form action="" class="newsletter_form">
                            <div class="input-group">
                                <input type="email" class="form-control p-2 px-3" placeholder="Enter your email">
                                <button class="btn subscribe_btn border-start">Subscribe</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    {{-- ============================================= Newsletter Section End ==================================== --}}


    <!-- Login Modal -->
    <div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="loginModalLabel">Login</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="loginForm" action="{{ route('login') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="email" class="form-label">Phone Number</label>
                            <input type="number" class="form-control" min="0" name="phone" required>
                        </div>
                        <button type="submit" class="w-100 login_btn">Login</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var loginModalEl = document.getElementById('loginModal');
            var loginModal = new bootstrap.Modal(loginModalEl);
            var modalClosedDate = localStorage.getItem("loginModalClosedDate");
            var today = new Date().toDateString();

            // Show the login modal if it hasn't been closed today
            if (modalClosedDate !== today) {
                loginModal.show();
            }

            // When the modal is closed, record today's date
            loginModalEl.addEventListener('hidden.bs.modal', function() {
                localStorage.setItem("loginModalClosedDate", today);
            });
        });
    </script>

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
            autoplay: {
                delay: 5000,
                disableOnInteraction: false,
            },
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
        });
        // Get navigation arrow elements
        var nextArrow = document.querySelector('.swiper-button-next');
        var prevArrow = document.querySelector('.swiper-button-prev');

        // Initially hide the navigation arrows
        if (nextArrow && prevArrow) {
            nextArrow.style.opacity = 0;
            prevArrow.style.opacity = 0;
        }

        // Show arrows only on hover
        var swiperContainer = document.querySelector('.swiper-container');
        swiperContainer.addEventListener('mouseenter', function() {
            nextArrow.style.opacity = 1;
            prevArrow.style.opacity = 1;
        });
        swiperContainer.addEventListener('mouseleave', function() {
            nextArrow.style.opacity = 0;
            prevArrow.style.opacity = 0;
        });
    </script>

@endsection
