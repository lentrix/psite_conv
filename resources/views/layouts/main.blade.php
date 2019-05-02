<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>PSITE-7 | Regional Convention 2019</title>
    <script src="{{asset('js/jquery.js')}}"></script>
    <link rel="stylesheet" href="{{asset('css/w3.css')}}">
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    <link rel="stylesheet" href="http://localhost/cdn/fontawesome-free-5.8.1-web/css/all.css">
</head>
<body>

    @include('layouts.nav')

    <div class="main-container">

        @include('layouts.err')

        @yield('content')

    </div>

    <footer class="w3-bar w3-black">
        <div style="color: #888; text-align: center">
            PSITE-7 Copyright &copy; 2019. All rights reserved.
        </div>
    </footer>

</body>
</html>
