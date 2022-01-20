@extends('layouts.app')

@section('style')
<!-- <link href="{{ asset('css/viewAllProduct.css') }}" rel="stylesheet"> -->
@endsection

@section('content')
    <div class="row">
        <form class="col-md-12" method="GET" action="/p/all">
            <select onchange="this.form.submit()" name="sort_price" aria-label="Default select example">
                <option value="">Select</option>
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
            <h6>{{ $product->quantity }}</h6>
            <h6>₹ {{ $product->price }}</h6>
            <form action="/cart/product" method="POST">
            {{ csrf_field() }}
                <input type="hidden" name="type" id="type" value="">
                <input type="hidden" name="id" value="{{ $product->id }}">
                <button type="submit" onclick="setType('SUB')">minus</button>
                <button>{{$product["pivot"]["quantity"]}}</button>
                <button type="submit" onclick="setType('ADD')">add</button>
            </form>
        </div>
    </div>
    @endforeach

    @if($products && count($products) > 0)
    <form action="/checkout" method="POST">
    {{ csrf_field() }}
    <input type="hidden" name="products" value="{{ $products }}">
    <button type="submit">Checkout</button>
    </form>
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