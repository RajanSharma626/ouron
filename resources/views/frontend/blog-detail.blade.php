@extends('frontend.layouts.app')

@section('title', $blog->title)

@section('content')

    <section class="blogs">
        <div class="container-fluid">
            <div class="row pb-5">
                <div class="col-12">
                    <h1 class="fs-3  text-center py-3 fw-bold">{{ $blog->title }}</h1>
                </div>
                <div class="col-12 px-0 py-3">
                    <img src="{{ asset($blog->banner_image) }}" class="img-fluid" alt="">
                </div>

                <div class="col-12">
                    <div class="container transform-none ">
                        {!! $blog->blog_content !!}
                    </div>
                </div>

                <div class="col-12">
                    <div class="share-buttons text-center my-3">
                        <a href="javascript:void(0)" class="link-normal fw-bold" id="shareBtn">
                            Explore the Collection Now → [ <a class="primary-color" href="{{ route('product.detail', $blog->product->slug) }}">SHOP NOW</a> ]
                        </a>
                    </div>
                    {{-- <script>
                        document.getElementById('shareBtn').addEventListener('click', async () => {
                            try {
                                if (navigator.share) {
                                    await navigator.share({
                                        title: '{{ $blog->title }}',
                                        text: 'Check out this blog post!',
                                        url: window.location.href
                                    });
                                } else if (navigator.clipboard) {
                                    await navigator.clipboard.writeText(window.location.href);
                                    alert('Link copied to clipboard!');
                                } else {
                                    window.open(window.location.href, '_blank');
                                }
                            } catch (error) {
                                console.error('Error sharing:', error);
                            }
                        });
                    </script> --}}
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
