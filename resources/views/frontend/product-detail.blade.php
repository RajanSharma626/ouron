@section('openGraph')
    <meta name="description" content="{{ $product->meta_description }}">
    <meta name="keywords" content="{{ $product->meta_keywords }}">
    <meta property="og:title" content="{{ $product->name }}" />
    <meta property="og:description" content="{{ $product->meta_description }}" />
    <meta property="og:image" content="{{ asset($product->firstimage->img) }}" />
    <meta property="og:url" content="{{ route('product.detail', $product->slug) }}" />
    <meta property="og:type" content="product" />
    <meta property="og:site_name" content="Ouron" />
    <meta property="og:locale" content="en_US" />
    <meta property="og:locale:alternate" content="en_IN" />
    <meta property="og:image:alt" content="{{ $product->name }}" />
    <meta property="og:image:type" content="image/jpeg" />
    <meta property="og:image:type" content="image/jpg" />
    <meta property="og:image:type" content="image/png" />
    <meta property="og:image:type" content="image/webp" />
    <meta property="og:image:secure_url" content="{{ asset($product->firstimage->img) }}" />
    <meta property="og:updated_time" content="{{ $product->updated_at }}" />
    <meta property="og:price:amount"
        content="{{ number_format($product->price - ($product->price * $product->discount_price) / 100, 2) }}" />
    <meta property="og:price:currency" content="INR" />
    <meta property="og:availability" content="in stock" />
@endsection


@extends('frontend.layouts.app')

@section('title', 'Product Detail page')

@section('content')

    <section class="product_detail  py-md-5">
        <div class="container-fluid px-md-5">
            <div class="row">
                <div class="col-md-6 col-lg-7 col-12 px-0 px-md-3" style="position: relative">
                    <div class="row product_images d-none d-md-flex">
                        @foreach ($product->productImg as $image)
                            @php
                                $filename = basename($image->img ?? '');
                                $imageBasePath = asset('uploads/products/');

                                $totalStock = $product->variants->sum('stock');
                            @endphp

                            <div class="col-lg-6 col-12 p-1">
                                <picture>
                                    <!-- Desktop: Original high-quality image -->
                                    <source srcset="{{ $imageBasePath . '/' . $filename }}" media="(min-width: 768px)">
                                    <!-- Mobile: Compressed but high-quality image -->
                                    <source srcset="{{ $imageBasePath . '/mobile_' . $filename }}"
                                        media="(max-width: 767px)">
                                    <!-- Fallback -->
                                    <img src="{{ $imageBasePath . '/' . $filename }}" alt="{{ $product->name }}"
                                        class="img-fluid" loading="lazy">

                                </picture>
                            </div>
                        @endforeach

                        <div style="position: absolute; top: 10px; right: 10px;">
                            <div class="product_icons">
                                <a href="javascript:void(0)" class="share_icon primary-bg" title="Share" id="shareBtn">
                                    <i class="bi bi-upload text-white"></i>
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="swiper product-swiper d-md-none">
                        <div class="swiper-wrapper">
                            @foreach ($product->productImg as $image)
                                @php
                                    $filename = basename($image->img ?? '');
                                    $imageBasePath = asset('uploads/products/');
                                @endphp

                                <div class="swiper-slide">
                                   <picture>
                                    <!-- Desktop: Original high-quality image -->
                                    <source srcset="{{ $imageBasePath . '/' . $filename }}" media="(min-width: 768px)">
                                    <!-- Mobile: Compressed but high-quality image -->
                                    <source srcset="{{ $imageBasePath . '/mobile_' . $filename }}"
                                        media="(max-width: 767px)">
                                    <!-- Fallback -->
                                    <img src="{{ $imageBasePath . '/' . $filename }}" alt="{{ $product->name }}"
                                        class="img-fluid" loading="lazy">

                                </picture>
                                </div>
                            @endforeach
                        </div>
                        <!-- Add Pagination -->
                        <div class="swiper-pagination"></div>

                        <div class="d-md-none" style="position: absolute; bottom: 50px; right: 10px; z-index: 1050;">
                            <div class="product_icons">
                                <a href="javascript:void(0)" class="share_icon " title="Share" id="shareBtn2">
                                    <i class="bi bi-upload"></i>
                                </a>
                            </div>
                        </div>
                    </div>


                </div>
                <div class="col-md-6 col-lg-5 col-12 p-md-5 py-4 py-md-0">
                    <div class="row justify-content-between align-items-center">

                        <div class="col-10">
                            <h1 class="fs-6 mb-0 fw-bold">{{ $product->name }}</h1>
                            <h1 class="fs-6 mb-0 fw-bold mb-2">{{ $product->category->name ?? '' }} |
                                {{ $product->collection->name ?? '' }}</h1>
                        </div>

                        <div class="modal fade" id="sizeChart" tabindex="-1" aria-labelledby="sizeChartLabel"
                            aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header border-0">
                                        <h1 class="modal-title fs-5" id="sizeChartLabel">Size Chart</h1>
                                    </div>
                                    <div class="modal-body">
                                        <img src="{{ asset($product->category->image) }}" class="img-fluid"
                                            alt="">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col text-end">
                            <div class="like-heart">
                                {{-- <i class="bi bi-heart fs-3 outline-heart"></i>
                                <i class="bi bi-heart-fill fs-3 text-danger filled-heart"></i> --}}

                                @auth
                                    <a href="javascript:void(0)" class="like_icon wishlist-btn2"
                                        data-id="{{ $product->id }}" title="Add to Wishlist">
                                        @if ($product->liked)
                                            <i class="bi bi-heart-fill fs-3 text-danger"></i>
                                        @else
                                            <i class="bi bi-heart fs-3 text-black"></i>
                                        @endif
                                    </a>
                                @endauth

                                @guest
                                    <a href="{{ route('login') }}" class="like_icon" title="Add to Wishlist">
                                        <i class="bi bi-heart fs-3 text-black"></i>
                                    </a>
                                @endguest
                            </div>
                        </div>
                    </div>

                    <h5>
                        <del>RS. {{ number_format($product->price, 2) }}</del>
                        &nbsp; RS.
                        {{ number_format($product->discount_price, 2) }}
                    </h5>
                    <p class="text-muted fs-12 mb-2">MRP inclusive of all taxes </p>

                    <form action="{{ route('buy.now') }}" method="get">
                        @csrf
                        <input type="hidden" name="id" value="{{ $product->id }}">
                        <div class="row justify-content-between align-items-center mb-2">
                            <div class="row justify-content-between align-items-center mb-2">
                                <div class="col"><b>Color:</b></div>
                            </div>
                            <div class="col-12 d-flex gap-1 py-2">
                                @php
                                    $first_color = 1;
                                @endphp

                                @foreach (json_decode($product->colors, true) as $color)
                                    <div class="color text-center">
                                        <input class="form-check-input d-none" type="radio" name="color"
                                            id="color-{{ $color }}" value="{{ $color }}"
                                            {{ $first_color === 1 ? 'checked' : '' }} required>
                                        <label class="form-check-label color-label" for="color-{{ $color }}">
                                            <span class="color-circle {{ $first_color === 1 ? 'active_color' : '' }}"
                                                style="background-color: {{ $color }};"></span>
                                        </label>
                                    </div>

                                    @php
                                        $first_color++;
                                    @endphp
                                @endforeach
                            </div>

                        </div>

                        <div class="row justify-content-between align-items-center mb-2">
                            <div class="row justify-content-between align-items-center mb-2">
                                <div class="col"><b>Size:</b></div>
                                <div class="col text-end fs-12"><a href="#!" class="primary-color"
                                        data-bs-toggle="modal" data-bs-target="#sizeChart">Size Guide</a>
                                </div>
                            </div>
                            <div class="col-12 d-flex gap-md-3 py-2">
                                @php
                                    $variantStock = $product->variants->pluck('stock', 'size')->toArray();
                                    $sizeList = ['S', 'M', 'L', 'XL', 'XXL'];
                                    $firstAvailable = collect($variantStock)
                                        ->filter(fn($stock) => $stock > 0)
                                        ->keys()
                                        ->first();
                                @endphp

                                @foreach ($sizeList as $size)
                                    @php
                                        $stock = $variantStock[$size] ?? 0;
                                        $isOutOfStock = $stock <= 0;
                                    @endphp

                                    <div class="size text-center {{ $isOutOfStock ? 'opacity-50' : '' }}">
                                        <input class="form-check-input d-none" type="radio" name="size"
                                            id="size-{{ $size }}" value="{{ $size }}"
                                            {{ $isOutOfStock ? 'disabled' : '' }}
                                            {{ $size === $firstAvailable && !$isOutOfStock ? 'checked' : '' }}>
                                        <label class="form-check-label size-label" for="size-{{ $size }}">
                                            <img src="{{ asset('/images/sizes/' . $size . '.png') }}"
                                                class="img-fluid size_img {{ $size === $firstAvailable && !$isOutOfStock ? 'active_size' : '' }}"
                                                alt="{{ $size }}">
                                        </label>
                                    </div>
                                @endforeach
                            </div>


                        </div>


                        <div class="row py-3 g-2">
                            <div class="col-6 mb-md-0">
                                @if ($totalStock > 0)
                                    <button type="button" class="checkout_btn w-100 addToCartBtn" title="Add to Cart"
                                        data-id="{{ $product->id }}">Add to Cart</button>
                                @else
                                    <button type="button" class="checkout_btn w-100 opacity-50" disabled>Add to
                                        Cart</button>
                                @endif
                            </div>
                            <div class="col-6 mb-md-0">
                                <a href="{{ $product->blog ? route('blog.detail', $product->blog->slug) : '#' }}">
                                    <button type="button" class="checkout_btn w-100">WTS?</button>
                                </a>
                            </div>
                            <div class="col-12 mb-md-0">
                                @if ($totalStock > 0)
                                    <button type="submit" class="checkout_btn w-100">Buy Now</button>
                                @else
                                    <button type="button" class="checkout_btn w-100 opacity-50" disabled>Out of
                                        Stock</button>
                                @endif
                            </div>
                        </div>
                    </form>
                    <div class="row">
                        <div class="col-12">
                            <p class="text-normal">
                                <i class="bi bi-info-circle"></i> Delivery Time : 5-7 days
                            </p>
                        </div>
                    </div>

                    <div class="row">
                        <div class="accordion accordion-flush" id="accordionFlushExample">
                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#flush-collapseOne" aria-expanded="false"
                                        aria-controls="flush-collapseOne">
                                        Description
                                    </button>
                                </h2>
                                <div id="flush-collapseOne" class="accordion-collapse collapse"
                                    data-bs-parent="#accordionFlushExample">
                                    <div class="accordion-body transform-none">
                                        {!! $product->description !!}
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#flush-collapseTwo" aria-expanded="false"
                                        aria-controls="flush-collapseTwo">
                                        Detail
                                    </button>
                                </h2>
                                <div id="flush-collapseTwo" class="accordion-collapse collapse"
                                    data-bs-parent="#accordionFlushExample">
                                    <div class="accordion-body transform-none ">{!! $product->detail !!}</div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#flush-collapseThree" aria-expanded="false"
                                        aria-controls="flush-collapseThree">
                                        Shipping & Return
                                    </button>
                                </h2>
                                <div id="flush-collapseThree" class="accordion-collapse collapse"
                                    data-bs-parent="#accordionFlushExample">
                                    <div class="accordion-body transform-none ">{!! $product->shipping_Return !!}</div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>

    <section class="new_arrival_section my-5">
        <div class="container-fluid">
            <div class="row justify-content-between mb-3 align-items-center">
                <div class="col">
                    <p class="text-uppercase mb-0 fw-bold">You may also like</p>
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
    </section>



@endsection

@section('swiper-script')
    <!-- Initialize Swiper -->
    <script>
        var swiper = new Swiper('.product-swiper', {
            loop: false,
            slidesPerView: 1,
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
            },
        });
    </script>

    <script>
        document.getElementById('shareBtn').addEventListener('click', function() {
            const shareData = {
                title: '{{ $product->name }}',
                text: 'Check out this product: {{ $product->name }}',
                url: '{{ route('product.detail', $product->slug) }}'
            };
            if (navigator.share) {
                navigator.share(shareData)
                    .then(() => console.log('Shared successfully'))
                    .catch((error) => console.log('Error sharing', error));
            } else {
                // Fallback: prompt the URL for manual copy
                prompt('Copy this URL to share:', shareData.url);
            }
        });
        document.getElementById('shareBtn2').addEventListener('click', function() {
            const shareData = {
                title: '{{ $product->name }}',
                text: 'Check out this product: {{ $product->name }}',
                url: '{{ route('product.detail', $product->slug) }}'
            };
            if (navigator.share) {
                navigator.share(shareData)
                    .then(() => console.log('Shared successfully'))
                    .catch((error) => console.log('Error sharing', error));
            } else {
                // Fallback: prompt the URL for manual copy
                prompt('Copy this URL to share:', shareData.url);
            }
        });
    </script>

@endsection
