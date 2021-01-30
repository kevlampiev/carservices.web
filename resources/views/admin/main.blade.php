<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <title>@section('title')Админка@show</title>
</head>
<body>
@if (session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{ session('error') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        </button>
    </div>
@endif

<nav class="navbar navbar-expand-lg" style="background-color:limegreen; margin-bottom: 20px;">
    <a class="navbar-brand" href="{{ route('admin.users.index') }}">Users</a>
    <a class="navbar-brand" href="{{ route('admin.services.index') }}">Services</a>
    <a class="navbar-brand" href="{{ route('admin.schedules.index') }}">Schedules</a>

    <a class="navbar-brand" href="{{ route('admin.orders.index') }}">Orders</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

</nav>

@yield('content')

<script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
