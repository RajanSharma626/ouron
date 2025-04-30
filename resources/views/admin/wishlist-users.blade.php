@extends('admin.layouts.master')

@section('title', 'Liked Users')

@section('page_title', 'Liked Users')

@section('content')
    <div class="page-content">

        <!-- Start Container Fluid -->
        <div class="container-xxl">

            <div class="row">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="d-flex card-header justify-content-between align-items-center">
                            <div>
                                <h4 class="card-title">Users List</h4>
                            </div>
                            <span>

                                <a href="{{ route('admin.wishlist') }}" class="btn btn-sm btn-outline-primary">
                                   Back
                                </a>

                                <a href="{{ route('wishlist.csv.download', $id) }}" class="btn btn-sm btn-primary">
                                    Download CSV
                                </a>
                            </span>

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
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @foreach ($users as $user)
                                            <tr>
                                                <td>{{ $user->name }}</td>
                                                <td>{{ $user->email ?? 'N/A' }}</td>
                                                <td>{{ $user->phone }}</td>
                                                <td>{{ $user->defaultAddress ? $user->defaultAddress->address . ' ' . $user->defaultAddress->address_2 . ', ' . $user->defaultAddress->city . ', ' . $user->defaultAddress->state . ', ' . $user->defaultAddress->pin_code : 'N/A' }}
                                                </td>
                                                <td>{{ $user->created_at->diffForHumans() }}</td>

                                               
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
                                    @if ($users->onFirstPage())
                                        <li class="page-item disabled">
                                            <span class="page-link">Previous</span>
                                        </li>
                                    @else
                                        <li class="page-item">
                                            <a class="page-link" href="{{ $users->previousPageUrl() }}">Previous</a>
                                        </li>
                                    @endif

                                    @foreach ($users->getUrlRange(1, $users->lastPage()) as $page => $url)
                                        <li class="page-item {{ $users->currentPage() == $page ? 'active' : '' }}">
                                            <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                                        </li>
                                    @endforeach

                                    @if ($users->hasMorePages())
                                        <li class="page-item">
                                            <a class="page-link" href="{{ $users->nextPageUrl() }}">Next</a>
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
