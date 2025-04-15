@extends('admin.layouts.master')

@section('title', 'FAQs')

@section('page_title', 'FAQs')

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
                            <h4 class="card-title flex-grow-1">All FAQs List</h4>
                            <a href="{{ route('admin.faq.add') }}" class="btn btn-sm btn-primary">
                                Add Question
                            </a>
                        </div>
                        <div>
                            <div class="table-responsive">
                                <table class="table align-middle mb-0 table-hover table-centered">
                                    <thead class="bg-light-subtle">
                                        <tr>
                                            <th>Sno.</th>
                                            <th>Question</th>
                                            <th>Answer</th>
                                            <th>Category</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $sno = 1;
                                        @endphp
                                        @foreach ($faqs as $faq)
                                            <tr>
                                                <td>
                                                    {{ $sno }}
                                                </td>

                                                <td>
                                                    {{ $faq->question }}
                                                </td>

                                                <td>
                                                    {{ $faq->answer }}
                                                </td>

                                                <td>
                                                    {{ $faq->category }}
                                                </td>

                                                <td>

                                                <a href="{{ route('admin.faq.edit', $faq->id) }}"
                                                    class="btn btn-soft-primary btn-sm"><iconify-icon
                                                        icon="solar:pen-2-broken"
                                                        class="align-middle fs-18"></iconify-icon></a>
                                                <a href="{{ route('admin.faq.delete', $faq->id) }}"
                                                    onclick="event.preventDefault(); confirmAction('Delete this FAQs?', 'This cannot be undone.', '{{ route('admin.faq.delete', $faq->id) }}')"
                                                    class="btn btn-soft-danger btn-sm"><iconify-icon
                                                        icon="solar:trash-bin-minimalistic-2-broken"
                                                        class="align-middle fs-18"></iconify-icon></a>
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
                                    <!-- Previous Button -->
                                    @if ($faqs->onFirstPage())
                                        <li class="page-item disabled"><span class="page-link">Previous</span></li>
                                    @else
                                        <li class="page-item">
                                            <a class="page-link" href="{{ $faqs->previousPageUrl() }}">Previous</a>
                                        </li>
                                    @endif

                                    <!-- Page Numbers -->
                                    @foreach ($faqs->getUrlRange(1, $faqs->lastPage()) as $page => $url)
                                        <li class="page-item {{ $page == $faqs->currentPage() ? 'active' : '' }}">
                                            <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                                        </li>
                                    @endforeach

                                    <!-- Next Button -->
                                    @if ($faqs->hasMorePages())
                                        <li class="page-item">
                                            <a class="page-link" href="{{ $faqs->nextPageUrl() }}">Next</a>
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
