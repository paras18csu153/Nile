<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Nile</title>

        <!-- Title Logo -->
        <link rel="icon" href="images/svgs/home-logo.svg" />

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Lora&display=swap" rel="stylesheet">

        <!-- Styles -->
        <style>
            html, body {
                background-image: url("https://images.unsplash.com/photo-1615529328331-f8917597711f?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxzZWFyY2h8OXx8d2F0ZXJ8ZW58MHx8MHx8&auto=format&fit=crop&w=500&q=60");
                -webkit-background-size: cover;
                -moz-background-size: cover;
                -o-background-size: cover;
                background-size: cover;
                color: #636b6f;
                font-family: 'Lora', serif;
                height: 100vh;
                margin: 0;
                -webkit-user-select: none; /* Safari */
                -ms-user-select: none; /* IE 10 and IE 11 */
                user-select: none; /* Standard syntax */
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .top-left {
                position: absolute;
                left: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 12px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }

            #description{
                font-weight: 900;
                color: #131516;
            }
        </style>

        <!-- JQuery CDN -->
        <script src="https://code.jquery.com/jquery-3.6.0.js"></script>

        <!-- Scripts -->
        <script src="js/welcome.js"></script>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            <div class="top-left links">
                <a href="{{ url('/home') }}">Home</a>
            </div>

            @if (Route::has('login'))
                <div class="top-right links">
                    @if (Auth::check())
                    @else
                        <a href="{{ url('/login') }}">Login</a>
                    @endif
                </div>
            @endif

            <div class="content">
                <div class="title m-b-md">
                    <img src="images/svgs/home-logo.svg" alt="logo.svg" draggable="false">
                </div>

                <div id="description"></div>
            </div>
        </div>
    </body>
</html>
