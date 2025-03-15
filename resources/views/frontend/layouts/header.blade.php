<header>
    <nav class="navbar sticky-top navbar-expand-lg py-2 secondary-bg">
        <div class="container-fluid px-4">
            <div class="d-flex w-100 justify-content-between align-items-center">
                <!-- Left: Logo -->
                <div class="d-flex align-items-center">
                    <a class="navbar-brand py-0" href="{{route('home')}}">
                        <img src="{{ asset('images/logo/logo.svg') }}" alt="Logo" width="100">
                    </a>
                </div>

                <!-- Center: Navigation Menu -->
                <div class="text-center">
                    <ul class="navbar-nav gap-4 align-items-center d-flex">
                        <li class="nav-item">
                            <a class="nav-link text-uppercase primary-font-size fw-400" href="{{route('new.in')}}">New in</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-uppercase primary-font-size fw-400" href="#">Apparel</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-uppercase primary-font-size fw-400"
                                href="{{ route('all-product') }}">All Product</a>
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
                                    <i class="bi bi-cart3" aria-hidden="true"></i>
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

                                <a class="nav-link d-flex align-items-center" href="{{route('profile')}}" id="profileDropdown">
                                    <span
                                        class="rounded-circle primary-bg text-white d-flex justify-content-center align-items-center"
                                        style="width: 30px; height: 30px;">
                                        {{ $initials }}
                                    </span>
                                </a>
                                {{-- <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="profileDropdown">
                                    <li><a class="dropdown-item text-normal" href="">Profile</a></li>
                                    <li><a class="dropdown-item text-normal" href="">Orders</a></li>
                                    <li>
                                        <hr class="dropdown-divider">
                                    </li>
                                    <li>
                                        <form method="POST" action="{{ route('logout') }}">
                                            @csrf
                                            <button type="submit" class="dropdown-item">Logout</button>
                                        </form>
                                    </li>
                                </ul> --}}
                            </li>
                        @endauth
                    </ul>
                </div>
            </div>
        </div>
    </nav>

</header>
