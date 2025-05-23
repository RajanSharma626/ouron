@extends('frontend.layouts.app')

@section('title', 'About Us')

@section('content')

    <section class="product_detail py-3 py-md-5">
        <div class="container py-md-5">

            {{-- <div class="row">
                <div class="col-12">
                    <h1 class="text-center mb-md-5 fs-3 fw-bolder">ABOUT US</h1>
                </div>
            </div> --}}
            <div class="row">
                <div class="col-12 col-md-6 px-md-5">
                    <img src="{{ asset('images/about/about-us.webp') }}" class="img-fluid" alt="about-us">
                </div>
                <div class="col-12 col-md-6">
                    <h1 class="fs-3 d-block text-center mt-3 d-md-none mb-3">ABOUT US</h1>
                    <h1 class="fs-3 d-none d-md-block mb-3">ABOUT US</h1>
                    <p>
                        <b>Ouron — Where Clothing Becomes a Conversation</b>
                    </p>

                    <p>
                        What if your clothes didn’t just match your vibe — but told your story?
                    </p>

                    <p class="text-normal mb-4 mt-3 mt-md-0">
                        At <b>Ouron</b>, we’re not just designing clothing — we’re creating a new language of
                        self-expression.
                        Inspired by real people and real struggles, each design is a living story stitched into fabric. A
                        reminder of the power of resilience, belief, and becoming.
                    </p>

                    <p class="text-normal mb-4">
                        The name <b>Ouron</b> comes from “Our Own” — because your story, your fight, and your dreams are
                        entirely yours. We exist to celebrate that.
                    </p>
                    <p class="text-normal mb-4">
                        <b>"People pay millions for art (like paintings or photographs) because of the story behind it. So
                            why
                            don’t our clothes have a story? They’re with us every day, expressing our identity silently.
                            That’s
                            what we want to change."</b>
                        <br>
                        — Smit Anghan, Founder of Ouron
                    </p>

                    <p>
                        This isn’t fashion that fades with seasons. <br>
                        This is meaning you can wear. <br>
                        <b>This is Ouron. Crafted from stories. Built to speak.</b>
                    </p>

                </div>

            </div>

        </div>

        {{-- ============================================= Marquee Section Start ==================================== --}}
        <section class="marquee-section">
            {{-- <div class="marquee">
                <div class="text-track mb-0 w-100">
                    100% Made With Indian Pride &nbsp;&nbsp;&nbsp; | &nbsp;&nbsp;&nbsp; Free Shipping | &nbsp;&nbsp;&nbsp; COD
                    Available &nbsp;&nbsp;&nbsp; | &nbsp;&nbsp;&nbsp; 7-Day Easy Returns
                </div>
            </div> --}}

            <div class="marquee_container">
                <div class="marquee">
                    <p>100% Made With Indian Pride </p>
                    <p>|</p>
                    <p>Free Shipping</p>
                    <p>|</p>
                    <p>COD Available</p>
                    <p>|</p>
                    <p>7-Day Easy Returns</p>
                    <p>|</p>
                </div>
                <div class="marquee">
                    <p>100% Made With Indian Pride </p>
                    <p>|</p>
                    <p>Free Shipping</p>
                    <p>|</p>
                    <p>COD Available</p>
                    <p>|</p>
                    <p>7-Day Easy Returns</p>
                    <p>|</p>
                </div>
                <div class="marquee">
                    <p>100% Made With Indian Pride </p>
                    <p>|</p>
                    <p>Free Shipping</p>
                    <p>|</p>
                    <p>COD Available</p>
                    <p>|</p>
                    <p>7-Day Easy Returns</p>
                    <p>|</p>
                </div>
            </div>
        </section>
        {{-- ============================================= Marquee Section End ==================================== --}}
    </section>

@endsection
