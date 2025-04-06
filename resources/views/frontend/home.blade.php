@extends('frontend.layouts.app')

@section('title', 'Welcome to Quron eCommerce')

@section('content')

    {{-- ============================================= Banner Section Start ==================================== --}}
    <section class="banner-section">
        <div class="container-fluid p-0">
            <div class="swiper swiper-container">
                <div class="swiper-wrapper">
                    <div class="swiper-slide">
                        <a href="">
                            <img src="{{ asset('images/banner/banner.webp') }}" class="img-fluid d-none d-md-block"
                                alt="Slide 1">
                            <img src="https://prod-img.thesouledstore.com/public/theSoul/storage/mobile-cms-media-prod/banner-images/App_Banner_VkEP24P.jpg?format=webp&w=768&dpr=2.0"
                                class="img-fluid d-md-none" alt="Slide 1">
                        </a>
                    </div>
                    <div class="swiper-slide">
                        <a href="">
                            <img src="{{ asset('images/banner/banner-2.webp') }}" class="img-fluid d-none d-md-block"
                                alt="Slide 2">
                            <img src="https://prod-img.thesouledstore.com/public/theSoul/storage/mobile-cms-media-prod/banner-images/APP-BANNER_1_ZjJAKiL.jpg?format=webp&w=768&dpr=2.0"
                                class="img-fluid d-md-none" alt="Slide 2">
                        </a>
                    </div>
                    <div class="swiper-slide">
                        <a href="">
                            <img src="{{ asset('images/banner/banner-3.webp') }}" class="img-fluid d-none d-md-block"
                                alt="Slide 3">
                            <img src="https://prod-img.thesouledstore.com/public/theSoul/storage/mobile-cms-media-prod/banner-images/summer-app-banner_zIaYRHS.jpg?format=webp&w=768&dpr=2.0"
                                class="img-fluid d-md-none" alt="Slide 3">
                        </a>
                    </div>
                </div>
                <!-- Add Pagination -->
                <div class="swiper-pagination"></div>
                <!-- Add Navigation -->
                {{-- <div class="custom-swiper-button swiper-button-next"></div>
                <div class="custom-swiper-button swiper-button-prev"></div> --}}
            </div>
        </div>
    </section>
    {{-- ============================================= Banner Section End ==================================== --}}


    {{-- ============================================= New Arrival Section Start ==================================== --}}
    <section class="new_arrival_section mt-md-5 mt-3">
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

                @foreach ($newProducts as $product)
                    @php
                        $firstImage = $product->firstimage;
                        $filename = basename($firstImage->img ?? '');
                        $imageBasePath = asset('uploads/products/');

                        $secondimage = $product->secondimage;
                        $secondfilename = basename($secondimage->img ?? '');
                    @endphp

                    <div class="col-6 col-md-3" data-aos="fade-up">
                        <a href="{{ route('product.detail', $product->slug) }}" class="text-decoration-none">
                            <div class="product_card">
                                <div class="product_img position-relative">
                                    <picture>
                                        <!-- High-quality image for fast connections -->
                                        <source srcset="{{ $imageBasePath . '/' . $filename }}" media="(min-width: 1400px)">
                                        <source srcset="{{ $imageBasePath . '/' . $filename }}" media="(min-width: 1200px)">
                                        <source srcset="{{ $imageBasePath . '/940_' . $filename }}"
                                            media="(min-width: 992px)">
                                        <source srcset="{{ $imageBasePath . '/720_' . $filename }}"
                                            media="(min-width: 768px)">
                                        <source srcset="{{ $imageBasePath . '/533_' . $filename }}"
                                            media="(min-width: 576px)">
                                        <source srcset="{{ $imageBasePath . '/360_' . $filename }}"
                                            media="(max-width: 575px)">
                                        <source srcset="{{ $imageBasePath . '/165_' . $filename }}"
                                            media="(max-width: 400px)">

                                        <!-- Original image as fallback -->
                                        <img src="{{ $imageBasePath . '/' . $filename }}" alt="{{ $product->name }}"
                                            class="img-fluid">
                                    </picture>

                                    <picture>
                                        <!-- High-quality image for fast connections -->
                                        <source srcset="{{ $imageBasePath . '/' . $secondfilename }}"
                                            media="(min-width: 1400px)">
                                        <source srcset="{{ $imageBasePath . '/' . $secondfilename }}"
                                            media="(min-width: 1200px)">
                                        <source srcset="{{ $imageBasePath . '/940_' . $secondfilename }}"
                                            media="(min-width: 992px)">
                                        <source srcset="{{ $imageBasePath . '/720_' . $secondfilename }}"
                                            media="(min-width: 768px)">
                                        <source srcset="{{ $imageBasePath . '/533_' . $secondfilename }}"
                                            media="(min-width: 576px)">
                                        <source srcset="{{ $imageBasePath . '/360_' . $secondfilename }}"
                                            media="(max-width: 575px)">
                                        <source srcset="{{ $imageBasePath . '/165_' . $secondfilename }}"
                                            media="(max-width: 400px)">

                                        <!-- Original image as fallback -->
                                        <img src="{{ $imageBasePath . '/' . $secondfilename }}" alt="{{ $product->name }}"
                                            class="img-fluid hover_img">
                                    </picture>

                                    <!-- Icons (Positioned correctly) -->
                                    <div class="product_icons position-absolute top-0 end-0 p-2">

                                        <a href="javascript:void(0)" class="cart_icon add-to-cart" title="Add to Cart"
                                            data-id="{{ $product->id }}" data-name="{{ $product->name }}"
                                            data-price="{{ number_format($product->price - ($product->price * $product->discount_price) / 100, 2) }}"
                                            data-image="{{ $imageBasePath . '/' . $secondfilename }}"
                                            alt="{{ $product->name }}">
                                            <i class="bi bi-handbag"></i>
                                        </a>

                                        @guest
                                            <a href="{{ route('login') }}" class="like_icon" title="Add to Wishlist">
                                                <i class="bi bi-heart"></i>
                                            </a>
                                        @endguest

                                        @auth
                                            <a href="javascript:void(0)" class="like_icon wishlist-btn"
                                                data-id="{{ $product->id }}" title="Add to Wishlist">

                                                @if ($product->liked)
                                                    <i class="bi bi-heart-fill text-danger"></i>
                                                @else
                                                    <i class="bi bi-heart"></i>
                                                @endif
                                            </a>
                                        @endauth
                                    </div>
                                </div>
                                <a href="{{ route('product.detail', $product->slug) }}" class="text-decoration-none">
                                    <div class="product_info p-3">
                                        <h3 class="product_title primary-color">{{ $product->name }}</h3>
                                        <p class="product_price mb-0 text-muted">
                                            <del>RS. {{ number_format($product->price, 2) }}</del>
                                            &nbsp; RS.
                                            {{ number_format($product->price - ($product->price * $product->discount_price) / 100, 2) }}
                                        </p>
                                    </div>
                                </a>
                            </div>
                        </a>
                    </div>
                @endforeach

            </div>

            <div class="row py-4">
                <div class="col-12 text-center">
                    <a href="{{ route('new.in') }}" class="discover_more_btn">Discover More</a>
                </div>
            </div>
        </div>
    </section>
    {{-- ============================================= New Arrival Section End ==================================== --}}

    <div class="container-fluid py-md-5">
        <div class="row">
            <div class="col-12 px-0" data-aos="fade-up">
                <a href="">
                    <img src="https://crazymonk.in/cdn/shop/files/Banner_for_Website_front_page_1.jpg?v=1740377697&width=2000"
                        class="img-fluid d-none d-md-block" alt="Slide 1">

                    <img src="https://prod-img.thesouledstore.com/public/theSoul/storage/mobile-cms-media-prod/banner-images/App-banner_exABeVx.jpg?format=webp&w=768&dpr=2.0"
                        class="img-fluid d-md-none" alt="Slide 1">
                </a>
            </div>
        </div>
    </div>


    {{-- ============================================= All Product Section Start ==================================== --}}
    <section class="design_collection_section py-5 pb-0 pb-md-5">
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
                {{-- Loop through the products --}}
                @foreach ($allProducts as $product)
                    @php
                        $firstImage = $product->firstimage;
                        $filename = basename($firstImage->img ?? '');
                        $imageBasePath = asset('uploads/products/');

                        $secondimage = $product->secondimage;
                        $secondfilename = basename($secondimage->img ?? '');
                    @endphp

                    <div class="col-6 col-md-3" data-aos="fade-up">
                        <a href="{{ route('product.detail', $product->slug) }}" class="text-decoration-none">
                            <div class="product_card">
                                <div class="product_img position-relative">
                                    <picture>
                                        <!-- High-quality image for fast connections -->
                                        <source srcset="{{ $imageBasePath . '/' . $filename }}"
                                            media="(min-width: 1400px)">
                                        <source srcset="{{ $imageBasePath . '/' . $filename }}"
                                            media="(min-width: 1200px)">
                                        <source srcset="{{ $imageBasePath . '/940_' . $filename }}"
                                            media="(min-width: 992px)">
                                        <source srcset="{{ $imageBasePath . '/720_' . $filename }}"
                                            media="(min-width: 768px)">
                                        <source srcset="{{ $imageBasePath . '/533_' . $filename }}"
                                            media="(min-width: 576px)">
                                        <source srcset="{{ $imageBasePath . '/360_' . $filename }}"
                                            media="(max-width: 575px)">
                                        <source srcset="{{ $imageBasePath . '/165_' . $filename }}"
                                            media="(max-width: 400px)">

                                        <!-- Original image as fallback -->
                                        <img src="{{ $imageBasePath . '/' . $filename }}" alt="{{ $product->name }}"
                                            class="img-fluid">
                                    </picture>

                                    <picture>
                                        <!-- High-quality image for fast connections -->
                                        <source srcset="{{ $imageBasePath . '/' . $secondfilename }}"
                                            media="(min-width: 1400px)">
                                        <source srcset="{{ $imageBasePath . '/' . $secondfilename }}"
                                            media="(min-width: 1200px)">
                                        <source srcset="{{ $imageBasePath . '/940_' . $secondfilename }}"
                                            media="(min-width: 992px)">
                                        <source srcset="{{ $imageBasePath . '/720_' . $secondfilename }}"
                                            media="(min-width: 768px)">
                                        <source srcset="{{ $imageBasePath . '/533_' . $secondfilename }}"
                                            media="(min-width: 576px)">
                                        <source srcset="{{ $imageBasePath . '/360_' . $secondfilename }}"
                                            media="(max-width: 575px)">
                                        <source srcset="{{ $imageBasePath . '/165_' . $secondfilename }}"
                                            media="(max-width: 400px)">

                                        <!-- Original image as fallback -->
                                        <img src="{{ $imageBasePath . '/' . $secondfilename }}"
                                            alt="{{ $product->name }}" class="img-fluid hover_img">
                                    </picture>

                                    <!-- Icons (Positioned correctly) -->
                                    <div class="product_icons position-absolute top-0 end-0 p-2">

                                        <a href="javascript:void(0)" class="cart_icon add-to-cart" title="Add to Cart"
                                            data-id="{{ $product->id }}" data-name="{{ $product->name }}"
                                            data-price="{{ number_format($product->price - ($product->price * $product->discount_price) / 100, 2) }}"
                                            data-image="{{ $imageBasePath . '/' . $secondfilename }}"
                                            alt="{{ $product->name }}">
                                            <i class="bi bi-handbag"></i>
                                        </a>


                                        @guest
                                            <a href="{{ route('login') }}" class="like_icon" title="Add to Wishlist">
                                                <i class="bi bi-heart"></i>
                                            </a>
                                        @endguest

                                        @auth
                                            <a href="javascript:void(0)" class="like_icon wishlist-btn"
                                                data-id="{{ $product->id }}" title="Add to Wishlist">

                                                @if ($product->liked)
                                                    <i class="bi bi-heart-fill text-danger"></i>
                                                @else
                                                    <i class="bi bi-heart"></i>
                                                @endif
                                            </a>
                                        @endauth
                                    </div>
                                </div>

                                <a href="{{ route('product.detail', $product->slug) }}" class="text-decoration-none">
                                    <div class="product_info p-3">
                                        <h3 class="product_title primary-color">{{ $product->name }}</h3>
                                        <p class="product_price mb-0 text-muted">
                                            <del>RS. {{ number_format($product->price, 2) }}</del>
                                            &nbsp; RS.
                                            {{ number_format($product->price - ($product->price * $product->discount_price) / 100, 2) }}
                                        </p>
                                    </div>
                                </a>
                            </div>
                        </a>
                    </div>
                @endforeach
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
                    <a href="{{ route(name: 'best-seller') }}" class="link-normal p-2  discover_more_btn">Discover
                        More</a>
                </div>
            </div>


            <div class="row g-2">
                @foreach ($bestSellerProducts as $product)
                    @php
                        $firstImage = $product->firstimage;
                        $filename = basename($firstImage->img ?? '');
                        $imageBasePath = asset('uploads/products/');

                        $secondimage = $product->secondimage;
                        $secondfilename = basename($secondimage->img ?? '');
                    @endphp

                    <div class="col-6 col-md-3" data-aos="fade-up">
                        <a href="{{ route('product.detail', $product->slug) }}" class="text-decoration-none">
                            <div class="product_card">
                                <div class="product_img position-relative">
                                    <picture>
                                        <!-- High-quality image for fast connections -->
                                        <source srcset="{{ $imageBasePath . '/' . $filename }}"
                                            media="(min-width: 1400px)">
                                        <source srcset="{{ $imageBasePath . '/' . $filename }}"
                                            media="(min-width: 1200px)">
                                        <source srcset="{{ $imageBasePath . '/940_' . $filename }}"
                                            media="(min-width: 992px)">
                                        <source srcset="{{ $imageBasePath . '/720_' . $filename }}"
                                            media="(min-width: 768px)">
                                        <source srcset="{{ $imageBasePath . '/533_' . $filename }}"
                                            media="(min-width: 576px)">
                                        <source srcset="{{ $imageBasePath . '/360_' . $filename }}"
                                            media="(max-width: 575px)">
                                        <source srcset="{{ $imageBasePath . '/165_' . $filename }}"
                                            media="(max-width: 400px)">

                                        <!-- Original image as fallback -->
                                        <img src="{{ $imageBasePath . '/' . $filename }}" alt="{{ $product->name }}"
                                            class="img-fluid">
                                    </picture>

                                    <picture>
                                        <!-- High-quality image for fast connections -->
                                        <source srcset="{{ $imageBasePath . '/' . $secondfilename }}"
                                            media="(min-width: 1400px)">
                                        <source srcset="{{ $imageBasePath . '/' . $secondfilename }}"
                                            media="(min-width: 1200px)">
                                        <source srcset="{{ $imageBasePath . '/940_' . $secondfilename }}"
                                            media="(min-width: 992px)">
                                        <source srcset="{{ $imageBasePath . '/720_' . $secondfilename }}"
                                            media="(min-width: 768px)">
                                        <source srcset="{{ $imageBasePath . '/533_' . $secondfilename }}"
                                            media="(min-width: 576px)">
                                        <source srcset="{{ $imageBasePath . '/360_' . $secondfilename }}"
                                            media="(max-width: 575px)">
                                        <source srcset="{{ $imageBasePath . '/165_' . $secondfilename }}"
                                            media="(max-width: 400px)">

                                        <!-- Original image as fallback -->
                                        <img src="{{ $imageBasePath . '/' . $secondfilename }}"
                                            alt="{{ $product->name }}" class="img-fluid hover_img">
                                    </picture>

                                    <!-- Icons (Positioned correctly) -->
                                    <div class="product_icons position-absolute top-0 end-0 p-2">

                                        <a href="javascript:void(0)" class="cart_icon add-to-cart" title="Add to Cart"
                                            data-id="{{ $product->id }}" alt="{{ $product->name }}">
                                            <i class="bi bi-handbag"></i>
                                        </a>


                                        @guest
                                            <a href="{{ route('login') }}" class="like_icon" title="Add to Wishlist">
                                                <i class="bi bi-heart"></i>
                                            </a>
                                        @endguest

                                        @auth
                                            <a href="javascript:void(0)" class="like_icon wishlist-btn"
                                                data-id="{{ $product->id }}" title="Add to Wishlist">

                                                @if ($product->liked)
                                                    <i class="bi bi-heart-fill text-danger"></i>
                                                @else
                                                    <i class="bi bi-heart"></i>
                                                @endif
                                            </a>
                                        @endauth
                                    </div>
                                </div>

                                <a href="{{ route('product.detail', $product->slug) }}" class="text-decoration-none">
                                    <div class="product_info p-3">
                                        <h3 class="product_title primary-color">{{ $product->name }}</h3>
                                        <p class="product_price mb-0 text-muted">
                                            <del>RS. {{ number_format($product->price, 2) }}</del>
                                            &nbsp; RS.
                                            {{ number_format($product->price - ($product->price * $product->discount_price) / 100, 2) }}
                                        </p>
                                    </div>
                                </a>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>

            <div class="row py-4">
                <div class="col-12 text-center">
                    <a href="{{ route(name: 'best-seller') }}" class="discover_more_btn">Discover More</a>
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
                    <p class="text-uppercase heading-font mb-0">Latest WTS?</p>
                </div>
                <div class="col text-end">
                    <a href="{{ route('allblogs') }}" class="link-normal p-2  discover_more_btn">Discover More</a>
                </div>
            </div>

            <div class="row g-2">

                @foreach ($blogs as $blog)
                    <div class="col-6 col-md-3" data-aos="fade-up">
                        <a href="{{ route('blog.detail', $blog->slug) }}" class="text-decoration-none">
                            <div class="blog_card">
                                <div class="blog_img">
                                    <img src="{{ asset($blog->cover_image) }}" alt="{{ $blog->title }}"
                                        class="img-fluid">
                                </div>
                                <div class="blog_info p-3">
                                    <h3 class="blog_title">{{ $blog->title }}</h3>
                                    <p class="blog_short_desc mb-0 text-muted">
                                        {{ Str::limit(strip_tags($blog->short_desc), 100) }}
                                    </p>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach

            </div>

            <div class="row py-4">
                <div class="col-12 text-center">
                    <a href="{{ route('allblogs') }}" class="discover_more_btn">Discover More</a>
                </div>
            </div>
        </div>
    </section>
    {{-- ============================================= Best Seller Section End ==================================== --}}

    {{-- ============================================= Newsletter Section ==================================== --}}
    <section class="newsletter_section py-5 primary-bg">
        <div class="container-fluid py-5">
            <div class="row justify-content-center">
                <div class="col-12 col-md-6">
                    <div class="newsletter_content text-center">
                        <h3 class="newsletter title">Subscribe to our Newsletter</h3>
                        <p class="newsletter_desc text-normal">Join the Ouron newsletter for exclusive updates, early
                            drops, and inspiring stories!</p>
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

    @guest
        <!-- Login Modal -->
        <div class="modal fade" id="loginModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
            aria-labelledby="loginModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title fw-bold" id="loginModalLabel">Login</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">

                        <div class="row align-items-center">
                            <div class="col-md-6 p-md-3 mb-3 mb-md-0">
                                <img src="{{ asset('images/banner/ouron-login.png') }}" class="img-fluid" alt="">
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="logo text-center mb-4">
                                    <img src="{{ asset('/images/logo/logo.svg') }}" class="img-fluid" width="150"
                                        alt="logo">
                                </div>
                                <small class="text-muted mb-3 d-block text-center">
                                    Every story begins with a name. Let’s start yours Log in now to unlock exclusive designs,
                                    early drops, and a community that inspires.
                                </small>
                                <form id="loginForm" action="{{ route('login') }}" method="POST">
                                    @csrf
                                    <div class="mb-3">
                                        <input type="text" class="form-control py-2" name="phone"
                                            placeholder="Enter Phone Number" required>
                                    </div>
                                    <button type="submit" class="w-100 login_btn">Send OTP</button>
                                </form>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    @endguest

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
    </script>

@endsection
