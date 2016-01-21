<div class="form-padding">
    {!! Form::label('language_focus', 'Language Focus:', array('class' => 'white_text')) !!}
    {!! Form::select('language_focus[]', $language_focuses, $previous, ['id' => 'language_focus',
        'class' => 'form-control', 'multiple']) !!}
</div>