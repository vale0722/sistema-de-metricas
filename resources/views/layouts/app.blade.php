<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Workshop métricas</title>

        <link rel="stylesheet" href="https://unpkg.com/buefy/dist/buefy.min.css">
        <!-- Styles -->
        <link href="{{ asset(mix('css/app.css')) }}" rel="stylesheet">
    </head>
    <body>
        <div id="app" class="has-background-info-light columns">
            @include('layouts.__sidebar')
            <div class="container column py-6">
                @yield('content')
            </div>
        </div>
        <script src="{{ asset(mix('js/app.js')) }}"></script>
    </body>
</html>
