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
        <input id="btn_start" type="button" value="Load Data" onclick="Init.start();">
        <form id="myform" action="/guess" method="GET" style="display: none">
            <button type="submit">Next</button>
        </form>
    </div>

</div>

<script src="{{asset('js/init_app.js')}}"></script>

</body>
</html>



