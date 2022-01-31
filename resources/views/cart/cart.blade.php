@extends('layouts.app')

@section('style')
<link href="{{ asset('css/cart.css') }}" rel="stylesheet">
@endsection

@section('content')
    @if($products && count($products) > 0)
    <div class="row no-margin">
        <form class="col-md-10 col-md-offset-1" method="GET">
            <select onchange="sorting()" class="pad" name="sort_price" aria-label="Default select example">
                <option value="">Sort By Price</option>
                <option value="ASC">Price Low to High</option>
                <option value="DESC">Price High to Low</option>
            </select>
        </form>
    </div>

    <div class="row no-margin" id="products">
    @foreach($products as $key => $product)
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
                <input type="hidden" name="type" class="type" value="">
                <input type="hidden" name="id" value="{{ $product->id }}">
                <button type="submit" onclick="setType('SUB', {{ $key }})"><img src="{{ asset('images/svgs/sub.svg') }}" alt=""></button>
                <input id="quantity" type="text" value="{{$product['pivot']['quantity']}}" disabled>
                <button type="submit" onclick="setType('ADD', {{ $key }})"><img src="{{ asset('images/svgs/add.svg') }}" alt=""></button>
            </form>
        </div>
    </div>
    @endforeach
    </div>
    <form class="col-md-10 col-md-offset-1" action="/checkout" method="POST">
    {{ csrf_field() }}
        <input type="hidden" name="products" value="{{ $products }}">
        <button class="pad btn-primary" id="checkout" type="submit">Checkout ( ₹ {{ $total }} )</button>
    </form>
    
    @else
    <div id="no-product-image">
        <img src="https://www.plant4u.in/images/no-product-found.png" alt="No Product Image.jpg">
    </div>
    @endif
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    function sortByPrice(){
        console.log(this);
    }

    function changeAction(){
        var text = document.getElementsByClassName('pad')[0].value;
        var form = document.getElementsByClassName('category')[0];
        form.setAttribute('action', '/p/all/'+text);
    }

    function setType(i, e){
        var input = document.getElementsByClassName('type')[e];
        input.setAttribute('value', i);

        $.ajax({
                url: "/cart/product",
                type: "POST",
                success:function (response) {
                    location.reload();
                }
            })
    }

    function sorting(){
        $(document).ready(function(){
            var data = document.getElementsByClassName("pad")[0].value;
            $.ajax({
                url: "/p/all?sort_price=" + data,
                type: "GET",
                success:function (response) {
                    $("#products").empty();
                    console.log(response);

                    display(response);
                }
            })
        });
    }

    function display(response){
        var str = "";
        $.each(response,function(key,product){
                        console.log(key, product);
                        console.log("GTH");
                        str = "<div class='row products'>\
                        <div class='col-md-6 productsImages'>\
        <img id='dummy' src='/storage/" + product["image"] + "' alt='ProductImage.jpg' draggable='false'>\
    </div>\
    <div class='col-md-6 productsText'>\
        <h2>" + product["name"] + "</h2>\
        <h4>" + product["description"] + "</h4>\
        <h6>" + product["quantity"] + " left</h6>\
        <h6>₹ " + product["price"] + " </h6>\
        <form>\
            <input type='hidden' name='type' class='type' value=''>\
            <input type='hidden' name='id' value='" + product["id"] + " '>\
            <button type='submit' onclick='setType('SUB', " + key + " ))'><img src='images/svgs/sub.svg' alt=''></button>\
            <input id='quantity' type='text' value='" + product['pivot']['quantity'] + "' disabled>\
            <button type='submit' onclick='setType('ADD', "+ key +")'><img src='images/svgs/add.svg' alt=''></button>\
        </form>\
        </div>\
</div>";
$('#products').append(str);
                    });
    }
</script>
@endsection