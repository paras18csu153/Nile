@extends('layouts.app')

@section('style')
<link href="{{ asset('css/viewAllProduct.css') }}" rel="stylesheet">
@endsection

@section('content')
<div class="container">
    @if(Auth::user() && Auth::user()->role != 'SELLER')
    <form class="row category" method="GET" action="/p/all">
        <div class="col-md-11">
            <input type="text" placeholder="Search ..." class="pad" autocomplete="off"/>
        </div>
        <div class="col-md-1">
            <button type="submit" class="pad" id="btn" onclick="changeAction()">Search</button>
        </div>
    </form>
    @endif

    @if($products && $products->total() > 0)
    <div class="row">
        <form class="col-md-12" method="GET" action="/p/all">
            <input type="hidden" name="page" value="{{ app('request')->input('page') }}">
            @if($type == 'ASC')
            <select class="pad" onchange="this.form.submit()" name="sort_price" aria-label="Default select example">
                <option value="">Select</option>
                <option value="ASC" selected>Price Low to High</option>
                <option value="DESC">Price High to Low</option>
            </select>
            @elseif($type)
            <select class="pad" onchange="this.form.submit()" name="sort_price" aria-label="Default select example">
                <option value="">Select</option>
                <option value="ASC">Price Low to High</option>
                <option value="DESC" selected>Price High to Low</option>
            </select>
            @else
            <select class="pad" onchange="this.form.submit()" name="sort_price" aria-label="Default select example">
                <option value="">Select</option>
                <option value="ASC">Price Low to High</option>
                <option value="DESC">Price High to Low</option>
            </select>
            @endif
        </form>
    </div>

    <div class="row">
        <div class="col-md-4">
            <h3>Found {{ $products->total() }} results!!</h3>
        </div>
        <div class="col-md-8" id="paginator">
            {!! $products->render() !!}
        </div>
    </div>
    @foreach($products as $product)
    <div class="row products">
        <div class="col-md-6 productsImages">
            <img id="dummy" src="/storage/{{ $product->image }}" alt="ProductImage.jpg" draggable="false">
        </div>
        <div class="col-md-6 productsText">
            <h2><a href="/p/{{ $product->id }}">{{ $product->name }}</a></h2>
            <h4>{{ $product->description }}</h4>
            <h6>{{ $product->quantity }} left</h6>
            <h6>₹ {{ $product->price }}</h6>
        </div>
    </div>
    @endforeach

    <div class="row">
        <div class="col-md-12" id="bottom-paginator">
            {!! $products->render() !!}
        </div>
    </div>

    @else
    <div id="no-product-image">
        <img src="https://www.plant4u.in/images/no-product-found.png" alt="No Product Image.jpg">
    </div>
    @endif
</div>

<script>
    function sortByPrice(){
        console.log(this);
    }

    function changeAction(){
        var text = document.getElementsByClassName('pad')[0].value;
        var form = document.getElementsByClassName('category')[0];
        form.setAttribute('action', '/p/all/'+text);
    }
</script>
@endsection