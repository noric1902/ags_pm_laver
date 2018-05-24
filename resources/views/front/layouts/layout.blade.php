<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="crsf-token" content="{{ csrf_token() }}">
    <title>Document</title>
    <link rel="stylesheet" href="{{ mix('/css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/semantic.min.css') }}">
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script>
        window.Laravel = { csrfToken: '{{ csrf_token() }}' }
    </script>
</head>
<body>
    <div id="app">
        @yield('content')
    </div>
    <script src="{{ mix('/js/app.js') }}"></script>
    <script src="{{ asset('js/semantic.min.js') }}"></script>
</body>
</html>