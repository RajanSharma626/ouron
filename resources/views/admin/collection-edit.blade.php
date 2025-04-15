@extends('admin.layouts.master')

@section('title', 'Edit Collections')

@section('page_title', 'Edit Collections')

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
            
                <div class="12">
                    <form action="{{ route('collection.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Add Logo</h4>
                            </div>
                            <div class="card-body">
                                <!-- File Upload -->

                                <div class="fallback">
                                    <input name="file" class="form-control" type="file" />
                                </div>
                                @error('file')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror

                                <input type="hidden" name="id" value="{{ old('id', $collections->id) }}">
                                <img src="{{ asset($collections->image) }}" alt="" width="100px">

                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">General Information</h4>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label for="collection-title" class="form-label">Collection Title</label>
                                            <input type="text" name="collection-title" class="form-control"
                                                placeholder="Enter Title" value="{{$collections->name}}" required>
                                        </div>
                                        @error('collection-title')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="mb-0">
                                            <label for="description" class="form-label">Description</label>
                                            <textarea class="form-control bg-light-subtle" name="description"  rows="7" placeholder="Type description"
                                                required>{{$collections->description}}</textarea>
                                        </div>
                                        @error('description')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Meta Options</h4>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label for="meta-title" class="form-label">Meta Title</label>
                                            <input type="text" class="form-control" name="meta-title" value="{{$collections->meta_title}}"
                                                placeholder="Enter Title">
                                        </div>
                                        @error('meta-title')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label for="meta-tag" class="form-label">Meta Tag Keyword</label>
                                            <input type="text" name="meta-tag" class="form-control" value="{{$collections->meta_keywords}}"
                                                placeholder="Enter word">
                                        </div>
                                        @error('meta-tag')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="mb-0">
                                            <label for="description" class="form-label">Description</label>
                                            <textarea class="form-control bg-light-subtle" name="meta-description" rows="4" placeholder="Type description">{{ $collections->meta_description }}</textarea>
                                        </div>

                                        @error('meta-description')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="p-3 bg-light mb-3 rounded">
                            <div class="row justify-content-end g-2">
                                <div class="col-lg-2">
                                    <a href="{{route('admin.collection')}}" class="btn btn-primary w-100">Cancel</a>
                                </div>
                                <div class="col-lg-2">
                                    <button type="submit" class="btn btn-outline-secondary w-100">Save
                                        Change</button>
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
