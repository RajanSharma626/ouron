@extends('frontend.layouts.app')

@section('title', 'FAQ - Ouron')

@section('content')

    <section class="product_detail py-5">
        <div class="container py-5">
            <div class="row">
                <div class="col-12">
                    <div class="row justify-content-evenly">
                        <div class="col-2">
                            <button class="custom-btn py-2 px-3 custom-active" data-target="faq-product">Product</button>
                        </div>
                        <div class="col-2">
                            <button class="custom-btn py-2 px-3" data-target="faq-delivery">Delivery</button>
                        </div>
                        <div class="col-2">
                            <button class="custom-btn py-2 px-3" data-target="faq-order">Order</button>
                        </div>
                        <div class="col-2">
                            <button class="custom-btn py-2 px-3" data-target="faq-order-received">Order Received</button>
                        </div>
                        <div class="col-2">
                            <button class="custom-btn py-2 px-3" data-target="faq-general">General FAQ</button>
                        </div>
                    </div>
                </div>

                <div class="col-12 py-5">
                    <!-- Product FAQ Section -->
                    <div id="faq-product" class="faq-container">
                        <div class="accordion" id="faqAccordionProduct">
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="productHeadingOne">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#productCollapseOne" aria-expanded="true"
                                        aria-controls="productCollapseOne">
                                        1. How do I order a product?
                                    </button>
                                </h2>
                                <div id="productCollapseOne" class="accordion-collapse collapse show"
                                    aria-labelledby="productHeadingOne" data-bs-parent="#faqAccordionProduct">
                                    <div class="accordion-body">
                                        <p>To order a product, simply navigate to the product page, click "Add to Cart," and
                                            follow the checkout process.</p>
                                    </div>
                                </div>
                            </div>
                            <!-- Additional Product FAQ items can go here -->
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="productHeadingTwo">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#productCollapseTwo" aria-expanded="false" aria-controls="productCollapseTwo">
                                        2. What payment methods do you accept?
                                    </button>
                                </h2>
                                <div id="productCollapseTwo" class="accordion-collapse collapse" aria-labelledby="productHeadingTwo" data-bs-parent="#faqAccordionProduct">
                                    <div class="accordion-body">
                                        <p>We accept various payment methods including major credit cards, PayPal, and bank transfers.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="productHeadingThree">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#productCollapseThree" aria-expanded="false" aria-controls="productCollapseThree">
                                        3. Can I return a product if I am not satisfied?
                                    </button>
                                </h2>
                                <div id="productCollapseThree" class="accordion-collapse collapse" aria-labelledby="productHeadingThree" data-bs-parent="#faqAccordionProduct">
                                    <div class="accordion-body">
                                        <p>Yes, you can return your product within 30 days of purchase provided it meets our return criteria.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Delivery FAQ Section -->
                    <div id="faq-delivery" class="faq-container d-none">
                        <div class="accordion" id="faqAccordionDelivery">
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="deliveryHeadingOne">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#deliveryCollapseOne" aria-expanded="true"
                                        aria-controls="deliveryCollapseOne">
                                        Delivery FAQ 1: What delivery options are available?
                                    </button>
                                </h2>
                                <div id="deliveryCollapseOne" class="accordion-collapse collapse show"
                                    aria-labelledby="deliveryHeadingOne" data-bs-parent="#faqAccordionDelivery">
                                    <div class="accordion-body">
                                        <p>We offer standard and express delivery options. Choose the one that suits you
                                            best during checkout.</p>
                                    </div>
                                </div>
                            </div>
                            <!-- Additional Delivery FAQ items can go here -->
                        </div>
                    </div>

                    <!-- Order FAQ Section -->
                    <div id="faq-order" class="faq-container d-none">
                        <div class="accordion" id="faqAccordionOrder">
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="orderHeadingOne">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#orderCollapseOne" aria-expanded="true"
                                        aria-controls="orderCollapseOne">
                                        Order FAQ 1: How do I update my order?
                                    </button>
                                </h2>
                                <div id="orderCollapseOne" class="accordion-collapse collapse show"
                                    aria-labelledby="orderHeadingOne" data-bs-parent="#faqAccordionOrder">
                                    <div class="accordion-body">
                                        <p>You can update your order before it is processed. Contact our support for
                                            assistance.</p>
                                    </div>
                                </div>
                            </div>
                            <!-- Additional Order FAQ items can go here -->
                        </div>
                    </div>

                    <!-- Order Received FAQ Section -->
                    <div id="faq-order-received" class="faq-container d-none">
                        <div class="accordion" id="faqAccordionOrderReceived">
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="orderReceivedHeadingOne">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#orderReceivedCollapseOne" aria-expanded="true"
                                        aria-controls="orderReceivedCollapseOne">
                                        Order Received FAQ 1: How do I confirm receipt of my order?
                                    </button>
                                </h2>
                                <div id="orderReceivedCollapseOne" class="accordion-collapse collapse show"
                                    aria-labelledby="orderReceivedHeadingOne" data-bs-parent="#faqAccordionOrderReceived">
                                    <div class="accordion-body">
                                        <p>Once you receive your order, please click on the "Order Received" button in your
                                            account to confirm.</p>
                                    </div>
                                </div>
                            </div>
                            <!-- Additional Order Received FAQ items can go here -->
                        </div>
                    </div>

                    <!-- General FAQ Section -->
                    <div id="faq-general" class="faq-container d-none">
                        <div class="accordion" id="faqAccordionGeneral">
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="generalHeadingOne">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#generalCollapseOne" aria-expanded="true"
                                        aria-controls="generalCollapseOne">
                                        General FAQ 1: How does your service work?
                                    </button>
                                </h2>
                                <div id="generalCollapseOne" class="accordion-collapse collapse show"
                                    aria-labelledby="generalHeadingOne" data-bs-parent="#faqAccordionGeneral">
                                    <div class="accordion-body">
                                        <p>Our service connects you with the best products and delivery options available
                                            worldwide.</p>
                                    </div>
                                </div>
                            </div>
                            <!-- Additional General FAQ items can go here -->
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
