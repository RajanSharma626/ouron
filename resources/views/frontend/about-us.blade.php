@extends('frontend.layouts.app')

@section('title', 'About Us')

@section('content')

    <section class="product_detail py-3 py-md-5">
        <div class="container py-md-5">

            <div class="row">
                <div class="col-12">
                    <h1 class="text-center mb-md-5 fs-3 fw-bolder">ABOUT US</h1>
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-md-6 px-md-5">
                    <img src="https://cdn.shopify.com/s/files/1/0514/9494/4962/files/DSC00144copy211.jpg?v=1732202229"
                        class="img-fluid" alt="about-us">
                </div>
                <div class="col-12 col-md-6">
                    {{-- <h1 class="fs-3 text-center d-none d-md-block">ABOUT US</h1> --}}
                    <p class="text-normal mb-4 mt-3 mt-md-0">
                        At Ouron, we believe fashion is more than just fabric—it's a voice, a statement, a story. Born from
                        the idea of “Our Own” (with the silent ‘w’), Ouron is a lifestyle brand that turns inspiration into
                        wearable art.
                    </p>
                    <p class="text-normal mb-4">
                        Every piece we create carries a spark—of resilience, creativity, and authenticity. We bring stories
                        to life through bold designs crafted for those who dare to stand out.
                    </p>
                    <p class="text-normal mb-4">
                        Our mission is simple: to inspire self-expression and confidence through clothing that speaks louder
                        than words. Because at Ouron, you don't just wear clothes—you wear stories.
                    </p>
                </div>

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
