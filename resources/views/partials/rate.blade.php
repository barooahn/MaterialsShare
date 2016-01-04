@if(Auth::user()->id != $material->user_id)

    {!! Form::open(['action' => 'MaterialsController@addStars']) !!}

    <div class="form-group">

        {!! Form::label('stars', 'Rate:') !!}
        {!! Form::text('stars', $stars, [
        'class' => 'form-control rating',
        'data-step' => 0.5,
        'data-stars' => 5,
        'data-min' => 0,
        'data-max' => 5,
        'data-symbol' => '&#xe005;',
        'data-default-caption' => '{rating} hearts',
        'data-star-captions' => '{}'
        ])
        !!}

        {!! Form::hidden('id', $material->id) !!}
    </div>

    <div class="form-group">

        {!! Form::submit('Rate',['class' => 'btn btn-primary btn-large form-control']) !!}

    </div>
    {!! Form::close() !!}

@endif