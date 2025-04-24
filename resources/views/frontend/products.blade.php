@extends('frontend.layouts.app')

@section('title', $pageTitle . ' - Ouron')

@section('content')

    <section class="product_detail">
        <div class="container-fluid py-3">
            @if (isset($pageHeading) && isset($pageDesc))
                <div class="row justify-content-center mb-3 align-items-center">
                    <div class="col-md-6 text-center">
                        <div class="heading-logo">
                            <img src="{{ asset($collectionLogo) }}" class="img-fluid" alt="" width="200px">
                        </div>
                        <h4 class="text-uppercase mb-0  text-center">{{ $pageHeading }}</h4>
                        <small class="text-uppercase text-muted">{{ $pageDesc }}</small>
                    </div>
                </div>
            @endif
            <div class="row justify-content-between mb-3 align-items-center">
                <div class="col">
                    <p class="text-uppercase heading-font mb-0">{{ $pageTitle }}</p>
                </div>
            </div>

            <div class="row mb-4 align-items-center flex-row-reverse">
                <div class="col-md-6 d-none d-md-block text-end">
                    <span class="me-3 text-muted fs-07rem text-end">Showing {{ $products->count() }} Products</span>
                </div>
                <div class="col-12 col-md-6 col-md-4">
                    <div class="d-flex align-items-center">
                        <label for="sizeFilter" class="form-label me-2 mb-0 fs-07rem">Filter :</label>
                        <select id="sizeFilter" class="w-auto custom_filter px-3 py-1 fs-07rem"
                            onchange="window.location.href='{{ url()->current() }}?filter=' + this.value">
                            <option value="" {{ request('filter') == '' ? 'selected' : '' }}>All</option>
                            @if (!in_array(Route::currentRouteName(), ['best-seller', 'new.in']))
                                <option value="new-in" {{ request('filter') == 'new-in' ? 'selected' : '' }}>New In</option>
                            @endif
                            @if (!in_array(Route::currentRouteName(), ['best-seller', 'new.in']))
                                <option value="best-seller" {{ request('filter') == 'best-seller' ? 'selected' : '' }}>Best
                                    Seller</option>
                            @endif
                            <option value="high-to-low" {{ request('filter') == 'high-to-low' ? 'selected' : '' }}>Price -
                                High to Low</option>
                            <option value="low-to-high" {{ request('filter') == 'low-to-high' ? 'selected' : '' }}>Price -
                                Low to High</option>
                        </select>
                    </div>
                </div>
                {{-- <div class="col-6 col-md-4">
                    <div class="d-flex align-items-center justify-content-end">

                        <label for="sortBy" class="form-label me-2 mb-0 fs-07rem">Sort by:</label>
                        <select id="sortBy" class="w-auto custom_filter px-3 py-1 fs-07rem">
                            <option value="Featured">Featured</option>
                            <option value="priceAsc">Price: Low to High</option>
                            <option value="priceDesc">Price: High to Low</option>
                        </select>
                    </div>
                </div> --}}

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

                                        <picture class="">
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
                                    </div>
                                    <!-- Icons (Positioned correctly) -->
                                    <div class="product_icons position-absolute top-0 end-0 p-2">
                                        @if ($totalStock != 0)
                                            <a href="javascript:void(0)" class="cart_icon add-to-cart" title="Add to Cart"
                                                data-id="{{ $product->id }}" data-name="{{ $product->name }}"
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
                                            <button class="out_of_stocl btn primary-bg text-white">
                                                Out of Stock
                                            </button>
                                        </div>
                                    @endif
                                </div>
                                <a href="{{ route('product.detail', $product->slug) }}" class="text-decoration-none">
                                    <div class="product_info p-3">
                                        <h3 class="product_title primary-color">{{ $product->name }}</h3>
                                        <p class="product_price mb-0 text-muted">
                                            <del>RS. {{ number_format($product->price, 2) }}</del>
                                            &nbsp; RS.
                                            {{ number_format($product->discount_price, 2) }}
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
                    100% Made With Indian Pride &nbsp;&nbsp;&nbsp; |
                    &nbsp;&nbsp;&nbsp; Free Shipping
                    | &nbsp;&nbsp;&nbsp; COD Available &nbsp;&nbsp;&nbsp; | &nbsp;&nbsp;&nbsp; 7-Day Easy Returns
                </marquee>
            </div>
        </section>
        {{-- ============================================= Marquee Section End ==================================== --}}
    </section>

@endsection
