<header>

    <div class="fs-07rem text-center primary-bg text-white py-2">
        <strong>Coupon Offer:</strong> Use code <span class="fw-bold">SAVE20</span> at checkout for a 20% discount!
    </div>
    <nav class="navbar navbar-expand-lg py-2 secondary-bg d-none d-lg-block">
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

                                @foreach ($categories as $category)
                                    <li class="">
                                        <a class="dropdown-item primary-font-size fw-400"
                                            href="{{ route('cat-product', $category->slug) }}">{{ $category->name }}</a>
                                    </li>
                                @endforeach
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
                                    <a class="primary-font-size fw-400 text-decoration-none dropdown-item"
                                        href="{{ route('collection-product', "edge-by-ouron") }}">Edge by Ouron</a>

                                </li>
                                <li class="dropdown-item">
                                    <a class="primary-font-size fw-400 text-decoration-none dropdown-item"
                                        href="{{ route('collection-product', "legacy-origins") }}">Legacy:Origins</a>
                                </li>
                            </ul>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link text-uppercase primary-font-size fw-400"
                                href="{{ route('allblogs') }}">WTS?</a>
                        </li>
                    </ul>
                </div>

                <!-- Right: Icons/Menu -->
                <div class="d-flex align-items-center">
                    <ul class="navbar-nav gap-3 align-items-center d-flex">
                        <li class="nav-item">
                            <a href="javascript:void(0)" class="nav-link text-uppercase primary-font-size fw-400"
                                data-bs-toggle="offcanvas" data-bs-target="#searchCanvas"
                                aria-controls="search">Search</a>
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

    <nav class="navbar navbar-expand-lg py-2 secondary-bg d-lg-none">
        <div class="container">
            <div class="row align-items-center w-100">
                <!-- Left: Logo -->
                <div class="col-4 align-items-center">
                    <a href="javascript:void(0)" data-bs-toggle="offcanvas" data-bs-target="#mobileMenu"
                        aria-controls="mobileMenu">
                        <i class="bi bi-list fs-4 primary-color"></i>
                    </a>
                </div>

                <!-- Center: Navigation Menu -->
                <div class="col-4 text-center">
                    <a class="navbar-brand py-0" href="{{ route('home') }}">
                        <img src="{{ asset('images/logo/logo.svg') }}" alt="Logo" width="100">
                    </a>
                </div>

                <!-- Right: Icons/Menu -->
                <div class="col-4 align-items-center d-flex justify-content-end px-0">
                    <a class="nav-link text-uppercase primary-font-size fw-400 pe-2" href="javascript:void(0)"
                        data-bs-toggle="offcanvas" data-bs-target="#searchCanvas" aria-controls="search">
                        <i class="bi bi-search fs-6 primary-color"></i>
                    </a>

                    <a class="nav-link px-2" href="javascript:void(0)" data-bs-toggle="offcanvas"
                        data-bs-target="#cart" aria-controls="cart">
                        <div class="position-relative">
                            <i class="bi bi-handbag" aria-hidden="true"></i>
                        </div>
                    </a>

                    <a class="nav-link ps-2 " href="{{ route('wishlist') }}">
                        <div class="position-relative">
                            <i class="bi bi-heart"></i>
                        </div>
                    </a>

                </div>
            </div>
        </div>
    </nav>

    <div class="offcanvas offcanvas-start secondary-bg" tabindex="-1" id="mobileMenu"
        aria-labelledby="mobileMenuLabel">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="mobileMenuLabel">
                <a href="{{ route('home') }}">
                    <img src="{{ asset('images/logo/logo.svg') }}" alt="" class="img-fluid" width="100px">
                </a>
            </h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link text-uppercase fw-400" href="{{ route('new.in') }}">New in</a>
                </li>

                <!-- Apparel Dropdown -->
                <li class="nav-item">
                    <a class="nav-link text-uppercase fw-400 d-flex justify-content-between align-items-center"
                        data-bs-toggle="collapse" href="#apparelDropdownMobile" role="button" aria-expanded="false"
                        aria-controls="apparelDropdownMobile">
                        Apparel
                        <i class="fas fa-chevron-down"></i>
                    </a>
                    <ul class="collapse list-unstyled ms-3" id="apparelDropdownMobile">
                        <li>
                            <a href="{{ route('all-product') }}" class="nav-link fw-400">All Product</a>
                        </li>
                        @foreach ($categories as $category)
                            <li>
                                <a href="{{ route('cat-product', $category->slug) }}" class="nav-link fw-400">
                                    {{ $category->name }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </li>

                <!-- Collection Dropdown -->
                <li class="nav-item">
                    <a class="nav-link text-uppercase fw-400 d-flex justify-content-between align-items-center"
                        data-bs-toggle="collapse" href="#collectionDropdownMobile" role="button"
                        aria-expanded="false" aria-controls="collectionDropdownMobile">
                        Collection
                        <i class="fas fa-chevron-down"></i>
                    </a>
                    <ul class="collapse list-unstyled ms-3" id="collectionDropdownMobile">
                        <li>
                            <a class="nav-link fw-400" href="#">Collection 1</a>
                        </li>
                        <li>
                            <a class="nav-link fw-400" href="#">Collection 2</a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item">
                    <a class="nav-link text-uppercase fw-400" href="{{ route('allblogs') }}">WTS?</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link text-uppercase fw-400" href="{{ route('wishlist') }}">Wishlist</a>
                </li>

                @guest
                    <li class="nav-item">
                        <a class="nav-link text-uppercase fw-400" href="{{ route('login') }}">Login</a>
                    </li>
                @endguest
                @auth
                    <li class="nav-item">
                        <a class="nav-link text-uppercase fw-400" href="{{ route('profile') }}">Profile</a>
                    </li>
                @endauth
            </ul>
        </div>
    </div>


    <div class="offcanvas offcanvas-top secondary-bg w-100 h-100" tabindex="-1" id="searchCanvas"
        aria-labelledby="searchCanvasLabel">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="searchCanvasLabel">Search</h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <form action="{{ route('search.view') }}" method="GET" id="searchForm">
                <div class="position-relative w-100">
                    <div class="input-group">
                        <input type="text" class="form-control" name="query" id="liveSearchInput"
                            placeholder="Search for products..." autocomplete="off" required>
                        <button class="btn primary-bg" type="submit">Search</button>
                    </div>
                    <div id="suggestionBox" class="list-group position-absolute w-100 mt-1 shadow"
                        style="z-index: 1055;"></div>
                </div>
            </form>
        </div>
    </div>

</header>
