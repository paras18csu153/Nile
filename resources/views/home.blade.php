@extends('layouts.app')

@section('style')
<link href="css/home.css" rel="stylesheet">
@endsection

@section('content')
<div class="container" id="hero-container">
    <!-- Carousel container -->
    <div id="my-pics" class="carousel slide" data-ride="carousel" style="width: 100%;">
            <!-- Indicators -->
            <!-- <ol class="carousel-indicators">
                <li data-target="#my-pics" data-slide-to="0" class="active"></li>
                <li data-target="#my-pics" data-slide-to="1"></li>
                <li data-target="#my-pics" data-slide-to="2"></li>
            </ol> -->

            <!-- Content -->
            <div class="carousel-inner" role="listbox" style="max-width: 100%; max-height: 250px !important;">

                <!-- Slide 1 -->
                <div class="item active">
                    <img src="https://images.unsplash.com/photo-1476044591369-74ee6ac6899c?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxzZWFyY2h8MTZ8fHJhaW58ZW58MHx8MHx8&auto=format&fit=crop&w=500&q=60" alt="Sunset over beach" style="margin: auto;">
                    <!-- <div class="carousel-caption">
                        <h3>Boracay</h3>
                        <p>White Sand Beach.</p>
                    </div> -->
                </div>

                <!-- Slide 2 -->
                <div class="item">
                    <img src="https://images.unsplash.com/photo-1639050642315-6b3ba06a5e59?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxlZGl0b3JpYWwtZmVlZHw0fHx8ZW58MHx8fHw%3D&auto=format&fit=crop&w=4096&q=60" alt="Rob Roy Glacier" style="margin: auto;">
                    <!-- <div class="carousel-caption">
                        <h3>Rob Roy Glacier</h3>
                        <p>You can almost touch it!</p>
                    </div> -->
                </div>

                <!-- Slide 3 -->
                <div class="item">
                    <img src="https://images.unsplash.com/photo-1476044591369-74ee6ac6899c?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxzZWFyY2h8MTZ8fHJhaW58ZW58MHx8MHx8&auto=format&fit=crop&w=500&q=60" alt="Longtail boats at Phi Phi" style="margin: auto;">
                    <!-- <div class="carousel-caption">
                        <h3>Phi Phi</h3>
                        <p>Longtail boats at Phi Phi.</p>
                    </div> -->
                </div>

            </div>

            <!-- Previous/Next controls -->
            <a class="left carousel-control" href="#my-pics" role="button" data-slide="prev">
                <span class="icon-prev" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="right carousel-control" href="#my-pics" role="button" data-slide="next">
                <span class="icon-next" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
    </div>

    <h1>Search Product:</h1>

    <form class="row category" method="GET" action="/p/all">
        <div class="col-md-11">
            <input type="text" placeholder="Search in items posted by you..." class="pad" autocomplete="off"/>
        </div>
        <div class="col-md-1">
            <button type="submit" class="pad" id="btn" onclick="changeAction()">Search</button>
        </div>
    </form>
</div>

<script>
    function changeAction(){
        var text = document.getElementsByClassName('pad')[0].value;
        var form = document.getElementsByClassName('category')[0];
        form.setAttribute('action', '/p/all/'+text);
    }
</script>
@endsection
