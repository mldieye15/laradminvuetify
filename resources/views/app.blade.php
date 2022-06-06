<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="description" content="Portails de gestion du basket mauritanienne">
    <meta name="author" content="FB RIM">

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('images/logo.jpg') }}" />
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ UtilHelper::getTitle($title  ?? '') }}</title>

    <!-- Styles -->
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@mdi/font@latest/css/materialdesignicons.min.css">

    <!-- Fonts
    <link href="https://fonts.googleapis.com/css?family=Montserrat:300,600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@mdi/font@latest/css/materialdesignicons.min.css">
    <link href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" rel="stylesheet">
-->
    @routes

    <!--    Scripts -->
    <script src="{{ mix('js/app.js') }}" defer></script>
</head>
<body>
    <noscript>
        <strong>We're sorry but this application doesn't work properly without JavaScript enabled. Please enable it to continue.</strong>
      </noscript>
    @inertia
</body>
</html>
