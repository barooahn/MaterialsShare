<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Materials Share: Share Save Teaching Resources</title>
    @section('meta_keywords')
        <meta name="keywords"
              content="ELT, TESOL, Resources, English teaching, Materials, Teaching aids, share teaching materials, share teaching aids, TEFL resources"/>
    @show @section('meta_author')
        <meta name="author" content="Nicholas R Barooah"/>
    @show @section('meta_description')
        <meta name="description"
              content="ELT TEFL teaching materials and resources - create save share teaching aids.  Save your teaching material to the cloud safe and forever.  Never lose another resource again."/>
    @show
    <meta property="og:title" content="Materials Share: Share Save Teaching Resources">
    <meta property="og:url" content="http://materialsshare.com">
    <meta property="og:description" content="ELT TEFL teaching materials and resources - create save share teaching aids.  Save your teaching material to the cloud safe and forever.  Never lose another resource again.">

    <meta name="twitter:title" content="Materials Share: Share Save Teaching Resources">
    <meta name="twitter:description" content="ELT TEFL teaching materials and resources - create save share teaching aids.  Save your teaching material to the cloud safe and forever.  Never lose another resource again.">
    <link href="{{ asset('css/site.css') }}" rel="stylesheet">


@yield('styles')
<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}">
</head>
<body>

@include('partials.nav')
@include('partials.splash')
@include('partials.services')

@include('partials.footer')

<script async="async" src="{{ asset('js/site.js') }}"></script>

<!-- Go to www.addthis.com/dashboard to customize your tools -->
<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-56a36cca3e6619f4"
        async="async"></script>

<script>
    $(document).ready(function () {

//Check to see if the window is top if not then display button
        $(window).scroll(function () {
            if ($(this).scrollTop() > 400) {
                $('.scrollToTop').fadeIn().css('z-index', 20000);

            } else {
                $('.scrollToTop').fadeOut();
            }
        });

//Click event to scroll to top
        $('.scrollToTop').click(function () {
            $('html, body').animate({scrollTop: 0}, 800);
            return false;
        });

    });

</script>
</body>
</html>
