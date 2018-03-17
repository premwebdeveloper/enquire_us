<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="">
    <title><?= $title; ?></title>
    <meta name="description" content="<?= $meta_description; ?>" />
    <meta name="keywords" content="<?= $meta_keywords; ?>" />


    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <script src="{{ asset('resources/frontend_assets/js/jquery-3.1.1.min.js') }}"></script>
    <script src="{{ asset('resources/frontend_assets/js/bootstrap.min.js') }}"></script>
    <!-- Styles -->
    <link href="{{ asset('resources/frontend_assets/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('resources/frontend_assets/css/custom.css') }}" rel="stylesheet">
    <link href="{{ asset('resources/frontend_assets/css/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('resources/frontend_assets/css/font-awesome.css') }}" rel="stylesheet">

    <link href="{{ asset('resources/frontend_assets/js/nivo-slider/nivo-slider.css') }}" rel="stylesheet">
    <link href="{{ asset('resources/frontend_assets/js/nivo-slider/themes/default/default.css') }}" rel="stylesheet">

    <link href="{{ asset('resources/frontend_assets/css/bootstrap-social.css') }}" rel="stylesheet">
    <link href="{{ asset('resources/frontend_assets/css/bootstrap-checkbox.css') }}" rel="stylesheet">
    <link href="{{ asset('resources/frontend_assets/css/custom_new.css') }}" rel="stylesheet">
    <link href="{{ asset('resources/frontend_assets/css/theme.css') }}" rel="stylesheet">
    <link href="{{ asset('resources/frontend_assets/js/fancybox/jquery.fancybox.css') }}" rel="stylesheet">
    <link href="{{ asset('resources/frontend_assets/js/owlcarousel/assets/owl.carousel.min.css') }}" rel="stylesheet">

    <link href="{{ asset ('resources/frontend_assets/css/validationEngine.jquery.css') }}" rel="stylesheet" />

</head>
<body>
