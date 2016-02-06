<div class="form_padding">
    {!! Form::label('level', 'Level:') !!}
    {!! Form::select('level[]', $levels, $previous, ['id' => 'level', 'class' => 'form-control', 'multiple']) !!}
</div>