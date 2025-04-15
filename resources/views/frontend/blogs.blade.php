@extends('frontend.layouts.app')

@section('title', 'Blogs - Ouron')

@section('content')

    <section class="blogs">
        <div class="container">
            <div class="row py-5">
                <div class="row">
                    <div class="col-12">
                        <h1 class="text-center fs-3 fw-bold">WTS? (What's the Story?)</h1>
                        <p class="text-center mb-5">
                            Every design at Ouron carries more than just style - it carries a story. "WTS?" is where we
                            revieal the inspiration behind each piece. Dicover the story. Feel the legacy. Wear the
                            inspiration.
                        </p>
                    </div>
                    <div class="col-12 py-4">
                        <div class="row align-items-center">
                            @foreach ($blogs as $blog)
                                <div class="col-6 col-md-3">
                                    <a href="{{ route('blog.detail', $blog->slug) }}" class="link-normal">
                                        <div class="blog">
                                            <div class="product_img">
                                                <img src="{{ asset($blog->cover_image) }}" alt="" class="img-fluid">
                                            </div>
                                            <div class="product_info p-2 pb-0">
                                                <h3 class="blog_title">
                                                    {{ $blog->title }}
                                                </h3>
                                                <p class="blog_desc text-muted">
                                                    {{ $blog->short_desc }}
                                                </p>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    </div>

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
