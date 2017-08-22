<div class="splash">

    <div class="row">

        <div class="col-md-12">
            <h1>Materials Share</h1>

            <h2>Save, share and get feedback on your teaching aids</h2>
            <ul class="selling_points">
                <li><i class="fa fa-check-square-o green fa-lg"></i>   Save materials to the cloud</li>
                <li><i class="fa fa-check-square-o green fa-lg"></i>   Share resources with other teachers</li>
                <li><i class="fa fa-check-square-o green fa-lg"></i>   Find new teaching aids</li>
                <li><i class="fa fa-check-square-o green fa-lg"></i>   Access anywhere with internet</li>
                <li><i class="fa fa-check-square-o green fa-lg"></i>   Access on any device</li>
                <li><i class="fa fa-check-square-o green fa-lg"></i>   Never lose materials again</li>
                <li><i class="fa fa-check-square-o green fa-lg"></i>   TEFL, ESL, English teachers</li>
            </ul>
        </div>
        <div class="col-md-6 col-md-offset-3">
            <div class="save-work">
                <a class="btn btn-success btn-lg save-work-button"
                   href="{{ URL::to('options') }}">Save your work</a>
            </div>
            <div class="search">

                {!! Form::open([
                       'method' => 'GET',
                       'class' => 'splash-search',
                       'route' => ['search']
                   ]) !!}

                    {!! Form::text('Title, Level, Objective etc.', null, ['class' => 'form-control search-box', 'placeholder' => 'Title, level, objective etc.']) !!}

                    <button class="btn btn-success btn-lg search-button" type="submit" value="submit">Search</button>
                {!! Form::close() !!}

            </div>
        </div>
    </div>

</div>