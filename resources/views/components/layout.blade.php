<!DOCTYPE html>
<html data-theme="light" lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@picocss/pico@2/css/pico.min.css">
        
        <title>{{ $title }}</title>
    </head>
    <body>
        <script src="https://unpkg.com/htmx.org@1.9.2"></script>
        {{ $slot }}
    </body>
</html>
