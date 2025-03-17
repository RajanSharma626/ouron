<footer class="pt-5 pb-3 secondary-bg primary-color">
    <div class="container">
        <div class="row">
            <!-- Categories -->
            <div class="col-md-3">
                <h6 class="fw-bold">Categories</h6>
                <ul class="list-unstyled">
                    <li><a href="#" class="primary-color text-decoration-none">Men</a></li>
                    <li><a href="#" class="primary-color text-decoration-none">Women</a></li>
                    <li><a href="#" class="primary-color text-decoration-none">Summer Tees</a></li>
                    <li><a href="#" class="primary-color text-decoration-none">Oversized Tees</a></li>
                    <li><a href="#" class="primary-color text-decoration-none">Travel Jogger</a></li>
                    <li><a href="#" class="primary-color text-decoration-none">Fashion Joggers</a></li>
                </ul>
            </div>

            <!-- Need Help -->
            <div class="col-md-3">
                <h6 class="fw-bold">Need Help</h6>
                <ul class="list-unstyled">
                    <li><a href="#" class="primary-color text-decoration-none">Track Your Order</a></li>
                    <li><a href="{{ route('refund-exchange-policy') }}"
                            class="primary-color text-decoration-none">Refund & Exchanges</a></li>
                    <li><a href="{{ route('faq') }}" class="primary-color text-decoration-none">FAQs</a></li>
                    <li><a href="{{ route('terms-and-conditions') }}" class="primary-color text-decoration-none">Terms &
                            Condition</a></li>
                    <li><a href="{{ route('shipping-policy') }}" class="primary-color text-decoration-none">Shipping
                            Policy</a></li>
                </ul>
            </div>

            <!-- Company -->
            <div class="col-md-3">
                <h6 class="fw-bold">Company</h6>
                <ul class="list-unstyled">
                    <li><a href="{{ route('about.us') }}" class="primary-color text-decoration-none">Story</a></li>
                    <li><a href="{{ route('contact.us') }}" class="primary-color text-decoration-none">Contact Us</a>
                    </li>
                    <li><a href="{{ route('blogs') }}" class="primary-color text-decoration-none">Blogs</a></li>
                </ul>
            </div>

            <!-- Get in touch (Social Media) -->
            <div class="col-md-3">
                <h6 class="fw-bold">Get in touch</h6>
                <div class="d-flex gap-3">
                    <a href="#" class="primary-color fs-4"><i class="bi bi-instagram"></i></a>
                    <a href="#" class="primary-color fs-4"><i class="bi bi-facebook"></i></a>
                    <a href="#" class="primary-color fs-4"><i class="bi bi-whatsapp"></i></a>
                </div>

                <div class="footer_logo mt-4">
                    <img src="{{ asset('/images/logo/logo.svg') }}" class="img-fluid" alt="" width="150">
                </div>
            </div>
        </div>
        <div class="text-center mt-4 text-muted">
            &copy; 2025 Quron, ALL RIGHTS RESERVED.
        </div>
    </div>
</footer>



<div class="offcanvas offcanvas-end" tabindex="-1" id="cart" aria-labelledby="cartLabel">
    <div class="offcanvas-header border-bottom">
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        <div class="cart-items">

            <!-- Example Cart Item -->
            {{-- <div class="cart-item d-flex justify-content-between align-items-center mb-3">
                <div class="cart-item-info d-flex align-items-center">
                    <img src="https://bluorng.com/cdn/shop/files/tshirt4backwithgradient.jpg?v=1738601055&width=823"
                        alt="Product Image" class="img-fluid rounded" width="80">
                    <div class="ms-3">
                        <h6 class="mb-1 fw-bold">THE CLASH T-SHIRT</h6>
                        <small class="text-muted d-block">RS. 4,995</small>
                        <small class="text-muted">Size: XXXS</small>
                    </div>
                </div>
                <div class="cart-item-price d-flex align-items-center">
                    <button class="btn btn-sm border px-2">-</button>
                    <span class="fw-bold mx-2">2</span>
                    <button class="btn btn-sm border px-2">+</button>
                    <button class="btn btn-sm text-danger ms-3"><i class="bi bi-trash"></i></button>
                </div>
            </div> --}}
            <!-- Add More Cart Items Here -->
        </div>

        <!-- Cart Summary -->
        <hr>
        <div class="cart-total mt-3">
            <h6 class="d-flex justify-content-between fw-bold">
                <span>ESTIMATED TOTAL</span>
                <span>RS. 0</span>
            </h6>
            <small class="text-muted">TAX INCLUDED. SHIPPING AND DISCOUNTS CALCULATED AT CHECKOUT.</small>
        </div>

        <!-- Gift Card Checkbox -->
        <div class="form-check mt-3">
            <input class="form-check-input" type="checkbox" id="giftCard">
            <label class="form-check-label" for="giftCard">
                HAVE A GIFT CARD?
            </label>
        </div>

        <!-- Checkout Button -->
        <div class="d-grid mt-4">
            <a href="{{ route('checkout') }}" class="link-normal text-center checkout_btn">CHECK OUT</a>
        </div>
    </div>
</div>
