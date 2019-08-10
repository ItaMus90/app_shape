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

<div class="container-fluid" style="height: 100vh;">

    <div class="row">
        <input id="btn_start" type="button" value="Load Data" onclick="start();">
        <form id="myform" action="/guess" method="GET" style="display: none">
            <button type="submit">Next</button>
        </form>
    </div>

</div>

<script>


    function start() {
        var csrf = document.getElementsByName('csrf-token')[0].getAttribute('content');
        var shapes = {

            0: {

                "shape_name" : "square_1",
                "shape_type_name": "square",
                "params": {
                    "x1": 100,
                    "x2": 20
                },
                "extent": 240

            },

            1: {

                "shape_name" : "square_2",
                "shape_type_name": "square",
                "params": {
                    "x1": 150,
                    "x2": 75
                },
                "extent": 450

            }

        };

        var xhr = new XMLHttpRequest();
        var data = {
            shapes: shapes

        };
        xhr.open('POST','/',true);

        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.setRequestHeader("Content-Type", "application/json");
        xhr.setRequestHeader("X-CSRF-TOKEN", csrf);

        xhr.onreadystatechange = function() {

            if (this.readyState === XMLHttpRequest.DONE && this.status === 200) {

                var res = JSON.parse(xhr.responseText || null);
                var myform = document.getElementById('myform');
                var btn_start = document.getElementById('btn_start');

                if (res.data === "Error"){
                    myform.style.display = "none";
                    btn_start.style.display = "block";
                    alert("Error with data");
                }else{
                    myform.style.display = "block";
                    btn_start.style.display = "none";
                    alert("Success press on Next button")
                }

            }

        }

        xhr.send(JSON.stringify(data));

    }




</script>

</body>
</html>



