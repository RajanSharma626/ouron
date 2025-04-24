@extends('admin.layouts.master')

@section('title', 'Coupons Create')

@section('page_title', 'Coupons Create')

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
                                <h4 class="card-title">Coupon For</h4>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-12 mb-3">
                                        <label for="for-type" class="form-label text-dark">For?</label>
                                        <select name="for-type" id="for-type" class="form-control" required>
                                            <option value="all" {{ old('for-type') == 'all' ? 'selected' : '' }}>All</option>
                                            <option value="category" {{ old('for-type') == 'category' ? 'selected' : '' }}>Category</option>
                                            <option value="collection" {{ old('for-type') == 'collection' ? 'selected' : '' }}>Collection</option>
                                            <option value="product" {{ old('for-type') == 'product' ? 'selected' : '' }}>Product</option>
                                        </select>
                                    </div>
                                    <div class="col-lg-12 mb-3 d-none" id="category">
                                        <label for="category-select" class="form-label text-dark">Category</label>
                                        <select name="category" id="category-select" class="form-control">
                                            <option value="" selected disabled>- Select -</option>
                                            <option value="" {{ old('category') == 'all' ? 'selected' : '' }}>All</option>
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}" {{ old('category') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-lg-12 mb-3 d-none" id="collection">
                                        <label for="collection-select" class="form-label text-dark">Collection</label>
                                        <select name="collection" id="collection-select" class="form-control">
                                            <option value="" selected disabled>- Select -</option>
                                            <option value="" {{ old('collection') == '' ? 'selected' : '' }}>All</option>
                                            @foreach ($collections as $collection)
                                                <option value="{{ $collection->id }}" {{ old('collection') == $collection->id ? 'selected' : '' }}>{{ $collection->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-lg-12 mb-3 d-none" id="product">
                                        <label for="product-select" class="form-label text-dark">Product</label>
                                        <select name="product" id="product-select" class="form-control">
                                            <option value="" selected disabled>- Select -</option>
                                            <option value="" {{ old('product') == '' ? 'selected' : '' }}>All</option>
                                            @foreach ($products as $product)
                                                <option value="{{ $product->id }}" {{ old('product') == $product->id ? 'selected' : '' }}>{{ $product->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                @error('status')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Date Schedule</h4>
                            </div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <label for="start-date" class="form-label text-dark">Start Date</label>
                                    <input type="date" id="start-date" class="form-control" placeholder="dd-mm-yyyy"
                                        name="start-date" value="{{ old('start-date') }}">
                                    @error('start-date')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="end-date" class="form-label text-dark">End Date</label>
                                    <input type="date" id="end-date" class="form-control" placeholder="dd-mm-yyyy"
                                        name="end-date" value="{{ old('end-date') }}">
                                    @error('end-date')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
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
                                    <div class="col-lg-12">
                                        <div class="mb-3">
                                            <label for="coupons-code" class="form-label">Coupons Code</label>
                                            <input type="text" id="coupons-code" name="coupons-code" class="form-control"
                                                placeholder="Code enter" value="{{ old('coupons-code') }}">
                                            @error('coupons-code')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                </div>
                                <h4 class="card-title mb-3 mt-2">Coupons Types</h4>
                                <div class="row mb-3">
                                    <div class="col-lg-4">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="coupons-type"
                                                id="flexRadioDefault13" value="percentage" {{ old('coupons-type') == 'percentage' ? 'checked' : '' }}>
                                            <label class="form-check-label" for="flexRadioDefault13">
                                                Percentage
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="coupons-type"
                                                id="flexRadioDefault14" value="fixed_amount" {{ old('coupons-type') == 'fixed_amount' ? 'checked' : '' }}>
                                            <label class="form-check-label" for="flexRadioDefault14">
                                                Fixed Amount
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="coupons-type"
                                                id="flexRadioDefault14" value="free_shipping" {{ old('coupons-type') == 'free_shipping' ? 'checked' : '' }}>
                                            <label class="form-check-label" for="flexRadioDefault14">
                                                Fixed Amount
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                @error('coupons-type')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="">
                                            <label for="discount-value" class="form-label">Discount Value</label>
                                            <input type="number" id="discount-value" name="discount-value"
                                                class="form-control" placeholder="value enter" value="{{ old('discount-value') }}">
                                            @error('discount-value')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
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
