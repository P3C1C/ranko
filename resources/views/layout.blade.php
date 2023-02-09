<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" ></script>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <script src="{{ asset('js/multiselect-dropdown.js') }}"></script>
    @vite('resources/css/app.css')
    <title>RANKO</title>
</head>

<body class="bg-[#e5f6ff] relative">
    @yield('body')
</body>

</html>
