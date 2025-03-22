<header>

    <div class="fs-07rem text-center primary-bg text-white py-2">
        <strong>Coupon Offer:</strong> Use code <span class="fw-bold">SAVE20</span> at checkout for a 20% discount!
    </div>
    <nav class="navbar sticky-top navbar-expand-lg py-2 secondary-bg">
        <div class="container-fluid px-4">
            <div class="d-flex w-100 justify-content-between align-items-center">
                <!-- Left: Logo -->
                <div class="d-flex align-items-center">
                    <a class="navbar-brand py-0" href="{{ route('home') }}">
                        <img src="{{ asset('images/logo/logo.svg') }}" alt="Logo" width="100">
                    </a>
                </div>

                <!-- Center: Navigation Menu -->
                <div class="text-center">
                    <ul class="navbar-nav gap-4 align-items-center d-flex">
                        <li class="nav-item">
                            <a class="nav-link text-uppercase primary-font-size fw-400" href="{{ route('new.in') }}">New
                                in</a>
                        </li>

                        <!-- Apparel Dropdown -->
                        <li class="nav-item dropdown">
                            <a class="nav-link text-uppercase primary-font-size fw-400 dropdown-toggle" href="#"
                                id="apparelDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Apparel
                            </a>
                            <ul class="dropdown-menu secondary-bg" aria-labelledby="apparelDropdown">

                                <!-- Thirt Sub Menu -->
                                <li class="">
                                    <a href="{{ route('all-product') }}" class="dropdown-item primary-font-size fw-400"
                                        href="#">All Product</a>
                                </li>

                                
                                <li class="dropdown-submenu">
                                    <a class="dropdown-item dropdown-toggle primary-font-size fw-400"
                                        href="#">Polo</a>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" href="#">T-Shirts</a></li>
                                        <li><a class="dropdown-item" href="#">Jeans</a></li>
                                        <li><a class="dropdown-item" href="#">Jackets</a></li>
                                    </ul>
                                </li>
                               
                                
                                <li class="dropdown-submenu">
                                    <a class="dropdown-item dropdown-toggle primary-font-size fw-400"
                                        href="#">Oversized</a>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" href="#">Dresses</a></li>
                                        <li><a class="dropdown-item" href="#">Tops</a></li>
                                        <li><a class="dropdown-item" href="#">Skirts</a></li>
                                    </ul>
                                </li>


                            </ul>
                        </li>

                        <li class="nav-item dropdown">
                            <a class="nav-link text-uppercase primary-font-size fw-400 dropdown-toggle" href="#"
                                id="footwearDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Collection
                            </a>
                            <ul class="dropdown-menu secondary-bg" aria-labelledby="footwearDropdown">
                                <!-- First Sub Menu -->
                                <li class="dropdown-item">
                                    <a class="primary-font-size fw-400 text-decoration-none" href="#">Collection
                                        1</a>

                                </li>
                                <li class="dropdown-item">
                                    <a class="primary-font-size fw-400 text-decoration-none" href="#">Collection
                                        2</a>
                                </li>
                            </ul>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link text-uppercase primary-font-size fw-400"
                                href="{{ route('blogs') }}">Blogs</a>
                        </li>
                    </ul>
                </div>

                <!-- Right: Icons/Menu -->
                <div class="d-flex align-items-center">
                    <ul class="navbar-nav gap-3 align-items-center d-flex">
                        <li class="nav-item">
                            <a class="nav-link text-uppercase primary-font-size fw-400" href="#">Search</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link p-0" href="javascript:void(0)" data-bs-toggle="offcanvas"
                                data-bs-target="#cart" aria-controls="cart">
                                <div class="position-relative">
                                    <i class="bi bi-handbag" aria-hidden="true"></i>
                                </div>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link p-0" href="{{ route('wishlist') }}">
                                <div class="position-relative">
                                    <i class="bi bi-heart"></i>
                                </div>
                            </a>
                        </li>

                        @guest
                            <li class="nav-item">
                                <a class="nav-link text-uppercase primary-font-size fw-400"
                                    href="{{ route('login') }}">Login</a>
                            </li>
                        @endguest

                        @auth
                            <li class="nav-item dropdown">
                                @php
                                    $name = trim(Auth::user()->name);
                                    $words = preg_split('/\s+/', $name);
                                    $initials = '';
                                    foreach ($words as $word) {
                                        $initials .= strtoupper(substr($word, 0, 1));
                                    }
                                @endphp

                                <a class="nav-link d-flex align-items-center p-0" href="{{ route('profile') }}"
                                    id="profileDropdown">
                                    <span
                                        class="rounded-circle primary-bg text-white d-flex justify-content-center align-items-center"
                                        style="width: 25px; height: 25px;">
                                        {{ $initials }}
                                    </span>
                                </a>
                            </li>
                        @endauth
                    </ul>
                </div>
            </div>
        </div>
    </nav>

</header>
