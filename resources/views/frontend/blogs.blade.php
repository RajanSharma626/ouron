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
                            WTS? Every tee tells a tale. Discover where we reveal the inspiration behind each piece—because
                            every journey deserves to be celebrated.
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
                                                <h3 class="blog_title mb-2">
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
