@extends('frontend.master')

@section('content')
 <!-- breadcrumb_section - start
            ================================================== -->
            <div class="breadcrumb_section">
                <div class="container">
                    <ul class="breadcrumb_nav ul_li">
                        <li><a href="index.html">Home</a></li>
                        <li>Order Confirmed</li>
                    </ul>
                </div>
            </div>
            <!-- breadcrumb_section - end
            ================================================== -->

            <div class="container">
                <div class="row">
                    <div class="col-lg-8 my-5 m-auto">
                        <div class="card text-center">
                            <div class="card-header bg-success">
                                <h3 class="text-white">Order Confirm Message</h3>
                            </div>
                            <div class="card-body">
                                <p>Thank you Mr/Mrs. {{ session('success') }} for purchasing our product.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

@endsection
