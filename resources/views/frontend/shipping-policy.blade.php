@extends('frontend.layouts.app')

@section('title', 'Shipping Policy')

@section('content')

    <section class="product_detail py-5">
        <div class="container">
            <div class="row">

                <div class="col-12 policy-content">
                    <h1 class="text-center mb-5 fs-3">Shipping POLICY</h1>

                    <h5>
                        ORDER PLACEMENT
                    </h5>

                    <ul class="mb-5">
                        <li class="text-normal">Customers must provide accurate billing and shipping details at checkout.</li>
                        <li class="text-normal">Once an order is placed, it cannot be modified or canceled. Please review your order carefully before finalizing the purchase.</li>
                        <li class="text-normal">An order confirmation email will be sent immediately upon successful payment.</li>
                    </ul>

                    <h5>
                        PAYMENT METHODS
                    </h5>
                    <p class="text-normal">We accept the following payment options:</p>
                    <ul class="mb-5">
                        <li class="text-normal">Credit/Debit Cards (Visa, MasterCard, American Express)</li>
                        <li class="text-normal">UPI & Net Banking</li>
                        <li class="text-normal">Wallet Payments</li>
                        <li class="text-normal">PayPal (for international customers)</li>
                        <li class="text-normal">Cash on Delivery (Available for select locations within India)</li>
                    </ul>

                    <h5>
                        PRICING & TAXES
                    </h5>
                    <ul class="mb-5">
                        <li class="text-normal">All prices are listed in INR (Indian Rupees).</li>
                        <li class="text-normal">Prices do not include applicable taxes, which will be calculated at checkout.</li>
                        <li class="text-normal">International orders may be subject to customs duties and import taxes, payable by the recipient.</li>
                    </ul>

                    <h5>
                        ORDER PROCESSING & SHIPPING
                    </h5>
                    <ul class="mb-5">
                        <li class="text-normal">Orders are processed within 24 hours, excluding weekends and public holidays.</li>
                        <li class="text-normal">Shipping confirmation with tracking details will be sent via email once dispatched.</li>
                        <li class="text-normal">Domestic Shipping: Standard delivery within <b>4 business days</b> (Free shipping on all orders).</li>
                    </ul>

                    <h5>
                        NO EXCHANGE, REFUND, OR RETURN
                    </h5>
                    <ul class="mb-5">
                        <li class="text-normal">All sales are final. We do not offer returns, exchanges, or refunds for any products once delivered.</li>
                        <li class="text-normal">Please ensure your order details and customization (if any) are correct before placing the order.</li>
                    </ul>

                    <h5>
                        FINAL SALE ITEMS
                    </h5>
                    <ul class="mb-5">
                        <li class="text-normal">Products purchased during a sale, clearance, or promotional period are non-refundable and cannot be exchanged.</li>
                    </ul>

                    <h5>
                        DAMAGED OR MISSING ITEMS
                    </h5>
                    <ul class="mb-5">
                        <li class="text-normal">If you receive a damaged product, notify us within 48 hours with photos as proof.</li>
                        <li class="text-normal">Missing items must be reported within 72 hours of delivery.</li>
                    </ul>

                    <h5>
                        CONTACT US
                    </h5>
                    <p>For any shopping-related inquiries, reach out to:</p>
                    <ul class="mb-5">
                        <li class="text-normal"><i class="bi bi-envelope"></i> Email: <a class="primary-color" href="mailto:support@ouron.com">support@ouron.com</a></li>
                        <li class="text-normal"><i class="bi bi-telephone-inbound"></i> Phone: <a class="primary-color" href="tel:+91 8799232708">+91 8799232708</a></li>
                        <li class="text-normal"><i class="bi bi-clock-history"></i> Support Hours: <b>Monday – Saturday</b> | <b>11:30 AM – 7:00 PM IST</b></li>
                    </ul>
                </div>

            </div>
        </div>
    </section>

@endsection
