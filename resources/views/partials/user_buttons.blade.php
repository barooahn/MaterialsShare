<div class="user_buttons">
    @if(Auth::user())

        @include('partials.rate')


        @if(Auth::user()->id == $material->user_id)

            <div class="delete">
                {!! Form::open([
                    'method' => 'DELETE',
                    'route' => ['material.destroy', $material->id]
                ]) !!}
                {!! Form::submit('Delete', ['class' => 'btn btn-danger user_button form-control']) !!}
                {!! Form::close() !!}

            </div>


            <div class="edit">
                <a href="{{ route('material/edit_options', $material->id) }}"
                   class="btn btn-warning user_button form-control">Edit</a>
            </div>



            @include('partials.private')



        @elseif($material->liked())

            <div>
                <a class="btn btn-info user_button form-control"
                   href="{{ URL::route('addLike', array('material' => $material)) }}">Remove</a>

            </div>

        @else
            <div>
                <a class="btn btn-success user_button form-control"
                   href="{{ URL::route('addLike', array('material' => $material)) }}">Save</a>


            </div>
        @endif



    @endif

</div>