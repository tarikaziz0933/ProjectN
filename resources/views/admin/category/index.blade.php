@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-header">
                        <h3>Category List</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('category.marked') }}" method="POST">
                        @csrf
                        <table class="table table-bordered">
                            <tr>
                                <th><input type="checkbox" id="checkAll"> Mark All</th>
                                <th>SL</th>
                                <th>Category Name</th>
                                <th>Added By</th>
                                <th>Image</th>
                                <th>Created At</th>
                                <th>Action</th>
                            </tr>
                            @forelse ($categories as $key => $category)
                                <tr>
                                    <td><input type="checkbox" name="mark[]" value="{{ $category->id }}"></td>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $category->category_name }}</td>
                                    <td>{{ $category->rel_to_user->name }}</td>
                                    <td><img width="100" src="{{ asset('/uploads/category') }}/{{ $category->category_image }}" alt=""></td>
                                    <td>{{ $category->created_at->diffForHumans() }}</td>
                                    <td>
                                        <a href="{{ route('edit.category', $category->id) }}" class="btn btn-success">Edit</a>
                                        <a href="{{ route('delete.category', $category->id) }}"
                                            class="btn btn-danger">Delete</a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center">No Data Found</td>
                                </tr>
                            @endforelse
                            </table>
                            @error('mark')
                                <div>
                                    <strong class="text-danger">{{ $message }}</strong>
                                </div>
                            @enderror

                            @if(App\Models\Category::count() > 0)
                                <button type="submit" class="btn btn-danger">Delete Marked</button>
                            @endif
                    </form>
                    </div>
                </div>

                <div class="card mt-5">
                    <div class="card-header">
                        <h3>Trashed Category List</h3>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <tr>
                                <th>SL</th>
                                <th>Category Name</th>
                                <th>Added By</th>
                                <th>Created At</th>
                                <th>Action</th>
                            </tr>
                            @forelse ($trash_categories as $key => $category)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $category->category_name }}</td>
                                    <td>{{ $category->rel_to_user->name }}</td>
                                    <td>{{ $category->created_at->diffForHumans() }}</td>
                                    <td>
                                        <a href="{{ route('restore.category', $category->id) }}" class="btn btn-success">Restore</a>
                                        <a href="{{ route('permanent.delete.category', $category->id) }}"
                                            class="btn btn-danger">Delete</a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center">No Data Found</td>
                                </tr>
                            @endforelse
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-header">
                        <h3>Add Category</h3>
                    </div>
                    {{-- @if (session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif --}}
                    <div class="card-body">
                        <form action="{{ route('category.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="mt-3">
                                <label for="" class="form-label">Category Name</label>
                                <input type="text" name="category_name" class="form-control">
                                @error('category_name')
                                    <strong class="text-danger">{{ $message }}</strong>
                                @enderror
                            </div>
                            <div class="mt-3">
                                <label for="" class="form-label">Category Image</label>
                                <input type="file" name="category_image" class="form-control">
                                @error('category_image')
                                    <strong class="text-danger">{{ $message }}</strong>
                                @enderror
                            </div>
                            <div class="mt-3">
                                <button type="submit" class="btn btn-danger">Add Category</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('footer_script')
    @if (session('success'))
        <script>
            const Toast = Swal.mixin({
                toast: true,
                position: "top-end",
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.onmouseenter = Swal.stopTimer;
                    toast.onmouseleave = Swal.resumeTimer;
                }
            });
            Toast.fire({
                icon: "success",
                title: "{{ session('success') }}"
            });
        </script>
    @endif

    <script>
        $("#checkAll").click(function(){
            $('input:checkbox').not(this).prop('checked', this.checked);
        });
    </script>
@endsection
