<div class="col-md-3">
    <ul class="nav nav-pills nav-stacked">
        <li role="presentation" class="{{ (Request::is('start_here') ? 'active' : '') }}">
            <a href="{{ URL::to('start_here') }}">How to use Materials Share</a></li>
        <li role="presentation" class="{{ (Request::is('why') ? 'active' : '') }}">
            <a href="{{ URL::to('why') }}">Why are we doing this?</a></li>
        <li role="presentation" class="{{ (Request::is('services') ? 'active' : '') }}">
            <a href="{{ URL::to('services') }}">Values and services</a></li>
        <li role="presentation" class="{{ (Request::is('content') ? 'active' : '') }}">
                <a href="{{ URL::to('content') }}">Examples of our content</a></li>
    </ul>
</div>