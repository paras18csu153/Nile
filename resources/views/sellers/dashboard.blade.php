@extends('layouts.app')

@section('style')
<link href="{{ asset('css/dashboard.css') }}" rel="stylesheet">
@endsection

@section('content')
<div class="container" id="hero-container" style="margin-top: 15%;">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-body" style="background-color: #FAFAFA;">
                    <div class="row">
                        <div class="col-md-6">
                            <button class="hero-btn" onclick="redirectToaddProduct()">Add Product</button>
                        </div>
                        <div class="col-md-6">
                            <button class="hero-btn" onclick="showMyAllProducts()">Show My Products</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function redirectToaddProduct(){
        location.href = '/p';
    }
    function showMyAllProducts(){
        location.href = '/p/all';
    }
</script>
@endsection