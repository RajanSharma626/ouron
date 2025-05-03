@extends('frontend.layouts.app')

@section('title', 'FAQ - Ouron')

@section('content')

    <section class="product_detail">
        <div class="container">
            <div class="row">
                <div class="col-12 py-5 ">
                    <h2 class="text-center">FAQ's</h2>
                </div>
                <div class="col-12">
                    <div class="row justify-content-md-evenly ">
                        <div class="col-6 col-md-2">
                            <button class="custom-btn py-2 px-3 custom-active" data-target="faq-product">Product</button>
                        </div>
                        <div class="col-6 col-md-2 mb-3">
                            <button class="custom-btn py-2 px-3" data-target="faq-delivery">Delivery</button>
                        </div>
                        <div class="col-6 col-md-2 mb-3">
                            <button class="custom-btn py-2 px-3" data-target="faq-order">Order</button>
                        </div>
                        <div class="col-6 col-md-2 mb-3">
                            <button class="custom-btn py-2 px-3" data-target="faq-order-received">Order Received</button>
                        </div>
                        <div class="col-6 col-md-2 mb-3">
                            <button class="custom-btn py-2 px-3" data-target="faq-general">General FAQ</button>
                        </div>
                    </div>
                </div>

                <div class="col-12 py-5">
                    <!-- Product FAQ Section -->
                    <div id="faq-product" class="faq-container">
                        <div class="accordion" id="faqAccordionProduct">
                            @foreach ($faqsProduct as $faq)
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="productHeading{{ $loop->index }}">
                                        <button class="accordion-button {{ $loop->first ? '' : 'collapsed' }}"
                                            type="button" data-bs-toggle="collapse"
                                            data-bs-target="#productCollapse{{ $loop->index }}"
                                            aria-expanded="{{ $loop->first ? 'true' : 'false' }}"
                                            aria-controls="productCollapse{{ $loop->index }}">
                                            {{ $faq->question }}
                                        </button>
                                    </h2>
                                    <div id="productCollapse{{ $loop->index }}"
                                        class="accordion-collapse collapse {{ $loop->first ? 'show' : '' }}"
                                        aria-labelledby="productHeading{{ $loop->index }}"
                                        data-bs-parent="#faqAccordionProduct">
                                        <div class="accordion-body transform-none">
                                            <p>{{ $faq->answer }}</p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Delivery FAQ Section -->
                    <div id="faq-delivery" class="faq-container d-none">
                        <div class="accordion" id="faqAccordionDelivery">
                            @foreach ($faqsDelivery as $faq)
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="deliveryHeading{{ $loop->index }}">
                                        <button class="accordion-button {{ $loop->first ? '' : 'collapsed' }}"
                                            type="button" data-bs-toggle="collapse"
                                            data-bs-target="#deliveryCollapse{{ $loop->index }}"
                                            aria-expanded="{{ $loop->first ? 'true' : 'false' }}"
                                            aria-controls="deliveryCollapse{{ $loop->index }}">
                                            {{ $faq->question }}
                                        </button>
                                    </h2>
                                    <div id="deliveryCollapse{{ $loop->index }}"
                                        class="accordion-collapse collapse {{ $loop->first ? 'show' : '' }}"
                                        aria-labelledby="deliveryHeading{{ $loop->index }}"
                                        data-bs-parent="#faqAccordionDelivery">
                                        <div class="accordion-body transform-none">
                                            <p>{{ $faq->answer }}</p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Order FAQ Section -->
                    <div id="faq-order" class="faq-container d-none">
                        <div class="accordion" id="faqAccordionOrder">
                            @foreach ($faqsOrder as $faq)
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="orderHeading{{ $loop->index }}">
                                        <button class="accordion-button {{ $loop->first ? '' : 'collapsed' }}"
                                            type="button" data-bs-toggle="collapse"
                                            data-bs-target="#orderCollapse{{ $loop->index }}"
                                            aria-expanded="{{ $loop->first ? 'true' : 'false' }}"
                                            aria-controls="orderCollapse{{ $loop->index }}">
                                            {{ $faq->question }}
                                        </button>
                                    </h2>
                                    <div id="orderCollapse{{ $loop->index }}"
                                        class="accordion-collapse collapse {{ $loop->first ? 'show' : '' }}"
                                        aria-labelledby="orderHeading{{ $loop->index }}"
                                        data-bs-parent="#faqAccordionOrder">
                                        <div class="accordion-body transform-none">
                                            <p>{{ $faq->answer }}</p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Order Received FAQ Section -->
                    <div id="faq-order-received" class="faq-container d-none">
                        <div class="accordion" id="faqAccordionOrderReceived">
                            @foreach ($faqsOrderReceived as $faq)
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="orderReceivedHeading{{ $loop->index }}">
                                        <button class="accordion-button {{ $loop->first ? '' : 'collapsed' }}"
                                            type="button" data-bs-toggle="collapse"
                                            data-bs-target="#orderReceivedCollapse{{ $loop->index }}"
                                            aria-expanded="{{ $loop->first ? 'true' : 'false' }}"
                                            aria-controls="orderReceivedCollapse{{ $loop->index }}">
                                            {{ $faq->question }}
                                        </button>
                                    </h2>
                                    <div id="orderReceivedCollapse{{ $loop->index }}"
                                        class="accordion-collapse collapse {{ $loop->first ? 'show' : '' }}"
                                        aria-labelledby="orderReceivedHeading{{ $loop->index }}"
                                        data-bs-parent="#faqAccordionOrderReceived">
                                        <div class="accordion-body transform-none">
                                            <p>{{ $faq->answer }}</p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- General FAQ Section -->
                    <div id="faq-general" class="faq-container d-none">
                        <div class="accordion" id="faqAccordionGeneral">
                            @foreach ($faqsGeneral as $faq)
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="generalHeading{{ $loop->index }}">
                                        <button class="accordion-button {{ $loop->first ? '' : 'collapsed' }}"
                                            type="button" data-bs-toggle="collapse"
                                            data-bs-target="#generalCollapse{{ $loop->index }}"
                                            aria-expanded="{{ $loop->first ? 'true' : 'false' }}"
                                            aria-controls="generalCollapse{{ $loop->index }}">
                                            {{ $faq->question }}
                                        </button>
                                    </h2>
                                    <div id="generalCollapse{{ $loop->index }}"
                                        class="accordion-collapse collapse {{ $loop->first ? 'show' : '' }}"
                                        aria-labelledby="generalHeading{{ $loop->index }}"
                                        data-bs-parent="#faqAccordionGeneral">
                                        <div class="accordion-body transform-none">
                                            <p>{{ $faq->answer }}</p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <script>
                    document.addEventListener('DOMContentLoaded', function() {
                        const buttons = document.querySelectorAll('.custom-btn');
                        buttons.forEach(btn => {
                            btn.addEventListener('click', function() {
                                // Remove active class from all buttons
                                buttons.forEach(b => b.classList.remove('custom-active'));
                                // Add active class to clicked button
                                this.classList.add('custom-active');

                                // Hide all FAQ sections
                                const faqContainers = document.querySelectorAll('.faq-container');
                                faqContainers.forEach(container => container.classList.add('d-none'));

                                // Show the targeted FAQ section
                                const targetId = this.getAttribute('data-target');
                                const targetContainer = document.getElementById(targetId);
                                if (targetContainer) {
                                    targetContainer.classList.remove('d-none');
                                }
                            });
                        });
                    });
                </script>
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
