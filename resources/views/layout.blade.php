<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="jquery-3.6.1.min.js"></script>
    <script src="{{ asset('js/multiselect-dropdown.js')}}"></script>
    @vite('resources/css/app.css')
    <title>RANKO</title>
</head>
<body class="bg-[#E5F6FF]">
    @yield('body')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
</body>
</html>