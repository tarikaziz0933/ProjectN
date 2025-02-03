@extends('layouts.dashboard')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h3>Product List</h3>
            </div>
            <div class="card-body">
                <table class="table table-striped">
                    <tr>
                        <th>SL</th>
                        <th>Category</th>
                        <th>Subcategory</th>
                        <th>Product Name</th>
                        <th>Price</th>
                        <th>Discount</th>
                        <th>After Discount</th>
                        <th>preview</th>
                        <th>Action</th>
                    </tr>
                    @foreach ($all_products as $key=>$product)
                        <tr>
                            <td>{{ $key+1 }}</td>
                            <td>{{ $product->rel_to_category->category_name }}</td>
                            <td>{{ $product->rel_to_subcategory->subcategory_name }}</td>
                            <td>{{ $product->product_name }}</td>
                            <td>{{ $product->product_price }}</td>
                            <td>{{ $product->discount }}</td>
                            <td>{{ $product->after_discount }}</td>
                            <td><img width="100" src="{{ asset('/uploads/product/preview') }}/{{ $product->preview }}" alt=""></td>
                            <td class="d-flex">
                                <a href="{{ route('inventory', $product->id) }}" class="btn btn-info shadow btn-xs sharp mr-2"><i class="fa fa-archive"></i></a>
                                <a href="#" class="btn btn-danger shadow btn-xs sharp"><i class="fa fa-trash"></i></a>
                            </td>
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
@endsection
