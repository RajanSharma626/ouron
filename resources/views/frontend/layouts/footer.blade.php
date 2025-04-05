<footer class="pt-5 pb-3 secondary-bg primary-color">
    <div class="container">
        <div class="row">

            <div class="col-12 text-center d-md-none mb-5">
                <a href="{{ route('home') }}">
                    <img src="{{ asset('/images/logo/logo.svg') }}" class="img-fluid footer_logo" alt=""
                        width="200">
                </a>
            </div>


            <!-- Categories -->
            <div class="col-md-3 col-6">
                <h6 class="fw-bold">Categories</h6>
                <ul class="list-unstyled">
                    @foreach ($categories as $category)
                        <li><a href="{{ route('cat-product', $category->slug) }}"
                                class="primary-color text-decoration-none">{{ $category->name }}</a></li>
                    @endforeach
                </ul>
            </div>

            <!-- Need Help -->
            <div class="col-md-3 col-6">
                <h6 class="fw-bold">Need Help</h6>
                <ul class="list-unstyled">
                    <li><a href="#" class="primary-color text-decoration-none">Track Your Order</a></li>
                    <li><a href="{{ route('refund-exchange-policy') }}"
                            class="primary-color text-decoration-none">RETURN  & REFUND </a></li>
                    <li><a href="{{ route('faq') }}" class="primary-color text-decoration-none">FAQs</a></li>
                    <li><a href="{{ route('privacy-policy') }}" class="primary-color text-decoration-none">Privacy Policy</a></li>
                    <li><a href="{{ route('terms-and-conditions') }}" class="primary-color text-decoration-none">Terms &
                            Condition</a></li>
                    <li><a href="{{ route('shipping-policy') }}" class="primary-color text-decoration-none">Shipping
                            Policy</a></li>
                </ul>
            </div>

            <!-- Company -->
            <div class="col-md-3 col-6">
                <h6 class="fw-bold">Company</h6>
                <ul class="list-unstyled">
                    <li><a href="{{ route('about.us') }}" class="primary-color text-decoration-none">About us</a></li>
                    <li><a href="{{ route('contact.us') }}" class="primary-color text-decoration-none">Contact Us</a>
                    </li>
                    <li><a href="{{ route('allblogs') }}" class="primary-color text-decoration-none">WTS?</a></li>
                </ul>
            </div>

            <!-- Get in touch (Social Media) -->
            <div class="col-md-3 col-6">
                <h6 class="fw-bold">Get in touch</h6>
                <div class="d-flex gap-3">
                    <a href="https://www.instagram.com/ouron.in?utm_source=qr&igsh=bTBvN21ocm9pZGFl" target="_blank"
                        class="primary-color fs-4"><i class="bi bi-instagram"></i></a>
                    <a href="https://www.facebook.com/share/1EDMyA4cfL/" target="_blank" class="primary-color fs-4"><i
                            class="bi bi-facebook"></i></a>
                    <a href="https://wa.link/3ifr4q" target="_blank" class="primary-color fs-4"><i
                            class="bi bi-whatsapp"></i></a>
                </div>

                <div class="footer_logo mt-4 d-none d-md-block">
                    <a href="{{ route('home') }}">
                        <img src="{{ asset('/images/logo/logo.svg') }}" class="img-fluid footer_logo" alt=""
                            width="200">
                    </a>
                </div>
            </div>
        </div>
        <div class="text-center text-muted fs-12">
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

        </div>

        <!-- Cart Summary -->
        <hr>
        <div class="cart-total mt-3 cart-total-hide">
            <h6 class="d-flex justify-content-between fw-bold">
                <span>ESTIMATED TOTAL</span>
                <span id="cart-total">RS. 0</span>
            </h6>
            <small class="text-muted">TAX INCLUDED. SHIPPING AND DISCOUNTS CALCULATED AT CHECKOUT.</small>
        </div>

        <!-- Checkout Button -->
        <div class="d-grid mt-4">
            <a href="{{ route('checkout') }}" class="link-normal text-center checkout_btn checkout_btn_hide">CHECK OUT</a>
        </div>
    </div>

</div>


<!-- Modal -->
<div class="modal fade" id="addToCartModal" tabindex="-1" aria-labelledby="addToCartModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addToCartModalLabel">Select Size & Color</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="d-flex align-items-center">
                    <img id="modalProductImage" src="" class="img-fluid rounded me-3" width="80"
                        alt="Product Image">
                    <div>
                        <h6 id="modalProductTitle" class="fw-bold"></h6>
                        <p class="text-muted">Price: RS. <span id="modalProductPrice"></span></p>
                    </div>
                </div>
                <hr>

                <!-- Size Selection -->
                <h6>Select Size</h6>
                <div id="modalProductSizes" class="d-flex flex-wrap gap-2"></div>

                <!-- Color Selection -->
                <h6 class="mt-3">Select Color</h6>
                <div id="modalProductColors" class="d-flex flex-wrap gap-2"></div>

                <input type="hidden" id="modalProductId">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn primary-bg" id="confirmAddToCart">Add to Cart</button>
            </div>
        </div>
    </div>
</div>
