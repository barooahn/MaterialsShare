<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@section('title') Materials Share @show</title>
    @section('meta_keywords')
        <meta name="keywords"
              content="ELT, TESOL, Resources, English teaching, Materials, Teaching aids, share teaching materials, share teaching aids, TEFL resources"/>
    @show @section('meta_author')
        <meta name="author" content="Nicholas R Barooah"/>
    @show @section('meta_description')
        <meta name="description"
              content="ELT TEFL teaching materials and resources - create save share teaching aids"/>
    @show

    <link href="{{ asset('css/site.css') }}" rel="stylesheet">

    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}">

    @yield('styles')
            <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <link rel="shortcut icon" href="{!! asset('assets/site/ico/favicon.ico')  !!} ">
</head>

<body id=@yield('body-id')>
@include('partials.nav_create')

<div class="container">


    @include('partials.notifications')


    @yield('content')
</div>

        <!-- Scripts -->
@yield('scripts')
<script  src="{{ asset('js/site.js') }}"></script>
</body>
</html>
