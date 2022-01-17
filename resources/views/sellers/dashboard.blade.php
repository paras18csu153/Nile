@extends('layouts.app')

@section('style')
<link href="{{ asset('css/dashboard.css') }}" rel="stylesheet">
@endsection

@section('content')
<div class="container" id="hero-container">
    <div class="row hero-buttons">
        <div class="col-md-4">
            <button class="hero-btn" onclick="redirectToaddProduct()">Add Product</button>
        </div>
        <div class="col-md-4">
            <button class="hero-btn">Add Product</button>
        </div>
        <div class="col-md-4">
            <button class="hero-btn">Add Product</button>
        </div>
    </div>
</div>

<script>
    function redirectToaddProduct(){
        location.href = '/p/create';
    }
</script>
@endsection