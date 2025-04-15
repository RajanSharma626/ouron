@extends('admin.layouts.master')

@section('title', 'Add FAQs')

@section('page_title', 'Add FAQs')

@section('content')
    <div class="page-content">

        <!-- Start Container Fluid -->
        <div class="container-xxl">
            <div class="row">
                <div class="12">
                    <form action="{{ route('admin.faq.store') }}" method="POST">
                        @csrf
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">General Information</h4>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label for="category-title" class="form-label">Question</label>
                                            <input type="text" name="question" class="form-control"
                                                placeholder="Enter Questions" required>
                                        </div>
                                        @error('questios')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label for="category" class="form-label">Category</label>
                                            <select name="category" class="form-select" required>
                                                <option value="" disabled selected>-Select-</option>
                                                <option value="Product">Product</option>
                                                <option value="Delivery">Delivery</option>
                                                <option value="Order">Order</option>
                                                <option value="Order Received">Order Received</option>
                                                <option value="General">General</option>
                                            </select>
                                        </div>
                                        @error('questios')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="mb-0">
                                            <label for="description" class="form-label">Answer</label>
                                            <textarea class="form-control bg-light-subtle" name="answer" rows="7" placeholder="Answer" required></textarea>
                                        </div>
                                        @error('answer')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="p-3 bg-light mb-3 rounded">
                            <div class="row justify-content-end g-2">
                                <div class="col-lg-2">
                                    <a href="{{ route('admin.faq') }}" class="btn btn-primary w-100">Cancel</a>
                                </div>
                                <div class="col-lg-2">
                                    <button type="submit" href="#!"
                                        class="btn btn-outline-secondary w-100">Create</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

        </div>
        <!-- End Container Fluid -->

        <!-- ========== Footer Start ========== -->
        @include('admin.layouts.footer')
        <!-- ========== Footer End ========== -->

    </div>
@endsection
