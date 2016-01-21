<div class="form-padding">
    {!! Form::label('book', 'Text Book:', array('class' => 'white_text')) !!}
    {!! Form::select('book[]', $books, $previous, ['id' => 'book', 'class' => 'form-control', 'multiple']) !!}

    {!! Form::label('page', 'What page of the book?', array('class' => 'white_text')) !!}
    {!! Form::text('page', null, ['class' => 'form-control']) !!}
</div>