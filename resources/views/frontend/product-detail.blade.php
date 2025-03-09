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
                    <h1 class="fs-4 mb-0">Loose Fit Shirt</h1>
                    <h5>Rs. 2,999.00</h5>
                    <p class="text-muted">MRP inclusive of all taxes </p>

                    <div class="row justify-content-between align-items-center mb-2">
                        <div class="col"><b>Size:</b></div>
                        <div class="col text-end"><a href="#!" class="primary-color">Size Guide</a></div>
                    </div>

                    <div class="row justify-content-start gap-1">
                        <div class="col">
                            <div class="size_box">
                                <span>S</span>
                            </div>
                        </div>
                        <div class="col">
                            <div class="size_box active">
                                <span>M</span>
                            </div>
                        </div>
                        <div class="col">
                            <div class="size_box">
                                <span>L</span>
                            </div>
                        </div>
                        <div class="col">
                            <div class="size_box">
                                <span>XL</span>
                            </div>
                        </div>
                    </div>

                    <div class="row py-3">
                        <div class="col-md-6 col-12 mb-3 mb-md-0">
                            <button class="checkout_btn w-100">Add to Cart</button>
                        </div>
                        <div class="col-md-6 col-12 mb-3 mb-md-0">
                            <button class="checkout_btn w-100">Buy Now</button>
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
                                    <div class="accordion-body">Placeholder content for this accordion, which is intended to
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
                                    <div class="accordion-body">Placeholder content for this accordion, which is intended to
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
                                    <div class="accordion-body">Placeholder content for this accordion, which is intended to
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

@endsection
