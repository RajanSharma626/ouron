<footer class="py-5 pb-0 mt-5 secondary-bg">
    <div class="container">
        <div class="row justify-content-between">
            <!-- Left: Logo -->
            <div class="col-md-4 text-center text-md-start">
                <a href=""><img src="{{ asset('images/logo/logo.svg') }}" class="img-fluid" alt=""
                        width="150"></a>
                <p class="text-muted mt-3">&copy; 2025 Quron, ALL RIGHTS RESERVED.</p>
            </div>

            <!-- Center: Help Section -->
            <div class="col-md-3">
                <h6>HELP</h6>
                <ul class="list-unstyled text-muted">
                    <li><a href="" class="text-decoration-none text-muted">PLACE AN EXCHANGE/RETURN REQUEST</a>
                    </li>
                    <li><a href="{{ route('refund-exchange-policy') }}"
                            class="text-decoration-none text-muted">EXCHANGE/RETURNS POLICY</a></li>
                    <li><a href="{{ route('faq') }}" class="text-decoration-none text-muted">FAQ</a></li>
                    <li><a href="{{ route('terms-and-conditions') }}" class="text-decoration-none text-muted">TERMS</a>
                    </li>
                    <li><a href="{{ route('shipping-policy') }}" class="text-decoration-none text-muted">SHIPPING</a>
                    </li>
                </ul>
            </div>

            <!-- Right: Company Section -->
            <div class="col-md-3 text-center text-md-start">
                <h6>COMPANY</h6>
                <ul class="list-unstyled text-muted">
                    <li><a href="{{route('about.us')}}" class="text-decoration-none text-muted">STORY</a></li>
                    <li><a href="{{ route('contact.us') }}" class="text-decoration-none text-muted">CONTACT US</a></li>
                </ul>
            </div>
        </div>
    </div>

    <!-- Bottom Social Media Links -->
    <div class="primary-bg text-white text-center py-2">
        <div class="container">
            <div class="row">
                <div class="col">
                    <a href="#" class="text-white text-decoration-none fs-12">CONNECT</a>
                </div>
                <div class="col">
                    <a href="#" class="text-white text-decoration-none fs-12">INSTAGRAM</a>
                </div>
                <div class="col">
                    <a href="#" class="text-white text-decoration-none fs-12">YOUTUBE</a>
                </div>
                <div class="col">
                    <a href="#" class="text-white text-decoration-none fs-12">LINKEDIN</a>
                </div>
            </div>
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
            <div class="cart-item d-flex justify-content-between align-items-center mb-3">
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
            </div>
            <!-- Add More Cart Items Here -->
            <!-- Example Cart Item -->
            <div class="cart-item d-flex justify-content-between align-items-center mb-3">
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
            </div>
            <!-- Add More Cart Items Here -->
            <!-- Example Cart Item -->
            <div class="cart-item d-flex justify-content-between align-items-center mb-3">
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
            </div>
            <!-- Add More Cart Items Here -->
            <!-- Example Cart Item -->
            <div class="cart-item d-flex justify-content-between align-items-center mb-3">
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
            </div>
            <!-- Add More Cart Items Here -->
            <!-- Example Cart Item -->
            <div class="cart-item d-flex justify-content-between align-items-center mb-3">
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
            </div>
            <!-- Add More Cart Items Here -->
            <!-- Example Cart Item -->
            <div class="cart-item d-flex justify-content-between align-items-center mb-3">
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
            </div>
            <!-- Add More Cart Items Here -->
            <!-- Example Cart Item -->
            <div class="cart-item d-flex justify-content-between align-items-center mb-3">
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
            </div>
            <!-- Add More Cart Items Here -->
            <!-- Example Cart Item -->
            <div class="cart-item d-flex justify-content-between align-items-center mb-3">
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
            </div>
            <!-- Add More Cart Items Here -->
            <!-- Example Cart Item -->
            <div class="cart-item d-flex justify-content-between align-items-center mb-3">
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
            </div>
            <!-- Add More Cart Items Here -->
            <!-- Example Cart Item -->
            <div class="cart-item d-flex justify-content-between align-items-center mb-3">
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
            </div>
            <!-- Add More Cart Items Here -->
            <!-- Example Cart Item -->
            <div class="cart-item d-flex justify-content-between align-items-center mb-3">
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
            </div>
            <!-- Add More Cart Items Here -->
            <!-- Example Cart Item -->
            <div class="cart-item d-flex justify-content-between align-items-center mb-3">
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
            </div>
            <!-- Add More Cart Items Here -->
            <!-- Example Cart Item -->
            <div class="cart-item d-flex justify-content-between align-items-center mb-3">
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
            </div>
            <!-- Add More Cart Items Here -->
        </div>

        <!-- Cart Summary -->
        <hr>
        <div class="cart-total mt-3">
            <h6 class="d-flex justify-content-between fw-bold">
                <span>ESTIMATED TOTAL</span>
                <span>RS. 9,990</span>
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
