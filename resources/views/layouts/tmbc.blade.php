<!doctype html>

<html lang="en">
<head>
    <meta charset="utf-8">

    <title>TMBC - @yield('title')</title>
    <meta name="description" content="Sample TMBC App.">
    <meta name="author" content="Roosevelt Purification">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="stylesheet" href="css/app.css">

</head>

<body>

@yield('content')

<script src="js/app.js"></script>
</body>
</html>
