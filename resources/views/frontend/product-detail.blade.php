@extends('frontend.layouts.app')

@section('title', 'Product Detail page')

@section('content')

<section>
    
</section>

@endsection


@section('swiper-script')
    <!-- Initialize Swiper -->
    <script>
        var swiper = new Swiper('.swiper-container', {
            loop: true,
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
            },
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
        });
    </script>

@endsection
