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
                    <li><a href="#" class="text-decoration-none text-muted">MEMBERS LOGIN</a></li>
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
                    <li><a href="#" class="text-decoration-none text-muted">STORY</a></li>
                    <li><a href="#" class="text-decoration-none text-muted">OUR STORES</a></li>
                    <li><a href="#" class="text-decoration-none text-muted">CAREERS</a></li>
                    <li><a href="{{ route('contact.us') }}" class="text-decoration-none text-muted">CONTACT US</a></li>
                    <li><a href="#" class="text-decoration-none text-muted">COLLABORATIONS</a></li>
                    <li><a href="#" class="text-decoration-none text-muted">BLOGS</a></li>
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
    <div class="offcanvas-header">
        {{-- <h5 class="offcanvas-title fw-bold" id="cartLabel"><i class="bi bi-cart3"></i> Cart</h5> --}}
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        <h5 class="offcanvas-title fw-bold mb-3" id="cartLabel"><i class="bi bi-cart3"></i> Cart</h5>
        <div class="cart-items">
            <!-- Example Cart Item -->
            <div class="cart-item d-flex justify-content-between align-items-center mb-3">
                <div class="cart-item-info d-flex align-items-center">
                    <img src="https://bluorng.com/cdn/shop/files/tshirt4backwithgradient.jpg?v=1738601055&width=823"
                        alt="Product Image" class="img-fluid" width="50">
                    <div class="ms-3">
                        <h6 class="mb-0 fw-bold">Product Name</h6>
                        <small class="text-muted">Quantity: 1</small>
                    </div>
                </div>
                <div class="cart-item-price">
                    <h6 class="mb-0">$25.00</h6>
                </div>
                <button class="btn btn-sm btn-danger ms-3"><i class="bi bi-trash"></i></button>
            </div>
            <div class="cart-item d-flex justify-content-between align-items-center mb-3">
                <div class="cart-item-info d-flex align-items-center">
                    <img src="https://bluorng.com/cdn/shop/files/tshirt4backwithgradient.jpg?v=1738601055&width=823"
                        alt="Product Image" class="img-fluid" width="50">
                    <div class="ms-3">
                        <h6 class="mb-0 fw-bold">Product Name</h6>
                        <small class="text-muted">Quantity: 1</small>
                    </div>
                </div>
                <div class="cart-item-price">
                    <h6 class="mb-0">$25.00</h6>
                </div>
                <button class="btn btn-sm btn-danger ms-3"><i class="bi bi-trash"></i></button>
            </div>
            <!-- Repeat Cart Item as needed -->
        </div>
        <div class="cart-total mt-4">
            <h5>Total: $75.00</h5>
        </div>
        <div class="d-grid gap-2 mt-4">
            <a href="" class="primary-bg checkout_btn link-normal text-center">Checkout</a>
            <a href="" class="btn btn-secondary">View Cart</a>
        </div>
    </div>
</div>
