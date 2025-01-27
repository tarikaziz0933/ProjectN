@extends('layouts.dashboard')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-8 m-auto">
                <div class="card">
                    <div class="card-header">
                        <h3>Edit Category</h3>
                    </div>
                    {{-- @if (session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif --}}
                    <div class="card-body">
                        <form action="{{ route('category.update') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="mt-3">
                                <label for="" class="form-label">Category Name</label>
                                <input type="hidden" name="category_id" class="form-control"
                                    value="{{ $category_info->id }}">

                                <input type="text" name="category_name" class="form-control"
                                    value="{{ $category_info->category_name }}">
                                @error('category_name')
                                    <strong class="text-danger">{{ $message }}</strong>
                                @enderror
                            </div>

                            <div class="mt-3">
                                <img id="pic" width="100" src="{{ asset('uploads/category') }}/{{ $category_info->category_image }}" alt="">
                                <input type="file" oninput="pic.src=window.URL.createObjectURL(this.files[0])" name="category_image" class="form-control">
                            </div>
                            <div class="mt-3">
                                <button type="submit" class="btn btn-danger">Update Category</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
