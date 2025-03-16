@extends('frontend.layouts.app')

@section('title', 'Product Detail page')

@section('content')

    <section class="product_detail py-5">
        <div class="container-fluid px-md-5">
            <div class="row">
                <div class="col-md-6 col-lg-7 col-12">
                    <div class="row product_images">
                        <div class="col-lg-6 col-12 p-1">
                            <img src="https://image.hm.com/assets/hm/d8/8a/d88ab4b923cb4fc04a40fe2666634bc69e42df43.jpg?imwidth=564"
                                class="img-fluid" alt="">
                        </div>
                        <div class="col-lg-6 col-12 p-1">
                            <img src="https://lp2.hm.com/hmgoepprod?set=quality%5B79%5D%2Csource%5B%2Fbd%2F35%2Fbd3598007cb7d42cf5fb13cfad985eaf2f082675.jpg%5D%2Corigin%5Bdam%5D%2Ccategory%5B%5D%2Ctype%5BLOOKBOOK%5D%2Cres%5Bm%5D%2Chmver%5B1%5D&call=url[file:/product/main]"
                                alt="" class="img-fluid">
                        </div>
                        <div class="col-lg-6 col-12 p-1">
                            <img src="https://lp2.hm.com/hmgoepprod?set=quality%5B79%5D%2Csource%5B%2Fbd%2F35%2Fbd3598007cb7d42cf5fb13cfad985eaf2f082675.jpg%5D%2Corigin%5Bdam%5D%2Ccategory%5B%5D%2Ctype%5BLOOKBOOK%5D%2Cres%5Bm%5D%2Chmver%5B1%5D&call=url[file:/product/main]"
                                alt="" class="img-fluid">
                        </div>
                        <div class="col-lg-6 col-12 p-1">
                            <img src="https://image.hm.com/assets/hm/d8/8a/d88ab4b923cb4fc04a40fe2666634bc69e42df43.jpg?imwidth=564"
                                class="img-fluid" alt="">
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-5 col-12 p-md-5 py-4 py-md-0">
                    <div class="row justify-content-between align-items-center mb-2">
                        <div class="col">
                            <h1 class="fs-4 mb-0 fw-bold">Loose Fit Shirt</h1>
                        </div>

                        <div class="col text-end">
                            <div class="like-heart">
                                <i class="bi bi-heart fs-3 outline-heart"></i>
                                <i class="bi bi-heart-fill fs-3 text-danger filled-heart"></i>
                            </div>
                        </div>
                    </div>
                    <h5>Rs. 2,999.00</h5>
                    <p class="text-muted">MRP inclusive of all taxes </p>

                    <div class="row justify-content-between align-items-center mb-2">
                        <div class="row justify-content-between align-items-center mb-2">
                            <div class="col"><b>Color:</b></div>
                        </div>
                        <div class="col-12 d-flex gap-1">
                            <div class="color">
                                <input class="form-check-input d-none" type="radio" name="color" id="color-red"
                                    value="red">
                                <label class="form-check-label" for="color-red">
                                    <span class="color-circle" style="background-color: #ff0000;"></span>
                                </label>
                            </div>
                            <div class="color">
                                <input class="form-check-input d-none" type="radio" name="color" id="color-blue"
                                    value="blue">
                                <label class="form-check-label" for="color-blue">
                                    <span class="color-circle" style="background-color: #0000ff;"></span>
                                </label>
                            </div>
                            <div class="color">
                                <input class="form-check-input d-none" type="radio" name="color" id="color-green"
                                    value="green">
                                <label class="form-check-label" for="color-green">
                                    <span class="color-circle" style="background-color: #008000;"></span>
                                </label>
                            </div>
                            <div class="color">
                                <input class="form-check-input d-none" type="radio" name="color" id="color-yellow"
                                    value="yellow">
                                <label class="form-check-label" for="color-yellow">
                                    <span class="color-circle" style="background-color: #ffff00;"></span>
                                </label>
                            </div>
                        </div>

                    </div>

                    <div class="row justify-content-between align-items-center mb-2">
                        <div class="row justify-content-between align-items-center mb-2">
                            <div class="col"><b>Size:</b></div>
                            <div class="col text-end"><a href="#!" class="primary-color">Size Guide</a></div>
                        </div>
                        <div class="col-12 d-flex gap-3 py-2">
                            <div class="size">
                                <img src="{{ asset('/images/sizes/xs.svg') }}" class="img-fluid size_img" alt="">
                            </div>
                            <div class="size">
                                <img src="{{ asset('/images/sizes/s.svg') }}" class="img-fluid size_img" alt="">
                            </div>
                            <div class="size">
                                <img src="{{ asset('/images/sizes/m.svg') }}" class="img-fluid size_img" alt="">
                            </div>
                            <div class="size">
                                <img src="{{ asset('/images/sizes/l.svg') }}" class="img-fluid size_img" alt="">
                            </div>
                            <div class="size">
                                <img src="{{ asset('/images/sizes/xl.svg') }}" class="img-fluid size_img" alt="">
                            </div>
                            <div class="size">
                                <img src="{{ asset('/images/sizes/xxl.svg') }}" class="img-fluid size_img"
                                    alt="">
                            </div>
                            <div class="size">
                                <img src="{{ asset('/images/sizes/3xl.svg') }}" class="img-fluid size_img"
                                    alt="">
                            </div>
                        </div>
                    </div>


                    <div class="row py-3 g-2">
                        <div class="col-md-6 col-12 mb-md-0">
                            <button class="checkout_btn w-100">Add to Cart</button>
                        </div>
                        <div class="col-md-6 col-12 mb-md-0">
                            <button class="checkout_btn w-100">Story</button>
                        </div>
                        <div class="col-12 mb-md-0">
                            <button class="checkout_btn w-100">Buy Now</button>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <p class="text-normal">
                                <i class="bi bi-info-circle"></i> Delivery Time : 2-7 days
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
                                        Details
                                    </button>
                                </h2>
                                <div id="flush-collapseOne" class="accordion-collapse collapse"
                                    data-bs-parent="#accordionFlushExample">
                                    <div class="accordion-body">Placeholder content for this accordion, which is intended
                                        to
                                        demonstrate the <code>.accordion-flush</code> class. This is the first item's
                                        accordion body.</div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#flush-collapseTwo" aria-expanded="false"
                                        aria-controls="flush-collapseTwo">
                                        Size & Fit
                                    </button>
                                </h2>
                                <div id="flush-collapseTwo" class="accordion-collapse collapse"
                                    data-bs-parent="#accordionFlushExample">
                                    <div class="accordion-body">Placeholder content for this accordion, which is intended
                                        to
                                        demonstrate the <code>.accordion-flush</code> class. This is the second item's
                                        accordion body. Let's imagine this being filled with some actual content.</div>
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
                                    <div class="accordion-body">Placeholder content for this accordion, which is intended
                                        to
                                        demonstrate the <code>.accordion-flush</code> class. This is the third item's
                                        accordion body. Nothing more exciting happening here in terms of content, but just
                                        filling up the space to make it look, at least at first glance, a bit more
                                        representative of how this would look in a real-world application.</div>
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
        </div>
    </section>

@endsection
