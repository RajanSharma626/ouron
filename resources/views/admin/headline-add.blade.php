@extends('admin.layouts.master')

@section('title', 'Create Headline')

@section('page_title', 'Create Headline')

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

            <form action="{{ route('admin.headline.store') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="d-flex card-header justify-content-between align-items-center">
                                <div>
                                    <h4 class="card-title">Create Headline</h4>
                                </div>
                                <div class="dropdown">
                                    <a href="{{ route('admin.headline') }}" class="btn btn-sm btn-warning">
                                        Back
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-4 col-md-6 col-12">
                                        <div class="mb-3">
                                            <label for="headline" class="form-label">Headline</label>
                                            <input type="text" id="headline" name="headline" class="form-control"
                                                placeholder="Enter headline" value="{{ old('headline') }}" required>
                                            @error('headline')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-lg-4 col-md-6 col-12">
                                        <div class="mb-3">
                                            <label for="coupons-code" class="form-label">Status</label>
                                            <select name="status" class="form-select" id="" required>
                                                <option value="">Select Status</option>
                                                <option value="Active" {{ old('status') == 'Active' ? 'selected' : '' }}>
                                                    Active</option>
                                                <option value="Draft" {{ old('status') == 'Draft' ? 'selected' : '' }}>
                                                    Draft
                                                </option>
                                            </select>
                                            @error('status')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="card-footer border-top">
                                <button type="submit" class="btn btn-primary">Create Headline</button>
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
