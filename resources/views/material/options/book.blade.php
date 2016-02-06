<div class="form-padding">
    {!! Form::label('book', 'Text Book:') !!}
    {!! Form::select('book[]', $books, $previous, ['id' => 'book', 'class' => 'form-control', 'multiple']) !!}

    {!! Form::label('page', 'What page of the book?') !!}
    {!! Form::text('page', null, ['class' => 'form-control']) !!}
</div>