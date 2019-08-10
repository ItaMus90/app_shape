<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>App Shapes</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>

<body>
<input type="hidden" id="shapes" name="shapes" value="{{$shapes}}">
    <div class="container-fluid" style="height: 100vh;">
        <div class="row pt-5" style="height: 100%;">
            <div class="col-5">
                <label for="shape1" class=" col-form-label text-md-right">Guess the extent</label>

                <div class="d-inline-flex">
                    <input id="shape1" type="text" class="form-control" name="shape1" >
                    <input type="button" value="Guess"  onclick="App.guess(this);">
                </div>
                <canvas></canvas>
            </div>
            <div class="col-1">

            </div>
            <div class="col-5">
                <label for="shape2" class=" col-form-label text-md-right">Guess the extent</label>
                <div class="d-inline-flex">
                    <input id="shape2" type="text" class="form-control" name="shape2" >
                    <input type="button" value="Guess"  onclick="App.guess(this);">
                </div>

                <canvas></canvas>
            </div>
        </div>


    </div>

    <script src="{{asset('js/app_shapes.js')}}"></script>

</body>
</html>



