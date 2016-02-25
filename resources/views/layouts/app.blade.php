<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@section('title') Materials Share @show</title>
    @section('meta_keywords')
        <meta name="keywords"
              content="ELT, TESOL, Resources, English teaching, Materials, Teaching aids, share teaching materials, share teaching aids, TEFL resources"/>
    @show @section('meta_author')
        <meta name="author" content="Nicholas R Barooah"/>
    @show @section('meta_description')
        <meta name="description"
              content="ELT Tefl teaching materials resources, create, save, share teaching aids"/>
    @show

    <link href="{{ asset('css/site.css') }}" rel="stylesheet">
    {{--<script src="{{ asset('js/site.js') }}"></script>--}}
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
<body>

@include('partials.nav')


<div class="container">

    @include('partials.notifications')


    @yield('content')
</div>

@unless (Request::is('home') ? 'active' : '')

@include('partials.footer')

@endif

        <!-- Scripts -->
@yield('scripts')

        <!-- Go to www.addthis.com/dashboard to customize your tools -->
<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-56a36cca3e6619f4"
        async="async"></script>

</body>
</html>
