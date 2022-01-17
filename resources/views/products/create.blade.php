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

                    <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>

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

                            <textarea id="description" class="form-control" rows="4" name="description" value="{{ old('description') }}"></textarea>

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
            <div class="col-md-3 col-md-offset-5">
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
            <div class="col-md-3 col-md-offset-5">
                <button id="backToDashboard" type="reset" class="btn btn-primary" onclick="redirectToDashboard()">
                    Back To Dashboard
                </button>
            </div>
            <div class="col-md-3">
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