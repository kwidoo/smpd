<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" >
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>@yield('title') | SMP Doktorāts</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport"> 
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="{{ asset('/css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div class="container-fluid " style="padding:0">
        @include('partials.header')
        @include('partials.partners')
        @include('partials.menu')
        @yield('content')
        @include('partials.footer')
    </div>

    <script src="{{ asset('/js/app.js') }}"></script>  
    
    <script>
        const admin = true;
    </script>    
</body>
</html>
