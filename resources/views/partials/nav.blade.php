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
            <a class="navbar-brand" href="{{ URL::to('home') }}">Materials Share</a>
        </div>

        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">

                <li class="{{ (Request::is('materials') ? 'active' : '') }}">
                    <a href="{{ URL::to('materials') }}">Materials</a>
                </li>
                @unless (Auth::guest())
                    <li class="{{ (Request::is('create') ? 'active' : '') }}">
                        <a href="{{ URL::to('options') }}">New Material</a>
                    </li>
                @endunless
                <li class="{{ (Request::is('start_here') ? 'active' : '') }}">
                    <a href="{{ URL::to('start_here') }}">Start Here</a>
                </li>
                <li class="{{ (Request::is('contact') ? 'active' : '') }}">
                    <a href="{{ URL::to('contact') }}">Contact</a>
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
                    <li class="{{ (Request::is('auth/login') ? 'active' : '') }}"><a href="{{ URL::to('auth/login') }}"><i
                                    class="fa fa-sign-in"></i> Login</a></li>
                    <li class="{{ (Request::is('auth/register') ? 'active' : '') }}"><a
                                href="{{ URL::to('auth/register') }}">Register</a></li>
                @else
                    <li>
                        <a href="{{ URL::to('admin/user/home') }}"><i
                                    class="fa fa-sign-out"></i> My materials</a>
                    </li>
                    <li>
                        <a href="{{ URL::to('auth/logout') }}"><i class="fa fa-sign-out"></i> Logout</a>
                    </li>

                @endif
            </ul>
        </div>
    </div>
</nav>