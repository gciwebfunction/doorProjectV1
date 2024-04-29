<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script type="javascript">var $ = require('jquery');</script>
    <script type="javascript" src="{{asset('js/app.js')}}"></script>
    <script type="javascript" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>

    <script src="https://code.jquery.com/ui/1.11.1/jquery-ui.min.js"></script>

</head>
<body class="font-sans antialiased">
@include('layouts.guestnavigation')

<!-- Page Content -->

<main>
    <div style="width:100%; padding:0px; margin:1em 2.5em 4em auto;">
        {{ $slot }}
    </div>
</main>

<div style="padding: 5px; margin: 5px;"></div>

<footer class="d-flex flex-wrap justify-content-between align-items-center py-3 my-4 border-top">
    <p class="col-md-4 mb-0 text-muted">©@php echo date('Y') @endphp GCI, Inc</p>

    <a href="/" class="col-md-4 d-flex align-items-center justify-content-center mb-3 mb-md-0 me-md-auto link-dark text-decoration-none">
        <svg class="bi me-2" width="40" height="32"><use xlink:href="#bootstrap"></use></svg>
    </a>

    <ul class="nav col-md-4 justify-content-end">
        <li class="nav-item"><a href="/" class="nav-link px-2 text-muted">Home</a></li>
        <li class="nav-item"><a href="/dashboard" class="nav-link px-2 text-muted">Dashboard</a></li>
        <li class="nav-item"><a href="/about" class="nav-link px-2 text-muted">About</a></li>
    </ul>
</footer>

<!-- Scripts -->
@include('layouts.script')
</body>
</html>
