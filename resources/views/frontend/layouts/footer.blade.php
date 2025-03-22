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
                    <img src="{{ asset('/images/logo/logo.svg') }}" class="img-fluid" alt="" width="200">
                </div>
            </div>
        </div>
        <div class="text-center mt-4 text-muted">
            &copy; 2025 Ouron Lifestyle & Co., All Rights Reserved.
        </div>
    </div>
</footer>



<div class="offcanvas offcanvas-end" tabindex="-1" id="cart" aria-labelledby="cartLabel">
    <div class="offcanvas-header border-bottom">
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        <div class="cart-items" id="cart-items-container">
            <!-- Cart items will be loaded here dynamically -->
        </div>

        <!-- Cart Summary -->
        <hr>
        <div class="cart-total mt-3">
            <h6 class="d-flex justify-content-between fw-bold">
                <span>ESTIMATED TOTAL</span>
                <span id="cart-total">RS. 0</span>
            </h6>
            <small class="text-muted">TAX INCLUDED. SHIPPING AND DISCOUNTS CALCULATED AT CHECKOUT.</small>
        </div>

        <!-- Checkout Button -->
        <div class="d-grid mt-4">
            <a href="{{ route('checkout') }}" class="link-normal text-center checkout_btn">CHECK OUT</a>
        </div>
    </div>

</div>
