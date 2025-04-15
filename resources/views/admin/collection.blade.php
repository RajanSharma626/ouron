@extends('admin.layouts.master')

@section('title', 'Collections')

@section('page_title', 'Collections')

@section('content')
    <div class="page-content">

        <!-- Start Container Fluid -->
        <div class="container-xxl">
            <div class="row">

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

                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center gap-1">
                            <h4 class="card-title flex-grow-1">All Collections List</h4>

                            <a href="{{ route('admin.collection.add') }}" class="btn btn-sm btn-primary">
                                Add Collection
                            </a>

                            {{-- <div class="dropdown">
                                <a href="#" class="dropdown-toggle btn btn-sm btn-outline-light"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                    This Month
                                </a>
                                <div class="dropdown-menu dropdown-menu-end">
                                    <!-- item-->
                                    <a href="#!" class="dropdown-item">Download</a>
                                    <!-- item-->
                                    <a href="#!" class="dropdown-item">Export</a>
                                    <!-- item-->
                                    <a href="#!" class="dropdown-item">Import</a>
                                </div>
                            </div> --}}
                        </div>
                        <div>
                            <div class="table-responsive">
                                <table class="table align-middle mb-0 table-hover table-centered">
                                    <thead class="bg-light-subtle">
                                        <tr>
                                            <th>Logo</th>
                                            <th>Collection</th>
                                            <th>Description</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($collections as $collection)
                                            <tr>

                                                <td>
                                                    <div class="d-flex align-items-center gap-2">
                                                        <div
                                                            class="rounded bg-light avatar-md d-flex align-items-center justify-content-center">
                                                            <img src="{{ asset($collection->image ?? 'assets/images/default-category.png') }}"
                                                                alt="{{ $collection->name }}" class="avatar-md">
                                                        </div>

                                                    </div>

                                                </td>

                                                <td>
                                                    <p class="text-dark fw-medium fs-15 mb-0">{{ $collection->name }}</p>
                                                </td>
                                                <td>{{ $collection->description ?? 'N/A' }}</td>
                                                <td>
                                                    <div class="d-flex gap-2">
                                                        <a href="{{route('collection.edit', $collection->id)}}" class="btn btn-soft-primary btn-sm"><iconify-icon
                                                                icon="solar:pen-2-broken"
                                                                class="align-middle fs-18"></iconify-icon></a>
                                                        <a href="{{ route('collection.delete', $collection->id) }}"
                                                            class="btn btn-soft-danger btn-sm"><iconify-icon
                                                                icon="solar:trash-bin-minimalistic-2-broken"
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
                                    <!-- Previous Button -->
                                    @if ($collections->onFirstPage())
                                        <li class="page-item disabled"><span class="page-link">Previous</span></li>
                                    @else
                                        <li class="page-item">
                                            <a class="page-link" href="{{ $collections->previousPageUrl() }}">Previous</a>
                                        </li>
                                    @endif

                                    <!-- Page Numbers -->
                                    @foreach ($collections->getUrlRange(1, $collections->lastPage()) as $page => $url)
                                        <li class="page-item {{ $page == $collections->currentPage() ? 'active' : '' }}">
                                            <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                                        </li>
                                    @endforeach

                                    <!-- Next Button -->
                                    @if ($collections->hasMorePages())
                                        <li class="page-item">
                                            <a class="page-link" href="{{ $collections->nextPageUrl() }}">Next</a>
                                        </li>
                                    @else
                                        <li class="page-item disabled"><span class="page-link">Next</span></li>
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
