<!DOCTYPE html>
<html data-theme="light" lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@picocss/pico@2/css/pico.min.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@picocss/pico@2/css/pico.colors.min.css">
        <title>{{ $title }}</title>
    </head>
    <body class="container">
        <style>
            :root {
                --pico-font-size: 90%;
            }
        </style>


        <header>
            <nav>
                <ul>
                    <li><strong>Opis Mock Backend</strong></li>
                </ul>
                <ul>
                    <li><a href="{{ route('course.index') }}">Course</a></li>
                    <li><a href="{{ route('subject.index') }}">Subject</a></li>
                    <li><a href="{{ route('curriculum.index') }}">Curriculum</a></li>
                </ul>
            </nav>
        </header>

        <script src="https://unpkg.com/htmx.org@1.9.2"></script>
        {{ $slot }}
    </body>
</html>
