<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{config('app.name'),'Assignment'}}</title>

    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" defer></script>
    <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" defer></script>


    <!-- Fonts -->
    <link rel="stylesheet" href="{{asset('/css/app.css')}}">
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <!-- Styles -->
</head>
<body>
@include('Layout.nav')
<div id="app" class="jumbotron content">
    @yield('content')
</div>
</body>
</html>
