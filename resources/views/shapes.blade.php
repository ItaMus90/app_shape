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

                <input id="shape1" type="text" class="form-control" name="shape1" >
                <input type="button" value="Guess" name="guess1" onclick="guess();">
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

    <script
        src="https://code.jquery.com/jquery-3.4.1.min.js"
        integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
        crossorigin="anonymous"></script>
    <script src="{{asset('js/app_shapes.js')}}"></script>
    <script>
        var canvas1 = document.getElementById('canvas1');
        var canvas2 = document.getElementById('canvas2');

        var x = document.getElementById("shapes").value;
        JSON.parse(x);

        App.draw(canvas1);
        App.draw(canvas2);

        function guess(){

            var guess = document.getElementById('shape1').value;
            var csrf = document.getElementsByName('csrf-token')[0].getAttribute('content');

            if(guess.trim() === "" || isNaN(guess)){

                alert('Invalid input');
                return;

            }


            var xhr = new XMLHttpRequest();
            var data = {
                guess: guess,
                shape_name: "square_1",
                extent: "100"

            };
            xhr.open('POST','/guess',true);

            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xhr.setRequestHeader("Content-Type", "application/json");
            xhr.setRequestHeader("X-CSRF-TOKEN", csrf);

            xhr.onreadystatechange = function() {

                if (this.readyState === XMLHttpRequest.DONE && this.status === 200) {

                        var res = JSON.parse(xhr.responseText || null);
                        console.log("res: " + res.success);
                        //alert result

                }

            }

            xhr.send(JSON.stringify(data));

        }

    </script>
</body>
</html>



