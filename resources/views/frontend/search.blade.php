@extends('frontend.layouts.app')

@section('title', 'Search Product - Ouron')

@section('content')

    <section class="product_detail">
        <div class="container-fluid py-5">

            <div class="row justify-content-between mb-3 align-items-center">
                <div class="col">
                    <p class="text-uppercase heading-font mb-0">Search "{{ $query }}"</p>
                </div>
            </div>

            <div class="row mb-4 align-items-center flex-row-reverse">
                <div class="col-md-6 d-none d-md-block text-end">
                    <span class="me-3 text-muted fs-07rem text-end">Showing {{ $products->count() }} Products</span>
                </div>

                <div class="col-12 text-center d-md-none mt-3">
                    <span class="me-3 text-muted fs-07rem">Showing {{ $products->count() }} Products</span>
                </div>
            </div>

            <div class="row g-2">
                {{-- Loop through the products --}}
                @foreach ($products as $product)
                    @php
                        $firstImage = $product->firstimage;
                        $filename = basename($firstImage->img ?? '');
                        $imageBasePath = asset('uploads/products/');

                        $secondimage = $product->secondimage;
                        $secondfilename = basename($secondimage->img ?? '');

                        $totalStock = $product->variants->sum('stock');
                    @endphp

                    <div class="col-6 col-md-3" data-aos="fade-up">
                        <a href="{{ route('product.detail', $product->slug) }}" class="text-decoration-none">
                            <div class="product_card">
                                <div class="product_img position-relative">
                                    <div class="{{ $totalStock == 0 ? 'opacity-50' : '' }}">
                                        <picture class="">
                                            <!-- Desktop: Original high-quality image -->
                                            <source srcset="{{ $imageBasePath . '/' . $filename }}"
                                                media="(min-width: 768px)">
                                            <!-- Mobile: Compressed but high-quality image -->
                                            <source srcset="{{ $imageBasePath . '/mobile_' . $filename }}"
                                                media="(max-width: 767px)">
                                            <!-- Fallback -->
                                            <img src="{{ $imageBasePath . '/' . $filename }}" alt="{{ $product->name }}"
                                                class="img-fluid" loading="lazy">

                                        </picture>

                                        <picture class="">
                                            <!-- Desktop: Original high-quality image -->
                                            <source srcset="{{ $imageBasePath . '/' . $secondfilename }}"
                                                media="(min-width: 768px)">
                                            <!-- Mobile: Compressed but high-quality image -->
                                            <source srcset="{{ $imageBasePath . '/mobile_' . $secondfilename }}"
                                                media="(max-width: 767px)">
                                            <!-- Fallback -->
                                            <img src="{{ $imageBasePath . '/' . $secondfilename }}"
                                                alt="{{ $product->name }}" class="img-fluid hover_img" loading="lazy">
                                        </picture>
                                    </div>
                                    <!-- Icons (Positioned correctly) -->
                                    <div class="product_icons position-absolute top-0 end-0 p-2">
                                        @if ($totalStock != 0)
                                            <a href="javascript:void(0)" class="cart_icon add-to-cart"
                                                title="Add to Cart" data-id="{{ $product->id }}"
                                                data-name="{{ $product->name }}"
                                                data-price="{{ number_format($product->discount_price, 2) }}"
                                                data-image="{{ $imageBasePath . '/' . $secondfilename }}"
                                                alt="{{ $product->name }}">
                                                <i class="bi bi-handbag"></i>
                                            </a>
                                        @endif
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
                                    @if ($totalStock == 0)
                                        <div class="out_of_stock position-absolute top-0 start-0 p-2">
                                            <button class="out_of_stocl btn primary-bg text-white btn-sm">
                                                Out of Stock
                                            </button>
                                        </div>
                                    @endif
                                </div>
                                <a href="{{ route('product.detail', $product->slug) }}" class="text-decoration-none">
                                    <div class="product_info p-3">
                                        <h3 class="product_title primary-color">{{ $product->name }}</h3>
                                        <p
                                            class="product_price mb-0 text-muted d-flex align-items-center justify-content-between">
                                            <span>

                                                <del>RS. {{ number_format($product->price, 2) }}</del>
                                                &nbsp; RS.
                                                {{ number_format($product->discount_price, 2) }}
                                            </span>
                                            @php
                                                $totalStock = $product->variants->sum('stock');
                                            @endphp
                                            @if ($totalStock <= 5 && $totalStock > 0)
                                                <span class="text-danger fw-bold "> {{ $totalStock }} left</span>
                                            @endif
                                        </p>
                                    </div>
                                </a>
                            </div>
                        </a>
                    </div>
                @endforeach
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
