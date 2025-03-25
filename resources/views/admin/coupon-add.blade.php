@extends('admin.layouts.master')

@section('title', 'Coupons')

@section('page_title', 'Coupons')

@section('content')
    <div class="page-content">

        <!-- Start Container Fluid -->
        <div class="container-xxl">

            <div class="col-12">
                @if (session('error'))
                    <div class="alert alert-danger text-truncate mb-3" role="alert">
                        {{ session('error') }}
                    </div>
                @endif
            </div>

            <form action="{{ route('admin.coupons.store') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-lg-5">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Coupon Status</h4>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="d-flex gap-2 align-items-center">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="status"
                                                                                                    id="flexRadioDefault9" value="active" checked="">
                                                <label class="form-check-label" for="flexRadioDefault9">
                                                    Active
                                                </label>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="status"
                                                                                            id="flexRadioDefault10" value="inactive">
                                            <label class="form-check-label" for="flexRadioDefault10">
                                                In Active
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="status"
                                                                                            id="flexRadioDefault11" value="future">
                                            <label class="form-check-label" for="flexRadioDefault11">
                                                Future Plan
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Date Schedule</h4>
                            </div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <label for="start-date" class="form-label text-dark">Start Date</label>
                                    <input type="date" id="start-date" class="form-control flatpickr-input active"
                                        placeholder="dd-mm-yyyy" name="start-date">
                                </div>
                                <div class="mb-3">
                                    <label for="end-date" class="form-label text-dark">End Date</label>
                                    <input type="date" id="end-date" class="form-control flatpickr-input active"
                                        placeholder="dd-mm-yyyy" name="end-date">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-7">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Coupon Information</h4>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label for="coupons-code" class="form-label">Coupons Code</label>
                                            <input type="text" id="coupons-code" name="coupons-code" class="form-control"
                                                placeholder="Code enter">
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label for="coupons-limits" class="form-label">Coupons Limits</label>
                                            <input type="number" id="coupons-limits" name="coupons-limits"
                                                class="form-control" placeholder="limits no.">
                                        </div>
                                    </div>
                                </div>
                                <h4 class="card-title mb-3 mt-2">Coupons Types</h4>
                                <div class="row mb-3">
                                    <div class="col-lg-4">
                                        <div class="d-flex gap-2 align-items-center">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="coupons-type"
                                                                                                    id="flexRadioDefault12" value="free_shipping" checked="">
                                                <label class="form-check-label" for="flexRadioDefault12">
                                                    Free Shipping
                                                </label>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="coupons-type"
                                                                                            id="flexRadioDefault13" value="percentage">
                                            <label class="form-check-label" for="flexRadioDefault13">
                                                Percentage
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="coupons-type"
                                                                                            id="flexRadioDefault14" value="fixed">
                                            <label class="form-check-label" for="flexRadioDefault14">
                                                Fixed Amount
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="">
                                            <label for="discount-value" class="form-label">Discount Value</label>
                                            <input type="text" id="discount-value" name="discount-value"
                                                class="form-control" placeholder="value enter">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer border-top">
                                <button type="submit" class="btn btn-primary">Create Coupon</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <!-- End Container Fluid -->

        <!-- ========== Footer Start ========== -->
        @include('admin.layouts.footer')
        <!-- ========== Footer End ========== -->

    </div>
@endsection
