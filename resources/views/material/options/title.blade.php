<div>
    {!! Form::label('title', 'Give your material a title:', array('class' => 'white_text')) !!}
    {!! Form::text('title', null, ['class' => 'form-control', 'files' => true, $material->id]) !!}

</div>