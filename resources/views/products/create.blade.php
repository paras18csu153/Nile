@extends('layouts.app')

@section('style')
<link href="{{ asset('css/createProduct.css') }}" rel="stylesheet">
@endsection

@section('content')
<div class="container">
    <form action="/p" enctype="multipart/form-data" method="POST">
        {{ csrf_field() }}

        <div class="row">
            <div class="col-md-6 col-md-offset-5">
                <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                    <label for="name" class="col-md-4 control-label">Name</label>

                    <input id="name" type="text" class="form-control" name="name" minlength="10" maxlength="100" value="{{ old('name') }}" required autofocus>

                    @if ($errors->has('name'))
                    <span class="help-block">
                        <strong>{{ $errors->first('name') }}</strong>
                    </span>
                    @endif
                </div>
            </div>
        </div>

        <div class="row" id="image-row">
            <div class="col-md-4 col-md-offset-1">
                <label for="image" id="image-label">
                    <div>
                        <img id="dummy" src="{{ asset('images/svgs/dummy.svg') }}" alt="dummy.svg" draggable="false" />
                        <p id="image-p">Add Product Image<p>
                    </div>
                </label>
                <input onchange="loadFile(event)" type="file" name="image" id="image" required/>

                @if ($errors->has('image'))
                <span class="help-block">
                    <strong>{{ $errors->first('image') }}</strong>
                </span>
                @endif
            </div>
            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                            <label for="description" class="col-md-4 control-label">Description</label>

                            <textarea id="description" class="form-control" rows="4" minlength="50" maxlength="65535" name="description" value="{{ old('description') }}"></textarea>

                            @if ($errors->has('description'))
                            <span class="help-block">
                                <strong>{{ $errors->first('description') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group{{ $errors->has('additionalInformation') ? ' has-error' : '' }}">
                            <label for="additionalInformation" class="col-md-5 control-label">Additional Information (If any)</label>

                            <textarea id="additionalInformation" class="form-control" rows="4" name="additionalInformation" value="{{ old('additionalInformation') }}"></textarea>

                            @if ($errors->has('additionalInformation'))
                            <span class="help-block">
                                <strong>{{ $errors->first('additionalInformation') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-4 col-md-offset-1">
                <div class="form-group{{ $errors->has('category') ? ' has-error' : '' }}">
                    <label for="category" class="col-md-4 control-label">Category</label>

                    <select name="category" id="category"  class="form-control" required>
                        <option disabled selected value=""> -- Select a Category -- </option>
                        <option value="Mobile & Accessories">Mobile & Accessories</option>
                        <option value="Personal health, grooming & wellness">Personal health, grooming & wellness</option>
                        <option value="Electronics & accessories">Electronics & accessories</option>
                        <option value="Computers & accessories">Computers & accessories</option>
                        <option value="TVs, Appliances">TVs, Appliances</option>
                        <option value="Women's Fashion">Women's Fashion</option>
                        <option value="Men's Fashion">Men's Fashion</option>
                        <option value="Kid's Fashion">Kid's Fashion</option>
                        <option value="Home & Kitchen">Home & Kitchen</option>
                        <option value="Furniture">Furniture</option>
                        <option value="Grocery & Gourment">Grocery & Gourment</option>
                        <option value="Beauty & Luxury beauty">Beauty & Luxury beauty</option>
                        <option value="Health & household">Health & household</option>
                        <option value="Sports & Fitness">Sports & Fitness</option>
                        <option value="Bags, Wallets & Luggage">Bags, Wallets & Luggage</option>
                        <option value="Toys & Games">Toys & Games</option>
                        <option value="Baby Products">Baby Products</option>
                        <option value="Pet Supplies">Pet Supplies</option>
                        <option value="Car, Motorbike">Car, Motorbike</option>
                        <option value="Industrial & Scientific supplies">Industrial & Scientific supplies</option>
                        <option value="Home & electronics">Home & electronics</option>
                        <option value="Daily essentials">Daily essentials</option>
                        <option value="Books">Books</option>
                        <option value="Video Games">Video Games</option>
                        <option value="Software">Software</option>
                        <option value="Gift Cards">Gift Cards</option>
                    </select>

                    @if ($errors->has('category'))
                    <span class="help-block">
                        <strong>{{ $errors->first('category') }}</strong>
                    </span>
                    @endif
                </div>
            </div>

            <div class="col-md-3">
                <div class="form-group{{ $errors->has('price') ? ' has-error' : '' }}">
                    <label for="price" class="col-md-4 control-label">Price</label>

                    <input id="price" type="number" class="form-control" name="price" value="{{ old('price') }}" required>

                    @if ($errors->has('price'))
                    <span class="help-block">
                        <strong>{{ $errors->first('price') }}</strong>
                    </span>
                    @endif
                </div>
            </div>

            <div class="col-md-3">
                <div class="form-group{{ $errors->has('quantity') ? ' has-error' : '' }}">
                    <label for="quantity" class="col-md-4 control-label">Quantity</label>

                    <input id="quantity" type="number" class="form-control" name="quantity" value="{{ old('quantity') }}" required>

                    @if ($errors->has('quantity'))
                    <span class="help-block">
                        <strong>{{ $errors->first('quantity') }}</strong>
                    </span>
                    @endif
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-5 col-md-offset-1">
                <button id="backToDashboard" type="reset" class="btn btn-primary" onclick="redirectToDashboard()">
                    Back To Dashboard
                </button>
            </div>
            <div class="col-md-5">
                <button id="addProduct" type="submit" class="btn btn-primary">
                    Add Product
                </button>
            </div>
        </div>
    </form>
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