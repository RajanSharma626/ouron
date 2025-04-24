@extends('frontend.layouts.app')

@section('title', 'Shipping Policy')

@section('content')

    <section class="product_detail py-5">
        <div class="container">
            <div class="row">

                <div class="col-12 policy-content">
                    <h1 class="text-center mb-5 fs-3 fw-bold">Shipping POLICY</h1>

                    <h5>
                        ORDER PLACEMENT
                    </h5>

                    <ul class="mb-5">
                        <li class="text-normal">
                            <small>
                                Customers must provide accurate billing and shipping details at checkout.
                            </small>
                        </li>
                        <li class="text-normal">
                            <small>
                                Once an order is placed, it cannot be modified or cancelled. Please review your order
                                carefully before finalizing the purchase.
                            </small>
                        </li>
                        <li class="text-normal">
                            <small>
                                An order confirmation email will be sent immediately upon successful payment.
                            </small>
                        </li>
                    </ul>

                    <h5>
                        PAYMENT METHODS
                    </h5>
                    <p class="text-normal">
                        <small>
                            We accept the following payment options:
                        </small>
                    </p>
                    <ul class="mb-5">
                        <li class="text-normal">
                            <small>
                                Credit/Debit Cards (Visa, MasterCard, American Express)
                            </small>
                        </li>
                        <li class="text-normal">
                            <small>
                                UPI & Net Banking
                            </small>
                        </li>
                        <li class="text-normal">
                            <small>
                                Wallet Payments
                            </small>
                        </li>
                        <li class="text-normal">
                            <small>
                                Cash on Delivery (Available for select locations within India)
                            </small>
                        </li>
                    </ul>

                    <h5>
                        PRICING & TAXES
                    </h5>
                    <ul class="mb-5">
                        <li class="text-normal">
                            <small>
                                All prices are listed in INR (Indian Rupees).
                            </small>
                        </li>
                        <li class="text-normal">
                            <small>
                                Prices are inclusive of all applicable taxes.
                            </small>
                        </li>
                        <li class="text-normal">
                            <small>
                                Currently, we do not offer international shipping.
                            </small>
                        </li>
                    </ul>

                    <h5>
                        ORDER PROCESSING & SHIPPING
                    </h5>
                    <ul class="mb-5">
                        <li class="text-normal">
                            <small>
                                Orders are processed within 24 hours, excluding weekends and public
                                holidays.
                            </small>
                        </li>
                        <li class="text-normal">
                            <small>
                                Shipping confirmation with tracking details will be sent via email once
                                dispatched.
                            </small>
                        </li>
                        <li class="text-normal">
                            <small>
                                Domestic Shipping: Standard delivery within <b>5-7 business days</b> (Free
                                shipping on all orders).
                            </small>
                        </li>
                    </ul>

                    <h5>
                        RETURNS & EXCHANGES
                    </h5>
                    <ul class="mb-5">
                        <li class="text-normal">
                            <small>
                                Returns are accepted within 7 days of delivery, provided the product is unused, unworn, and
                                in its original condition and packaging.For more details, please refer to our [Returns &
                                Exchanges Policy].
                            </small>
                            <ul>
                                <li>
                                    <small>We do not accept exchanges due to company policy.</small>
                                </li>
                                <li>
                                    <small>To initiate a return, contact our support team at <a
                                            href="maileto:support@ouron.in">support@ouron.in</a></small>
                                </li>
                            </ul>
                        </li>
                        <li class="text-normal">
                            <small>

                                Please ensure your order details and customization (if any) are correct
                                before placing the order.
                            </small>
                        </li>
                    </ul>

                    <h5>
                        FINAL SALE ITEMS
                    </h5>
                    <ul class="mb-5">
                        <li class="text-normal">
                            <small>

                                Products purchased during a sale, clearance, or promotional period are
                                non-refundable and cannot be exchanged.
                            </small>
                        </li>
                    </ul>

                    <h5>
                        DAMAGED OR MISSING ITEMS
                    </h5>
                    <ul class="mb-5">
                        <li class="text-normal">
                            <small>
                                If you receive a damaged product, notify us within 48 hours with photos as proof.( <a
                                    href="mailto:support@ouron.in">support@ouron.in</a> )
                            </small>
                        </li>
                        <li class="text-normal">
                            <small>
                                Missing items must be reported within 48 hours of delivery. ( <a
                                href="mailto:support@ouron.in">support@ouron.in</a> )
                            </small>
                        </li>
                    </ul>

                    <h5>
                        CONTACT US
                    </h5>
                    <p>
                        <small>

                            For any shopping-related inquiries, reach out to:
                        </small>
                    </p>
                    <ul class="mb-5">
                        <li class="text-normal">
                            <small>

                                <i class="bi bi-envelope"></i> Email: <a class="primary-color"
                                    href="mailto:support@ouron.in">support@ouron.in</a>
                            </small>
                        </li>
                        <li class="text-normal">
                            <small>

                                <i class="bi bi-telephone-inbound"></i> Phone: <a class="primary-color"
                                    href="tel:+91 8799232708">+91 8799 232 708</a>
                            </small>
                        </li>
                        <li class="text-normal">
                            <small>

                                <i class="bi bi-clock-history"></i> Support Hours: <b>Monday – Saturday</b>
                                | <b>11:30 AM – 7:00 PM IST</b>
                            </small>
                        </li>
                    </ul>
                </div>

            </div>
        </div>
    </section>

@endsection
