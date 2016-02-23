<div class="form-group">
    {!! Form::label('language_focus', 'Language Focus:') !!}
    {!! Form::select('language_focus[]', $language_focuses, $previous, ['id' => 'language_focus',
        'class' => 'form-control', 'multiple']) !!}
</div>