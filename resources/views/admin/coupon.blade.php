@extends('admin.layouts.master')

@section('title', 'Coupons')

@section('page_title', 'Coupons')

@section('content')
    <div class="page-content">

        <!-- Start Container Fluid -->
        <div class="container-xxl">

            <div class="row">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="d-flex card-header justify-content-between align-items-center">
                            <div>
                                <h4 class="card-title">All Coupons List</h4>
                            </div>
                            <div class="dropdown">
                                <a href="{{ route('admin.coupons.add') }}" class="btn btn-sm btn-primary">
                                    Add Coupon
                                </a>
                            </div>
                        </div>
                        <div>
                            <div class="table-responsive">
                                <table class="table align-middle mb-0 table-hover table-centered">
                                    <thead class="bg-light-subtle">
                                        <tr>

                                            <th>Code</th>
                                            <th>Limit</th>
                                            <th>Value</th>
                                            <th>Type</th>
                                            <th>Start Date</th>
                                            <th>End Date</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @foreach ($coupons as $coupon)
                                            <tr>
                                                <td>{{ $coupon->coupon_code }}</td>
                                                <td>{{ $coupon->coupon_limits }}</td>
                                                <td>{{ $coupon->discount_value }}</td>
                                                <td>{{ $coupon->coupon_type }}</td>
                                                <td>{{ $coupon->start_date }}</td>
                                                <td>{{ $coupon->end_date }}</td>
                                                <td>
                                                    @php
                                                        $now = \Carbon\Carbon::now();
                                                        $startDate = \Carbon\Carbon::parse($coupon->start_date);
                                                        $endDate = \Carbon\Carbon::parse($coupon->end_date);
                                                    @endphp

                                                    @if($startDate->gt($now))
                                                        <span class="badge text-warning bg-warning-subtle fs-12">
                                                            <i class="bx bx-time-five"></i>Future
                                                        </span>
                                                    @elseif($endDate->lt($now))
                                                        <span class="badge text-danger bg-danger-subtle fs-12">
                                                            <i class="bx bx-x"></i>Inactive
                                                        </span>
                                                    @else
                                                        <span class="badge text-success bg-success-subtle fs-12">
                                                            <i class="bx bx-check-double"></i>Active
                                                        </span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <div class="d-flex gap-2">
                                                        <a href="#!" class="btn btn-light btn-sm"><iconify-icon
                                                                icon="solar:eye-broken"
                                                                class="align-middle fs-18"></iconify-icon></a>
                                                        <a href="#!" class="btn btn-soft-primary btn-sm"><iconify-icon
                                                                icon="solar:pen-2-broken"
                                                                class="align-middle fs-18"></iconify-icon></a>
                                                        <a href="{{ route('admin.coupons.delete', $coupon->id) }}"
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
                                    <li class="page-item"><a class="page-link" href="javascript:void(0);">Previous</a>
                                    </li>
                                    <li class="page-item active"><a class="page-link" href="javascript:void(0);">1</a>
                                    </li>
                                    <li class="page-item"><a class="page-link" href="javascript:void(0);">2</a></li>
                                    <li class="page-item"><a class="page-link" href="javascript:void(0);">3</a></li>
                                    <li class="page-item"><a class="page-link" href="javascript:void(0);">Next</a></li>
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
