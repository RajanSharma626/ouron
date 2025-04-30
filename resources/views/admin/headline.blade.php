@extends('admin.layouts.master')

@section('title', 'Headlines')

@section('page_title', 'Headlines')

@section('content')
    <div class="page-content">

        <!-- Start Container Fluid -->
        <div class="container-xxl">

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
                        <div class="d-flex card-header justify-content-between align-items-center">
                            <div>
                                <h4 class="card-title">All Headlines List</h4>
                            </div>
                            <div class="dropdown">
                                <a href="{{ route('admin.headline.add') }}" class="btn btn-sm btn-primary">
                                    Add Coupon
                                </a>
                            </div>
                        </div>
                        <div>
                            <div class="table-responsive">
                                <table class="table align-middle mb-0 table-hover table-centered">
                                    <thead class="bg-light-subtle">
                                        <tr>

                                            <th>Sno.</th>
                                            <th>Headline</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $sno = 1;
                                        @endphp
                                        @foreach ($headlines as $headline)
                                            <tr>
                                                <td>{{ $sno }}</td>
                                                <td>{{ $headline->headline }}</td>
                                                <td>
                                                    <div class="form-check form-switch">
                                                        @if ($headline->status == 'Active')
                                                            <span class="badge bg-success">Active</span>
                                                        @else
                                                            <span class="badge bg-secondary">Draft</span>
                                                        @endif
                                                    </div>
                                                </td>

                                                <td>
                                                    <div class="d-flex gap-2">
                                                        <a href="{{ route('admin.headline.edit', $headline->id) }}"
                                                            class="btn btn-soft-primary btn-sm"><iconify-icon
                                                                icon="solar:pen-2-broken"
                                                                class="align-middle fs-18"></iconify-icon></a>
                                                        <a href="{{ route('admin.headline.delete', $headline->id) }}"
                                                            onclick="event.preventDefault(); confirmAction('Delete this Headline?', 'This cannot be undone.', '{{ route('admin.headline.delete', $headline->id) }}')"
                                                            class="btn btn-soft-danger btn-sm"><iconify-icon
                                                                icon="solar:trash-bin-minimalistic-2-broken"
                                                                class="align-middle fs-18"></iconify-icon></a>
                                                    </div>
                                                </td>
                                            </tr>
                                            @php
                                                $sno++;
                                            @endphp
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <!-- end table-responsive -->
                        </div>
                        <div class="card-footer border-top">
                            <nav aria-label="Page navigation example">
                                <ul class="pagination justify-content-end mb-0">
                                    @if ($headlines->onFirstPage())
                                        <li class="page-item disabled">
                                            <a class="page-link" href="javascript:void(0);">Previous</a>
                                        </li>
                                    @else
                                        <li class="page-item">
                                            <a class="page-link" href="{{ $headlines->previousPageUrl() }}">Previous</a>
                                        </li>
                                    @endif

                                    @foreach ($headlines->links()->elements[0] as $page => $url)
                                        @if ($page == $headlines->currentPage())
                                            <li class="page-item active">
                                                <a class="page-link" href="javascript:void(0);">{{ $page }}</a>
                                            </li>
                                        @else
                                            <li class="page-item">
                                                <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                                            </li>
                                        @endif
                                    @endforeach

                                    @if ($headlines->hasMorePages())
                                        <li class="page-item">
                                            <a class="page-link" href="{{ $headlines->nextPageUrl() }}">Next</a>
                                        </li>
                                    @else
                                        <li class="page-item disabled">
                                            <a class="page-link" href="javascript:void(0);">Next</a>
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
