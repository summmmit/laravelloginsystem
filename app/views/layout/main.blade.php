<!DOCTYPE html>
<html>
    <head>
        <title>Authentication System</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>

        @if(Session::has('global'))
        <p>{{ Session::get('global') }}</p>
        @endif

        @include('layout.nevigation')
        @yield('content')
    </body>
</html>
