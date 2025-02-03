@extends('layouts.dashboard')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-8"></div>
        <div class="col-lg-4">
            <div class="card">
                <div class="card-header">
                    <h3>Add Inventory</h3>
                </div>
                <div class="card-body">
                    <form action="" method="POST">
                        <div class="form-grou">
                            <input type="text" class="form-control" readonly value="{{ $product_info->product_name }}">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
