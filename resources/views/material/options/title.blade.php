<div>
    {!! Form::label('title', 'Give your material a title:') !!}
    {!! Form::text('title', null, ['class' => 'form-control', 'files' => true, $material->id]) !!}

</div>