<!DOCTYPE html>
<html lang="en">
<head>
    {{--  <meta charset="UTF-8">  --}}
    {{--  <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">  --}}
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Document</title>
    <link rel="stylesheet" href="{{ mix('/css/app.css') }}">
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/semantic.min.js') }}"></script>
    {{--  <script src="https://unpkg.com/nprogress"></script>  --}}
    <script>
        window.Laravel = { csrfToken: '{{ csrf_token() }}' }
    </script>
</head>
<body>
    {{-- {{ $ssr }}
    <script src="{{ asset('js/entry-client.js') }}" type="text/javascript"></script> --}}

        <div id="app"></div>
    
    <script src="{{ mix('/js/app.js') }}"></script>
    <script>
        // semantic
    $(function() {
        $('.ui.dropdown').dropdown();
        $('.ui.checkbox').checkbox();
        $('#show-sidebar').click(function() {
            $('#show-sidebar').show();
            $('.menu.sidebar').sidebar('toggle');
        });
        
        $('#hide-sidebar').click(function() {
            $('#show-sidebar').show();
            $('.menu.sidebar').sidebar('toggle');
        });
    });
    </script>
</body>
</html>