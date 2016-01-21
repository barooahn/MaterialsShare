<div class="form_padding">
    {!! Form::label('level', 'Level:', array('class' => 'white_text')) !!}
    {!! Form::select('level[]', $levels, $previous, ['id' => 'level', 'class' => 'form-control', 'multiple']) !!}
</div>