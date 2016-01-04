<div>
    {!! Form::open([
       'route' => ['togglePrivate', $material->id]
   ]) !!}

    @if($material->private == 0)
        {!! Form::submit('Make private', ['class' => 'btn btn-default user_button form-control']) !!}

    @else
        {!! Form::submit('Make public', ['class' => 'btn btn-success user_button form-control']) !!}

    @endif
    {!! Form::hidden('id', $material->id) !!}
    {!! Form::close() !!}

</div>