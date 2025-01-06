<!doctype html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    {{--
    <link href="./src/style.css" rel="stylesheet"> --}}
    <title>Digitree</title>
    <link rel="shortcut icon" href="{{ asset('assets/img/favicon.png') }}" type="image/x-icon" />
    @vite('resources/css/app.css')
    @stack('style-frontend')
</head>

<body class="max-w-screen-sm mx-auto bg-white min-h-screen h-fit">
    @yield('konten-frontend')

    @stack('script-frontend')
</body>

</html>
