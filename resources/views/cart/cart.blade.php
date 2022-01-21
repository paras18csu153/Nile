@extends('layouts.app')

@section('style')
<link href="{{ asset('css/cart.css') }}" rel="stylesheet">
@endsection

@section('content')
    @if($products && count($products) > 0)
    <div class="row no-margin">
        <form class="col-md-10 col-md-offset-1" method="GET" action="/p/all">
            <select onchange="this.form.submit()" class="pad" name="sort_price" aria-label="Default select example">
                <option value="">Sort By Price</option>
                <option value="ASC">Price Low to High</option>
                <option value="DESC">Price High to Low</option>
            </select>
        </form>
    </div>

    @foreach($products as $product)
    <div class="row products">
        <div class="col-md-6 productsImages">
            <img id="dummy" src="/storage/{{ $product->image }}" alt="ProductImage.jpg" draggable="false">
        </div>
        <div class="col-md-6 productsText">
            <h2>{{ $product->name }}</h2>
            <h4>{{ $product->description }}</h4>
            <h6>{{ $product->quantity }} left</h6>
            <h6>₹ {{ $product->price }}</h6>
            <form action="/cart/product" method="POST">
            {{ csrf_field() }}
                <input type="hidden" name="type" id="type" value="">
                <input type="hidden" name="id" value="{{ $product->id }}">
                <button type="submit" onclick="setType('SUB')"><img src="{{ asset('images/svgs/sub.svg') }}" alt=""></button>
                <input id="quantity" type="text" value="{{$product['pivot']['quantity']}}" disabled>
                <button type="submit" onclick="setType('ADD')"><img src="{{ asset('images/svgs/add.svg') }}" alt=""></button>
            </form>
        </div>
    </div>
    @endforeach

    <form class="col-md-10 col-md-offset-1" action="/checkout" method="POST">
    {{ csrf_field() }}
        <input type="hidden" name="products" value="{{ $products }}">
        <button class="pad btn-primary" id="checkout" type="submit">Checkout</button>
    </form>
    
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

    function setType(i){
        var input = document.getElementById('type');
        input.setAttribute('value', i);
    }
</script>
@endsection