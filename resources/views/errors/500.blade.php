<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- Title Logo -->
    <link rel="icon" href="{{ asset('images/svgs/icon.svg') }}" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lora&display=swap" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/error.css') }}" rel="stylesheet">

    <title>Nile</title>
</head>
<body>
    <div class="row center">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-body" style="background-color: #FAFAFA;">
                    <div class="row">
                        <div class="col-md-12 exception">
                            <h2>{{ $exception->getStatusCode() }}</h2>
                            <h2 id="dash"> | </h2>
                            <h2>Internal Server Error</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>