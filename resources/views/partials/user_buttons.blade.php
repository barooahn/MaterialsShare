<div class="user_buttons">
    @if(Auth::user())
        @if(Auth::user()->id == $material->user_id)

            <div class="delete">
                {!! Form::open([
                    'method' => 'DELETE',
                    'route' => ['material.destroy', $material->id]
                ]) !!}
                {!! Form::submit('Delete', ['class' => 'btn btn-primary user_button']) !!}
                {!! Form::close() !!}

            </div>


            <div class="edit">
                <a href="{{ route('material.edit', $material->id) }}"
                   class="btn btn-danger user_button">Edit</a>
            </div>



            @include('partials.private')



        @elseif($material->liked())

            <div>
                <a class="btn btn-warning user_button"
                   href="{{ URL::route('addLike', array('material' => $material)) }}">Remove</a>

            </div>

        @else
            <div>
                <a class="btn btn-success user_button"
                   href="{{ URL::route('addLike', array('material' => $material)) }}">Save</a>


            </div>
        @endif

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

    @endif

</div>