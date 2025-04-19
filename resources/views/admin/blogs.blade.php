@extends('admin.layouts.master')

@section('title', 'Blogs')

@section('page_title', 'Blogs')

@section('content')
    <div class="page-content">

        <!-- Start Container Fluid -->
        <div class="container-xxl">
            <div class="d-flex card-header justify-content-between align-items-center py-2">
                <div>
                    <h4 class="card-title">All Blogs List</h4>
                </div>
                <div class="dropdown">
                    <a href="{{ route('admin.blogs.add') }}" class="btn btn-sm btn-primary">
                        Add Blog
                    </a>
                </div>
            </div>
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

                @foreach ($blogs as $blog)
                    <div class="col-xl-3 col-md-6">
                        <div class="card overflow-hidden">
                            <img src="{{ asset($blog->cover_image) }}" alt="Cover Photo" class="img-fluid">
                            <div class="card-body">
                                <p class="mb-2 text-dark fw-semibold fs-15">{{ $blog->title }}</p>
                                <p class="mb-0">{{ $blog->short_desc }}</p>
                                <div class="d-flex align-items-center gap-2 mt-2 mb-1">
                                    <div class="mt-3 d-flex gap-2">

                                        <a href="{{ route('blog.detail', $blog->slug) }}"
                                            class="btn btn-soft-secondary btn-sm"><iconify-icon icon="solar:eye-broken"
                                                class="align-middle fs-18"></iconify-icon></a>

                                        <a href="{{ route('admin.blog.edit', $blog->id) }}"
                                            class="btn btn-soft-primary btn-sm"><iconify-icon icon="solar:pen-2-broken"
                                                class="align-middle fs-18"></iconify-icon></a>

                                        <a href="{{ route('admin.blog.delete', $blog->id) }}"
                                            class="btn btn-soft-danger btn-sm"
                                            onclick="event.preventDefault(); confirmAction('Delete this Blog?', 'This cannot be undone.', '{{ route('admin.blog.delete', $blog->id) }}')"><iconify-icon
                                                icon="solar:trash-bin-minimalistic-2-broken"
                                                class="align-middle fs-18"></iconify-icon></a>

                                        <a href="#" class="btn btn-soft-secondary btn-sm" data-bs-toggle="modal"
                                            data-bs-target="#qrModal{{ $blog->id }}">
                                            <iconify-icon icon="bx:qr" class="align-middle fs-18"></iconify-icon>
                                        </a>

                                        <div class="modal fade" id="qrModal{{ $blog->id }}" tabindex="-1"
                                            aria-labelledby="qrModalLabel{{ $blog->id }}" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="qrModalLabel{{ $blog->id }}">QR
                                                            Code
                                                            for {{ $blog->title }}</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body text-center">
                                                        <img src="{{ asset($blog->qr_code) }}" alt="QR Code" id="qrImage{{ $blog->id }}"
                                                            class="img-fluid" style="padding: 10px;"> <br>
                                                        <a href="#" onclick="downloadQRCode({{ $blog->id }})"
                                                            class="btn btn-primary mt-3 w-100">Download QR</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
        <!-- End Container Fluid -->

        <!-- ========== Footer Start ========== -->
        @include('admin.layouts.footer')
        <!-- ========== Footer End ========== -->

    </div>
@endsection
