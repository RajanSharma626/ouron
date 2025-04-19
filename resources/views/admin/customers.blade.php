@extends('admin.layouts.master')

@section('title', 'Customers')

@section('page_title', 'Customers')

@section('content')
    <div class="page-content">

        <!-- Start Container Fluid -->
        <div class="container-xxl">

            <div class="row">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="d-flex card-header justify-content-between align-items-center">
                            <div>
                                <h4 class="card-title">All Customers List</h4>
                            </div>

                        </div>
                        <div>
                            <div class="table-responsive">
                                <table class="table align-middle mb-0 table-hover table-centered">
                                    <thead class="bg-light-subtle">
                                        <tr>

                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Phone</th>
                                            <th>Address</th>
                                            <th>Join at</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @foreach ($customers as $customer)
                                            <tr>
                                                <td>{{ $customer->name }}</td>
                                                <td>{{ $customer->email ?? 'N/A' }}</td>
                                                <td>{{ $customer->phone }}</td>
                                                <td>{{ $customer->defaultAddress ? $customer->defaultAddress->address . " " . $customer->defaultAddress->address_2 . ", " . $customer->defaultAddress->city. ", " . $customer->defaultAddress->state. ", " . $customer->defaultAddress->pin_code : 'N/A' }}</td>
                                                <td>{{ $customer->created_at->diffForHumans() }}</td>

                                                <td>
                                                    <div class="d-flex gap-2">
                                                        <a href="#!" class="btn btn-light btn-sm"><iconify-icon
                                                                icon="solar:eye-broken"
                                                                class="align-middle fs-18"></iconify-icon></a>
                                                    </div>
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
                                    @if ($customers->onFirstPage())
                                        <li class="page-item disabled">
                                            <span class="page-link">Previous</span>
                                        </li>
                                    @else
                                        <li class="page-item">
                                            <a class="page-link" href="{{ $customers->previousPageUrl() }}">Previous</a>
                                        </li>
                                    @endif

                                    @foreach ($customers->getUrlRange(1, $customers->lastPage()) as $page => $url)
                                        <li class="page-item {{ $customers->currentPage() == $page ? 'active' : '' }}">
                                            <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                                        </li>
                                    @endforeach

                                    @if ($customers->hasMorePages())
                                        <li class="page-item">
                                            <a class="page-link" href="{{ $customers->nextPageUrl() }}">Next</a>
                                        </li>
                                    @else
                                        <li class="page-item disabled">
                                            <span class="page-link">Next</span>
                                        </li>
                                    @endif
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>

            </div>

        </div>
        <!-- End Container Fluid -->

        <!-- ========== Footer Start ========== -->
        @include('admin.layouts.footer')
        <!-- ========== Footer End ========== -->

    </div>
@endsection
