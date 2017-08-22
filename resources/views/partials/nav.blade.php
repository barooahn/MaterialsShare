<nav class="navbar navbar-default navbar-fixed-top">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                    data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle Navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="{{ URL::to('home') }}" title="Materials Share Home page"><span><img class="img-responsive" src="/img/logo.png" alt="Materials Share - Share teaching material and resources - Logo"></span></a>

        </div>

        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">

                <li class="{{ (Request::is('materials') ? 'active' : '') }}">
                    <a href="{{ URL::to('materials') }}" title="Browse Materials">Materials</a>
                </li>
                @unless (Auth::guest())
                    <li class="{{ (Request::is('create') ? 'active' : '') }}">
                        <a href="{{ URL::to('options') }}" title="Create a new resource">New Material</a>
                    </li>
                @endunless
                <li class="{{ (Request::is('help') ? 'active' : '') }}">
                    <a href="{{ URL::to('help') }}" title="Get help using materials share">Help</a>
                </li>
                <li class="{{ (Request::is('contact') ? 'active' : '') }}">
                    <a href="{{ URL::to('contact') }}" title="Contact Materials Share">Contact</a>
                </li>
                <li>
                    {!! Form::open([
                        'method' => 'GET',
                        'class' => 'navbar-form',
                        'route' => ['search']
                    ]) !!}

                    <div class="input-group">
                        {!! Form::text('material_search', null, ['class' => 'form-control', 'placeholder' => 'Search']) !!}
                    </div>

                    {!! Form::close() !!}

                </li>
            </ul>

            <ul class="nav navbar-nav navbar-right">

                @if (Auth::guest())
                    <li class="{{ (Request::is('auth/login') ? 'active' : '') }}"><a href="{{ URL::to('auth/login') }}" title="Login to Materials Share"><i
                                    class="fa fa-sign-in"></i> Login</a></li>
                    <li class="{{ (Request::is('auth/register') ? 'active' : '') }}" title="Register at Materials Share"><a
                                href="{{ URL::to('auth/register') }}">Register</a></li>
                @else
                    <li>
                        <a href="{{ URL::to('admin/user/home') }}" title="Your Home page at Materials Share"><i
                                    class="fa fa-sign-out"></i> My materials</a>
                    </li>
                    <li>
                        <a href="{{ URL::to('auth/logout') }}"><i class="fa fa-sign-out" title="Sign out of Materials Share"></i> Logout</a>
                    </li>

                @endif
            </ul>
        </div>
    </div>
</nav>