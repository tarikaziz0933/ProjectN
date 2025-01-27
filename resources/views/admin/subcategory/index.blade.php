@extends('layouts.dashboard')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-8">
            <div class="carg">
                <div class="card-header">
                    <h3>Sub Category List</h3>
                </div>
                <div class="card-body">
                    <table class="table table-striped">
                        <tr>
                            <th>SL</th>
                            <th>CAtegory Name</th>
                            <th>Subcatrgory Name</th>
                            <th>Action</th>
                        </tr>
                        @foreach ($subcategories as $key=>$subcategory)
                        <tr>
                            <td>{{ $key+1 }}</td>
                            <td>{{ $subcategory->rel_tocategory->category_name }}</td>
                            <td>{{ $subcategory->subcategory_name }}</td>
                            <td>
                                <a href="#" class="btn btn-primary shadow btn-xs sharp mr-1"><i class="fa fa-pencil"></i></a>
								<a href="#" class="btn btn-danger shadow btn-xs sharp"><i class="fa fa-trash"></i></a>
                            </td>
                        </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="cad">
                <div class="card-header">
                    <h3>Add Subcategory</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('subcategory.store') }}" method="POST">
                        @csrf
                        <div class="mt-3">
                            <select name="category_id" class="form-control">
                                <option value="">-- Select Category --</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mt-3">
                            <label for="">Subcategory Name</label>
                            <input type="text" name="subcategory_name" class="form-control">
                            @if(session('exist'))
                                <strong class="text-danger">{{ session('exist') }}</strong>
                            @endif
                        </div>
                        <div class="mt-3">
                            <button type="submit" class="btn btn-primary">Add Subcategory</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
