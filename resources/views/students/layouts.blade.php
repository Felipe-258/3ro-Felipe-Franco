<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laravel 10 CRUD Application Tutorial - AllPHPTricks.com</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
@include('layouts.navigation')
</head>
<body>   

    <div class="container">
        {{-- <h3 class=" mt-3">Laravel 10 CRUD Application Felipe Franco - <a href="https://music.youtube.com/playlist?list=PLrdoby5FrCBDbcYWQjCkZkJSBLY6FBLT5&si=xCs1spLLkTwAwEj2">felipefranco.com</a></h3> --}}
        
            @yield('content')
        <div class="row justify-content-center text-center mt-3">
            <div class="col-md-12">
                {{-- <p>Back to Tutorial: 
                    <a href="https://music.youtube.com/playlist?list=PLrdoby5FrCBDbcYWQjCkZkJSBLY6FBLT5&si=xCs1spLLkTwAwEj2"><strong>Music link</strong></a>
                </p>
                <p>
                    For More Content<a href="https://www.allphptricks.com/"><strong>AllPHPTricks.com</strong></a>
                </p> --}}
            </div>
        </div>
    </div>
    
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
</body>
</html>
