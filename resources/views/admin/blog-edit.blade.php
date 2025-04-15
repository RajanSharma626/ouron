@extends('admin.layouts.master')

@section('title', 'Blog Edit')

@section('page_title', 'BLog Edit')

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

            <form action="{{ route('admin.blog.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Blog Details</h4>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="mb-3">
                                            <label for="title" class="form-label">Title</label>
                                            <input type="text" id="title" name="title" class="form-control" value="{{ $blog->title }}"
                                                placeholder="Blog title">
                                            @error('title')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror

                                            <input type="hidden" id="id" name="id" class="form-control"
                                                value="{{ $blog->id }}">

                                        </div>
                                    </div>

                                    <div class="col-lg-4">
                                        <div class="mb-3">
                                            <label for="short_desc" class="form-label">Short Description</label>
                                            <input type="text" id="short_desc" name="short_desc" class="form-control" value="{{ $blog->short_desc }}"
                                                placeholder="Short description">
                                            @error('short_desc')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-lg-4">
                                        <div class="mb-3">
                                            <label for="product_id" class="form-label">Product</label>
                                            <select class="form-control" id="product_id" name="product_id">
                                                <option value="">- Select -</option>
                                                @foreach ($products as $product)
                                                    <option value="{{ $product->id }}" {{ $blog->product_id ==  $product->id ? "selected" : ''}}>{{ $product->name }}</option>
                                                @endforeach
                                            </select>
                                            @error('product_id')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-lg-4">
                                        <div class="mb-3">
                                            <label for="cover_image" class="form-label">Cover Image</label>
                                            <input type="file" id="cover_image" name="cover_image" class="form-control"
                                                placeholder="Cover image">
                                            @error('cover_image')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                            <img src="{{asset($blog->cover_image)}}" alt="" class="img-fluid mt-2" width="100px">
                                        </div>
                                    </div>

                                    <div class="col-lg-4">
                                        <div class="mb-3">
                                            <label for="banner_image" class="form-label">Banner Image</label>
                                            <input type="file" id="banner_image" name="banner_image" class="form-control"
                                                placeholder="Banner image">
                                            @error('banner_image')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                            <img src="{{asset($blog->banner_image)}}" alt="" class="img-fluid mt-2" width="100px">
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <label for="blog_content" class="form-label">Write Blog</label>
                                        <textarea class="form-control bg-light-subtle" id="editorBlog" name="blog_content" rows="7"
                                            placeholder="Write blog..."> {{$blog->blog_content}}</textarea>
                                        @error('blog_content')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer border-top">
                                <div class="row justify-content-end g-2">
                                    <div class="col-lg-2">
                                        <a href="{{ route('admin.blogs') }}" class="btn btn-primary w-100">Cancel</a>
                                    </div>
                                    <div class="col-lg-2">
                                        <button type="submit" class="btn btn-outline-secondary w-100">Update Blog</button>
                                    </div>
                                </div>
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
