<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'EmpowerU') }}</title>

    <!-- Scripts -->
    {{-- <script src="{{ asset('js/app.js') }}" defer></script> --}}

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!-- Styles -->
    {{-- <link href="{{ asset('css/app.css') }}" rel="stylesheet"> --}}

    <link rel="stylesheet" href="{{ asset('template/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('template/css/metisMenu.min.css') }}">
    <link rel="stylesheet" href="{{ asset('template/css/timeline.css') }}">
    <link rel="stylesheet" href="{{ asset('template/css/startmin.css') }}">
    <link rel="stylesheet" href="{{ asset('template/css/morris.css') }}">
    <link rel="stylesheet" href="{{ asset('template/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('template/css/custom.css') }}">
</head>
<body>

    <div id="wrapper">
        @include('layouts.sidebar')

        <div id="page-wrapper">
            @yield('content')
        </div>
    </div>

    <script src="{{ asset('template/js/jquery.min.js') }}"></script>
    <script src="{{ asset('template/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('template/js/metisMenu.min.js') }}"></script>
    <script src="{{ asset('template/js/raphael.min.js') }}"></script>
    <script src="{{ asset('template/js/morris.min.js') }}"></script>
    <script src="{{ asset('template/js/morris-data.js') }}"></script>
    <script src="{{ asset('template/js/startmin.js') }}"></script>

</body>
</html>
