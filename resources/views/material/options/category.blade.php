<div class="form-group">

    {!! Form::label('category', 'What educational institute do you work for?', array('class' => 'white_text')) !!}
    {!! Form::select('category_list[]', $categories, $previous, ['id' => 'category', 'class' => 'form-control', 'multiple']) !!}

</div>