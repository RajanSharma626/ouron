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
                                           
                                            <th>Product Name</th>
                                            <th>Wishlist</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @foreach ($wishlistData as $wishlist)
                                            <tr>
                                    
                                                <td>
                                                    <div class="d-flex align-items-center gap-2">
                                                        <div
                                                            class="rounded bg-light avatar-md d-flex align-items-center justify-content-center">

                                                            <img src="{{ asset($wishlist->product_image) }}"
                                                                alt="" class="avatar-md">

                                                        </div>
                                                        <div>
                                                            <a href="#!"
                                                                class="text-dark fw-medium fs-15">{{ $wishlist->name }}</a>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <span
                                                        class="text-dark fw-medium">{{ $wishlist->total_wishlist_count }}</span>
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
                                    @if ($wishlistData->onFirstPage())
                                        <li class="page-item disabled"><span class="page-link">Previous</span></li>
                                    @else
                                        <li class="page-item">
                                            <a class="page-link" href="{{ $wishlistData->previousPageUrl() }}">Previous</a>
                                        </li>
                                    @endif

                                    <!-- Page Numbers -->
                                    @foreach ($wishlistData->getUrlRange(1, $wishlistData->lastPage()) as $page => $url)
                                        <li class="page-item {{ $page == $wishlistData->currentPage() ? 'active' : '' }}">
                                            <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                                        </li>
                                    @endforeach

                                    <!-- Next Button -->
                                    @if ($wishlistData->hasMorePages())
                                        <li class="page-item">
                                            <a class="page-link" href="{{ $wishlistData->nextPageUrl() }}">Next</a>
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
