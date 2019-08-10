<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>App Shapes</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>

<body>
    <div class="container-fluid" style="height: 100vh;">

        <div class="row pt-5" style="height: 100%;">
            <div class="col-5">
                <label for="shape1" class=" col-form-label text-md-right">Guess the extent</label>

                <input id="shape1" type="text" class="form-control" name="shape1" >
                <canvas id="canvas1"></canvas>
            </div>
            <div class="col-2">

            </div>
            <div class="col-5">
                <label for="shape2" class=" col-form-label text-md-right">Guess the extent</label>

                <input id="shape2" type="text" class="form-control" name="shape2" >
                <canvas id="canvas2"></canvas>
            </div>
        </div>


    </div>

    <script src="{{asset('js/app_shapes.js')}}"></script>
    <script>
        var canvas1 = document.getElementById('canvas1');
        var canvas2 = document.getElementById('canvas2');

        App.draw(canvas1);
        App.draw(canvas2);

    </script>
</body>
</html>



