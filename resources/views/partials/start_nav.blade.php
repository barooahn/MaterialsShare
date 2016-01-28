<div class="col-md-3">
    <ul class="nav nav-pills nav-stacked">
        <li role="presentation" class="{{ (Request::is('start_here') ? 'active' : '') }}">
            <a href="{{ URL::to('start_here') }}">How to use Materials Share</a></li>
        <li role="presentation" class="{{ (Request::is('author') ? 'active' : '') }}">
            <a href="{{ URL::to('author') }}">About the author</a></li>
        <li role="presentation" class="{{ (Request::is('why') ? 'active' : '') }}">
            <a href="{{ URL::to('why') }}">Why are we3 doing this?</a></li>
        <li role="presentation" class="{{ (Request::is('services') ? 'active' : '') }}">
            <a href="{{ URL::to('services') }}">Values and services</a></li>
        <li role="presentation" class="{{ (Request::is('help_you') ? 'active' : '') }}">
            <a href="{{ URL::to('help_you') }}">How can we help you?</a></li>
        <li role="presentation" class="{{ (Request::is('content') ? 'active' : '') }}">
                <a href="{{ URL::to('content') }}">Examples of our content</a></li>
    </ul>
</div>