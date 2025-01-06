<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="Premium Laravel Admin & Dashboard Template" />
    <meta name="author" content="Webonzer" />
    <meta name="base-url" content="{{ url('/') }}">

    <!-- Site Tiltle -->
    <title>Digitree</title>

    <!-- Favicon Icon -->
    <link rel="shortcut icon" href="{{ asset('assets/img/favicon.png') }}" type="image/x-icon" />
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.8/css/dataTables.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.8/css/dataTables.tailwindcss.css">
    {{-- <link rel="stylesheet" href="{{asset('assets/css/dataTables.dataTables.css')}}"> --}}

    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.3/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.9.3/dist/leaflet.js"></script>


    @yield('css')
    @vite('resources/css/app.css')
    <!-- Style Css -->
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">


</head>
