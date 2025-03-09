@extends('frontend.layouts.app')

@section('title', 'About Us')

@section('content')

    <section class="product_detail py-5">
        <div class="container py-5">
            <div class="row">

                <div class="col-12 col-md-6 px-md-5">
                    <img src="https://cdn.shopify.com/s/files/1/0514/9494/4962/files/DSC00144copy211.jpg?v=1732202229"
                        class="img-fluid" alt="about-us">
                </div>
                <div class="col-12 col-md-6">
                    <h1 class="fs-3 text-center">ABOUT US</h1>
                    <p class="text-normal mb-4">
                        At Ouron, we believe the most inspiring stories aren’t written in books—
                        they’re lived, every single day. From quiet victories to bold leaps, life’s
                        moments define us, and they deserve to be celebrated.
                    </p>
                    <p class="text-normal mb-4">
                        Born from the idea of celebrating individuality and the stories that define us,
                        Ouron stands as a symbol of inspiration. Derived from 'Our Own,' Ouron
                        embraces the silent 'w,' symbolizing the unspoken strength of personal
                        journeys and shared experiences.
                    </p>
                    <p class="text-normal mb-4">
                        Every design is a tribute to resilience, hope, and creativity. It's more than
                        just clothing—it’s a constant reminder to carry your dreams, passions, and
                        triumphs wherever life takes you.
                    </p>
                    <p class="text-normal mb-4">
                        Ouron is not just a brand; it’s a movement. A movement to inspire,
                        empower, and unite. When you wear Ouron, you’re not just wearing
                        fabric—you’re embracing a piece of inspiration and sharing your story with
                        the world.
                    </p>
                </div>

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
