@extends('frontend.layouts.app')

@section('title', 'Wishlist - Ouron')

@section('content')

    <section class="product_detail">
        <div class="container-fluid py-5">

            <div class="row justify-content-between mb-3 align-items-center">
                <div class="col">
                    <p class="text-uppercase heading-font mb-0">Wishlist</p>
                </div>
            </div>

            <div class="row">
                @forelse ($wishlist as $product)
                    @php
                        $imageBasePath = asset('uploads/products/');
                        $filename = basename($product->product_image ?? 'default.jpg');
                        $secondfilename = basename($product->hover_image ?? $filename);
                    @endphp

                    <div class="col-6 col-md-3" data-aos="fade-up">
                        <a href="{{ route('product.detail', $product->slug) }}" class="text-decoration-none">
                            <div class="product_card">
                                <div class="product_img position-relative">

                                    <!-- Default Image -->
                                    <picture>
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
                                        <img src="{{ $imageBasePath . '/' . $filename }}" alt="{{ $product->name }}"
                                            class="img-fluid default_img">
                                    </picture>

                                    <!-- Hover Image -->
                                    <picture>
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
                                        <img src="{{ $imageBasePath . '/' . $secondfilename }}" alt="{{ $product->name }}"
                                            class="img-fluid hover_img">
                                    </picture>

                                    <!-- Icons -->
                                    <div class="product_icons position-absolute top-0 end-0 p-2">
                                        <!-- Add to Cart -->
                                        <a href="javascript:void(0)" class="cart_icon add-to-cart"
                                            data-id="{{ $product->id }}" data-name="{{ $product->name }}"
                                            data-price="{{ number_format($product->price - ($product->price * $product->discount_price) / 100, 2) }}"
                                            data-image="{{ $imageBasePath . '/' . $secondfilename }}">
                                            <i class="bi bi-handbag"></i>
                                        </a>

                                        <!-- Wishlist -->
                                        <a href="javascript:void(0)" class="like_icon wishlist-btn"
                                            data-id="{{ $product->id }}" title="Remove from Wishlist">
                                            <i class="bi bi-heart-fill text-danger"></i>
                                        </a>
                                    </div>
                                </div>

                                <div class="product_info p-3">
                                    <h3 class="product_title">{{ $product->name }}</h3>
                                    <p class="product_price mb-0 text-muted">
                                        <del>RS. {{ number_format($product->price, 2) }}</del>
                                        &nbsp; RS.
                                        {{ number_format($product->price - ($product->price * $product->discount_price) / 100, 2) }}
                                    </p>
                                </div>
                            </div>
                        </a>
                    </div>
                @empty
                    <p class="text-center text-muted">No items in your wishlist.</p>
                @endforelse
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
