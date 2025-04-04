@extends('admin.layouts.master')

@section('title', 'Products')

@section('page_title', 'Products')

@section('content')
    <div class="page-content">

        <!-- Start Container Fluid -->
        <div class="container-fluid">

            <!-- Start here.... -->

            <div class="row">
                <div class="col-xl-12">
                    @if (session('success'))
                        <div class="col-12">
                            <div class="alert alert-success text-truncate mb-3" role="alert">
                                {{ session('success') }}
                            </div>
                        </div>
                    @endif

                    @if (session('error'))
                        <div class="col-12">
                            <div class="alert alert-danger text-truncate mb-3" role="alert">
                                {{ session('error') }}
                            </div>
                        </div>
                    @endif
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center gap-1">
                            <h4 class="card-title flex-grow-1">Cart Product List</h4>
                        </div>
                        <div>
                            <div class="table-responsive">
                                <table class="table align-middle mb-0 table-hover table-centered">
                                    <thead class="bg-light-subtle">
                                        <tr>
                                        
                                            <th>Product Name & Size</th>
                                            <th>Price</th>
                                            <th>Quantity</th>
                                            <th>Category</th>
                                            <th>User</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @foreach ($cartItems as $cart)
                                            <tr>
                            
                                                <td>
                                                    <div class="d-flex align-items-center gap-2">
                                                        <div
                                                            class="rounded bg-light avatar-md d-flex align-items-center justify-content-center">

                                                            <img src="{{ asset($cart->product->firstimage->img) }}"
                                                                alt="" class="avatar-md">

                                                        </div>
                                                        <div>
                                                            <a href="#!"
                                                                class="text-dark fw-medium fs-15">{{ $cart->product->name }}</a>
                                                            <p class="text-muted mb-0 mt-1 fs-13"><span>Size :
                                                                </span>{{ $cart->size }}
                                                            </p>
                                                        </div>
                                                    </div>

                                                </td>
                                                <td>₹{{ ($cart->product->price - ($cart->product->price * $cart->product->discount_price) / 100) * $cart->quantity }}
                                                </td>
                                                <td>
                                                    <p class="mb-1 text-muted"><span
                                                            class="text-dark fw-medium">{{ $cart->quantity }}
                                                            Item</span> </p>
                                                </td>

                                                <td>
                                                    <p class="mb-1 text-muted"><span
                                                            class="text-dark fw-medium">{{ $cart->product->category->name }}
                                                        </span> </p>
                                                </td>

                                                <td>
                                                    <p class="mb-1 text-muted"><span
                                                            class="text-dark fw-medium">{{ $cart->user->name ?? 'Guest' }}
                                                        </span> </p>
                                                </td>

                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <!-- end table-responsive -->
                        </div>
                        <div class="card-footer border-top">
                            <nav aria-label="Page navigation example">
                                <ul class="pagination justify-content-end mb-0">
                                    <!-- Previous Button -->
                                    @if ($cartItems->onFirstPage())
                                        <li class="page-item disabled"><span class="page-link">Previous</span></li>
                                    @else
                                        <li class="page-item">
                                            <a class="page-link" href="{{ $cartItems->previousPageUrl() }}">Previous</a>
                                        </li>
                                    @endif

                                    <!-- Page Numbers -->
                                    @foreach ($cartItems->getUrlRange(1, $cartItems->lastPage()) as $page => $url)
                                        <li class="page-item {{ $page == $cartItems->currentPage() ? 'active' : '' }}">
                                            <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                                        </li>
                                    @endforeach

                                    <!-- Next Button -->
                                    @if ($cartItems->hasMorePages())
                                        <li class="page-item">
                                            <a class="page-link" href="{{ $cartItems->nextPageUrl() }}">Next</a>
                                        </li>
                                    @else
                                        <li class="page-item disabled"><span class="page-link">Next</span></li>
                                    @endif
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div><!-- end row -->

        </div>
        <!-- End Container Fluid -->

        <!-- ========== Footer Start ========== -->
        @include('admin.layouts.footer')
        <!-- ========== Footer End ========== -->

    </div>
@endsection
