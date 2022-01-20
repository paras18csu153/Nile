@extends('layouts.app')

@section('style')
<link href="{{ asset('css/viewProduct.css') }}" rel="stylesheet">
@endsection

@section('content')
<div class="container" id="hero-container">
    <div>
        <div class="row" id="image-row">
            <div class="col-md-4 col-md-offset-1">
                <label for="dummy" id="image-label">
                <img id="dummy" name="dummy" src="/storage/{{ $product->image }}" alt="dummy.svg" draggable="false" />
                </label>
            </div>

            <div class="col-md-6" id="describe">
                <div class="row">
                    <div class="col-md-12">
                        <div>
                            <label for="name" class="col-md-6 control-label">Name</label>
                            <p id="name" name="name" class="col-md-6">{{ $product->name }}</p>
                        </div>
                    </div>
                </div>
            
                <div class="row">
                    <div class="col-md-12">
                        <div>
                            <label for="description" class="col-md-6 control-label">Description</label>
                            <p id="description" name="description" class="col-md-6">{{ $product->description }}</p>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div>
                            <label for="additionalInformation" class="col-md-6 control-label">Additional Information (If any)</label>
                            <p id="additionalInformation" name="additionalInformation" class="col-md-6">{{ $product->additionalInformation }}</p>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div>
                            <label for="category" class="col-md-6 control-label">Category</label>
                            <p id="category" name="category" class="col-md-6">{{ $product->category }}</p>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div>
                            <label for="price" class="col-md-6 control-label">Price</label>
                            <p id="price" name="price" class="col-md-6">{{ $product->price }}</p>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div>
                            <label for="quantity" class="col-md-6 control-label">Quantity</label>
                            <p id="quantity" name="quantity" class="col-md-6">{{ $product->quantity }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @if(Auth::user()->role != 'SELLER')
        <div class="row">
            <div class="col-md-5 col-md-offset-1">
                <button id="backToDashboard" type="reset" class="btn btn-primary" onclick="redirectToDashboard()">
                    Back To Dashboard
                </button>
            </div>
            <div class="col-md-5">
                <form action="/cart" method="POST">
                {{ csrf_field() }}
                    <input type="hidden" name="quantity" value="1">
                    <input type="hidden" name="id" value="{{ $product->id }}">
                    <button type="submit" class="btn btn-primary">
                        Add To Cart
                    </button>
                </form>
            </div>
        </div>
        @else
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <button id="backToDashboard" type="reset" class="btn btn-primary" onclick="redirectToDashboard()">
                    Back To Dashboard
                </button>
            </div>
        </div>
        @endif
    </div>
</div>

<script>
    var loadFile = function (event) {
        var dummy = document.getElementById("dummy");
        var imageP = document.getElementById("image-p");
        var imgInp = document.getElementById("image");
        const [file] = imgInp.files;
        if (file && file.size < 200000) {
            dummy.src = URL.createObjectURL(file);
            imageP.style.display="none";
        }
    };

    function redirectToDashboard(){
        location.href = '/home';
    }
</script>
@endsection