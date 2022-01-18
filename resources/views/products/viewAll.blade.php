@extends('layouts.app')

@section('style')
<link href="{{ asset('css/viewAllProduct.css') }}" rel="stylesheet">
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <input type="text" placeholder="Search in items posted by you..." id="search" autocomplete="off"/>
        </div>
    </div>

    <div class="row">
        <form class="col-md-12" method="GET" action="/p/all">
            <select onchange="this.form.submit()" name="sort_price" aria-label="Default select example">
                <option value="">Select</option>
                <option value="ASC">Price Low to High</option>
                <option value="DESC">Price High to Low</option>
            </select>
        </form>
    </div>

    <div class="row">
        <div class="col-md-6">
            <h1>Found {{ $products->total() }} results!!</h1>
        </div>
        <div class="col-md-6" id="paginator">
            {!! $products->render() !!}
        </div>
    </div>
    @foreach($products as $product)
    <div class="row products">
        <div class="col-md-6 productsImages">
            <img id="dummy" src="/storage/{{ $product->image }}" alt="ProductImage.jpg" draggable="false">
        </div>
        <div class="col-md-6 productsText">
            <h2>{{ $product->name }}</h2>
            <h4>{{ $product->description }}</h4>
            <h6>{{ $product->quantity }}</h6>
            <h6>₹ {{ $product->price }}</h6>
        </div>
    </div>
    @endforeach

    <div class="row">
        <div class="col-md-12" id="bottom-paginator">
            {!! $products->render() !!}
        </div>
    </div>
</div>

<script>
    function sortByPrice(){
        console.log(this);
    }
</script>
@endsection