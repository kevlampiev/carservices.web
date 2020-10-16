<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    @section('styles')
    @endsection

    <title> Автосервисы|@yield('title') </title>
</head>

<body>

<div id="app">
    <App></App>
</div>

<script src="/js/app.js"></script>

@section('scripts')
@endsection

</body>
</html>
